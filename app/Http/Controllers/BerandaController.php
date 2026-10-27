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

        // Daftar Kegiatan PKK Terbaru
        $kegiatan = [
            [
                'judul' => 'Kegiatan Posyandu Desa Karangtanjung',
                'tanggal' => '17 Des 2024',
                'ringkasan' => 'Pemeriksaan rutin kesehatan balita, penimbangan berat badan, imunisasi, dan penyuluhan gizi seimbang untuk pencegahan stunting.',
                'kategori' => 'Kesehatan',
                'badge_color' => 'bg-emerald-100 text-emerald-800'
            ],
            [
                'judul' => 'Pertemuan Rutin TP. PKK Desa Karangtanjung',
                'tanggal' => '10 Des 2024',
                'ringkasan' => 'Evaluasi program kerja bulanan bersama kader dasawisma dan koordinasi persiapan kegiatan bakti sosial warga.',
                'kategori' => 'Organisasi',
                'badge_color' => 'bg-amber-100 text-amber-800'
            ],
            [
                'judul' => 'Kegiatan Pemberdayaan Keluarga',
                'tanggal' => '28 Nov 2024',
                'ringkasan' => 'Pelatihan keterampilan tata boga dan olahan pangan lokal guna mendorong Usaha Peningkatan Pendapatan Keluarga (UP2K).',
                'kategori' => 'Pemberdayaan',
                'badge_color' => 'bg-blue-100 text-blue-800'
            ],
            [
                'judul' => 'Kegiatan Sosial Masyarakat',
                'tanggal' => '15 Nov 2024',
                'ringkasan' => 'Aksi gotong royong kebersihan lingkungan desa, penanaman apotek hidup (AKU HATINYA PKK), dan bantuan sosial.',
                'kategori' => 'Sosial',
                'badge_color' => 'bg-purple-100 text-purple-800'
            ]
        ];

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
            ['judul' => 'Senam Sehat Bersama Kader', 'tag' => 'Kebugaran', 'icon' => 'fa-solid fa-person-running', 'bg' => 'bg-emerald-50 text-emerald-600'],
            ['judul' => 'Rapat Koordinasi Pengurus PKK', 'tag' => 'Rakor Bulanan', 'icon' => 'fa-solid fa-users', 'bg' => 'bg-amber-50 text-amber-600'],
            ['judul' => 'Pelatihan Memasak Olahan Pangan', 'tag' => 'UP2K', 'icon' => 'fa-solid fa-kitchen-set', 'bg' => 'bg-blue-50 text-blue-600'],
            ['judul' => 'Pemanfaatan Pekarangan HATINYA PKK', 'tag' => 'Lingkungan', 'icon' => 'fa-solid fa-seedling', 'bg' => 'bg-green-50 text-green-600'],
            ['judul' => 'Pelayanan Posyandu Balita & Lansia', 'tag' => 'Kesehatan', 'icon' => 'fa-solid fa-stethoscope', 'bg' => 'bg-rose-50 text-rose-600'],
            ['judul' => 'Kerja Bakti Kebersihan Saluran Desa', 'tag' => 'Gotong Royong', 'icon' => 'fa-solid fa-broom', 'bg' => 'bg-teal-50 text-teal-600']
        ];

        return view('beranda', compact('statistik', 'kegiatan', 'pokja', 'galeri'));
    }
}
