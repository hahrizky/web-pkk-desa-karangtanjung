<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    private function getAllGaleri()
    {
        return [
            ['id' => 1, 'judul' => 'Pertemuan Rutin Kader PKK', 'gambar' => '1.webp', 'kategori' => 'Kegiatan'],
            ['id' => 2, 'judul' => 'Gotong Royong Kebersihan Lingkungan', 'gambar' => '2.webp', 'kategori' => 'Kegiatan'],
            ['id' => 3, 'judul' => 'Pembinaan Administrasi Dasawisma', 'gambar' => '3.webp', 'kategori' => 'Pelatihan'],
            ['id' => 4, 'judul' => 'Pemanfaatan Pekarangan HATINYA PKK', 'gambar' => '4.webp', 'kategori' => 'Kegiatan'],
            ['id' => 5, 'judul' => 'Pelatihan Keterampilan UP2K', 'gambar' => '5.webp', 'kategori' => 'Pelatihan'],
            ['id' => 6, 'judul' => 'Posyandu Balita & Lansia', 'gambar' => '1.webp', 'kategori' => 'Posyandu'],
            ['id' => 7, 'judul' => 'Sosialisasi Pola Asuh Anak & Remaja', 'gambar' => '3.webp', 'kategori' => 'Kegiatan'],
            ['id' => 8, 'judul' => 'Pembagian Bibit Tanaman Produktif', 'gambar' => '5.webp', 'kategori' => 'Kegiatan'],
        ];
    }

    public function index()
    {
        $galeriList = $this->getAllGaleri();

        return view('admin.galeri.index', compact('galeriList'));
    }

    public function create()
    {
        return view('admin.galeri.form');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto berhasil diupload! (Demo — data belum disimpan ke database)');
    }

    public function edit(int|string $id)
    {
        $foto = collect($this->getAllGaleri())->firstWhere('id', (int) $id);

        if (! $foto) {
            abort(404, 'Foto tidak ditemukan');
        }

        return view('admin.galeri.form', compact('foto'));
    }

    public function update(Request $request, int|string $id)
    {
        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto berhasil diperbarui! (Demo — data belum disimpan ke database)');
    }

    public function destroy(int|string $id)
    {
        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto berhasil dihapus! (Demo — data belum disimpan ke database)');
    }
}
