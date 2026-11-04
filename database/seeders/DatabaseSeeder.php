<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Berita;
use App\Models\Agenda;
use App\Models\StatistikDasawisma;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Admin Default
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator TP. PKK',
                'email' => 'admin@karangtanjung.desa.id',
                'password' => Hash::make('pkk2024'),
            ]
        );

        // 2. Data Statistik Dasawisma
        $statistik = [
            [
                'judul' => 'Jumlah KK',
                'nilai' => '300',
                'deskripsi' => 'Penduduk keluarga di Desa Karangtanjung',
                'warna' => 'green',
                'icon' => 'fa-solid fa-house-chimney-user',
                'urutan' => 1,
            ],
            [
                'judul' => 'Jumlah Laki-laki',
                'nilai' => '1.200',
                'deskripsi' => 'Penduduk laki-laki di Desa Karangtanjung',
                'warna' => 'orange',
                'icon' => 'fa-solid fa-person',
                'urutan' => 2,
            ],
            [
                'judul' => 'Jumlah Perempuan',
                'nilai' => '300',
                'deskripsi' => 'Penduduk perempuan di Desa Karangtanjung',
                'warna' => 'blue',
                'icon' => 'fa-solid fa-person-dress',
                'urutan' => 3,
            ],
        ];

        StatistikDasawisma::truncate();
        foreach ($statistik as $st) {
            StatistikDasawisma::create($st);
        }

        // 3. Data Berita Kegiatan PKK
        $beritaList = [
            [
                'judul' => 'Pertemuan Rutin Bulanan Pengurus TP. PKK Desa',
                'slug' => 'pertemuan-rutin-tp-pkk-desa-karangtanjung-mei',
                'kategori' => 'Umum',
                'tanggal' => '2026-05-08',
                'ringkasan' => 'Evaluasi pelaksanaan program kerja bulanan, koordinasi kelompok dasawisma, dan penguatan peran kader.',
                'konten' => 'Kegiatan pertemuan rutin bulanan Tim Penggerak PKK Desa Karangtanjung diselenggarakan di Balai Desa dengan dihadiri oleh jajaran pengurus TP. PKK Desa yang dipimpin oleh Hj. Sunariyah, ketua kelompok Dasawisma dari masing-masing RW, serta perangkat desa terkait. Agenda utama meliputi evaluasi berkala capaian program kerja bulan sebelumnya, sinkronisasi data rekapitulasi dasawisma, serta pemantapan kesiapan kader dalam mendukung program prioritas penanggulangan stunting dan ketahanan pangan desa. Pertemuan ini juga menjadi forum dialog interaktif warga dalam menyampaikan aspirasi program kemasyarakatan.',
                'gambar' => '1.webp',
                'tags' => ['Rapat', 'Kader', 'Dasawisma'],
                'penulis' => 'Sekretariat TP. PKK Karangtanjung',
                'status' => 'published',
            ],
            [
                'judul' => 'Kerja Bakti Gotong Royong & Peduli Lingkungan Warga',
                'slug' => 'kegiatan-sosial-masyarakat-gotong-royong',
                'kategori' => 'Pokja I',
                'tanggal' => '2026-04-20',
                'ringkasan' => 'Gotong royong kebersihan lingkungan desa, penataan apotek hidup, dan penyaluran bakti sosial warga.',
                'konten' => 'Pokja I TP. PKK Desa Karangtanjung bersama warga lingkungan RW 01 dan RW 02 melaksanakan kegiatan kerja bakti gotong royong terpadu. Fokus kegiatan meliputi pembersihan drainase lingkungan mengantisipasi musim penghujan, penataan taman apotek hidup, serta penyerahan paket sembako bakti sosial kepada lansia pra-sejahtera. Semangat gotong royong ini merupakan cerminan pengamalan nilai-nilai luhur Pancasila dalam menjaga kerukunan dan keasrian desa.',
                'gambar' => '2.webp',
                'tags' => ['Pokja1', 'KerjaBakti', 'GotongRoyong'],
                'penulis' => 'Pokja I TP. PKK Karangtanjung',
                'status' => 'published',
            ],
            [
                'judul' => 'Pembinaan Tata Kelola Administrasi 6 Buku Wajib PKK',
                'slug' => 'pembinaan-administrasi-6-buku-wajib-pkk',
                'kategori' => 'Umum',
                'tanggal' => '2026-05-08',
                'ringkasan' => 'Pendampingan tertib administrasi pembukuan wajib PKK bagi sekretaris kelompok dasawisma di tingkat RT/RW.',
                'konten' => 'Pertemuan berkala pengurus TP. PKK Desa Karangtanjung membahas pembinaan pembukuan 6 buku wajib PKK serta sosialisasi jadwal pembinaan dasawisma tingkat RT. Kegiatan ini bertujuan memperkuat kapasitas manajerial para kader agar pencatatan administrasi kependudukan dan kegiatan keluarga terdokumentasi secara tertib dan akuntabel.',
                'gambar' => '3.webp',
                'tags' => ['Administrasi', 'Sekretariat', 'BukuWajib'],
                'penulis' => 'Sekretariat TP. PKK Karangtanjung',
                'status' => 'published',
            ],
            [
                'judul' => 'Pemanfaatan Pekarangan HATINYA PKK untuk Gizi Keluarga',
                'slug' => 'pemanfaatan-pekarangan-dan-gizi-keluarga',
                'kategori' => 'Pokja III',
                'tanggal' => '2026-05-08',
                'ringkasan' => 'Sosialisasi budidaya sayuran pekarangan dan tanaman obat keluarga untuk kemandirian pangan rumah tangga.',
                'konten' => 'Sesi pelatihan dan evaluasi kader Dasawisma difokuskan pada inovasi pemanfaatan pekarangan rumah (AKU HATINYA PKK) untuk penyediaan gizi mikro keluarga mandiri. Kader diberikan demonstrasi budidaya tanaman obat keluarga dan sayuran hidroponik sederhana ramah lingkungan.',
                'gambar' => '4.webp',
                'tags' => ['Pokja3', 'HatinyaPKK', 'PanganLokal'],
                'penulis' => 'Pokja III TP. PKK Karangtanjung',
                'status' => 'published',
            ],
            [
                'judul' => 'Pelatihan Keterampilan & Inovasi Pangan UP2K',
                'slug' => 'pelatihan-keterampilan-up2k-tata-boga-desa',
                'kategori' => 'Pokja II',
                'tanggal' => '2026-03-14',
                'ringkasan' => 'Pelatihan tata boga pengolahan komoditas lokal bandeng dan udang khas Sidoarjo untuk peningkatan ekonomi keluarga.',
                'konten' => 'Kelompok Kerja II (Pokja II) menggelar pelatihan kewirausahaan dan olahan pangan sehat bagi kelompok Usaha Peningkatan Pendapatan Keluarga (UP2K). Peserta diajarkan teknik pengemasan higienis, strategi pemasaran digital produk rumahan, serta pencatatan laba rugi sederhana guna mendongkrak pendapatan ibu rumah tangga.',
                'gambar' => '5.webp',
                'tags' => ['Pokja2', 'UP2K', 'Kewirausahaan'],
                'penulis' => 'Pokja II TP. PKK Karangtanjung',
                'status' => 'published',
            ],
            [
                'judul' => 'Pembinaan Ketahanan Pangan Lokal (Hatinya PKK)',
                'slug' => 'pembinaan-ketahanan-pangan-hatinya-pkk',
                'kategori' => 'Pokja III',
                'tanggal' => '2026-02-02',
                'ringkasan' => 'Sosialisasi pemanfaatan lahan pekarangan asri, teratur, indah, dan nyaman untuk ketahanan pangan mandiri.',
                'konten' => 'Pokja III menyelenggarakan bimbingan teknis HATINYA PKK (Halaman Asri, Teratur, Indah, dan Nyaman) kepada kelompok wanita tani desa. Bantuan bibit cabai, tomat, dan sayuran hijau dibagikan untuk ditanam serentak di tiap pekarangan dasawisma sebagai langkah antisipasi inflasi pangan skala rumah tangga.',
                'gambar' => '1.webp',
                'tags' => ['Pokja3', 'KetahananPangan', 'HatinyaPKK'],
                'penulis' => 'Pokja III TP. PKK Karangtanjung',
                'status' => 'published',
            ],
            [
                'judul' => 'Layanan Terpadu Posyandu & Skrining Tumbuh Kembang',
                'slug' => 'pelayanan-posyandu-balita-dan-cegah-stunting',
                'kategori' => 'Pokja IV',
                'tanggal' => '2026-01-18',
                'ringkasan' => 'Penimbangan balita terintegrasi, pemberian imunisasi dasar lengkap, serta konsultasi gizi pencegahan stunting.',
                'konten' => 'Pokja IV berkolaborasi bersama tenaga kesehatan Puskesmas Candi melaksanakan posyandu balita dan posbindu lansia terintegrasi. Sebanyak 85 balita mendapatkan penimbangan, pengukuran lingkar lengan, vitamin A, serta Pemberian Makanan Tambahan (PMT) bergizi berbahan dasar pangan lokal.',
                'gambar' => '2.webp',
                'tags' => ['Pokja4', 'Posyandu', 'Kesehatan', 'Stunting'],
                'penulis' => 'Pokja IV TP. PKK Karangtanjung',
                'status' => 'published',
            ],
            [
                'judul' => 'Sosialisasi Tertib Administrasi Buku Wajib Dasawisma',
                'slug' => 'sosialisasi-tertib-administrasi-dasawisma',
                'kategori' => 'Umum',
                'tanggal' => '2026-01-10',
                'ringkasan' => 'Workshop pengisian buku catatan keluarga dan rekapitulasi data demografi kesehatan warga desa.',
                'konten' => 'Guna mendukung validitas basis data kependudukan dan profil kesehatan desa, Sekretariat PKK mengadakan pendampingan teknis tata kelola pengisian formulir Dasawisma tahun 2026 bagi 25 kader perwakilan se-Desa Karangtanjung.',
                'gambar' => '3.webp',
                'tags' => ['Dasawisma', 'Administrasi', 'Kader'],
                'penulis' => 'Sekretariat TP. PKK Karangtanjung',
                'status' => 'published',
            ],
            [
                'judul' => 'Sosialisasi Pola Asuh Anak & Remaja di Era Digital (PAAR)',
                'slug' => 'pembinaan-pola-asuh-anak-dan-remaja-paar',
                'kategori' => 'Pokja I',
                'tanggal' => '2026-01-04',
                'ringkasan' => 'Edukasi peran orang tua dalam mendampingi tumbuh kembang emosional dan penggunaan gawai yang bijak bagi remaja.',
                'konten' => 'Pokja I bekerjasama dengan psikolog keluarga menyelenggarakan seminar parenting mengenai pola asuh anak dan remaja (PAAR) dengan penuh cinta dan kasih sayang dalam keluarga. Peserta dibekali pemahaman cara membangun komunikasi terbuka dengan anak serta pencegahan bahaya kecanduan gawai dan pornografi digital.',
                'gambar' => '4.webp',
                'tags' => ['Pokja1', 'Parenting', 'PAAR', 'Keluarga'],
                'penulis' => 'Pokja I TP. PKK Karangtanjung',
                'status' => 'published',
            ],
            [
                'judul' => 'Penyaluran 500 Bibit Tanaman Produktif & Pupuk Organik',
                'slug' => 'pembagian-bibit-sayur-dan-pupuk-organik',
                'kategori' => 'Pokja III',
                'tanggal' => '2025-12-22',
                'ringkasan' => 'Dukungan nyata penguatan ketahanan pangan keluarga lewat pembagian bibit cabai, terong, dan pupuk kompos ramah lingkungan.',
                'konten' => 'Dalam rangka merealisasikan program Aku Hatinya PKK, Pokja III menyalurkan 500 bibit tanaman sayuran produktif dan paket pupuk organik cair kepada 10 kelompok dasawisma. Bantuan ini diharapkan mampu mencukupi kebutuhan sayuran sehat mandiri skala rumah tangga.',
                'gambar' => '5.webp',
                'tags' => ['Pokja3', 'BibitTanaman', 'PupukOrganik', 'Pangan'],
                'penulis' => 'Pokja III TP. PKK Karangtanjung',
                'status' => 'published',
            ],
            [
                'judul' => 'Bimtek Manajemen Keuangan Koperasi Wanita & Kelompok UP2K',
                'slug' => 'bimbingan-teknis-koperasi-wanita-dan-up2k',
                'kategori' => 'Pokja II',
                'tanggal' => '2025-12-15',
                'ringkasan' => 'Peningkatan kapasitas pengelolaan permodalan usaha simpan pinjam dan pembukuan transparan bagi kelompok wanita wirausaha.',
                'konten' => 'Kelompok Kerja II melaksanakan pembinaan manajemen keuangan sederhana bagi pengurus koperasi wanita dan pelaku usaha mikro keluarga binaan PKK. Materi mencakup pemisahan keuangan usaha dan pribadi, penghitungan harga pokok produksi, dan literasi perbankan.',
                'gambar' => '1.webp',
                'tags' => ['Pokja2', 'Koperasi', 'Keuangan', 'UP2K'],
                'penulis' => 'Pokja II TP. PKK Karangtanjung',
                'status' => 'published',
            ],
            [
                'judul' => 'Penyaluran Paket PMT Berbahan Pangan Lokal Bagi Balita',
                'slug' => 'pemberian-makanan-tambahan-pmt-pemulihan-balita',
                'kategori' => 'Pokja IV',
                'tanggal' => '2025-12-02',
                'ringkasan' => 'Pemberian Makanan Tambahan (PMT) tinggi protein hewani selama 90 hari guna percepatan penurunan angka risiko stunting balita.',
                'konten' => 'Sebagai wujud aksi nyata program percepatan penurunan stunting, kader Pokja IV mendistribusikan menu kudapan sehat bergizi seimbang berbahan baku ikan lokal dan telur bagi balita sasaran prioritas di setiap posyandu desa.',
                'gambar' => '2.webp',
                'tags' => ['Pokja4', 'PMT', 'GiziBalita', 'BebasStunting'],
                'penulis' => 'Pokja IV TP. PKK Karangtanjung',
                'status' => 'published',
            ],
        ];

        Berita::truncate();
        foreach ($beritaList as $b) {
            Berita::create($b);
        }

        // 4. Data Agenda Kegiatan PKK
        $agendaList = [
            [
                'judul' => 'Posyandu Balita',
                'kategori' => 'Pokja IV',
                'tanggal' => '2026-11-10',
                'waktu' => '08.00 – 11.00 WIB',
                'lokasi' => 'Balai Desa Karangtanjung',
                'penyelenggara' => 'Pokja IV (Kesehatan) & Bidan Desa',
                'deskripsi' => 'Kegiatan pelayanan kesehatan balita meliputi penimbangan berat badan, pengukuran tinggi badan, pemantauan tumbuh kembang, serta edukasi kesehatan ibu dan anak.',
                'isi' => 'Kegiatan Posyandu Balita rutin diselenggarakan oleh Pokja IV TP. PKK Desa Karangtanjung bekerja sama dengan Bidan Desa dan Puskesmas Candi. Pelayanan ini mencakup penimbangan berat badan, pengukuran tinggi badan dan lingkar kepala, pencatatan di KMS / Buku KIA, imunisasi dasar lengkap, serta pemberian Vitamin A dan Pemberian Makanan Tambahan (PMT) bergizi berbahan dasar pangan lokal. Kader posyandu juga membuka layanan konsultasi gizi untuk mencegah resiko stunting pada anak usia 0-5 tahun.',
                'status' => 'Mendatang',
            ],
            [
                'judul' => 'Pertemuan Rutin Kader PKK',
                'kategori' => 'Umum',
                'tanggal' => '2026-11-15',
                'waktu' => '09.00 – 11.00 WIB',
                'lokasi' => 'Balai Desa Karangtanjung',
                'penyelenggara' => 'Sekretariat & Pengurus Inti TP. PKK',
                'deskripsi' => 'Pertemuan koordinasi kader untuk membahas evaluasi program kerja, kegiatan dasawisma, dan rencana pelaksanaan kegiatan PKK.',
                'isi' => 'Pertemuan koordinasi bulanan seluruh pengurus TP. PKK Desa, ketua kelompok Dasawisma, dan perwakilan kader dari setiap RW di lingkungan Desa Karangtanjung. Forum ini menjadi sarana evaluasi pencapaian 10 Program Pokok PKK, sinkronisasi data rekapitulasi dasawisma, pembinaan tata kelola 6 buku wajib PKK, serta penyusunan timeline kegiatan bakti sosial dan posyandu untuk bulan selanjutnya.',
                'status' => 'Mendatang',
            ],
            [
                'judul' => 'Gotong Royong Lingkungan Desa',
                'kategori' => 'Pokja I',
                'tanggal' => '2026-11-20',
                'waktu' => '07.00 – 09.00 WIB',
                'lokasi' => 'Lingkungan Desa Karangtanjung',
                'penyelenggara' => 'Pokja I (Karakter & Gotong Royong)',
                'deskripsi' => 'Kegiatan kebersihan lingkungan sebagai bentuk kepedulian masyarakat terhadap lingkungan yang bersih, sehat, dan nyaman.',
                'isi' => 'Kegiatan kerja bakti dan gotong royong massal yang diinisiasi oleh Pokja I TP. PKK Desa Karangtanjung bersama jajaran perangkat desa dan masyarakat umum. Titik fokus gotong royong meliputi pembersihan drainase dan saluran air warga menjelang musim penghujan, pemilahan sampah organik dan anorganik di pekarangan rumah, serta perapihan tanaman peneduh di ruas jalan utama desa demi mewujudkan desa yang asri, teratur, dan bebas banjir.',
                'status' => 'Mendatang',
            ],
            [
                'judul' => 'Pelatihan UP2K',
                'kategori' => 'Pokja II',
                'tanggal' => '2026-11-25',
                'waktu' => '09.00 – 12.00 WIB',
                'lokasi' => 'Balai Desa Karangtanjung',
                'penyelenggara' => 'Pokja II (Pendidikan & Keterampilan UP2K)',
                'deskripsi' => 'Kegiatan pembinaan keterampilan dan pemberdayaan ekonomi keluarga melalui pengembangan usaha peningkatan pendapatan keluarga.',
                'isi' => 'Program pelatihan kewirausahaan dan keterampilan olahan pangan lokal bagi kelompok Usaha Peningkatan Pendapatan Keluarga (UP2K) binaan Pokja II TP. PKK Desa Karangtanjung. Pelatihan ini menghadirkan praktisi UMKM kuliner dan dinas terkait guna memberikan edukasi mengenai pengolahan produk ikan bandeng higienis, standarisasi kemasan berlabel halal, pembukuan keuangan arus kas sederhana, serta strategi promosi digital via media sosial.',
                'status' => 'Mendatang',
            ],
        ];

        Agenda::truncate();
        foreach ($agendaList as $ag) {
            Agenda::create($ag);
        }
    }
}
