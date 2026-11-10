<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        view()->composer('layouts.app', function ($view) {
            $path = storage_path('app/profil_data.json');
            $kontak = [
                'alamat' => 'Jl. Sunan Giri No.1 Desa Karangtanjung, Kec. Candi, Kab. Sidoarjo, Jawa Timur',
                'telepon' => '+62 812-3456-7890 (Sekretariat PKK)',
                'email' => 'pkk.desakarangtanjung@gmail.com',
                'jam_layanan' => 'Jam Layanan: Senin - Jumat (08.00 - 15.00 WIB)',
            ];

            if (File::exists($path)) {
                $saved = json_decode(File::get($path), true) ?? [];
                // Jika key ada di file json (bisa berupa string atau null/kosong)
                $kontak['alamat'] = isset($saved['alamat']) ? trim($saved['alamat']) : $kontak['alamat'];
                $kontak['telepon'] = isset($saved['telepon']) ? trim($saved['telepon']) : $kontak['telepon'];
                $kontak['email'] = isset($saved['email']) ? trim($saved['email']) : $kontak['email'];
                if (isset($saved['jam_layanan'])) {
                    $jam = trim($saved['jam_layanan']);
                    $kontak['jam_layanan'] = (! empty($jam) && ! str_starts_with($jam, 'Jam Layanan:'))
                        ? 'Jam Layanan: '.$jam
                        : $jam;
                }
            }

            $view->with('kontakFooter', $kontak);
        });
    }
}
