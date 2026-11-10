<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('statistik_dasawisma', function (Blueprint $table) {
            $table->string('satuan', 30)->nullable()->after('nilai');
            $table->string('nilai')->nullable()->change();
        });

        $now = now();
        $baseline = [
            ['judul' => 'Jumlah KK', 'nilai' => null, 'satuan' => 'KK', 'deskripsi' => 'Data jumlah kepala keluarga', 'warna' => 'green', 'icon' => 'fa-solid fa-house-chimney-user', 'urutan' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['judul' => 'Jumlah Laki-laki', 'nilai' => null, 'satuan' => 'jiwa', 'deskripsi' => 'Data penduduk laki-laki', 'warna' => 'orange', 'icon' => 'fa-solid fa-person', 'urutan' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['judul' => 'Jumlah Perempuan', 'nilai' => null, 'satuan' => 'jiwa', 'deskripsi' => 'Data penduduk perempuan', 'warna' => 'blue', 'icon' => 'fa-solid fa-person-dress', 'urutan' => 3, 'created_at' => $now, 'updated_at' => $now],
        ];

        foreach ($baseline as $row) {
            if (! DB::table('statistik_dasawisma')->where('urutan', $row['urutan'])->exists()) {
                DB::table('statistik_dasawisma')->insert($row);
            }
        }

        DB::table('statistik_dasawisma')->whereNotNull('nilai')->get(['id', 'nilai'])->each(function ($row) {
            if (preg_match('/^\d{1,3}(\.\d{3})+$/', (string) $row->nilai)) {
                DB::table('statistik_dasawisma')->where('id', $row->id)
                    ->update(['nilai' => str_replace('.', '', $row->nilai)]);
            }
        });
    }

    public function down(): void
    {
        DB::table('statistik_dasawisma')
            ->whereNull('nilai')
            ->whereIn('judul', ['Jumlah KK', 'Jumlah Laki-laki', 'Jumlah Perempuan'])
            ->delete();

        DB::table('statistik_dasawisma')->whereNull('nilai')->update(['nilai' => '']);

        Schema::table('statistik_dasawisma', function (Blueprint $table) {
            $table->dropColumn('satuan');
            $table->string('nilai')->nullable(false)->change();
        });
    }
};
