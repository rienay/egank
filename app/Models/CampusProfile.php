<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampusProfile extends Model
{
    use HasFactory;
    protected $table = 'campusprofiles';
protected $fillable = [
    'kementerian', 'nama_kampus', 'alamat_kampus', 'telepon_kampus', 
    'fax_kampus', 'website', 'email_kampus', 'nama_kontak_person', 
    'telepon_kontak_person', 'jabatan_penandatangan', 'nama_penandatangan', 
    'nip_penandatangan', 'logo_kampus', 'ttd_image', 'stempel_image'
];
}