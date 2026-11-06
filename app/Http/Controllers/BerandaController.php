<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\StatistikDasawisma;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        // 1. Data Statistik Dasawisma dari Database (dengan safe try-catch jika tabel belum siap/di test env)
        try {
            $statistik = StatistikDasawisma::orderBy('urutan', 'asc')->get()->map(function ($item) {
                return [
                    'judul' => $item->judul,
                    'nilai' => $item->nilai,
                    'deskripsi' => $item->deskripsi,
                    'warna' => $item->warna,
                    'icon' => $item->icon,
                ];
            })->all();
        } catch (\Throwable $e) {
            $statistik = [];
        }

        // Fallback jika belum ada data di database
        if (empty($statistik)) {
            $statistik = [
                ['judul' => 'Jumlah KK', 'nilai' => '300', 'deskripsi' => 'Penduduk keluarga di Desa Karangtanjung', 'warna' => 'green', 'icon' => 'fa-solid fa-house-chimney-user'],
                ['judul' => 'Jumlah Laki-laki', 'nilai' => '1.200', 'deskripsi' => 'Penduduk laki-laki di Desa Karangtanjung', 'warna' => 'orange', 'icon' => 'fa-solid fa-person'],
                ['judul' => 'Jumlah Perempuan', 'nilai' => '300', 'deskripsi' => 'Penduduk perempuan di Desa Karangtanjung', 'warna' => 'blue', 'icon' => 'fa-solid fa-person-dress'],
            ];
        }

        // 2. Daftar Kegiatan PKK Terbaru dari Database Berita
        $badgeColors = [
            'Umum' => 'bg-amber-100 text-amber-800',
            'Pokja I' => 'bg-purple-100 text-purple-800',
            'Pokja II' => 'bg-blue-100 text-blue-800',
            'Pokja III' => 'bg-teal-100 text-teal-800',
            'Pokja IV' => 'bg-emerald-100 text-emerald-800',
        ];

        try {
            $kegiatan = Berita::where('status', 'published')->latest('tanggal')->get()->map(function ($item) use ($badgeColors) {
                return [
                    'id' => $item->id,
                    'judul' => $item->judul,
                    'kategori' => $item->kategori,
                    'badge_color' => $badgeColors[$item->kategori] ?? 'bg-emerald-100 text-emerald-800',
                    'tanggal' => $item->tanggal_formatted,
                    'ringkasan' => $item->ringkasan,
                    'gambar' => $item->gambar ?? '1.webp',
                ];
            })->all();
        } catch (\Throwable $e) {
            $kegiatan = [];
        }

        // 3. 4 Kelompok Kerja (Pokja) PKK
        $pokja = [
            [
                'kode' => 'Pokja 1',
                'nama' => 'Penghayatan Pengamalan & Gotong Royong',
                'deskripsi' => 'Pembinaan kesadaran bela negara, penghayatan Pancasila, kegiatan gotong royong, bakti sosial, dan dermawan sosial.',
                'icon' => 'fa-solid fa-hands-holding-child'
            ],
            [
                'kode' => 'Pokja 2',
                'nama' => 'Pendidikan, Keterampilan & UP2K',
                'deskripsi' => 'Meningkatkan mutu pendidikan keluarga, pelatihan keterampilan, dan Usaha Peningkatan Pendapatan Keluarga (UP2K).',
                'icon' => 'fa-solid fa-book-open-reader'
            ],
            [
                'kode' => 'Pokja 3',
                'nama' => 'Pangan, Sandang & Tata Laksana Rumah',
                'deskripsi' => 'Ketahanan pangan lokal (Hatinya PKK), busana sopan dan layak, serta tata laksana rumah tangga yang sehat dan asri.',
                'icon' => 'fa-solid fa-utensils'
            ],
            [
                'kode' => 'Pokja 4',
                'nama' => 'Kesehatan & Lingkungan Hidup',
                'deskripsi' => 'Pengelolaan posyandu, pencegahan stunting, perilaku hidup bersih dan sehat (PHBS), serta pelestarian lingkungan.',
                'icon' => 'fa-solid fa-heart-pulse'
            ]
        ];

        // 4. Dokumentasi Galeri Kegiatan (8 Berita Terbaru Saja dari Database)
        try {
            $galeri = Berita::where('status', 'published')
                ->whereNotNull('gambar')
                ->latest('tanggal')
                ->take(8)
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'gambar' => $item->gambar ?? '1.webp',
                        'judul' => $item->judul,
                        'kategori' => $item->kategori,
                        'tanggal' => $item->tanggal_formatted,
                    ];
                })->all();
        } catch (\Throwable $e) {
            $galeri = [];
        }

        return view('beranda', compact('statistik', 'kegiatan', 'pokja', 'galeri'));
    }
}
