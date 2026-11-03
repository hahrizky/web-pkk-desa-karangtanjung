<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class InformasiController extends Controller
{
    /**
     * Data Master Informasi / Berita Kegiatan PKK
     * Selaras dengan 4 Pokja dan Struktur Organisasi Desa Karangtanjung
     */
    private function getBeritaData()
    {
        return [
            [
                'id' => 1,
                'slug' => 'pertemuan-rutin-tp-pkk-desa-karangtanjung-mei',
                'judul' => 'Pertemuan Rutin Bulanan Pengurus TP. PKK Desa',
                'kategori' => 'Umum',
                'pokja' => 'Umum',
                'pokja_nama' => 'Sekretariat TP. PKK Desa Karangtanjung',
                'tanggal' => '08 Mei 2026',
                'bulan' => '05',
                'tahun' => '2026',
                'deskripsi' => 'Evaluasi pelaksanaan program kerja bulanan, koordinasi kelompok dasawisma, dan penguatan peran kader.',
                'isi' => 'Kegiatan pertemuan rutin bulanan Tim Penggerak PKK Desa Karangtanjung diselenggarakan di Balai Desa dengan dihadiri oleh jajaran pengurus TP. PKK Desa yang dipimpin oleh Hj. Sunariyah, ketua kelompok Dasawisma dari masing-masing RW, serta perangkat desa terkait. Agenda utama meliputi evaluasi berkala capaian program kerja bulan sebelumnya, sinkronisasi data rekapitulasi dasawisma, serta pemantapan kesiapan kader dalam mendukung program prioritas penanggulangan stunting dan ketahanan pangan desa. Pertemuan ini juga menjadi forum dialog interaktif warga dalam menyampaikan aspirasi program kemasyarakatan.',
                'gambar' => '1.webp',
                'tags' => ['Rapat', 'Kader', 'Dasawisma'],
                'penulis' => 'Sekretariat TP. PKK Karangtanjung',
            ],
            [
                'id' => 2,
                'slug' => 'kegiatan-sosial-masyarakat-gotong-royong',
                'judul' => 'Kerja Bakti Gotong Royong & Peduli Lingkungan Warga',
                'kategori' => 'Pokja I',
                'pokja' => 'Pokja I',
                'pokja_nama' => 'Pokja I — Bidang Pembinaan Karakter & Gotong Royong',
                'tanggal' => '20 April 2026',
                'bulan' => '04',
                'tahun' => '2026',
                'deskripsi' => 'Gotong royong kebersihan lingkungan desa, penataan apotek hidup, dan penyaluran bakti sosial warga.',
                'isi' => 'Pokja I TP. PKK Desa Karangtanjung bersama warga lingkungan RW 01 dan RW 02 melaksanakan kegiatan kerja bakti gotong royong terpadu. Fokus kegiatan meliputi pembersihan drainase lingkungan mengantisipasi musim penghujan, penataan taman apotek hidup, serta penyerahan paket sembako bakti sosial kepada lansia pra-sejahtera. Semangat gotong royong ini merupakan cerminan pengamalan nilai-nilai luhur Pancasila dalam menjaga kerukunan dan keasrian desa.',
                'gambar' => '2.webp',
                'tags' => ['Pokja1', 'KerjaBakti', 'GotongRoyong'],
                'penulis' => 'Pokja I TP. PKK Karangtanjung',
            ],
            [
                'id' => 3,
                'slug' => 'pembinaan-administrasi-6-buku-wajib-pkk',
                'judul' => 'Pembinaan Tata Kelola Administrasi 6 Buku Wajib PKK',
                'kategori' => 'Umum',
                'pokja' => 'Umum',
                'pokja_nama' => 'Sekretariat TP. PKK Desa Karangtanjung',
                'tanggal' => '08 Mei 2026',
                'bulan' => '05',
                'tahun' => '2026',
                'deskripsi' => 'Pendampingan tertib administrasi pembukuan wajib PKK bagi sekretaris kelompok dasawisma di tingkat RT/RW.',
                'isi' => 'Pertemuan berkala pengurus TP. PKK Desa Karangtanjung membahas pembinaan pembukuan 6 buku wajib PKK serta sosialisasi jadwal pembinaan dasawisma tingkat RT. Kegiatan ini bertujuan memperkuat kapasitas manajerial para kader agar pencatatan administrasi kependudukan dan kegiatan keluarga terdokumentasi secara tertib dan akuntabel.',
                'gambar' => '3.webp',
                'tags' => ['Administrasi', 'Sekretariat', 'BukuWajib'],
                'penulis' => 'Sekretariat TP. PKK Karangtanjung',
            ],
            [
                'id' => 4,
                'slug' => 'pemanfaatan-pekarangan-dan-gizi-keluarga',
                'judul' => 'Pemanfaatan Pekarangan HATINYA PKK untuk Gizi Keluarga',
                'kategori' => 'Pokja III',
                'pokja' => 'Pokja III',
                'pokja_nama' => 'Pokja III — Bidang Ketahanan Pangan & Tata Laksana Rumah',
                'tanggal' => '08 Mei 2026',
                'bulan' => '05',
                'tahun' => '2026',
                'deskripsi' => 'Sosialisasi budidaya sayuran pekarangan dan tanaman obat keluarga untuk kemandirian pangan rumah tangga.',
                'isi' => 'Sesi pelatihan dan evaluasi kader Dasawisma difokuskan pada inovasi pemanfaatan pekarangan rumah (AKU HATINYA PKK) untuk penyediaan gizi mikro keluarga mandiri. Kader diberikan demonstrasi budidaya tanaman obat keluarga dan sayuran hidroponik sederhana ramah lingkungan.',
                'gambar' => '4.webp',
                'tags' => ['Pokja3', 'HatinyaPKK', 'PanganLokal'],
                'penulis' => 'Pokja III TP. PKK Karangtanjung',
            ],
            [
                'id' => 5,
                'slug' => 'pelatihan-keterampilan-up2k-tata-boga-desa',
                'judul' => 'Pelatihan Keterampilan & Inovasi Pangan UP2K',
                'kategori' => 'Pokja II',
                'pokja' => 'Pokja II',
                'pokja_nama' => 'Pokja II — Bidang Pendidikan & Peningkatan Ekonomi (UP2K)',
                'tanggal' => '14 Maret 2026',
                'bulan' => '03',
                'tahun' => '2026',
                'deskripsi' => 'Pelatihan tata boga pengolahan komoditas lokal bandeng dan udang khas Sidoarjo untuk peningkatan ekonomi keluarga.',
                'isi' => 'Kelompok Kerja II (Pokja II) menggelar pelatihan kewirausahaan dan olahan pangan sehat bagi kelompok Usaha Peningkatan Pendapatan Keluarga (UP2K). Peserta diajarkan teknik pengemasan higienis, strategi pemasaran digital produk rumahan, serta pencatatan laba rugi sederhana guna mendongkrak pendapatan ibu rumah tangga.',
                'gambar' => '5.webp',
                'tags' => ['Pokja2', 'UP2K', 'Kewirausahaan'],
                'penulis' => 'Pokja II TP. PKK Karangtanjung',
            ],
            [
                'id' => 6,
                'slug' => 'pembinaan-ketahanan-pangan-hatinya-pkk',
                'judul' => 'Pembinaan Ketahanan Pangan Lokal (Hatinya PKK)',
                'kategori' => 'Pokja III',
                'pokja' => 'Pokja III',
                'pokja_nama' => 'Pokja III — Bidang Ketahanan Pangan & Tata Laksana Rumah',
                'tanggal' => '02 Februari 2026',
                'bulan' => '02',
                'tahun' => '2026',
                'deskripsi' => 'Sosialisasi pemanfaatan lahan pekarangan asri, teratur, indah, dan nyaman untuk ketahanan pangan mandiri.',
                'isi' => 'Pokja III menyelenggarakan bimbingan teknis HATINYA PKK (Halaman Asri, Teratur, Indah, dan Nyaman) kepada kelompok wanita tani desa. Bantuan bibit cabai, tomat, dan sayuran hijau dibagikan untuk ditanam serentak di tiap pekarangan dasawisma sebagai langkah antisipasi inflasi pangan skala rumah tangga.',
                'gambar' => '1.webp',
                'tags' => ['Pokja3', 'KetahananPangan', 'HatinyaPKK'],
                'penulis' => 'Pokja III TP. PKK Karangtanjung',
            ],
            [
                'id' => 7,
                'slug' => 'pelayanan-posyandu-balita-dan-cegah-stunting',
                'judul' => 'Layanan Terpadu Posyandu & Skrining Tumbuh Kembang',
                'kategori' => 'Pokja IV',
                'pokja' => 'Pokja IV',
                'pokja_nama' => 'Pokja IV — Bidang Kesehatan & Lingkungan Hidup',
                'tanggal' => '18 Januari 2026',
                'bulan' => '01',
                'tahun' => '2026',
                'deskripsi' => 'Penimbangan balita terintegrasi, pemberian imunisasi dasar lengkap, serta konsultasi gizi pencegahan stunting.',
                'isi' => 'Pokja IV berkolaborasi bersama tenaga kesehatan Puskesmas Candi melaksanakan posyandu balita dan posbindu lansia terintegrasi. Sebanyak 85 balita mendapatkan penimbangan, pengukuran lingkar lengan, vitamin A, serta Pemberian Makanan Tambahan (PMT) bergizi berbahan dasar pangan lokal.',
                'gambar' => '2.webp',
                'tags' => ['Pokja4', 'Posyandu', 'Kesehatan', 'Stunting'],
                'penulis' => 'Pokja IV TP. PKK Karangtanjung',
            ],
            [
                'id' => 8,
                'slug' => 'sosialisasi-tertib-administrasi-dasawisma',
                'judul' => 'Sosialisasi Tertib Administrasi Buku Wajib Dasawisma',
                'kategori' => 'Umum',
                'pokja' => 'Umum',
                'pokja_nama' => 'Sekretariat TP. PKK Desa Karangtanjung',
                'tanggal' => '10 Januari 2026',
                'bulan' => '01',
                'tahun' => '2026',
                'deskripsi' => 'Workshop pengisian buku catatan keluarga dan rekapitulasi data demografi kesehatan warga desa.',
                'isi' => 'Guna mendukung validitas basis data kependudukan dan profil kesehatan desa, Sekretariat PKK mengadakan pendampingan teknis tata kelola pengisian formulir Dasawisma tahun 2026 bagi 25 kader perwakilan se-Desa Karangtanjung.',
                'gambar' => '3.webp',
                'tags' => ['Dasawisma', 'Administrasi', 'Kader'],
                'penulis' => 'Sekretariat TP. PKK Karangtanjung',
            ],
        ];
    }

    /**
     * Data Master Agenda & Jadwal Kegiatan PKK
     */
    private function getAgendaData()
    {
        return [
            [
                'id' => 1,
                'judul' => 'Posyandu Balita',
                'kategori' => 'Pokja IV',
                'pokja_label' => 'Pokja IV (Kesehatan)',
                'tanggal' => '10',
                'bulan' => 'Nov',
                'tahun' => '2026',
                'tanggal_lengkap' => '10 November 2026',
                'hari' => 'Selasa',
                'waktu' => '08.00 – 11.00 WIB',
                'lokasi' => 'Balai Desa Karangtanjung',
                'penyelenggara' => 'Pokja IV (Kesehatan) & Bidan Desa',
                'deskripsi' => 'Kegiatan pelayanan kesehatan balita meliputi penimbangan berat badan, pengukuran tinggi badan, pemantauan tumbuh kembang, serta edukasi kesehatan ibu dan anak.',
                'isi' => 'Kegiatan Posyandu Balita rutin diselenggarakan oleh Pokja IV TP. PKK Desa Karangtanjung bekerja sama dengan Bidan Desa dan Puskesmas Candi. Pelayanan ini mencakup penimbangan berat badan, pengukuran tinggi badan dan lingkar kepala, pencatatan di KMS / Buku KIA, imunisasi dasar lengkap, serta pemberian Vitamin A dan Pemberian Makanan Tambahan (PMT) bergizi berbahan dasar pangan lokal. Kader posyandu juga membuka layanan konsultasi gizi untuk mencegah resiko stunting pada anak usia 0-5 tahun.',
                'status' => 'Contoh Agenda',
                'icon' => 'fa-solid fa-heart-pulse',
                'icon_color' => 'text-sky-600',
                'icon_bg' => 'bg-sky-50',
                'badge_color' => 'bg-sky-50 text-sky-700 border-sky-200',
            ],
            [
                'id' => 2,
                'judul' => 'Pertemuan Rutin Kader PKK',
                'kategori' => 'Umum',
                'pokja_label' => 'Sekretariat PKK',
                'tanggal' => '15',
                'bulan' => 'Nov',
                'tahun' => '2026',
                'tanggal_lengkap' => '15 November 2026',
                'hari' => 'Minggu',
                'waktu' => '09.00 – 11.00 WIB',
                'lokasi' => 'Balai Desa Karangtanjung',
                'penyelenggara' => 'Sekretariat & Pengurus Inti TP. PKK',
                'deskripsi' => 'Pertemuan koordinasi kader untuk membahas evaluasi program kerja, kegiatan dasawisma, dan rencana pelaksanaan kegiatan PKK.',
                'isi' => 'Pertemuan koordinasi bulanan seluruh pengurus TP. PKK Desa, ketua kelompok Dasawisma, dan perwakilan kader dari setiap RW di lingkungan Desa Karangtanjung. Forum ini menjadi sarana evaluasi pencapaian 10 Program Pokok PKK, sinkronisasi data rekapitulasi dasawisma, pembinaan tata kelola 6 buku wajib PKK, serta penyusunan timeline kegiatan bakti sosial dan posyandu untuk bulan selanjutnya.',
                'status' => 'Contoh Agenda',
                'icon' => 'fa-solid fa-users',
                'icon_color' => 'text-slate-600',
                'icon_bg' => 'bg-slate-100',
                'badge_color' => 'bg-slate-100 text-slate-700 border-slate-200',
            ],
            [
                'id' => 3,
                'judul' => 'Gotong Royong Lingkungan Desa',
                'kategori' => 'Pokja I',
                'pokja_label' => 'Pokja I (Gotong Royong)',
                'tanggal' => '20',
                'bulan' => 'Nov',
                'tahun' => '2026',
                'tanggal_lengkap' => '20 November 2026',
                'hari' => 'Jumat',
                'waktu' => '07.00 – 09.00 WIB',
                'lokasi' => 'Lingkungan Desa Karangtanjung',
                'penyelenggara' => 'Pokja I (Karakter & Gotong Royong)',
                'deskripsi' => 'Kegiatan kebersihan lingkungan sebagai bentuk kepedulian masyarakat terhadap lingkungan yang bersih, sehat, dan nyaman.',
                'isi' => 'Kegiatan kerja bakti dan gotong royong massal yang diinisiasi oleh Pokja I TP. PKK Desa Karangtanjung bersama jajaran perangkat desa dan masyarakat umum. Titik fokus gotong royong meliputi pembersihan drainase dan saluran air warga menjelang musim penghujan, pemilahan sampah organik dan anorganik di pekarangan rumah, serta perapihan tanaman peneduh di ruas jalan utama desa demi mewujudkan desa yang asri, teratur, dan bebas banjir.',
                'status' => 'Contoh Agenda',
                'icon' => 'fa-solid fa-broom',
                'icon_color' => 'text-emerald-700',
                'icon_bg' => 'bg-emerald-50',
                'badge_color' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
            ],
            [
                'id' => 4,
                'judul' => 'Pelatihan UP2K',
                'kategori' => 'Pokja II',
                'pokja_label' => 'Pokja II (Ekonomi UP2K)',
                'tanggal' => '25',
                'bulan' => 'Nov',
                'tahun' => '2026',
                'tanggal_lengkap' => '25 November 2026',
                'hari' => 'Rabu',
                'waktu' => '09.00 – 12.00 WIB',
                'lokasi' => 'Balai Desa Karangtanjung',
                'penyelenggara' => 'Pokja II (Pendidikan & Keterampilan UP2K)',
                'deskripsi' => 'Kegiatan pembinaan keterampilan dan pemberdayaan ekonomi keluarga melalui pengembangan usaha peningkatan pendapatan keluarga.',
                'isi' => 'Program pelatihan kewirausahaan dan keterampilan olahan pangan lokal bagi kelompok Usaha Peningkatan Pendapatan Keluarga (UP2K) binaan Pokja II TP. PKK Desa Karangtanjung. Pelatihan ini menghadirkan praktisi UMKM kuliner dan dinas terkait guna memberikan edukasi mengenai pengolahan produk ikan bandeng higienis, standarisasi kemasan berlabel halal, pembukuan keuangan arus kas sederhana, serta strategi promosi digital via media sosial.',
                'status' => 'Contoh Agenda',
                'icon' => 'fa-solid fa-briefcase',
                'icon_color' => 'text-amber-700',
                'icon_bg' => 'bg-amber-50',
                'badge_color' => 'bg-amber-50 text-amber-800 border-amber-200',
            ],
        ];
    }

    /**
     * Data Master Pengumuman Resmi PKK
     */
    private function getPengumumanData()
    {
        return [
            [
                'id' => 1,
                'kategori' => 'Kesehatan',
                'pokja_label' => 'Pokja IV',
                'tanggal' => '05 November 2026',
                'judul' => 'Informasi Pelaksanaan Kegiatan Posyandu Balita',
                'deskripsi' => 'Pemberitahuan mengenai pelaksanaan pelayanan Posyandu balita sebagai bagian dari upaya pemantauan kesehatan dan tumbuh kembang anak di Desa Karangtanjung.',
                'isi' => "Diberitahukan kepada seluruh warga Desa Karangtanjung yang memiliki putra-putri usia balita (0-5 tahun), bahwa kegiatan pelayanan Posyandu Balita bulan November 2026 akan dilaksanakan serentak di Pos Pelayanan RW 01 sampai dengan RW 05 mulai pukul 08.00 WIB sampai selesai.\n\nPelayanan yang diberikan meliputi:\n1. Penimbangan berat badan dan pengukuran tinggi badan anak.\n2. Pencatatan grafik pertumbuhan pada Kartu Menuju Sehat (KMS).\n3. Pelayanan imunisasi rutin dasar dan lanjutan.\n4. Pemberian Vitamin A dan suplemen gizi.\n5. Konsultasi kesehatan ibu dan anak bersama Bidan Desa.\n6. Pembagian Pemberian Makanan Tambahan (PMT) bergizi seimbang.\n\nDimohon kepada para ibu untuk membawa Buku KIA (Kesehatan Ibu dan Anak) saat datang ke posyandu.",
                'penulis' => 'Pokja IV (Kesehatan) TP. PKK Karangtanjung',
                'icon' => 'fa-solid fa-heart-pulse',
                'icon_bg' => 'bg-sky-50',
                'icon_color' => 'text-sky-600',
                'badge_color' => 'bg-sky-50 text-sky-700 border-sky-200',
            ],
            [
                'id' => 2,
                'kategori' => 'Kegiatan PKK',
                'pokja_label' => 'Sekretariat',
                'tanggal' => '03 November 2026',
                'judul' => 'Informasi Pertemuan Rutin Kader PKK',
                'deskripsi' => 'Pemberitahuan kepada kader PKK mengenai kegiatan koordinasi dan evaluasi program kerja serta pelaksanaan kegiatan pemberdayaan keluarga.',
                'isi' => "Sehubungan dengan pelaksanaan monitoring dan evaluasi program kerja triwulan akhir tahun 2026, kami mengundang Bapak/Ibu Pengurus TP. PKK Desa Karangtanjung, Ketua Kelompok Dasawisma, dan kader posyandu dari seluruh rukun warga untuk menghadiri Pertemuan Koordinasi Bulanan.\n\nAgenda Rapat:\n1. Evaluasi laporan pertanggungjawaban kegiatan Pokja I s/d Pokja IV.\n2. Validasi data catatan keluarga dan pembaruan buku administrasi dasawisma.\n3. Sosialisasi jadwal kegiatan bakti sosial dan posyandu bulan Desember.\n4. Koordinasi persiapan lomba desa tingkat kecamatan.\n\nAcara diselenggarakan di Balai Desa Karangtanjung. Diharapkan kehadiran tepat waktu pada pukul 09.00 WIB dengan mengenakan seragam batik PKK nasional.",
                'penulis' => 'Sekretariat TP. PKK Desa Karangtanjung',
                'icon' => 'fa-solid fa-users',
                'icon_bg' => 'bg-emerald-50',
                'icon_color' => 'text-emerald-700',
                'badge_color' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
            ],
            [
                'id' => 3,
                'kategori' => 'Pemberdayaan',
                'pokja_label' => 'Pokja II',
                'tanggal' => '01 November 2026',
                'judul' => 'Informasi Program Pemberdayaan Ekonomi Keluarga',
                'deskripsi' => 'Informasi kegiatan pembinaan dan pengembangan keterampilan keluarga melalui program UP2K untuk mendukung peningkatan ekonomi rumah tangga.',
                'isi' => "Pokja II TP. PKK Desa Karangtanjung mengumumkan pembukaan pendaftaran bagi kelompok usaha rintisan warga dalam program pembinaan Usaha Peningkatan Pendapatan Keluarga (UP2K) periode tahun 2026-2027.\n\nProgram ini bertujuan untuk:\n1. Memberikan pendampingan teknis manajemen produksi rumahan.\n2. Fasilitasi pengurusan Nomor Induk Berusaha (NIB) dan sertifikasi Halal gratis.\n3. Pelatihan pengemasan produk ramah lingkungan dan teknik pemasaran daring.\n4. Akses fasilitasi permodalan bergulir melalui kemitraan BUMDes Karangtanjung.\n\nBagi warga atau kelompok dasawisma yang berminat dapat mendaftarkan diri melalui ketua Dasawisma masing-masing atau menghubungi koordinator Pokja II di kantor Balai Desa.",
                'penulis' => 'Pokja II (Pendidikan & Keterampilan) TP. PKK',
                'icon' => 'fa-solid fa-briefcase',
                'icon_bg' => 'bg-amber-50',
                'icon_color' => 'text-amber-700',
                'badge_color' => 'bg-amber-50 text-amber-800 border-amber-200',
            ],
            [
                'id' => 4,
                'kategori' => 'Lingkungan',
                'pokja_label' => 'Pokja I & III',
                'tanggal' => '28 Oktober 2026',
                'judul' => 'Informasi Kegiatan Kebersihan Lingkungan Desa',
                'deskripsi' => 'Pemberitahuan kegiatan gotong royong dan kepedulian lingkungan sebagai bagian dari pembinaan keluarga dan masyarakat.',
                'isi' => "Dalam rangka menjaga kelestarian lingkungan dan mengantisipasi genangan air pada musim penghujan, Pokja I dan Pokja III mengimbau seluruh lapisan warga Desa Karangtanjung untuk bersama-sama melaksanakan kegiatan kebersihan lingkungan serentak.\n\nHimbauan Warga:\n1. Menguras tempat penampungan air secara berkala untuk memberantas jentik nyamuk Aedes aegypti.\n2. Membersihkan saluran selokan di depan hunian masing-masing dari tumpukan sampah plastik.\n3. Menata dan merawat pekarangan rumah dengan tanaman apotek hidup (HATINYA PKK).\n4. Tidak membuang sampah domestik ke aliran sungai atau selokan desa.\n\nKebersihan lingkungan merupakan tanggung jawab bersama demi kenyamanan dan kesehatan seluruh keluarga di Desa Karangtanjung.",
                'penulis' => 'Pokja I & Pokja III TP. PKK Karangtanjung',
                'icon' => 'fa-solid fa-seedling',
                'icon_bg' => 'bg-teal-50',
                'icon_color' => 'text-teal-700',
                'badge_color' => 'bg-teal-50 text-teal-800 border-teal-200',
            ],
        ];
    }

    /**
     * Data Master Ringkasan Panel Informasi Penting
     */
    private function getInfoPentingData()
    {
        return [
            [
                'id' => 1,
                'judul' => 'Pelayanan Posyandu',
                'deskripsi' => 'Informasi pelayanan kesehatan ibu dan anak serta pemantauan tumbuh kembang balita.',
                'icon' => 'fa-solid fa-stethoscope',
                'link_label' => 'Lihat Program Pokja IV',
                'route' => 'pokja',
            ],
            [
                'id' => 2,
                'judul' => 'Kegiatan Dasawisma',
                'deskripsi' => 'Informasi kegiatan pendataan, pembinaan, dan pemberdayaan keluarga melalui kelompok dasawisma.',
                'icon' => 'fa-solid fa-people-group',
                'link_label' => 'Lihat Struktur Pengurus',
                'route' => 'profil',
            ],
            [
                'id' => 3,
                'judul' => 'Program Kerja Pokja',
                'deskripsi' => 'Informasi pelaksanaan program kerja Pokja I, II, III, dan IV.',
                'icon' => 'fa-solid fa-list-check',
                'link_label' => 'Buka Rincian 4 Pokja',
                'route' => 'pokja',
            ],
            [
                'id' => 4,
                'judul' => 'Kegiatan Masyarakat',
                'deskripsi' => 'Informasi kegiatan sosial, gotong royong, dan partisipasi masyarakat desa.',
                'icon' => 'fa-solid fa-hand-holding-heart',
                'link_label' => 'Kembali ke Beranda Desa',
                'route' => 'beranda',
            ],
        ];
    }

    /**
     * Halaman Utama Informasi & Dokumentasi
     */
    public function index(Request $request)
    {
        $allBerita = collect($this->getBeritaData());

        // Filter Pencarian (Search)
        if ($request->filled('q')) {
            $q = strtolower($request->input('q'));
            $allBerita = $allBerita->filter(function ($item) use ($q) {
                return str_contains(strtolower($item['judul']), $q) ||
                       str_contains(strtolower($item['deskripsi']), $q) ||
                       str_contains(strtolower($item['kategori']), $q) ||
                       str_contains(strtolower(implode(' ', $item['tags'])), $q);
            });
        }

        // Filter Kategori (Pokja / Umum / Semua)
        if ($request->filled('kategori') && $request->input('kategori') !== 'Semua') {
            $kat = $request->input('kategori');
            $allBerita = $allBerita->filter(function ($item) use ($kat) {
                return strcasecmp($item['kategori'], $kat) === 0;
            });
        }

        // Filter Bulan
        if ($request->filled('bulan') && $request->input('bulan') !== '') {
            $bln = $request->input('bulan');
            $allBerita = $allBerita->filter(function ($item) use ($bln) {
                return $item['bulan'] == $bln;
            });
        }

        // Filter Tahun
        if ($request->filled('tahun') && $request->input('tahun') !== '') {
            $thn = $request->input('tahun');
            $allBerita = $allBerita->filter(function ($item) use ($thn) {
                return $item['tahun'] == $thn;
            });
        }

        // Pagination Manual (4 item per halaman sesuai grid 2x2)
        $perPage = 4;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $allBerita->slice(($currentPage - 1) * $perPage, $perPage)->all();

        $beritaPaginated = new LengthAwarePaginator(
            $currentItems,
            $allBerita->count(),
            $perPage,
            $currentPage,
            ['path' => route('informasi.index'), 'query' => $request->query()]
        );

        // Kategori Filter Pills
        $kategoriList = ['Semua', 'Pokja I', 'Pokja II', 'Pokja III', 'Pokja IV', 'Umum'];

        // Daftar Bulan
        $bulanList = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];

        // Daftar Tahun
        $tahunList = ['2026', '2025', '2024'];

        // Data Agenda Kegiatan & Pengumuman untuk Halaman Informasi Utama
        $agendaList = $this->getAgendaData();
        $pengumumanList = $this->getPengumumanData();
        $infoPenting = $this->getInfoPentingData();

        return view('informasi.index', compact(
            'beritaPaginated',
            'kategoriList',
            'bulanList',
            'tahunList',
            'agendaList',
            'pengumumanList',
            'infoPenting'
        ));
    }

    /**
     * Halaman Detail Berita
     */
    public function show($id)
    {
        $allBerita = collect($this->getBeritaData());
        $berita = $allBerita->firstWhere('id', (int) $id);

        if (!$berita) {
            abort(404, 'Berita atau kegiatan tidak ditemukan');
        }

        // Rekomendasi Berita Lainnya (selain yang sedang dibaca)
        $beritaLainnya = $allBerita->where('id', '!=', (int) $id)->take(3);

        return view('informasi.show', compact('berita', 'beritaLainnya'));
    }

    /**
     * Halaman Daftar Agenda Kegiatan PKK
     */
    public function agendaIndex()
    {
        $agendas = $this->getAgendaData();
        return view('informasi.agenda-index', compact('agendas'));
    }

    /**
     * Halaman Detail Agenda Kegiatan PKK
     */
    public function agendaShow($id)
    {
        $allAgenda = collect($this->getAgendaData());
        $agenda = $allAgenda->firstWhere('id', (int) $id);

        if (!$agenda) {
            abort(404, 'Agenda kegiatan tidak ditemukan');
        }

        $agendaLainnya = $allAgenda->where('id', '!=', (int) $id)->take(3);

        return view('informasi.agenda-show', compact('agenda', 'agendaLainnya'));
    }

    /**
     * Halaman Daftar Pengumuman PKK
     */
    public function pengumumanIndex()
    {
        $pengumumans = $this->getPengumumanData();
        $infoPenting = $this->getInfoPentingData();

        return view('informasi.pengumuman-index', compact('pengumumans', 'infoPenting'));
    }

    /**
     * Halaman Detail Pengumuman PKK
     */
    public function pengumumanShow($id)
    {
        $allPengumuman = collect($this->getPengumumanData());
        $pengumuman = $allPengumuman->firstWhere('id', (int) $id);

        if (!$pengumuman) {
            abort(404, 'Pengumuman tidak ditemukan');
        }

        $pengumumanLainnya = $allPengumuman->where('id', '!=', (int) $id)->take(3);
        $infoPenting = $this->getInfoPentingData();

        return view('informasi.pengumuman-show', compact('pengumuman', 'pengumumanLainnya', 'infoPenting'));
    }
}
