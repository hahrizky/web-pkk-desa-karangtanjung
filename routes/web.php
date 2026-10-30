<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PokjaController;

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
