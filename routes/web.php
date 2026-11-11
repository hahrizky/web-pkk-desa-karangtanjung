<?php

use App\Http\Controllers\Admin\AgendaController as AdminAgendaController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfilController as AdminProfilController;
use App\Http\Controllers\Admin\StatistikController as AdminStatistikController;
use App\Http\Controllers\Admin\StrukturController as AdminStrukturController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\PokjaController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;

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

// Halaman Informasi & Agenda Kegiatan
Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi.index');
Route::get('/informasi/agenda', [InformasiController::class, 'agendaIndex'])->name('informasi.agenda.index');
Route::get('/informasi/agenda/{id}', [InformasiController::class, 'agendaShow'])->name('informasi.agenda.show')->where('id', '[0-9]+');
Route::redirect('/informasi/pengumuman', '/informasi');
Route::redirect('/informasi/pengumuman/{id}', '/informasi');
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
    Route::resource('berita', AdminBeritaController::class)->except(['show']);

    // Agenda (CRUD Database)
    Route::resource('agenda', AdminAgendaController::class)->except(['show']);

    // Statistik Dasawisma (CRUD Database)
    Route::resource('statistik', AdminStatistikController::class)->only(['index', 'edit', 'update']);

    // Struktur Organisasi (Ganti Nama Pengurus)
    Route::get('/struktur', [AdminStrukturController::class, 'index'])->name('struktur.index');
    Route::put('/struktur', [AdminStrukturController::class, 'update'])->name('struktur.update');

    // Profil Desa
    Route::get('/profil', [AdminProfilController::class, 'index'])->name('profil');
    Route::put('/profil', [AdminProfilController::class, 'update'])->name('profil.update');
});
