<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\PengajuanMagang;
use App\Models\PengajuanSurat;
use App\Models\User;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('surat:sync-magangs', function () {
    $total = 0;
    $skipped = 0;

    PengajuanMagang::with('pengajuanSurats')->get()->each(function ($magang) use (&$total, &$skipped) {
        if ($magang->pengajuanSurats->isNotEmpty()) {
            return;
        }

        $user = User::query()
            ->where('nim', $magang->nim)
            ->orWhere('email', $magang->email)
            ->first();

        if (! $user) {
            $skipped++;
            return;
        }

        PengajuanSurat::create([
            'mahasiswa_id' => $user->id,
            'magang_id' => $magang->id,
            'jenis_surat' => 'Surat Pengantar Magang',
            'keperluan' => 'Pengajuan surat pengantar magang untuk ' . $magang->nama,
            'status' => 'pending',
        ]);

        $total++;
    });

    $this->info("Berhasil menambahkan {$total} surat pengantar dari data pengajuan magang yang belum punya surat.");
    if ($skipped > 0) {
        $this->warn("{$skipped} pengajuan magang dilewati karena user tidak ditemukan.");
    }
})->purpose('Sync existing internship applications into surat pengantar');
