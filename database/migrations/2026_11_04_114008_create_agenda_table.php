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
        Schema::create('agenda', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('kategori')->default('Umum'); // Pokja I, Pokja II, Pokja III, Pokja IV, Umum
            $table->date('tanggal');
            $table->string('waktu')->nullable(); // cth: "08.00 - 11.00 WIB"
            $table->string('lokasi');
            $table->string('penyelenggara')->nullable();
            $table->text('deskripsi')->nullable();
            $table->longText('isi')->nullable();
            $table->string('status')->default('Mendatang'); // Mendatang, Selesai
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda');
    }
};
