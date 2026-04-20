<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanMagang extends Model
{
    protected $fillable = [
        'nim', 
        'nama', 
        'email',
        'prodi', 
        'angkatan', 
        'perusahaan', 
        'alamat', 
        'tgl_mulai', 
        'tgl_selesai', 
        'file_pendukung', 
        'status',
        'status_magang',
        'keterangan'
    ];

    // Otomatis mengubah data JSON menjadi Array saat ditarik dari database
    protected $casts = [
        'file_pendukung' => 'array',
    ];
}