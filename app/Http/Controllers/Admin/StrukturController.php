<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StrukturController extends Controller
{
    private function getProfilPath()
    {
        return storage_path('app/profil_data.json');
    }

    private function getPokjaPath()
    {
        return storage_path('app/pokja_data.json');
    }

    private function getDefaultProfil()
    {
        return [
            'nama_desa' => 'Karangtanjung',
            'kecamatan' => 'Candi',
            'kabupaten' => 'Sidoarjo',
            'provinsi'  => 'Jawa Timur',
            'periode'   => '2024 - 2029',
            'alamat'    => 'Jl. Sunan Giri No.1 Desa Karangtanjung, Kec. Candi, Kab. Sidoarjo, Jawa Timur',
            'telepon'   => '+62 812-3456-7890',
            'email'     => 'pkk.desakarangtanjung@gmail.com',
            'visi'      => 'Terwujudnya Keluarga Karangtanjung yang Beriman, Berakhlak Mulia, Sehat, Sejahtera, Maju, dan Mandiri Berbasis Ketahanan Desa yang Berkelanjutan',
            'misi'      => "Meningkatkan kualitas keimanan, pengamalan nilai-nilai luhur Pancasila, pembinaan kesadaran bela negara, serta semangat gotong royong warga.\nMeningkatkan akses dan kualitas pendidikan formal, non-formal, keterampilan keluarga, serta pola asuh anak dan remaja yang bijak.\nMengembangkan ketahanan pangan keluarga lewat program AKU HATINYA PKK dan mendorong kemandirian ekonomi keluarga melalui UP2K.\nMeningkatkan derajat kesehatan keluarga melalui pencegahan stunting, optimalisasi posyandu, PHBS, serta kelestarian lingkungan hidup.",
            'struktur'  => [
                'pembina' => [
                    'jabatan' => 'Pembina',
                    'nama'    => 'Atmo',
                    'sub'     => 'Kepala Desa Karang Tanjung',
                ],
                'pengurus_inti' => [
                    ['jabatan' => 'Ketua', 'nama' => 'Hj. Sunariyah'],
                    ['jabatan' => 'Wakil Ketua', 'nama' => 'Dwi Setyowati'],
                    ['jabatan' => 'Sekretaris I', 'nama' => 'Alfianita Defi, S.Pd.'],
                    ['jabatan' => 'Sekretaris II', 'nama' => 'Cicik Suyanti'],
                    ['jabatan' => 'Bendahara I', 'nama' => 'Ita Susanti'],
                    ['jabatan' => 'Bendahara II', 'nama' => 'Nuryanti'],
                ],
                'pokja' => [
                    ['kode' => 'Pokja I', 'ketua' => "Mutma'innah, M.Pd."],
                    ['kode' => 'Pokja II', 'ketua' => 'Resti Duwi Rohmawati'],
                    ['kode' => 'Pokja III', 'ketua' => 'Jazil Laturohmah'],
                    ['kode' => 'Pokja IV', 'ketua' => 'Lilik Mutammimah'],
                ],
            ],
        ];
    }

    /**
     * Tampilkan formulir ganti nama struktur organisasi
     */
    public function index()
    {
        $path = $this->getProfilPath();
        $profil = File::exists($path) ? (json_decode(File::get($path), true) ?? $this->getDefaultProfil()) : $this->getDefaultProfil();

        $struktur = [
            'periode'       => $profil['periode'] ?? '2024 - 2029',
            'pembina_nama'  => $profil['struktur']['pembina']['nama'] ?? 'Atmo',
            'pembina_sub'   => $profil['struktur']['pembina']['sub'] ?? 'Kepala Desa Karang Tanjung',
            'ketua_nama'    => $profil['struktur']['pengurus_inti'][0]['nama'] ?? 'Hj. Sunariyah',
            'wakil_nama'    => $profil['struktur']['pengurus_inti'][1]['nama'] ?? 'Dwi Setyowati',
            'sekretaris_1'  => $profil['struktur']['pengurus_inti'][2]['nama'] ?? 'Alfianita Defi, S.Pd.',
            'sekretaris_2'  => $profil['struktur']['pengurus_inti'][3]['nama'] ?? 'Cicik Suyanti',
            'bendahara_1'   => $profil['struktur']['pengurus_inti'][4]['nama'] ?? 'Ita Susanti',
            'bendahara_2'   => $profil['struktur']['pengurus_inti'][5]['nama'] ?? 'Nuryanti',
            'pokja_1_ketua' => $profil['struktur']['pokja'][0]['ketua'] ?? "Mutma'innah, M.Pd.",
            'pokja_2_ketua' => $profil['struktur']['pokja'][1]['ketua'] ?? 'Resti Duwi Rohmawati',
            'pokja_3_ketua' => $profil['struktur']['pokja'][2]['ketua'] ?? 'Jazil Laturohmah',
            'pokja_4_ketua' => $profil['struktur']['pokja'][3]['ketua'] ?? 'Lilik Mutammimah',
        ];

        return view('admin.struktur.index', compact('struktur'));
    }

    /**
     * Simpan pembaruan nama-nama struktur organisasi
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'periode'       => 'required|string|max:50',
            'pembina_nama'  => 'required|string|max:150',
            'pembina_sub'   => 'nullable|string|max:150',
            'ketua_nama'    => 'required|string|max:150',
            'wakil_nama'    => 'required|string|max:150',
            'sekretaris_1'  => 'required|string|max:150',
            'sekretaris_2'  => 'required|string|max:150',
            'bendahara_1'   => 'required|string|max:150',
            'bendahara_2'   => 'required|string|max:150',
            'pokja_1_ketua' => 'required|string|max:150',
            'pokja_2_ketua' => 'required|string|max:150',
            'pokja_3_ketua' => 'required|string|max:150',
            'pokja_4_ketua' => 'required|string|max:150',
        ]);

        $path = $this->getProfilPath();
        $profil = File::exists($path) ? (json_decode(File::get($path), true) ?? $this->getDefaultProfil()) : $this->getDefaultProfil();

        // Update bagian struktur dan periode
        $profil['periode'] = $validated['periode'];
        $profil['struktur'] = [
            'pembina' => [
                'jabatan' => 'Pembina',
                'nama'    => $validated['pembina_nama'],
                'sub'     => $validated['pembina_sub'] ?? 'Kepala Desa Karang Tanjung',
            ],
            'pengurus_inti' => [
                ['jabatan' => 'Ketua', 'nama' => $validated['ketua_nama']],
                ['jabatan' => 'Wakil Ketua', 'nama' => $validated['wakil_nama']],
                ['jabatan' => 'Sekretaris I', 'nama' => $validated['sekretaris_1']],
                ['jabatan' => 'Sekretaris II', 'nama' => $validated['sekretaris_2']],
                ['jabatan' => 'Bendahara I', 'nama' => $validated['bendahara_1']],
                ['jabatan' => 'Bendahara II', 'nama' => $validated['bendahara_2']],
            ],
            'pokja' => [
                ['kode' => 'Pokja I', 'ketua' => $validated['pokja_1_ketua']],
                ['kode' => 'Pokja II', 'ketua' => $validated['pokja_2_ketua']],
                ['kode' => 'Pokja III', 'ketua' => $validated['pokja_3_ketua']],
                ['kode' => 'Pokja IV', 'ketua' => $validated['pokja_4_ketua']],
            ],
        ];

        File::ensureDirectoryExists(storage_path('app'));
        File::put($path, json_encode($profil, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        // Sinkronisasi juga ke data Pokja jika ada
        $pokjaPath = $this->getPokjaPath();
        if (File::exists($pokjaPath)) {
            $pokjaList = json_decode(File::get($pokjaPath), true);
            if (is_array($pokjaList)) {
                $ketuaMapping = [
                    1 => $validated['pokja_1_ketua'],
                    2 => $validated['pokja_2_ketua'],
                    3 => $validated['pokja_3_ketua'],
                    4 => $validated['pokja_4_ketua'],
                ];
                foreach ($pokjaList as &$item) {
                    if (isset($item['id']) && isset($ketuaMapping[$item['id']])) {
                        $item['ketua'] = $ketuaMapping[$item['id']];
                    }
                }
                File::put($pokjaPath, json_encode($pokjaList, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            }
        }

        return redirect()->route('admin.struktur.index')
            ->with('success', 'Nama-nama susunan struktur organisasi berhasil disimpan!');
    }
}

