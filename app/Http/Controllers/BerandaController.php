<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        // Data Statistik Dasawisma Desa Karangtanjung
        $statistik = [
            [
                'judul' => 'Jumlah KK',
                'nilai' => '300',
                'deskripsi' => 'Penduduk keluarga di Desa Karangtanjung',
                'warna' => 'green',
                'icon' => 'fa-solid fa-house-chimney-user'
            ],
            [
                'judul' => 'Jumlah Laki-laki',
                'nilai' => '1.200',
                'deskripsi' => 'Penduduk laki-laki di Desa Karangtanjung',
                'warna' => 'orange',
                'icon' => 'fa-solid fa-person'
            ],
            [
                'judul' => 'Jumlah Perempuan',
                'nilai' => '300',
                'deskripsi' => 'Penduduk perempuan di Desa Karangtanjung',
                'warna' => 'blue',
                'icon' => 'fa-solid fa-person-dress'
            ]
        ];

        // Daftar Kegiatan PKK Terbaru (Diambil langsung sama persis dengan Data Informasi / Berita)
        $badgeColors = [
            'Umum' => 'bg-amber-100 text-amber-800',
            'Pokja I' => 'bg-purple-100 text-purple-800',
            'Pokja II' => 'bg-blue-100 text-blue-800',
            'Pokja III' => 'bg-teal-100 text-teal-800',
            'Pokja IV' => 'bg-emerald-100 text-emerald-800',
        ];

        $kegiatan = collect(InformasiController::getBeritaData())->map(function ($item) use ($badgeColors) {
            return [
                'id' => $item['id'],
                'judul' => $item['judul'],
                'tanggal' => $item['tanggal'],
                'ringkasan' => $item['deskripsi'],
                'kategori' => $item['kategori'],
                'badge_color' => $badgeColors[$item['kategori']] ?? 'bg-emerald-100 text-emerald-800',
                'gambar' => $item['gambar'],
            ];
        })->all();

        // 4 Kelompok Kerja (Pokja) PKK
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

        // Dokumentasi Galeri Kegiatan
        $galeri = [
            ['judul' => 'Senam Sehat Bersama Kader', 'tag' => 'Kebugaran', 'gambar' => '1.webp'],
            ['judul' => 'Rapat Koordinasi Pengurus PKK', 'tag' => 'Rakor Bulanan', 'gambar' => '2.webp'],
            ['judul' => 'Pelatihan Memasak Olahan Pangan', 'tag' => 'UP2K', 'gambar' => '3.webp'],
            ['judul' => 'Pemanfaatan Pekarangan HATINYA PKK', 'tag' => 'Lingkungan', 'gambar' => '4.webp'],
            ['judul' => 'Pelayanan Posyandu Balita & Lansia', 'tag' => 'Kesehatan', 'gambar' => '5.webp'],
            ['judul' => 'Kerja Bakti Kebersihan Saluran Desa', 'tag' => 'Gotong Royong', 'gambar' => '1.webp']
        ];

        return view('beranda', compact('statistik', 'kegiatan', 'pokja', 'galeri'));
    }
}
