<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedomanController;
use App\Http\Controllers\PengajuanMagangController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CampusProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\PengajuanSuratController;


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    return view('home');
})->name('home');


Route::get('/validasi-surat/{id}', [PengajuanSuratController::class, 'validasiQR'])->name('validasi.surat');
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        $tahun_ini = now()->year;
        $pengajuan_per_bulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $pengajuan_per_bulan[] = \App\Models\PengajuanMagang::whereYear('created_at', $tahun_ini)
                ->whereMonth('created_at', $i)->count();
        }
        $data = [
            'total_mahasiswa' => \App\Models\User::where('role', 'mahasiswa')->count(),
            'total_pengajuan' => \App\Models\PengajuanMagang::count(),
            'pengajuan_bulan_ini' => \App\Models\PengajuanMagang::whereMonth('created_at', now()->month)->count(),
            'surat_disetujui' => \App\Models\PengajuanSurat::where('status', 'disetujui')->count(),
            'menunggu_persetujuan' => \App\Models\PengajuanSurat::where('status', 'pending')->count(),
            'pengajuan_hari_ini' => \App\Models\PengajuanMagang::whereDate('created_at', today())->count(),
            'disetujui_hari_ini' => \App\Models\PengajuanSurat::where('status', 'disetujui')->whereDate('updated_at', today())->count(),
            'sedang_magang' => \App\Models\PengajuanMagang::where('status_magang', 'Sedang Magang')->count(),
            'surat_ditolak' => \App\Models\PengajuanSurat::where('status', 'ditolak')->count(),
            'pengajuan_terbaru' => \App\Models\PengajuanSurat::with(['magang', 'mahasiswa'])->latest()->take(5)->get(),
            'tahun_ini' => $tahun_ini,
            'pengajuan_per_bulan' => $pengajuan_per_bulan,
        ];

        return view('admin.dashboard', $data);
    })->name('dashboard');

    Route::get('/pedoman', [PedomanController::class, 'index'])->name('pedoman.index');
    Route::get('/ajukan', [PengajuanMagangController::class, 'index'])->name('ajukan.index');
    Route::post('/ajukan-surat', [PengajuanMagangController::class, 'store'])->name('ajukan.store');
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
    Route::post('/riwayat-surat/update-status/{id}', [RiwayatController::class, 'updateStatusMagang'])->name('riwayat.update_status');

    Route::get('/profile', [UserController::class, 'showProfile'])->name('profile.show');
    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::get('/change-password', [UserController::class, 'showChangePassword'])->name('change-password.show');
    Route::post('/change-password', [UserController::class, 'updatePassword'])->name('change-password.update');

    Route::prefix('admin')->group(function () {

        Route::resource('user', UserController::class);
        Route::post('/user/{id}/reset-password', [UserController::class, 'resetPassword'])->name('user.reset_password');
        Route::resource('campus-profile', CampusProfileController::class);
        Route::get('/export', [ExportController::class, 'index'])->name('export.index');

        Route::resource('pengajuan_surat', PengajuanSuratController::class);

        Route::post('/pengajuan_surat/{id}/approve', [PengajuanSuratController::class, 'approve'])->name('pengajuan_surat.approve');
        Route::post('/pengajuan_surat/{id}/reject', [PengajuanSuratController::class, 'reject'])->name('pengajuan_surat.reject');
        Route::post('/pengajuan_surat/{id}/resubmit', [PengajuanSuratController::class, 'resubmit'])->name('pengajuan_surat.resubmit');
        Route::get('/pengajuan_surat/{id}/pdf', [PengajuanSuratController::class, 'downloadPDF'])->name('pengajuan_surat.pdf');
    });
});
