<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuan_surats', function (Blueprint $table) {
            // Tambah kolom magang_id setelah mahasiswa_id
            $table->foreignId('magang_id')
                  ->nullable()
                  ->after('mahasiswa_id')
                  ->constrained('pengajuan_magangs')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan_surats', function (Blueprint $table) {
            $table->dropForeignIdFor('pengajuan_magangs', 'magang_id');
            $table->dropColumn('magang_id');
        });
    }
};
