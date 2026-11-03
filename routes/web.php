<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PokjaController;
use App\Http\Controllers\InformasiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Halaman utama TP. PKK Desa Karangtanjung
*/

Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/beranda', [BerandaController::class, 'index']);
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
Route::get('/pokja', [PokjaController::class, 'index'])->name('pokja');

// Halaman Informasi, Agenda Kegiatan & Pengumuman
Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi.index');
Route::get('/informasi/agenda', [InformasiController::class, 'agendaIndex'])->name('informasi.agenda.index');
Route::get('/informasi/agenda/{id}', [InformasiController::class, 'agendaShow'])->name('informasi.agenda.show')->where('id', '[0-9]+');
Route::get('/informasi/pengumuman', [InformasiController::class, 'pengumumanIndex'])->name('informasi.pengumuman.index');
Route::get('/informasi/pengumuman/{id}', [InformasiController::class, 'pengumumanShow'])->name('informasi.pengumuman.show')->where('id', '[0-9]+');
Route::get('/informasi/{id}', [InformasiController::class, 'show'])->name('informasi.show')->where('id', '[0-9]+');
