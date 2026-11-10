<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StatistikDasawisma;
use Illuminate\Http\Request;
use Throwable;

class StatistikController extends Controller
{
    /**
     * Definisi 3 indikator tetap.
     * Hanya angka (nilai) yang disimpan di database, sedangkan judul, deskripsi,
     * warna, icon, dan satuan tetap di kode (Blade / Controller).
     */
    public const INDIKATOR = [
        1 => [
            'judul' => 'Jumlah KK',
            'satuan' => 'KK',
            'deskripsi' => 'Data jumlah kepala keluarga',
            'warna' => 'green',
            'icon' => 'fa-solid fa-house-chimney-user',
        ],
        2 => [
            'judul' => 'Jumlah Laki-laki',
            'satuan' => 'jiwa',
            'deskripsi' => 'Data penduduk laki-laki',
            'warna' => 'orange',
            'icon' => 'fa-solid fa-person',
        ],
        3 => [
            'judul' => 'Jumlah Perempuan',
            'satuan' => 'jiwa',
            'deskripsi' => 'Data penduduk perempuan',
            'warna' => 'blue',
            'icon' => 'fa-solid fa-person-dress',
        ],
    ];

    /**
     * Mengambil data statistik: definisi tetap digabungkan dengan nilai dari database.
     */
    public static function getStatistikData(): array
    {
        $dbRows = [];
        try {
            $dbRows = StatistikDasawisma::pluck('nilai', 'id')->toArray();
        } catch (Throwable $e) {
            // Jika koneksi DB bermasalah, gunakan array kosong
            $dbRows = [];
        }

        return collect(self::INDIKATOR)->map(function ($meta, $id) use ($dbRows) {
            $rawNilai = $dbRows[$id] ?? null;
            // Bersihkan jika ada format pemisah titik/koma yang tersimpan sebelumnya
            $cleanNilai = $rawNilai !== null ? (int) str_replace(['.', ','], '', (string) $rawNilai) : null;

            return array_merge($meta, [
                'id' => $id,
                'nilai' => $cleanNilai,
            ]);
        })->values()->all();
    }

    public function index()
    {
        $statistik = self::getStatistikData();

        return view('admin.statistik.index', compact('statistik'));
    }

    public function edit(int|string $id)
    {
        $id = (int) $id;
        abort_if(! isset(self::INDIKATOR[$id]), 404);

        $meta = self::INDIKATOR[$id];
        $nilai = null;

        try {
            $dbRow = StatistikDasawisma::find($id);
            if ($dbRow && $dbRow->nilai !== null) {
                $nilai = (int) str_replace(['.', ','], '', (string) $dbRow->nilai);
            }
        } catch (Throwable $e) {
            $nilai = null;
        }

        return view('admin.statistik.form', compact('id', 'meta', 'nilai'));
    }

    public function update(Request $request, int|string $id)
    {
        $id = (int) $id;
        abort_if(! isset(self::INDIKATOR[$id]), 404);

        $validated = $request->validate([
            'nilai' => 'required|integer|min:0',
        ]);

        $item = StatistikDasawisma::find($id);
        if ($item) {
            $item->nilai = (string) $validated['nilai'];
            $item->save();
        } else {
            StatistikDasawisma::create([
                'id' => $id,
                'judul' => self::INDIKATOR[$id]['judul'],
                'nilai' => (string) $validated['nilai'],
                'satuan' => self::INDIKATOR[$id]['satuan'],
                'deskripsi' => self::INDIKATOR[$id]['deskripsi'],
                'warna' => self::INDIKATOR[$id]['warna'],
                'icon' => self::INDIKATOR[$id]['icon'],
                'urutan' => $id,
            ]);
        }

        return redirect()->route('admin.statistik.index')->with('success', 'Data statistik berhasil diperbarui.');
    }
}
