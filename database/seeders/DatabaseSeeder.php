<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Admin Default
        $username = env('ADMIN_USERNAME', 'admin');
        $password = env('ADMIN_PASSWORD', 'pkk2024');

        User::updateOrCreate(
            ['username' => $username],
            [
                'name' => env('ADMIN_NAME', 'Administrator TP. PKK'),
                'email' => env('ADMIN_EMAIL', 'admin@karangtanjung.desa.id'),
                'password' => Hash::make($password),
            ]
        );

        // 2. Seeder Berita & Agenda
        $this->call([
            BeritaSeeder::class,
            AgendaSeeder::class,
        ]);
    }
}
