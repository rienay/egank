<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanMagang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifikasiPengajuan;

class PengajuanMagangController extends Controller
{
    public function index()
    {
        return view('ajukan');
    }

    public function store(Request $request)
    {
        // 1. Validasi Input (Tambah email)
        $validated = $request->validate([
            'nim' => 'required|string|max:20',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'prodi' => 'required|string|max:255',
            'angkatan' => 'required|string|max:4',
            'perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'file_pendukung' => 'required|array|max:5',
            'file_pendukung.*' => 'mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // 2. Proses Upload File
        $filePaths = [];
        if ($request->hasFile('file_pendukung')) {
            foreach ($request->file('file_pendukung') as $file) {
                $path = $file->store('berkas_magang', 'public');
                $filePaths[] = $path;
            }
        }

        // 3. Simpan ke Database
        $pengajuan = PengajuanMagang::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'email' => $request->email,
            'prodi' => $request->prodi,
            'angkatan' => $request->angkatan,
            'perusahaan' => $request->perusahaan,
            'alamat' => $request->alamat,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'file_pendukung' => $filePaths,
        ]);

        // 4. Kirim Email Notifikasi
        Mail::to($request->email)->send(new NotifikasiPengajuan($pengajuan->toArray()));

        // 5. Redirect kembali dengan pesan
        return redirect()->back()->with('success', 'Pengajuan berhasil dikirim! Silakan cek email Anda.');
    }
}