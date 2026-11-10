<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PokjaController extends Controller
{
    private function getStoragePath()
    {
        return storage_path('app/pokja_data.json');
    }

    private function getDefaultPokja()
    {
        return [
            [
                'id' => 1,
                'nomor' => 'I',
                'nama' => 'Pokja I',
                'ketua' => 'Mutma\'innah, M.Pd.',
                'deskripsi' => 'Bidang Pembinaan Karakter & Gotong Royong — Penghayatan dan pengamalan Pancasila, pembinaan kesadaran bela negara, pola asuh anak & remaja (PAAR), serta gotong royong warga.',
            ],
            [
                'id' => 2,
                'nomor' => 'II',
                'nama' => 'Pokja II',
                'ketua' => 'Resti Duwi Rohmawati',
                'deskripsi' => 'Bidang Pendidikan & Peningkatan Ekonomi (UP2K) — Pendidikan keluarga, pelatihan keterampilan mandiri, pembinaan koperasi desa, serta Usaha Peningkatan Pendapatan Keluarga.',
            ],
            [
                'id' => 3,
                'nomor' => 'III',
                'nama' => 'Pokja III',
                'ketua' => 'Jazil Laturohmah',
                'deskripsi' => 'Bidang Penguatan Ketahanan Pangan Keluarga — Pemanfaatan pekarangan (HATINYA PKK), pangan Beragam Bergizi Seimbang Aman (B2SA), sandang, dan tata laksana rumah sehat.',
            ],
            [
                'id' => 4,
                'nomor' => 'IV',
                'nama' => 'Pokja IV',
                'ketua' => 'Lilik Mutammimah',
                'deskripsi' => 'Bidang Kesehatan & Lingkungan Hidup — Pengelolaan Posyandu Balita & Lansia, pencegahan stunting, Perilaku Hidup Bersih & Sehat (PHBS), serta kelestarian lingkungan.',
            ],
        ];
    }

    private function getAllPokja()
    {
        $path = $this->getStoragePath();
        if (File::exists($path)) {
            $data = json_decode(File::get($path), true);
            if (is_array($data)) {
                return $data;
            }
        }

        return $this->getDefaultPokja();
    }

    public function index()
    {
        $pokjaList = $this->getAllPokja();

        return view('admin.pokja.index', compact('pokjaList'));
    }

    public function edit(int|string $id)
    {
        $pokja = collect($this->getAllPokja())->firstWhere('id', (int) $id);

        if (! $pokja) {
            abort(404, 'Pokja tidak ditemukan');
        }

        return view('admin.pokja.form', compact('pokja'));
    }

    public function update(Request $request, int|string $id)
    {
        $validated = $request->validate([
            'ketua' => 'required|string|max:150',
            'deskripsi' => 'required|string',
        ]);

        $list = $this->getAllPokja();
        foreach ($list as &$item) {
            if ($item['id'] == (int) $id) {
                $item['ketua'] = $validated['ketua'];
                $item['deskripsi'] = $validated['deskripsi'];
                break;
            }
        }

        File::ensureDirectoryExists(storage_path('app'));
        File::put($this->getStoragePath(), json_encode($list, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        // Sinkronkan juga ke profil_data.json jika ada
        $profilPath = storage_path('app/profil_data.json');
        if (File::exists($profilPath)) {
            $profil = json_decode(File::get($profilPath), true);
            if (isset($profil['struktur']['pokja'])) {
                foreach ($profil['struktur']['pokja'] as &$pk) {
                    if ($pk['kode'] === 'Pokja '.($id == 1 ? 'I' : ($id == 2 ? 'II' : ($id == 3 ? 'III' : 'IV')))) {
                        $pk['ketua'] = $validated['ketua'];
                    }
                }
                File::put($profilPath, json_encode($profil, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            }
        }

        return redirect()->route('admin.pokja.index')
            ->with('success', 'Data Pokja berhasil diperbarui dan tersimpan!');
    }
}
