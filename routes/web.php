<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedomanController;
use App\Http\Controllers\PengajuanMagangController;
use App\Http\Controllers\RiwayatController;


Route::get('/home', function () {
    return view('home');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/pedoman', [PedomanController::class, 'index'])->name('pedoman.index');

Route::get('/ajukan', [PengajuanMagangController::class, 'index'])->name('ajukan.index');
Route::get('/ajukan-surat', [PengajuanMagangController::class, 'create'])->name('ajukan.create');
Route::post('/ajukan-surat', [PengajuanMagangController::class, 'store'])->name('ajukan.store');

Route::get('/riwayat-surat', [RiwayatController::class, 'index'])->name('riwayat.index');
Route::post('/riwayat-surat/update-status/{id}', [RiwayatController::class, 'updateStatusMagang'])->name('riwayat.update_status');
    