<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PokjaController extends Controller
{
    public function index()
    {
        $pokja = [
            [
                'kode'            => 'POKJA I',
                'filter_kategori' => 'Pokja I',
                'nama'            => 'Bidang Pembinaan Karakter & Gotong Royong',
                'deskripsi'       => 'Membina kerukunan dan ketahanan mental keluarga, mempraktikkan pola asuh anak remaja (PAAR), serta menggerakkan kerja bakti gotong royong kebersihan lingkungan di seluruh rukun warga Desa Karangtanjung.',
                'badge_class'     => 'bg-[#e2f5ea] text-[#065f46]',
                'ringkasan_kegiatan' => 'Kegiatan rutin: Kerja bakti jumat bersih, santunan lansia dhuafa, dan penyuluhan pola asuh keluarga.',
                'program'         => [
                    [
                        'judul'     => 'Pola Asuh Anak & Remaja (PAAR)',
                        'deskripsi' => 'Pembinaan pengasuhan penuh kasih sayang dalam keluarga guna mencegah kenakalan remaja dan pernikahan dini.',
                        'icon'      => 'fa-solid fa-people-roof',
                        'icon_color'=> 'text-emerald-700',
                    ],
                    [
                        'judul'     => 'Gotong Royong & Kepedulian Sosial',
                        'deskripsi' => 'Gerakan kerja bakti kebersihan selokan desa serta kepedulian sosial bagi keluarga lansia dan pra-sejahtera.',
                        'icon'      => 'fa-solid fa-hand-holding-heart',
                        'icon_color'=> 'text-emerald-700',
                    ],
                    [
                        'judul'     => 'Kesadaran Kerukunan & Nilai Pancasila',
                        'deskripsi' => 'Sosialisasi toleransi hidup bertetangga, pembinaan keagamaan keluarga, dan pencegahan pengaruh negatif miras/narkoba.',
                        'icon'      => 'fa-solid fa-shield-halved',
                        'icon_color'=> 'text-emerald-700',
                    ],
                ],
            ],
            [
                'kode'            => 'POKJA II',
                'filter_kategori' => 'Pokja II',
                'nama'            => 'Bidang Pendidikan dan Peningkatan Ekonomi Keluarga',
                'deskripsi'       => 'Meningkatkan keterampilan praktis kaum ibu rumah tangga melalui pelatihan tata boga olahan pangan lokal, kerajinan tangan, pengelolaan pojok baca anak, serta penguatan usaha UP2K PKK.',
                'badge_class'     => 'bg-[#dce3fc] text-[#3730a3]',
                'ringkasan_kegiatan' => 'Kegiatan rutin: Pelatihan olahan bandeng/udang khas desa, standarisasi kemasan UMKM, dan pojok baca.',
                'program'         => [
                    [
                        'judul'     => 'Penguatan Kelompok Usaha UP2K PKK',
                        'deskripsi' => 'Pendampingan usaha mikro rumahan binaan kader PKK mulai dari produksi higienis hingga pembukuan arus kas sederhana.',
                        'icon'      => 'fa-solid fa-store',
                        'icon_color'=> 'text-indigo-700',
                    ],
                    [
                        'judul'     => 'Pelatihan Keterampilan Tata Boga & Kerajinan',
                        'deskripsi' => 'Pemberian kursus memasak produk olahan bernilai jual serta keterampilan jahit menjahit bagi warga desa.',
                        'icon'      => 'fa-solid fa-graduation-cap',
                        'icon_color'=> 'text-indigo-700',
                    ],
                    [
                        'judul'     => 'Taman Bacaan & Literasi Keluarga',
                        'deskripsi' => 'Penyediaan buku bacaan anak di pos pelayanan dan bimbingan gemar membaca untuk menunjang pendidikan keluarga.',
                        'icon'      => 'fa-solid fa-book-open',
                        'icon_color'=> 'text-indigo-700',
                    ],
                ],
            ],
            [
                'kode'            => 'POKJA III',
                'filter_kategori' => 'Pokja III',
                'nama'            => 'Bidang Ketahanan Pangan & Tata Laksana Rumah',
                'deskripsi'       => 'Mewujudkan kemandirian pangan keluarga melalui pemanfaatan pekarangan rumah (HATINYA PKK), penyuluhan gizi seimbang beragam, aman, dan halal, serta pembinaan rumah sehat layak huni.',
                'badge_class'     => 'bg-[#fef0cd] text-[#92400e]',
                'ringkasan_kegiatan' => 'Kegiatan rutin: Pembagian bibit sayuran, penataan apotek hidup (TOGA), dan penyuluhan menu gizi keluarga.',
                'program'         => [
                    [
                        'judul'     => 'Gerakan AKU HATINYA PKK',
                        'deskripsi' => 'Pemanfaatan pekarangan menjadi Halaman Asri, Teratur, Indah, dan Nyaman dengan sayur mayur dan apotek hidup.',
                        'icon'      => 'fa-solid fa-leaf',
                        'icon_color'=> 'text-amber-700',
                    ],
                    [
                        'judul'     => 'Ketahanan Pangan & Gizi Seimbang (B2SA)',
                        'deskripsi' => 'Sosialisasi penyajian makanan Beragam, Bergizi Seimbang, dan Aman menggunakan bahan pangan segar hasil kebun desa.',
                        'icon'      => 'fa-solid fa-wheat-awn',
                        'icon_color'=> 'text-amber-700',
                    ],
                    [
                        'judul'     => 'Pembinaan Rumah Sehat & Layak Huni',
                        'deskripsi' => 'Edukasi ventilasi udara bersih, pencahayaan alami, pengelolaan limbah dapur, serta sanitasi hunian keluarga.',
                        'icon'      => 'fa-solid fa-house-chimney',
                        'icon_color'=> 'text-amber-700',
                    ],
                ],
            ],
            [
                'kode'            => 'POKJA IV',
                'filter_kategori' => 'Pokja IV',
                'nama'            => 'Bidang Kesehatan dan Kelestarian Lingkungan',
                'deskripsi'       => 'Ujung tombak pelayanan posyandu balita & lansia di setiap RW, pencegahan gagal tumbuh anak (stunting), pemantauan jentik nyamuk (PSN), serta pembudayaan perilaku hidup bersih dan sehat (PHBS).',
                'badge_class'     => 'bg-[#e2f5ea] text-[#065f46]',
                'ringkasan_kegiatan' => 'Kegiatan rutin: Posyandu bulanan di 6 pos, pembagian PMT balita, dan skrining kesehatan berkala.',
                'program'         => [
                    [
                        'judul'     => 'Layanan Terpadu Posyandu Balita & Lansia',
                        'deskripsi' => 'Penimbangan rutin, pemantauan kurva KMS, imunisasi balita, serta pemeriksaan tensi & gula darah berkala lansia.',
                        'icon'      => 'fa-solid fa-hospital-user',
                        'icon_color'=> 'text-emerald-700',
                    ],
                    [
                        'judul'     => 'Pencegahan & Pengentasan Stunting',
                        'deskripsi' => 'Pendampingan 1000 Hari Pertama Kehidupan (HPK), pemberian asupan makanan tambahan gizi tinggi, serta bimbingan ibu hamil.',
                        'icon'      => 'fa-solid fa-baby',
                        'icon_color'=> 'text-emerald-700',
                    ],
                    [
                        'judul'     => 'PHBS & Kebersihan Sanitasi Lingkungan',
                        'deskripsi' => 'Pemberantasan sarang nyamuk DBD, kebiasaan cuci tangan pakai sabun, jamban sehat, dan air bersih rumah tangga.',
                        'icon'      => 'fa-solid fa-hand-holding-droplet',
                        'icon_color'=> 'text-emerald-700',
                    ],
                ],
            ],
        ];

        return view('pokja', compact('pokja'));
    }
}
