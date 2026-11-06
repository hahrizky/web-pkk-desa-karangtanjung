<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProfilController extends Controller
{
    public function index()
    {
        $customPath = storage_path('app/profil_data.json');
        $custom = File::exists($customPath) ? json_decode(File::get($customPath), true) : null;

        // 1. Data Visi & Misi
        $visi = $custom['visi'] ?? "Terwujudnya Keluarga Karangtanjung yang Beriman, Berakhlak Mulia, Sehat, Sejahtera, Maju, dan Mandiri Berbasis Ketahanan Desa yang Berkelanjutan";

        $misi = [
            [
                'nomor' => '01',
                'judul' => 'Ketahanan Mental & Gotong Royong',
                'deskripsi' => 'Meningkatkan kualitas keimanan, pengamalan nilai-nilai luhur Pancasila, pembinaan kesadaran bela negara, serta semangat gotong royong warga.',
                'icon' => 'fa-solid fa-hand-holding-heart'
            ],
            [
                'nomor' => '02',
                'judul' => 'Kualitas Pendidikan & Pola Asuh Anak',
                'deskripsi' => 'Meningkatkan akses dan kualitas pendidikan formal, non-formal, keterampilan keluarga, serta pola asuh anak dan remaja yang bijak.',
                'icon' => 'fa-solid fa-graduation-cap'
            ],
            [
                'nomor' => '03',
                'judul' => 'Ketahanan Pangan & Kemandirian UP2K',
                'deskripsi' => 'Mengembangkan ketahanan pangan keluarga lewat program AKU HATINYA PKK dan mendorong kemandirian ekonomi keluarga melalui UP2K.',
                'icon' => 'fa-solid fa-seedling'
            ],
            [
                'nomor' => '04',
                'judul' => 'Kesehatan Keluarga & Kelestarian Lingkungan',
                'deskripsi' => 'Meningkatkan derajat kesehatan keluarga melalui pencegahan stunting, optimalisasi posyandu, PHBS, serta kelestarian lingkungan hidup.',
                'icon' => 'fa-solid fa-heart-pulse'
            ],
        ];

        // 2. Data Struktur Organisasi
        $pembinaNama = $custom['struktur']['pembina']['nama'] ?? 'Atmo';
        $pembinaSub  = $custom['struktur']['pembina']['sub'] ?? 'Kepala Desa Karang Tanjung';
        $ketuaNama   = $custom['struktur']['pengurus_inti'][0]['nama'] ?? 'Hj. Sunariyah';
        $wakilNama   = $custom['struktur']['pengurus_inti'][1]['nama'] ?? 'Dwi Setyowati';
        $sekretaris1 = $custom['struktur']['pengurus_inti'][2]['nama'] ?? 'Alfianita Defi, S.Pd.';
        $sekretaris2 = $custom['struktur']['pengurus_inti'][3]['nama'] ?? 'Cicik Suyanti';
        $bendahara1  = $custom['struktur']['pengurus_inti'][4]['nama'] ?? 'Ita Susanti';
        $bendahara2  = $custom['struktur']['pengurus_inti'][5]['nama'] ?? 'Nuryanti';

        $pokja1Ketua = $custom['struktur']['pokja'][0]['ketua'] ?? 'Mutma\'innah, M.Pd.';
        $pokja2Ketua = $custom['struktur']['pokja'][1]['ketua'] ?? 'Resti Duwi Rohmawati';
        $pokja3Ketua = $custom['struktur']['pokja'][2]['ketua'] ?? 'Jazil Laturohmah';
        $pokja4Ketua = $custom['struktur']['pokja'][3]['ketua'] ?? 'Lilik Mutammimah';

        $defaultFoto = file_exists(public_path('images/pengurus/default_pas_foto.jpg')) ? 'pengurus/default_pas_foto.jpg' : null;

        $pembinaFoto = $custom['struktur']['pembina']['foto'] ?? $defaultFoto;
        $ketuaFoto   = $custom['struktur']['pengurus_inti'][0]['foto'] ?? $defaultFoto;
        $wakilFoto   = $custom['struktur']['pengurus_inti'][1]['foto'] ?? $defaultFoto;
        $sekretaris1Foto = $custom['struktur']['pengurus_inti'][2]['foto'] ?? $defaultFoto;
        $sekretaris2Foto = $custom['struktur']['pengurus_inti'][3]['foto'] ?? $defaultFoto;
        $bendahara1Foto  = $custom['struktur']['pengurus_inti'][4]['foto'] ?? $defaultFoto;
        $bendahara2Foto  = $custom['struktur']['pengurus_inti'][5]['foto'] ?? $defaultFoto;

        $pokja1Foto  = $custom['struktur']['pokja'][0]['foto'] ?? $defaultFoto;
        $pokja2Foto  = $custom['struktur']['pokja'][1]['foto'] ?? $defaultFoto;
        $pokja3Foto  = $custom['struktur']['pokja'][2]['foto'] ?? $defaultFoto;
        $pokja4Foto  = $custom['struktur']['pokja'][3]['foto'] ?? $defaultFoto;

        $struktur = [
            'pembina' => [
                'jabatan' => 'Pembina',
                'nama'    => $pembinaNama,
                'sub'     => $pembinaSub,
                'foto'    => $pembinaFoto,
            ],
            'pengurus_inti' => [
                [
                    'jabatan' => 'Ketua',
                    'nama'    => $ketuaNama,
                    'warna'   => 'emerald',
                    'utama'   => true,
                    'foto'    => $ketuaFoto,
                ],
                [
                    'jabatan' => 'Wakil Ketua',
                    'nama'    => $wakilNama,
                    'warna'   => 'emerald',
                    'utama'   => false,
                    'foto'    => $wakilFoto,
                ],
                [
                    'jabatan' => 'Sekretaris I',
                    'nama'    => $sekretaris1,
                    'warna'   => 'blue',
                    'utama'   => false,
                    'foto'    => $sekretaris1Foto,
                ],
                [
                    'jabatan' => 'Sekretaris II',
                    'nama'    => $sekretaris2,
                    'warna'   => 'blue',
                    'utama'   => false,
                    'foto'    => $sekretaris2Foto,
                ],
                [
                    'jabatan' => 'Bendahara I',
                    'nama'    => $bendahara1,
                    'warna'   => 'amber',
                    'utama'   => false,
                    'foto'    => $bendahara1Foto,
                ],
                [
                    'jabatan' => 'Bendahara II',
                    'nama'    => $bendahara2,
                    'warna'   => 'amber',
                    'utama'   => false,
                    'foto'    => $bendahara2Foto,
                ],
            ],
            'pokja' => [
                [
                    'kode'  => 'Pokja I',
                    'ketua' => $pokja1Ketua,
                    'foto'  => $pokja1Foto,
                ],
                [
                    'kode'  => 'Pokja II',
                    'ketua' => $pokja2Ketua,
                    'foto'  => $pokja2Foto,
                ],
                [
                    'kode'  => 'Pokja III',
                    'ketua' => $pokja3Ketua,
                    'foto'  => $pokja3Foto,
                ],
                [
                    'kode'  => 'Pokja IV',
                    'ketua' => $pokja4Ketua,
                    'foto'  => $pokja4Foto,
                ],
            ],
        ];

        // 3. 4 Pilar Peran Strategis TP. PKK Desa
        $pilar = [
            [
                'nomor' => '1',
                'judul' => 'Pemberdayaan Keluarga',
                'deskripsi' => 'Menggerakkan potensi keluarga agar berdaya mandiri melalui bimbingan hidup sehat, terampil, dan berpengetahuan.',
                'icon' => 'fa-solid fa-users',
                'color' => 'emerald'
            ],
            [
                'nomor' => '2',
                'judul' => 'Fasilitasi Pembangunan Desa',
                'deskripsi' => 'Menjembatani aspirasi masyarakat desa khususnya kaum ibu & balita ke dalam Musrenbangdes dan program desa.',
                'icon' => 'fa-solid fa-handshake-angle',
                'color' => 'blue'
            ],
            [
                'nomor' => '3',
                'judul' => 'Penggerak Partisipasi PKK',
                'deskripsi' => 'Membangun kesadaran warga desa untuk aktif dalam kegiatan posyandu, posbindu, kebersihan lingkungan, dan dasawisma.',
                'icon' => 'fa-solid fa-bullhorn',
                'color' => 'amber'
            ],
            [
                'nomor' => '4',
                'judul' => 'Mitra Strategis Pemerintah Desa',
                'deskripsi' => 'Mendukung percepatan target SDGs Desa khususnya keluarga sehat, sejahtera, bebas stunting, dan lingkungan bersih.',
                'icon' => 'fa-solid fa-building-columns',
                'color' => 'teal'
            ]
        ];

        // 4. Tugas dan Fungsi TP. PKK
        $tugas_fungsi = [
            [
                'tipe' => 'TUGAS 01',
                'judul' => 'Penggerak Partisipasi Masyarakat',
                'deskripsi' => 'Mendorong keikutsertaan aktif warga dalam setiap program pembangunan desa dan kegiatan kemasyarakatan.',
                'icon' => 'fa-solid fa-clipboard-check'
            ],
            [
                'tipe' => 'TUGAS 02',
                'judul' => 'Koordinasi & Pelaksanaan Program Kerja',
                'deskripsi' => 'Merumuskan serta merealisasikan rencana kerja 10 Program Pokok PKK secara konsisten dan terukur di Desa Karangtanjung.',
                'icon' => 'fa-solid fa-gears'
            ],
            [
                'tipe' => 'FUNGSI 01',
                'judul' => 'Pemberdayaan Kaum Ibu & Perempuan',
                'deskripsi' => 'Memfasilitasi peningkatan keahlian kaum wanita desa dalam kepemimpinan, parenting, dan ekonomi kreatif rumah tangga.',
                'icon' => 'fa-solid fa-hand-holding-heart'
            ],
            [
                'tipe' => 'FUNGSI 02',
                'judul' => 'Monitoring Kesejahteraan Keluarga',
                'deskripsi' => 'Memantau perkembangan gizi keluarga, pemetaan stunting, data dasawisma, dan perlindungan perempuan & anak.',
                'icon' => 'fa-solid fa-shield-heart'
            ],
            [
                'tipe' => 'FUNGSI 03',
                'judul' => 'Sinergi Bersama Pemerintahan Desa',
                'deskripsi' => 'Memberikan masukan program berbasis kebutuhan keluarga dan mengawal realisasi dana desa bidang pemberdayaan.',
                'icon' => 'fa-solid fa-network-wired'
            ]
        ];

        // 5. 10 Program Pokok PKK
        $program_pokok = [
            [
                'nomor' => '01',
                'pokja' => 'Pokja I',
                'judul' => 'Penghayatan dan Pengamalan Pancasila',
                'deskripsi' => 'Menumbuhkan kesadaran beriman, bertakwa, berbudi pekerti luhur, dan cinta tanah air dalam kehidupan keluarga.',
                'icon' => 'fa-solid fa-scale-balanced'
            ],
            [
                'nomor' => '02',
                'pokja' => 'Pokja I',
                'judul' => 'Gotong Royong',
                'deskripsi' => 'Menggalang kepedulian sosial, kebersamaan, bakti lingkungan, dan kearifan lokal warga desa.',
                'icon' => 'fa-solid fa-people-carry-box'
            ],
            [
                'nomor' => '03',
                'pokja' => 'Pokja III',
                'judul' => 'Pangan',
                'deskripsi' => 'Mewujudkan ketahanan pangan keluarga dengan konsumsi beragam, bergizi seimbang, dan aman melalui AKU HATINYA PKK.',
                'icon' => 'fa-solid fa-bowl-food'
            ],
            [
                'nomor' => '04',
                'pokja' => 'Pokja III',
                'judul' => 'Sandang',
                'deskripsi' => 'Mendorong kesadaran berbusana sopan, serasi, dan mencintai produk lokal/UMKM busana nusantara.',
                'icon' => 'fa-solid fa-shirt'
            ],
            [
                'nomor' => '05',
                'pokja' => 'Pokja III',
                'judul' => 'Perumahan & Tata Laksana',
                'deskripsi' => 'Mewujudkan rumah sehat, layak huni, penataan ruang yang asri, serta pengelolaan sanitasi rumah tangga.',
                'icon' => 'fa-solid fa-house-chimney-window'
            ],
            [
                'nomor' => '06',
                'pokja' => 'Pokja II',
                'judul' => 'Pendidikan & Keterampilan',
                'deskripsi' => 'Meningkatkan mutu literasi keluarga, pelatihan keahlian praktis, dan pembinaan karakter anak sejak usia dini.',
                'icon' => 'fa-solid fa-book-open-reader'
            ],
            [
                'nomor' => '07',
                'pokja' => 'Pokja II',
                'judul' => 'Kehidupan Berkoperasi',
                'deskripsi' => 'Menggerakkan UP2K PKK dan kelompok pra-koperasi perempuan untuk memperkuat ketahanan ekonomi keluarga.',
                'icon' => 'fa-solid fa-coins'
            ],
            [
                'nomor' => '08',
                'pokja' => 'Pokja IV',
                'judul' => 'Kelestarian Lingkungan Hidup',
                'deskripsi' => 'Membudayakan pengelolaan sampah mandiri, pemilahan organik, penanaman apotek hidup, dan lingkungan bersih.',
                'icon' => 'fa-solid fa-tree'
            ],
            [
                'nomor' => '09',
                'pokja' => 'Pokja IV',
                'judul' => 'Perencanaan Sehat',
                'deskripsi' => 'Mengatur kelahiran melalui KB, perencanaan keuangan keluarga, dan persiapan generasi sehat masa depan.',
                'icon' => 'fa-solid fa-calendar-check'
            ],
            [
                'nomor' => '10',
                'pokja' => 'Pokja IV',
                'judul' => 'Kesehatan',
                'deskripsi' => 'Optimalisasi posyandu balita & lansia, pencegahan stunting terintegrasi, imunisasi, dan penerapan PHBS keluarga.',
                'icon' => 'fa-solid fa-heart-pulse'
            ]
        ];

        $periode = $custom['periode'] ?? '2024 - 2029';

        return view('profil', compact(
            'periode',
            'visi',
            'misi',
            'struktur',
            'pilar',
            'tugas_fungsi',
            'program_pokok'
        ));
    }
}
