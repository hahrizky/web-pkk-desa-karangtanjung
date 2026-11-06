<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (request()->header('x-forwarded-proto') === 'https' || str_contains(request()->header('host', ''), 'trycloudflare.com')) {
            URL::forceScheme('https');
        }

        // Bagikan data kontak footer ke semua view publik
        View::composer('layouts.app', function ($view) {
            $path = storage_path('app/profil_data.json');
            $kontak = [
                'alamat' => 'Jl. Sunan Giri No.1 Desa Karangtanjung, Kec. Candi, Kab. Sidoarjo, Jawa Timur',
                'telepon' => '',
                'email' => '',
                'jam_layanan' => 'Jam Layanan: Senin - Jumat (08.00 - 15.00 WIB)',
            ];
            $saved = [];

            if (File::exists($path)) {
                $saved = json_decode(File::get($path), true) ?? [];
                if (array_key_exists('alamat', $saved)) {
                    $kontak['alamat'] = trim((string)$saved['alamat']);
                }
                if (array_key_exists('telepon', $saved)) {
                    $kontak['telepon'] = trim((string)$saved['telepon']);
                }
                if (array_key_exists('email', $saved)) {
                    $kontak['email'] = trim((string)$saved['email']);
                }
                if (array_key_exists('jam_layanan', $saved)) {
                    $jam = trim((string)$saved['jam_layanan']);
                    $kontak['jam_layanan'] = (!empty($jam) && !str_starts_with($jam, 'Jam Layanan:'))
                        ? 'Jam Layanan: ' . $jam
                        : $jam;
                }
            }

            $view->with('kontakFooter', $kontak);
            $view->with('profilFooter', $saved);
        });
    }
}
