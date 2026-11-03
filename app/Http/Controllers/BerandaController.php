<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        // 1. Data Statistik Kegiatan TP. PKK Desa Karangtanjung (Fokus pada capaian riil PKK)
        $statistik = [
            [
                'judul' => 'Kelompok Dasawisma',
                'nilai' => '28',
                'deskripsi' => 'Kelompok dasawisma aktif tersebar di RW 01 s/d RW 05',
                'warna' => 'green',
                'icon' => 'fa-solid fa-people-roof'
            ],
            [
                'judul' => 'Pos Pelayanan Posyandu',
                'nilai' => '6',
                'deskripsi' => 'Posyandu balita & posbindu lansia rutin setiap bulan',
                'warna' => 'orange',
                'icon' => 'fa-solid fa-heart-pulse'
            ],
            [
                'judul' => 'Kader Penggerak PKK',
                'nilai' => '54',
                'deskripsi' => 'Kader aktif penggerak kegiatan warga dan keluarga',
                'warna' => 'blue',
                'icon' => 'fa-solid fa-users'
            ]
        ];

        // 2. Daftar 4 Kegiatan PKK Terbaru (Tersambung langsung dengan detail di Halaman Informasi)
        $kegiatan = [
            [
                'id' => 1,
                'judul' => 'Pertemuan Rutin TP. PKK Desa Karangtanjung',
                'tanggal' => '08 Mei 2026',
                'ringkasan' => 'Evaluasi pelaksanaan program kerja bulanan, koordinasi kelompok dasawisma, dan penguatan peran kader.',
                'kategori' => 'Umum',
                'badge_color' => 'bg-emerald-100 text-[#075B3C]',
                'gambar' => '1.webp'
            ],
            [
                'id' => 2,
                'judul' => 'Kegiatan Sosial Masyarakat',
                'tanggal' => '20 April 2026',
                'ringkasan' => 'Gotong royong kebersihan lingkungan desa, pemanfaatan pekarangan (HATINYA PKK), dan bakti sosial warga.',
                'kategori' => 'Pokja I',
                'badge_color' => 'bg-emerald-100 text-[#075B3C]',
                'gambar' => '2.webp'
            ],
            [
                'id' => 5,
                'judul' => 'Pelatihan Keterampilan & Inovasi Pangan UP2K',
                'tanggal' => '14 Maret 2026',
                'ringkasan' => 'Pelatihan tata boga pengolahan komoditas pangan lokal untuk mendongkrak pendapatan dan ekonomi keluarga.',
                'kategori' => 'Pokja II',
                'badge_color' => 'bg-amber-100 text-amber-800',
                'gambar' => '5.webp'
            ],
            [
                'id' => 7,
                'judul' => 'Layanan Terpadu Posyandu & Skrining Tumbuh Kembang',
                'tanggal' => '18 Januari 2026',
                'ringkasan' => 'Penimbangan balita, imunisasi lengkap, dan konsultasi nutrisi keluarga untuk pencegahan resiko stunting.',
                'kategori' => 'Pokja IV',
                'badge_color' => 'bg-sky-100 text-sky-800',
                'gambar' => '4.webp'
            ]
        ];

        // 3. 4 Kelompok Kerja (Pokja) PKK (Tersambung ke halaman Pokja & filter kegiatan)
        $pokja = [
            [
                'kode' => 'Pokja I',
                'nama' => 'Pembinaan Karakter & Gotong Royong',
                'deskripsi' => 'Penguatan nilai keagamaan, pola asuh anak remaja (PAAR), serta gotong royong kebersihan lingkungan.',
                'icon' => 'fa-solid fa-hands-holding-child',
                'kategori_filter' => 'Pokja I'
            ],
            [
                'kode' => 'Pokja II',
                'nama' => 'Pendidikan, Keterampilan & UP2K',
                'deskripsi' => 'Pelatihan usaha rumahan, bimbingan literasi pojok baca, dan pembinaan kewirausahaan keluarga.',
                'icon' => 'fa-solid fa-book-open-reader',
                'kategori_filter' => 'Pokja II'
            ],
            [
                'kode' => 'Pokja III',
                'nama' => 'Pangan, Sandang & Tata Laksana',
                'deskripsi' => 'Ketahanan pangan keluarga lewat program AKU HATINYA PKK dan sosialisasi rumah sehat layak huni.',
                'icon' => 'fa-solid fa-utensils',
                'kategori_filter' => 'Pokja III'
            ],
            [
                'kode' => 'Pokja IV',
                'nama' => 'Kesehatan & Kelestarian Lingkungan',
                'deskripsi' => 'Pelayanan posyandu balita & lansia terpadu, pencegahan stunting, serta gerakan hidup bersih sehat (PHBS).',
                'icon' => 'fa-solid fa-heart-pulse',
                'kategori_filter' => 'Pokja IV'
            ]
        ];

        // 4. Dokumentasi Galeri Kegiatan Nyata Kader
        $galeri = [
            [
                'judul' => 'Pelayanan Posyandu Balita Melati',
                'tag' => 'Kesehatan',
                'icon' => 'fa-solid fa-baby',
                'bg' => 'bg-emerald-50 text-emerald-700',
                'gambar' => '1.webp'
            ],
            [
                'judul' => 'Rapat Rutin Pengurus & Kader Dasawisma',
                'tag' => 'Koordinasi',
                'icon' => 'fa-solid fa-users',
                'bg' => 'bg-amber-50 text-amber-700',
                'gambar' => '2.webp'
            ],
            [
                'judul' => 'Pelatihan Memasak Olahan Pangan UP2K',
                'tag' => 'Ekonomi Keluarga',
                'icon' => 'fa-solid fa-utensils',
                'bg' => 'bg-blue-50 text-blue-700',
                'gambar' => '5.webp'
            ],
            [
                'judul' => 'Kerja Bakti Kebersihan Lingkungan RW',
                'tag' => 'Gotong Royong',
                'icon' => 'fa-solid fa-broom',
                'bg' => 'bg-green-50 text-green-700',
                'gambar' => '3.webp'
            ],
            [
                'judul' => 'Edukasi Gizi & Cegah Stunting Anak',
                'tag' => 'Pokja IV',
                'icon' => 'fa-solid fa-heart-pulse',
                'bg' => 'bg-rose-50 text-rose-700',
                'gambar' => '4.webp'
            ],
            [
                'judul' => 'Pembinaan Administrasi 6 Buku PKK',
                'tag' => 'Sekretariat',
                'icon' => 'fa-solid fa-book',
                'bg' => 'bg-teal-50 text-teal-700',
                'gambar' => '1.webp'
            ]
        ];

        return view('beranda', compact('statistik', 'kegiatan', 'pokja', 'galeri'));
    }
}
