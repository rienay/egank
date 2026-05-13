<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanMagang;
use App\Models\PengajuanSurat;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\NotifikasiPengajuan;

class PengajuanMagangController extends Controller
{
    public function index()
    {
        return view('ajukan');
    }

    public function store(Request $request)
    {
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

        $filePaths = [];
        if ($request->hasFile('file_pendukung')) {
            foreach ($request->file('file_pendukung') as $file) {
                $path = $file->store('berkas_magang', 'public');
                $filePaths[] = $path;
            }
        }

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

        PengajuanSurat::create([
            'mahasiswa_id' => Auth::id(),
            'magang_id' => $pengajuan->id,
            'kode_surat' => null,
            'jenis_surat' => 'Surat Pengantar Magang',
            'keperluan' => 'Pengajuan surat pengantar magang untuk ' . $request->nama,
            'status' => 'pending',
        ]);

        try {
            Mail::to($request->email)->send(new NotifikasiPengajuan($pengajuan->toArray()));
            return redirect()->back()->with('success', 'Pengajuan berhasil dikirim! Silakan cek email Anda.');
        } catch (\Exception $e) {
            return redirect()->back()->with('success', 'Pengajuan berhasil dikirim ke database! Namun notifikasi email gagal terkirim karena sistem email sedang gangguan.');
        }
    }
}