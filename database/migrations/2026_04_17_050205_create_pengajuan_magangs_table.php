<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
{
    Schema::create('pengajuan_magangs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
        $table->string('nim');
        $table->string('nama');
        $table->string('email');
        $table->string('prodi');
        $table->string('angkatan');
        $table->string('perusahaan');
        $table->text('alamat');
        $table->string('kode_surat')->nullable(); 
        $table->date('tgl_mulai');
        $table->date('tgl_selesai');
        $table->json('file_pendukung');
        $table->string('status')->default('Menunggu Validasi');
        $table->string('status_magang')->default('Belum Konfirmasi');
        $table->text('keterangan')->nullable();
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('pengajuan_magangs');
    }
};