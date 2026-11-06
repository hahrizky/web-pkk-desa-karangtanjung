<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    private function getAllPengumuman()
    {
        return [
            [
                'id' => 1,
                'judul' => 'Informasi Pelaksanaan Kegiatan Posyandu Balita',
                'tanggal' => '05 November 2026',
                'ringkasan' => 'Pemberitahuan mengenai pelaksanaan pelayanan Posyandu balita.',
                'konten' => 'Diberitahukan kepada seluruh warga Desa Karangtanjung yang memiliki putra-putri usia balita (0-5 tahun)...',
                'prioritas' => 'Penting',
            ],
            [
                'id' => 2,
                'judul' => 'Informasi Pertemuan Rutin Kader PKK',
                'tanggal' => '03 November 2026',
                'ringkasan' => 'Pemberitahuan kepada kader PKK mengenai kegiatan koordinasi dan evaluasi program kerja.',
                'konten' => 'Sehubungan dengan pelaksanaan monitoring dan evaluasi program kerja triwulan akhir tahun 2026...',
                'prioritas' => 'Normal',
            ],
            [
                'id' => 3,
                'judul' => 'Informasi Program Pemberdayaan Ekonomi Keluarga',
                'tanggal' => '01 November 2026',
                'ringkasan' => 'Informasi kegiatan pembinaan dan pengembangan keterampilan keluarga melalui program UP2K.',
                'konten' => 'Pokja II TP. PKK Desa Karangtanjung mengumumkan pembukaan pendaftaran...',
                'prioritas' => 'Normal',
            ],
            [
                'id' => 4,
                'judul' => 'Informasi Kegiatan Kebersihan Lingkungan Desa',
                'tanggal' => '28 Oktober 2026',
                'ringkasan' => 'Pemberitahuan kegiatan gotong royong dan kepedulian lingkungan.',
                'konten' => 'Dalam rangka menjaga kelestarian lingkungan dan mengantisipasi genangan air...',
                'prioritas' => 'Penting',
            ],
        ];
    }

    public function index()
    {
        $pengumumanList = $this->getAllPengumuman();
        return view('admin.pengumuman.index', compact('pengumumanList'));
    }

    public function create()
    {
        return view('admin.pengumuman.form');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan! (Demo — data belum disimpan ke database)');
    }

    public function edit($id)
    {
        $pengumuman = collect($this->getAllPengumuman())->firstWhere('id', (int)$id);

        if (!$pengumuman) {
            abort(404, 'Pengumuman tidak ditemukan');
        }

        return view('admin.pengumuman.form', compact('pengumuman'));
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui! (Demo — data belum disimpan ke database)');
    }

    public function destroy($id)
    {
        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus! (Demo — data belum disimpan ke database)');
    }
}

