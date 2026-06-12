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
use App\Mail\SuratDitolak;
use Barryvdh\DomPDF\Facade\Pdf;

class PengajuanSuratController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $query = PengajuanSurat::with(['mahasiswa', 'magang']);
        $statsQuery = PengajuanSurat::query();

        if (!$user || $user->role !== 'admin') {
            $query->where('mahasiswa_id', Auth::id());
            $statsQuery->where('mahasiswa_id', Auth::id());
        }

        $status = request('status');
        if (in_array($status, ['pending', 'disetujui', 'ditolak'], true)) {
            $query->where('status', $status);
        }

        $search = trim((string) request('search', ''));
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nomor_surat', 'like', "%{$search}%")
                  ->orWhere('jenis_surat', 'like', "%{$search}%")
                  ->orWhereHas('magang', function ($magangQuery) use ($search) {
                      $magangQuery->where('nim', 'like', "%{$search}%")
                                  ->orWhere('nama', 'like', "%{$search}%")
                                  ->orWhere('perusahaan', 'like', "%{$search}%")
                                  ->orWhere('prodi', 'like', "%{$search}%");
                  });
            });
        }

        $pengajuans = $query->latest()->paginate(10)->withQueryString();
        $magangList = PengajuanMagang::whereDoesntHave('pengajuanSurats')
                        ->get();
        $total_pending = (clone $statsQuery)->where('status', 'pending')->count();
        $total_disetujui = (clone $statsQuery)->where('status', 'disetujui')->count();
        $total_ditolak = (clone $statsQuery)->where('status', 'ditolak')->count();

        return view('admin.pengajuan_surat.index', compact('pengajuans', 'magangList', 'total_pending', 'total_disetujui', 'total_ditolak'));
    }

    public function create()
    {
        $magangList = PengajuanMagang::whereDoesntHave('pengajuanSurats')
                        ->get();
        
        return view('admin.pengajuan_surat.create', compact('magangList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'magang_id'   => 'nullable|exists:pengajuan_magangs,id',
            'nim'         => 'required|string|max:50',
            'nama'        => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'prodi'       => 'required|string|max:255',
            'angkatan'    => 'required|string|max:4',
            'perusahaan'  => 'required|string|max:255',
            'alamat'      => 'required|string',
            'tgl_mulai'   => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'jenis_surat' => 'required|string',
            'keperluan'   => 'required|string',
        ]);

        if ($request->filled('magang_id')) {
            $magang = PengajuanMagang::findOrFail($request->magang_id);
            $magang->update([
                'nim' => $request->nim,
                'nama' => $request->nama,
                'email' => $request->email,
                'prodi' => $request->prodi,
                'angkatan' => $request->angkatan,
                'perusahaan' => $request->perusahaan,
                'alamat' => $request->alamat,
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_selesai' => $request->tgl_selesai,
                'status' => 'disetujui',
            ]);
        } else {
            $user = \App\Models\User::where('nim', $request->nim)
                                    ->orWhere('email', $request->email)
                                    ->first();
            $userId = $user ? $user->id : null;

            if (!$user) {
                $user = \App\Models\User::create([
                    'name' => $request->nama,
                    'email' => $request->email,
                    'nim' => $request->nim,
                    'prodi' => $request->prodi,
                    'angkatan' => $request->angkatan,
                    'password' => \Illuminate\Support\Facades\Hash::make('password123'),
                    'role' => 'mahasiswa',
                ]);
                $userId = $user->id;
            }

            $magang = PengajuanMagang::create([
                'user_id' => $userId,
                'nim' => $request->nim,
                'nama' => $request->nama,
                'email' => $request->email,
                'prodi' => $request->prodi,
                'angkatan' => $request->angkatan,
                'perusahaan' => $request->perusahaan,
                'alamat' => $request->alamat,
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_selesai' => $request->tgl_selesai,
                'status' => 'disetujui',
                'status_magang' => 'Belum Konfirmasi',
                'file_pendukung' => [],
            ]);
        }

        $nomorSurat = $this->generateNomorSurat();
        
        $pengajuan = PengajuanSurat::create([
            'mahasiswa_id' => $magang->user_id ?? Auth::id(),
            'magang_id'    => $magang->id,
            'kode_surat'   => null,
            'jenis_surat'  => $request->jenis_surat,
            'keperluan'    => $request->keperluan,
            'nomor_surat'  => $nomorSurat,
            'qr_code'      => null,
            'status'       => 'disetujui',
        ]);

        $qrPath = $this->generateQRCode($pengajuan->id);
        $pengajuan->update(['qr_code' => $qrPath]);

        if ($magang->email) {
            try {
                Mail::to($magang->email)->send(new SuratDisetujui($pengajuan));
            } catch (\Exception $e) {
                // Silently ignore email failure
            }
        }

        return redirect()->route('pengajuan_surat.index')
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
        $request->validate([
            'jenis_surat' => 'sometimes|required|string',
            'keperluan'   => 'sometimes|required|string',
            'status'      => 'sometimes|required|in:disetujui,pending,ditolak',
            // Validasi untuk data magang dari form edit
            'nim' => 'sometimes|required|string',
            'nama' => 'sometimes|required|string',
            'email' => 'sometimes|required|email',
            'prodi' => 'sometimes|required|string',
            'angkatan' => 'sometimes|required|string',
            'perusahaan' => 'sometimes|required|string',
            'alamat' => 'sometimes|required|string',
            'tgl_mulai' => 'sometimes|required|date',
            'tgl_selesai' => 'sometimes|required|date',
            'keterangan' => 'nullable|string',
        ]);

        $pengajuan = PengajuanSurat::findOrFail($id);

        // Bagian untuk update data magang dari form edit
        if ($pengajuan->magang && $request->has('nim')) {
            $pengajuan->magang->update($request->only(['nim', 'nama', 'email', 'prodi', 'angkatan', 'perusahaan', 'alamat', 'tgl_mulai', 'tgl_selesai', 'keterangan']));
        }

        $originalStatus = $pengajuan->status;
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

        if ($request->filled('status')) {
            if ($request->status === 'disetujui') {
                if (empty($pengajuan->nomor_surat)) {
                    $updateData['nomor_surat'] = $this->generateNomorSurat();
                }

                if (empty($pengajuan->qr_code)) {
                    $updateData['qr_code'] = $this->generateQRCode($pengajuan->id);
                }

                $updateData['alasan_penolakan'] = null;
                if ($pengajuan->magang) {
                    $pengajuan->magang->update(['status' => 'disetujui']);
                }
            } else {
                if ($pengajuan->qr_code && Storage::disk('public')->exists($pengajuan->qr_code)) {
                    Storage::disk('public')->delete($pengajuan->qr_code);
                }

                $updateData['nomor_surat'] = null;
                $updateData['qr_code'] = null;
                if ($pengajuan->magang) {
                    $pengajuan->magang->update(['status' => $request->status === 'ditolak' ? 'ditolak' : 'Menunggu Validasi']);
                }
            }
        }

        if (!empty($updateData)) {
            $pengajuan->update($updateData);
        }

        if (isset($updateData['status']) && $updateData['status'] !== $originalStatus) {
            $pengajuan->load(['mahasiswa', 'magang']);
            if ($pengajuan->mahasiswa && $pengajuan->mahasiswa->email) {
                try {
                    if ($updateData['status'] === 'disetujui') {
                        Mail::to($pengajuan->mahasiswa->email)->send(new SuratDisetujui($pengajuan));
                    } elseif ($updateData['status'] === 'ditolak') {
                        Mail::to($pengajuan->mahasiswa->email)->send(new SuratDitolak($pengajuan));
                    }
                } catch (\Exception $e) {
                    if (!$request->wantsJson() && !$request->ajax()) {
                        $request->session()->flash('error', 'Status diubah, tapi email notifikasi gagal terkirim (Cek SMTP).');
                    }
                }
            }
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'status' => $pengajuan->status]);
        }

        return redirect()->route('pengajuan_surat.index')->with('success', 'Pengajuan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);

        if ($pengajuan->qr_code && Storage::disk('public')->exists($pengajuan->qr_code)) {
            Storage::disk('public')->delete($pengajuan->qr_code);
        }

        $pengajuan->delete();

        return redirect()->route('pengajuan_surat.index')->with('success', 'Pengajuan berhasil dihapus.');
    }

    public function approve($id)
    {
        $pengajuan = PengajuanSurat::with(['mahasiswa', 'magang'])->findOrFail($id);

        if ($pengajuan->status !== 'disetujui') {
            $nomorSurat = $this->generateNomorSurat();
            $qrPath = $this->generateQRCode($pengajuan->id);

            $pengajuan->update([
                'status' => 'disetujui',
                'nomor_surat' => $nomorSurat,
                'qr_code' => $qrPath,
                'alasan_penolakan' => null,
            ]);

            if ($pengajuan->magang) {
                $pengajuan->magang->update(['status' => 'disetujui']);
            }

            if ($pengajuan->mahasiswa && $pengajuan->mahasiswa->email) {
                try {
                    Mail::to($pengajuan->mahasiswa->email)->send(new SuratDisetujui($pengajuan));
                    return redirect()->back()->with('success', 'Surat berhasil disetujui dan email telah dikirim.');
                } catch (\Exception $e) {
                    return redirect()->back()->with('success', 'Surat disetujui, namun email gagal terkirim (Periksa koneksi SMTP).');
                }
            }
        }

        return redirect()->back()->with('success', 'Surat berhasil disetujui.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate(['alasan_penolakan' => 'required|string']);
        $pengajuan = PengajuanSurat::with(['mahasiswa', 'magang'])->findOrFail($id);

        if ($pengajuan->qr_code && Storage::disk('public')->exists($pengajuan->qr_code)) {
            Storage::disk('public')->delete($pengajuan->qr_code);
        }

        $pengajuan->update([
            'status' => 'ditolak',
            'nomor_surat' => null,
            'qr_code' => null,
            'alasan_penolakan' => $request->alasan_penolakan,
        ]);

        if ($pengajuan->magang) {
            $pengajuan->magang->update(['status' => 'ditolak']);
        }

        if ($pengajuan->mahasiswa && $pengajuan->mahasiswa->email) {
            try {
                Mail::to($pengajuan->mahasiswa->email)->send(new SuratDitolak($pengajuan));
                return redirect()->back()->with('error', 'Surat ditolak dan email telah dikirim.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Surat ditolak, namun email gagal terkirim (Periksa koneksi SMTP).');
            }
        }

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

        if ($pengajuan->magang) {
            $pengajuan->magang->update(['status' => 'Menunggu Validasi']);
        }

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
        
        return $pdf->stream($filename);
    }

    public function validasiQR($id)
    {
        $pengajuan = PengajuanSurat::with(['mahasiswa', 'magang'])->findOrFail($id);
        return view('validasi-surat', compact('pengajuan'));
    }

    private function generateNomorSurat()
    {
        $tahun = Carbon::now()->year;
        
        $lastSurat = PengajuanSurat::whereYear('created_at', $tahun)
                        ->whereNotNull('nomor_surat')
                        ->latest('id')
                        ->first();

        $urut = $lastSurat ? ((int) explode('/', $lastSurat->nomor_surat)[0] + 1) : 1;
        $formattedUrut = str_pad($urut, 4, '0', STR_PAD_LEFT);

        return "{$formattedUrut}/PL.43/PP.02.10/{$tahun}";
    }

    private function generateQRCode($id = null)
    {
        if (!$id) {
            $id = 'temp';
        }

        $url = url('/validasi-surat/' . $id);
        $filename = 'qrcodes/qr_' . $id . '_' . time() . '.svg';
        
        $qrImage = QrCodeFacade::format('svg')->size(200)->margin(1)->generate($url);
        
        Storage::disk('public')->put($filename, $qrImage);
        
        return $filename;
    }
}