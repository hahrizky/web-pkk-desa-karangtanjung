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

        // Bagikan data kontak profil dinamis dari CMS ke layout publik
        View::composer('layouts.app', function ($view) {
            $path = storage_path('app/profil_data.json');
            $profilFooter = [];
            if (File::exists($path)) {
                $profilFooter = json_decode(File::get($path), true) ?? [];
            }
            $view->with('profilFooter', $profilFooter);
        });
    }
}
