<?php

namespace Database\Seeders;

use App\Models\Agenda;
use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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

        foreach ($agendaList as $ag) {
            Agenda::updateOrCreate(
                [
                    'judul' => $ag['judul'],
                    'tanggal' => $ag['tanggal'],
                ],
                $ag
            );
        }
    }
}
