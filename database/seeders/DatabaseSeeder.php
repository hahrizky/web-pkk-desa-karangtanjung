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
        // 1. Akun Admin dari Environment (.env)
        $username = env('ADMIN_USERNAME');
        $password = env('ADMIN_PASSWORD');

        if ($username && $password) {
            User::updateOrCreate(
                ['username' => $username],
                [
                    'name' => env('ADMIN_NAME'),
                    'email' => env('ADMIN_EMAIL'),
                    'password' => Hash::make($password),
                ]
            );
        }

        // 2. Seeder Berita & Agenda
        $this->call([
            BeritaSeeder::class,
            AgendaSeeder::class,
        ]);
    }
}
