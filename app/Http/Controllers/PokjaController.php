<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PokjaController extends Controller
{
    public function index()
    {
        $pokja = [
            [
                'kode'      => 'POKJA I',
                'nama'      => 'Bidang Pembinaan Karakter & Gotong Royong',
                'deskripsi' => 'Memperkokoh ketahanan mental spiritual keluarga, menanamkan nilai-nilai luhur Pancasila dalam pengasuhan generasi muda, serta menghidupkan kembali tradisi gotong royong di seluruh rukun warga Desa Karangtanjung.',
                'badge_class' => 'bg-[#e2f5ea] text-[#065f46]',
                'program'   => [
                    [
                        'judul'     => 'Pola Asuh Anak & Remaja (PAAR)',
                        'deskripsi' => 'Pembinaan pengasuhan penuh cinta dan kasih sayang dalam keluarga guna mencegah kekerasan serta pernikahan dini.',
                        'icon'      => 'fa-solid fa-people-roof',
                        'icon_color'=> 'text-emerald-700',
                    ],
                    [
                        'judul'     => 'Gotong Royong & Kepedulian Sosial',
                        'deskripsi' => 'Penggerakan kerja bakti kebersihan lingkungan rutin dan pendampingan lansia terlantar bersama kader Dasawisma & RW.',
                        'icon'      => 'fa-solid fa-hand-holding-heart',
                        'icon_color'=> 'text-emerald-700',
                    ],
                    [
                        'judul'     => 'Kesadaran Bela Negara (PKBN)',
                        'deskripsi' => 'Sosialisasi wawasan kebangsaan, toleransi rukun tetangga, dan pencegahan penyalahgunaan zat terlarang di kalangan remaja.',
                        'icon'      => 'fa-solid fa-shield-halved',
                        'icon_color'=> 'text-emerald-700',
                    ],
                ],
            ],
            [
                'kode'      => 'POKJA II',
                'nama'      => 'Bidang Pendidikan dan Peningkatan Ekonomi Keluarga',
                'deskripsi' => 'Meningkatkan kapasitas kecakapan hidup warga melalui pelatihan vokasi mandiri, tata kelola keuangan rumah tangga, serta pembinaan kelompok UP2K PKK di tingkat basis.',
                'badge_class' => 'bg-[#dce3fc] text-[#3730a3]',
                'program'   => [
                    [
                        'judul'     => 'Taman Bacaan Masyarakat dan BKB',
                        'deskripsi' => 'Pengelolaan pojok baca keluarga serta integrasi bina keluarga balita (BKB) bersama kegiatan posyandu lingkungan.',
                        'icon'      => 'fa-solid fa-book-open',
                        'icon_color'=> 'text-teal-700',
                    ],
                    [
                        'judul'     => 'Peningkatan Kualitas Pendidikan & Keterampilan',
                        'deskripsi' => 'Pelatihan kerajinan, menjahit, kewirausahaan dasar, dan bimbingan literasi fungsional bagi warga desa.',
                        'icon'      => 'fa-solid fa-graduation-cap',
                        'icon_color'=> 'text-teal-700',
                    ],
                    [
                        'judul'     => 'Penguatan UP2K PKK',
                        'deskripsi' => 'Pendataan, pembinaan tertib administrasi pembukuan usaha kecil, serta fasilitasi promosi produk lokal warga.',
                        'icon'      => 'fa-solid fa-store',
                        'icon_color'=> 'text-teal-700',
                    ],
                ],
            ],
            [
                'kode'      => 'POKJA III',
                'nama'      => 'Bidang Penguatan Ketahanan Keluarga',
                'deskripsi' => 'Mewujudkan kemandirian pangan tingkat rumah tangga melalui pemanfaatan lahan pekarangan, pembudayaan konsumsi pangan beragam, bergizi seimbang, dan aman (B2SA), serta tata laksana hunian sehat.',
                'badge_class' => 'bg-[#fef0cd] text-[#92400e]',
                'program'   => [
                    [
                        'judul'     => 'Pekarangan Pangan Lestari (P2L)',
                        'deskripsi' => 'Optimalisasi sayuran pekarangan, kolam gizi keluarga, dan budidaya tanaman cepat panen untuk kebutuhan nutrisi sehari-hari.',
                        'icon'      => 'fa-solid fa-wheat-awn',
                        'icon_color'=> 'text-amber-700',
                    ],
                    [
                        'judul'     => 'Program HATINYA PKK',
                        'deskripsi' => 'Gerakan Halaman Asri, Teratur, Indah, dan Nyaman melalui penataan tanaman obat keluarga (TOGA) serta lumbung hidup.',
                        'icon'      => 'fa-solid fa-leaf',
                        'icon_color'=> 'text-amber-700',
                    ],
                    [
                        'judul'     => 'Sosialisasi Rumah Sehat Layak Huni',
                        'deskripsi' => 'Penyuluhan tata ruang rumah berpenghawaan bersih, sanitasi layak, pencahayaan alami, serta penghematan energi rumah tangga.',
                        'icon'      => 'fa-solid fa-house-chimney',
                        'icon_color'=> 'text-amber-700',
                    ],
                ],
            ],
            [
                'kode'      => 'POKJA IV',
                'nama'      => 'Bidang Kesehatan dan Kelestarian Lingkungan',
                'deskripsi' => 'Memimpin garda depan perlindungan kesehatan keluarga, pencegahan gagal tumbuh pada anak balita (stunting), pelestarian sanitasi air bersih, serta perencanaan keluarga sejahtera berwawasan masa depan.',
                'badge_class' => 'bg-[#e2f5ea] text-[#065f46]',
                'program'   => [
                    [
                        'judul'     => 'Posyandu Balita & Lansia di 6 RW',
                        'deskripsi' => 'Pelayanan penimbangan berat badan, imunisasi dasar, pemeriksaan kesehatan lansia, dan konseling gizi terpadu.',
                        'icon'      => 'fa-solid fa-hospital-user',
                        'icon_color'=> 'text-emerald-700',
                    ],
                    [
                        'judul'     => 'Gerakan Pencegahan & Penurunan Stunting',
                        'deskripsi' => 'Pemantauan 1000 Hari Pertama Kehidupan (HPK), pendampingan ibu hamil berisiko, serta penyaluran PMT bergizi.',
                        'icon'      => 'fa-solid fa-baby',
                        'icon_color'=> 'text-emerald-700',
                    ],
                    [
                        'judul'     => 'PHBS & Perencanaan Keluarga Sehat',
                        'deskripsi' => 'Pemberantasan sarang nyamuk (PSN), pembiasaan cuci tangan pakai sabun, akses jamban sehat, serta edukasi KB.',
                        'icon'      => 'fa-solid fa-hand-holding-droplet',
                        'icon_color'=> 'text-emerald-700',
                    ],
                ],
            ],
        ];

        return view('pokja', compact('pokja'));
    }
}
