<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PokjaController extends Controller
{
    private function getAllPokja()
    {
        return [
            [
                'id' => 1,
                'nomor' => 'I',
                'nama' => 'Pokja I',
                'ketua' => 'Ibu Siti Aminah',
                'deskripsi' => 'Bidang Pembinaan Karakter & Gotong Royong — Penghayatan dan pengamalan Pancasila, kegiatan gotong royong, dan pembinaan mental spiritual.',
            ],
            [
                'id' => 2,
                'nomor' => 'II',
                'nama' => 'Pokja II',
                'ketua' => 'Ibu Dewi Rahayu',
                'deskripsi' => 'Bidang Pendidikan & Peningkatan Ekonomi (UP2K) — Pendidikan dan keterampilan, pengembangan kehidupan berkoperasi, usaha peningkatan pendapatan keluarga.',
            ],
            [
                'id' => 3,
                'nomor' => 'III',
                'nama' => 'Pokja III',
                'ketua' => 'Ibu Wati Suryani',
                'deskripsi' => 'Bidang Ketahanan Pangan & Tata Laksana Rumah — Pangan, sandang, perumahan dan tata laksana rumah tangga, HATINYA PKK.',
            ],
            [
                'id' => 4,
                'nomor' => 'IV',
                'nama' => 'Pokja IV',
                'ketua' => 'Ibu Endang Purwati',
                'deskripsi' => 'Bidang Kesehatan & Lingkungan Hidup — Kesehatan, kelestarian lingkungan hidup, perencanaan sehat.',
            ],
        ];
    }

    public function index()
    {
        $pokjaList = $this->getAllPokja();
        return view('admin.pokja.index', compact('pokjaList'));
    }

    public function edit($id)
    {
        $pokja = collect($this->getAllPokja())->firstWhere('id', (int)$id);

        if (!$pokja) {
            abort(404, 'Pokja tidak ditemukan');
        }

        return view('admin.pokja.form', compact('pokja'));
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('admin.pokja.index')
            ->with('success', 'Data Pokja berhasil diperbarui! (Demo — data belum disimpan ke database)');
    }
}

