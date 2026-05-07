<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSurat extends Model
{
    use HasFactory;

    protected $fillable = [
        'mahasiswa_id', 'magang_id', 'kode_surat', 'jenis_surat', 'keperluan',
        'nomor_surat', 'status', 'alasan_penolakan', 'qr_code'
    ];

    /**
     * Relasi ke tabel users (Mahasiswa/Admin yang membuat surat)
     */
    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }

    /**
     * Relasi ke tabel pengajuan_magangs
     */
    public function magang()
    {
        return $this->belongsTo(PengajuanMagang::class, 'magang_id');
    }

    /**
     * Relasi ke tabel campusprofiles
     */
    public function kampus()
    {
        return $this->hasOne(CampusProfile::class);
    }
}