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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('angkatan');
            $table->string('tempat_lahir')->nullable()->after('phone');
            $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            $table->text('alamat')->nullable()->after('tanggal_lahir');
            $table->string('rt_rw')->nullable()->after('alamat');
            $table->string('kelurahan')->nullable()->after('rt_rw');
            $table->string('kecamatan')->nullable()->after('kelurahan');
            $table->string('provinsi')->nullable()->after('kecamatan');
            $table->string('nama_dosen_pembimbing')->nullable()->after('provinsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'tempat_lahir',
                'tanggal_lahir',
                'alamat',
                'rt_rw',
                'kelurahan',
                'kecamatan',
                'provinsi',
                'nama_dosen_pembimbing',
            ]);
        });
    }
};
