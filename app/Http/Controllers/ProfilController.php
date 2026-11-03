<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        // 1. Data Visi & Misi TP. PKK Desa Karangtanjung
        $visi = "Terwujudnya Keluarga Desa Karangtanjung yang Beriman, Berakhlak Mulia, Sehat, Sejahtera, dan Mandiri";

        $misi = [
            [
                'nomor' => '01',
                'judul' => 'Pembinaan Karakter & Gotong Royong',
                'deskripsi' => 'Meningkatkan keimanan, kerukunan antarwarga, serta membudayakan semangat gotong royong di seluruh rukun warga.',
                'icon' => 'fa-solid fa-hand-holding-heart'
            ],
            [
                'nomor' => '02',
                'judul' => 'Keterampilan & Usaha Ekonomi Keluarga',
                'deskripsi' => 'Meningkatkan keterampilan ibu rumah tangga melalui pelatihan olahan pangan dan pembinaan kelompok UP2K.',
                'icon' => 'fa-solid fa-graduation-cap'
            ],
            [
                'nomor' => '03',
                'judul' => 'Ketahanan Pangan & Rumah Sehat',
                'deskripsi' => 'Mengoptimalkan pemanfaatan pekarangan rumah (HATINYA PKK) dan tata laksana hunian yang asri, bersih, dan sehat.',
                'icon' => 'fa-solid fa-seedling'
            ],
            [
                'nomor' => '04',
                'judul' => 'Kesehatan Ibu, Balita & Cegah Stunting',
                'deskripsi' => 'Menjaga kesehatan keluarga melalui posyandu balita dan lansia, pendampingan gizi, dan gerakan hidup bersih (PHBS).',
                'icon' => 'fa-solid fa-heart-pulse'
            ],
        ];

        // 2. Data Struktur Organisasi Pengurus Desa Asli
        $struktur = [
            'pembina' => [
                'jabatan' => 'Pembina',
                'nama'    => 'Atmo',
                'sub'     => 'Kepala Desa Karangtanjung',
            ],
            'pengurus_inti' => [
                [
                    'jabatan' => 'Ketua',
                    'nama'    => 'Hj. Sunariyah',
                    'warna'   => 'emerald',
                    'utama'   => true,
                ],
                [
                    'jabatan' => 'Wakil Ketua',
                    'nama'    => 'Dwi Setyowati',
                    'warna'   => 'emerald',
                    'utama'   => false,
                ],
                [
                    'jabatan' => 'Sekretaris I',
                    'nama'    => 'Alfianita Defi, S.Pd.',
                    'warna'   => 'blue',
                    'utama'   => false,
                ],
                [
                    'jabatan' => 'Sekretaris II',
                    'nama'    => 'Cicik Suyanti',
                    'warna'   => 'blue',
                    'utama'   => false,
                ],
                [
                    'jabatan' => 'Bendahara I',
                    'nama'    => 'Ita Susanti',
                    'warna'   => 'amber',
                    'utama'   => false,
                ],
                [
                    'jabatan' => 'Bendahara II',
                    'nama'    => 'Nuryanti',
                    'warna'   => 'amber',
                    'utama'   => false,
                ],
            ],
            'pokja' => [
                [
                    'kode'  => 'Pokja I',
                    'ketua' => 'Mutma\'innah, M.Pd.',
                    'bidang'=> 'Karakter & Gotong Royong',
                ],
                [
                    'kode'  => 'Pokja II',
                    'ketua' => 'Resti Duwi Rohmawati',
                    'bidang'=> 'Pendidikan & UP2K',
                ],
                [
                    'kode'  => 'Pokja III',
                    'ketua' => 'Jazil Laturohmah',
                    'bidang'=> 'Pangan & Rumah Sehat',
                ],
                [
                    'kode'  => 'Pokja IV',
                    'ketua' => 'Lilik Mutammimah',
                    'bidang'=> 'Kesehatan & Posyandu',
                ],
            ],
        ];

        // 3. Fokus Aksi & Kegiatan Nyata Kader PKK di Desa Karangtanjung
        $fokus_kegiatan = [
            [
                'nomor' => '1',
                'judul' => 'Layanan Kesehatan Posyandu & Gizi',
                'deskripsi' => 'Pelayanan penimbangan rutin balita, pembagian vitamin A, imunisasi dasar, serta PMT bergizi untuk pencegahan stunting.',
                'pokja' => 'Pokja IV',
                'icon' => 'fa-solid fa-heart-pulse',
                'kategori_filter' => 'Pokja IV'
            ],
            [
                'nomor' => '2',
                'judul' => 'Pemberdayaan Usaha Rumahan (UP2K)',
                'deskripsi' => 'Pelatihan tata boga pangan lokal, kemasan produk higienis, dan pembukuan sederhana untuk menambah penghasilan keluarga.',
                'pokja' => 'Pokja II',
                'icon' => 'fa-solid fa-store',
                'kategori_filter' => 'Pokja II'
            ],
            [
                'nomor' => '3',
                'judul' => 'Pemanfaatan Pekarangan (HATINYA PKK)',
                'deskripsi' => 'Penanaman sayuran pekarangan, kolam gizi, dan apotek hidup keluarga guna mendukung ketahanan pangan mandiri.',
                'pokja' => 'Pokja III',
                'icon' => 'fa-solid fa-seedling',
                'kategori_filter' => 'Pokja III'
            ],
            [
                'nomor' => '4',
                'judul' => 'Kerja Bakti & Pembinaan Dasawisma',
                'deskripsi' => 'Gerakan kebersihan lingkungan serentak, bakti sosial warga lansia, serta rekapitulasi data catatan keluarga di tiap RW.',
                'pokja' => 'Pokja I',
                'icon' => 'fa-solid fa-hand-holding-heart',
                'kategori_filter' => 'Pokja I'
            ]
        ];

        // 4. 10 Program Pokok PKK (Landasan Resmi Nasional)
        $program_pokok = [
            [
                'nomor' => '01',
                'pokja' => 'Pokja I',
                'judul' => 'Penghayatan dan Pengamalan Pancasila',
                'deskripsi' => 'Menumbuhkan kesadaran beriman, berbudi luhur, dan kerukunan dalam keluarga.',
                'icon' => 'fa-solid fa-scale-balanced'
            ],
            [
                'nomor' => '02',
                'pokja' => 'Pokja I',
                'judul' => 'Gotong Royong',
                'deskripsi' => 'Menggalang kepedulian sosial, kebersihan lingkungan, dan kearifan lokal warga.',
                'icon' => 'fa-solid fa-people-carry-box'
            ],
            [
                'nomor' => '03',
                'pokja' => 'Pokja III',
                'judul' => 'Pangan',
                'deskripsi' => 'Mewujudkan ketahanan pangan keluarga bergizi seimbang lewat HATINYA PKK.',
                'icon' => 'fa-solid fa-bowl-food'
            ],
            [
                'nomor' => '04',
                'pokja' => 'Pokja III',
                'judul' => 'Sandang',
                'deskripsi' => 'Mendorong kesadaran berbusana sopan, serasi, dan mencintai produk lokal.',
                'icon' => 'fa-solid fa-shirt'
            ],
            [
                'nomor' => '05',
                'pokja' => 'Pokja III',
                'judul' => 'Perumahan & Tata Laksana',
                'deskripsi' => 'Mewujudkan hunian sehat, layak huni, asri, dan sanitasi lingkungan yang baik.',
                'icon' => 'fa-solid fa-house-chimney-window'
            ],
            [
                'nomor' => '06',
                'pokja' => 'Pokja II',
                'judul' => 'Pendidikan & Keterampilan',
                'deskripsi' => 'Meningkatkan literasi keluarga dan pelatihan keterampilan praktis ibu rumah tangga.',
                'icon' => 'fa-solid fa-book-open-reader'
            ],
            [
                'nomor' => '07',
                'pokja' => 'Pokja II',
                'judul' => 'Pengembangan Kehidupan Berkoperasi',
                'deskripsi' => 'Menggerakkan kelompok usaha UP2K guna meningkatkan pendapatan keluarga.',
                'icon' => 'fa-solid fa-coins'
            ],
            [
                'nomor' => '08',
                'pokja' => 'Pokja IV',
                'judul' => 'Kelestarian Lingkungan Hidup',
                'deskripsi' => 'Pengelolaan kebersihan selokan, bebas jentik nyamuk, dan pemilahan sampah.',
                'icon' => 'fa-solid fa-tree'
            ],
            [
                'nomor' => '09',
                'pokja' => 'Pokja IV',
                'judul' => 'Perencanaan Sehat',
                'deskripsi' => 'Pengaturan keluarga berencana, pola hidup sehat, dan persiapan masa depan anak.',
                'icon' => 'fa-solid fa-calendar-check'
            ],
            [
                'nomor' => '10',
                'pokja' => 'Pokja IV',
                'judul' => 'Kesehatan',
                'deskripsi' => 'Pelayanan posyandu balita & lansia, pencegahan stunting, dan penerapan PHBS.',
                'icon' => 'fa-solid fa-heart-pulse'
            ]
        ];

        return view('profil', compact(
            'visi',
            'misi',
            'struktur',
            'fokus_kegiatan',
            'program_pokok'
        ));
    }
}
