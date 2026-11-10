<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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

        foreach ($beritaList as $b) {
            Berita::updateOrCreate(
                ['slug' => $b['slug']],
                $b
            );
        }
    }
}
