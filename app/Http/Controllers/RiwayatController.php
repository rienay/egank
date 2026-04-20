<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanMagang;

class RiwayatController extends Controller
{
    // Menampilkan halaman riwayat
    public function index()
    {
        // Mengambil semua data pengajuan, diurutkan dari yang terbaru
        $riwayat = PengajuanMagang::latest()->get();
        return view('riwayat', compact('riwayat'));
    }

    // Mengubah status magang (Mulai / Selesai)
    public function updateStatusMagang(Request $request, $id)
    {
        $pengajuan = PengajuanMagang::findOrFail($id);
        
        // Update status sesuai yang dikirim dari tombol konfirmasi
        $pengajuan->update([
            'status_magang' => $request->status_magang
        ]);

        return redirect()->back()->with('success', 'Status magang berhasil diperbarui!');
    }
}