<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void

{
    Schema::create('campusprofiles', function (Blueprint $table) {
        $table->id();
        $table->string('kementerian');
        $table->string('nama_kampus');
        $table->text('alamat_kampus');
        $table->string('telepon_kampus');
        $table->string('fax_kampus');
        $table->string('website');
        $table->string('email_kampus');
        $table->string('logo_kampus')->nullable();
        // kode_surat dihapus dari sini karena bikin error 500
        $table->string('nama_kontak_person');
        $table->string('telepon_kontak_person');
        $table->string('jabatan_penandatangan');
        $table->string('nama_penandatangan');
        $table->string('nip_penandatangan');
        $table->string('ttd_image')->nullable();
        $table->string('stempel_image')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Pastikan nama tabel di sini juga 'campusprofiles'
        Schema::dropIfExists('campusprofiles');
    }
};