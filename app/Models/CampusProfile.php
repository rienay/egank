<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampusProfile extends Model
{
    use HasFactory;

    /**
     * Menghubungkan model ke tabel 'campusprofiles'.
     * Ini penting karena nama tabel tidak menggunakan standar jamak Laravel (campus_profiles).
     */
    protected $table = 'campusprofiles';

    /**
     * Kolom yang dapat diisi secara massal (Mass Assignment).
     * Sesuai dengan kolom yang ada pada migrasi database kamu.
     */
protected $fillable = [
    'kementerian', 'nama_kampus', 'alamat_kampus', 'telepon_kampus', 
    'fax_kampus', 'website', 'email_kampus', 'nama_kontak_person', 
    'telepon_kontak_person', 'jabatan_penandatangan', 'nama_penandatangan', 
    'nip_penandatangan', 'logo_kampus', 'ttd_image', 'stempel_image'
];
}