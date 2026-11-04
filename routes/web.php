<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PokjaController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\AgendaController as AdminAgendaController;
use App\Http\Controllers\Admin\PengumumanController as AdminPengumumanController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\PokjaController as AdminPokjaController;
use App\Http\Controllers\Admin\ProfilController as AdminProfilController;
use App\Http\Controllers\Admin\StatistikController as AdminStatistikController;

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

/*
|--------------------------------------------------------------------------
| Admin CMS Routes
|--------------------------------------------------------------------------
*/

// Auth (tanpa middleware admin)
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin Panel (dengan middleware admin)
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Berita (CRUD Database)
    Route::resource('berita', AdminBeritaController::class);

    // Agenda (CRUD Database)
    Route::resource('agenda', AdminAgendaController::class);

    // Pengumuman (CRUD)
    Route::resource('pengumuman', AdminPengumumanController::class);

    // Galeri (CRUD)
    Route::resource('galeri', AdminGaleriController::class);

    // Statistik Dasawisma (CRUD Database)
    Route::resource('statistik', AdminStatistikController::class);

    // Pokja
    Route::get('/pokja', [AdminPokjaController::class, 'index'])->name('pokja.index');
    Route::get('/pokja/{id}/edit', [AdminPokjaController::class, 'edit'])->name('pokja.edit');
    Route::put('/pokja/{id}', [AdminPokjaController::class, 'update'])->name('pokja.update');

    // Profil Desa
    Route::get('/profil', [AdminProfilController::class, 'index'])->name('profil');
    Route::put('/profil', [AdminProfilController::class, 'update'])->name('profil.update');
});
