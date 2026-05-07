<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
use App\Models\PengajuanMagang;
use App\Models\CampusProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QrCodeFacade;
use Carbon\Carbon;
use App\Mail\SuratDisetujui;
use Barryvdh\DomPDF\Facade\Pdf;

class PengajuanSuratController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Untuk Admin, tampilkan semua. Jika mahasiswa, tampilkan miliknya saja.
        if ($user && $user->role === 'admin') {
            $pengajuans = PengajuanSurat::with(['mahasiswa', 'magang'])->latest()->paginate(10);
        } else {
            $pengajuans = PengajuanSurat::where('mahasiswa_id', Auth::id())->with(['mahasiswa', 'magang'])->latest()->paginate(10);
        }
        
        // Ambil data pengajuan magang untuk modal create
        $magangList = PengajuanMagang::where('status', 'disetujui')
                        ->whereDoesntHave('pengajuanSurats')
                        ->get();
        
        // Hitung statistik untuk kartu ringkasan
        $total_pending = PengajuanSurat::where('status', 'pending')->count();
        $total_disetujui = PengajuanSurat::where('status', 'disetujui')->count();
        $total_ditolak = PengajuanSurat::where('status', 'ditolak')->count();

        return view('admin.pengajuan_surat.index', compact('pengajuans', 'magangList', 'total_pending', 'total_disetujui', 'total_ditolak'));
    }

    public function create()
    {
        // Ambil data pengajuan magang yang belum memiliki surat
        $magangList = PengajuanMagang::where('status', 'disetujui')
                        ->whereDoesntHave('pengajuanSurats')
                        ->get();
        
        return view('admin.pengajuan_surat.create', compact('magangList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'magang_id'   => 'required|exists:pengajuan_magangs,id',
            'jenis_surat' => 'required|string',
            'keperluan'   => 'required|string',
        ]);

        // Ambil data magang
        $magang = PengajuanMagang::findOrFail($request->magang_id);

        // Generate nomor surat
        $nomorSurat = $this->generateNomorSurat();

        // Generate QR Code
        $qrPath = $this->generateQRCode();

        // Buat pengajuan surat dengan status langsung disetujui
        $pengajuan = PengajuanSurat::create([
            'mahasiswa_id' => Auth::id(),
            'magang_id'    => $magang->id,
            'kode_surat'   => null,
            'jenis_surat'  => $request->jenis_surat,
            'keperluan'    => $request->keperluan,
            'nomor_surat'  => $nomorSurat,
            'qr_code'      => $qrPath,
            'status'       => 'disetujui',
        ]);

        return redirect()->route('pengajuan_surat.show', $pengajuan->id)
                        ->with('success', 'Surat berhasil dibuat dan auto-generate nomor surat, QR code!');
    }

    public function show($id)
    {
        $pengajuan = PengajuanSurat::with(['mahasiswa', 'magang'])->findOrFail($id);
        return view('admin.pengajuan_surat.show', compact('pengajuan'));
    }

    public function edit($id)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);
        return view('admin.pengajuan_surat.edit', compact('pengajuan'));
    }

    public function update(Request $request, $id)
    {
        // Support updating jenis/keperluan as well as status via AJAX or normal form
        $request->validate([
            'jenis_surat' => 'sometimes|required|string',
            'keperluan'   => 'sometimes|required|string',
            'status'      => 'sometimes|required|in:disetujui,pending,ditolak',
        ]);

        $pengajuan = PengajuanSurat::findOrFail($id);

        $updateData = [];
        if ($request->filled('jenis_surat')) {
            $updateData['jenis_surat'] = $request->jenis_surat;
        }
        if ($request->filled('keperluan')) {
            $updateData['keperluan'] = $request->keperluan;
        }
        if ($request->filled('status')) {
            $updateData['status'] = $request->status;
        }

        if (!empty($updateData)) {
            $pengajuan->update($updateData);
        }

        // If request expects JSON (AJAX status change), return JSON response
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'status' => $pengajuan->status]);
        }

        return redirect()->route('pengajuan_surat.index')->with('success', 'Pengajuan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);

        // Hapus QR Code jika ada
        if ($pengajuan->qr_code && Storage::disk('public')->exists($pengajuan->qr_code)) {
            Storage::disk('public')->delete($pengajuan->qr_code);
        }

        $pengajuan->delete();

        return redirect()->route('pengajuan_surat.index')->with('success', 'Pengajuan berhasil dihapus.');
    }

    public function approve($id)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);

        if ($pengajuan->status !== 'disetujui') {
            $nomorSurat = $this->generateNomorSurat();
            $qrPath = $this->generateQRCode($pengajuan->id);

            $pengajuan->update([
                'status' => 'disetujui',
                'nomor_surat' => $nomorSurat,
                'qr_code' => $qrPath,
                'alasan_penolakan' => null,
            ]);

            // Kirim Email Notifikasi
            if ($pengajuan->mahasiswa) {
                Mail::to($pengajuan->mahasiswa->email)->send(new SuratDisetujui($pengajuan));
            }
        }

        return redirect()->back()->with('success', 'Surat berhasil disetujui.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate(['alasan_penolakan' => 'required|string']);
        $pengajuan = PengajuanSurat::findOrFail($id);

        // Hapus QR Code lama jika ada
        if ($pengajuan->qr_code && Storage::disk('public')->exists($pengajuan->qr_code)) {
            Storage::disk('public')->delete($pengajuan->qr_code);
        }

        $pengajuan->update([
            'status' => 'ditolak',
            'nomor_surat' => null,
            'qr_code' => null,
            'alasan_penolakan' => $request->alasan_penolakan,
        ]);

        return redirect()->back()->with('error', 'Surat ditolak.');
    }

    public function resubmit($id)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);
        $pengajuan->update([
            'status' => 'pending',
            'nomor_surat' => null,
            'alasan_penolakan' => null,
        ]);

        return redirect()->back()->with('success', 'Surat berhasil diajukan ulang.');
    }

    public function downloadPDF($id)
    {
        $pengajuan = PengajuanSurat::with(['mahasiswa', 'magang'])->findOrFail($id);
        
        if ($pengajuan->status !== 'disetujui') {
            return redirect()->back()->with('error', 'Hanya surat yang disetujui yang bisa diunduh.');
        }

        $kampus = CampusProfile::first();
        $verificationText = url('/validasi-surat/' . $pengajuan->id);
        $qrCodeBase64 = base64_encode(QrCodeFacade::format('png')->size(120)->margin(1)->generate($verificationText));

        $pdf = Pdf::loadView('admin.pengajuan_surat.pdf', compact('pengajuan', 'kampus', 'qrCodeBase64'));
        
        $safeJenis = preg_replace('/[^A-Za-z0-9_\-]/', '_', $pengajuan->jenis_surat ?? 'surat');
        $safeNim = $pengajuan->magang?->nim ? preg_replace('/[^A-Za-z0-9_\-]/', '_', $pengajuan->magang->nim) : 'unknown';
        $filename = "Surat_{$safeJenis}_{$safeNim}.pdf";
        
        return $pdf->download($filename);
    }

    public function validasiQR($id)
    {
        $pengajuan = PengajuanSurat::with(['mahasiswa', 'magang'])->findOrFail($id);
        return view('validasi-surat', compact('pengajuan'));
    }

    // ========== HELPER FUNCTIONS ==========

    /**
     * Generate nomor surat otomatis dengan format: 0001/PL.43/PP.02.01/{tahun}
     */
    private function generateNomorSurat()
    {
        $tahun = Carbon::now()->year;
        
        $lastSurat = PengajuanSurat::whereYear('created_at', $tahun)
                        ->whereNotNull('nomor_surat')
                        ->latest('id')
                        ->first();

        $urut = $lastSurat ? ((int) explode('/', $lastSurat->nomor_surat)[0] + 1) : 1;
        $formattedUrut = str_pad($urut, 4, '0', STR_PAD_LEFT);

        return "{$formattedUrut}/PL.43/PP.02.01/{$tahun}";
    }

    /**
     * Generate QR Code untuk validasi surat
     * QR Code berisi: /validasi-surat/{id}
     */
    private function generateQRCode($id = null)
    {
        // Jika belum ada ID, generate sementara (akan update setelah insert)
        if (!$id) {
            // Generate dummy QR untuk mendapatkan path
            $id = 'temp';
        }

        $url = url('/validasi-surat/' . $id);
        $filename = 'qrcodes/qr_' . $id . '_' . time() . '.svg';
        
        $qrImage = QrCodeFacade::format('svg')->size(200)->margin(1)->generate($url);
        
        Storage::disk('public')->put($filename, $qrImage);
        
        return $filename;
    }
}