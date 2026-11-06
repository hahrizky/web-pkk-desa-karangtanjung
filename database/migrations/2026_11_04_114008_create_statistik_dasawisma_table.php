<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('statistik_dasawisma', function (Blueprint $table) {
            $table->id();
            $table->string('judul'); // cth: "Jumlah KK", "Jumlah Laki-laki", "Jumlah Perempuan"
            $table->string('nilai'); // cth: "300", "1.200"
            $table->string('deskripsi')->nullable();
            $table->string('warna')->default('green'); // green, orange, blue
            $table->string('icon')->default('fa-solid fa-house-chimney-user');
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistik_dasawisma');
    }
};
