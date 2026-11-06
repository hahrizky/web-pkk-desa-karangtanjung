<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProfilController extends Controller
{
    private function getStoragePath()
    {
        return storage_path('app/profil_data.json');
    }

    private function getDefaultData()
    {
        return [
            'nama_desa' => 'Karangtanjung',
            'kecamatan' => 'Candi',
            'kabupaten' => 'Sidoarjo',
            'provinsi' => 'Jawa Timur',
            'periode' => '2024 - 2029',
            'alamat' => 'Jl. Sunan Giri No.1 Desa Karangtanjung, Kec. Candi, Kab. Sidoarjo, Jawa Timur',
            'telepon' => '',
            'email' => '',
            'visi' => 'Terwujudnya Keluarga Karangtanjung yang Beriman, Berakhlak Mulia, Sehat, Sejahtera, Maju, dan Mandiri Berbasis Ketahanan Desa yang Berkelanjutan',
            'misi' => "Meningkatkan kualitas keimanan, pengamalan nilai-nilai luhur Pancasila, pembinaan kesadaran bela negara, serta semangat gotong royong warga.\nMeningkatkan akses dan kualitas pendidikan formal, non-formal, keterampilan keluarga, serta pola asuh anak dan remaja yang bijak.\nMengembangkan ketahanan pangan keluarga lewat program AKU HATINYA PKK dan mendorong kemandirian ekonomi keluarga melalui UP2K.\nMeningkatkan derajat kesehatan keluarga melalui pencegahan stunting, optimalisasi posyandu, PHBS, serta kelestarian lingkungan hidup.",
            'struktur' => [
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

    public function index()
    {
        $path = $this->getStoragePath();
        if (File::exists($path)) {
            $profil = json_decode(File::get($path), true) ?? $this->getDefaultData();
        } else {
            $profil = $this->getDefaultData();
        }

        return view('admin.profil', compact('profil'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_desa' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'periode' => 'required|string|max:50',
            'alamat' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'visi' => 'required|string',
            'misi' => 'required|string',

            // Nama-nama struktur organisasi
            'pembina_nama' => 'required|string|max:150',
            'pembina_sub'  => 'nullable|string|max:150',
            'ketua_nama'   => 'required|string|max:150',
            'wakil_nama'   => 'required|string|max:150',
            'sekretaris_1' => 'required|string|max:150',
            'sekretaris_2' => 'required|string|max:150',
            'bendahara_1'  => 'required|string|max:150',
            'bendahara_2'  => 'required|string|max:150',
            'pokja_1_ketua'=> 'required|string|max:150',
            'pokja_2_ketua'=> 'required|string|max:150',
            'pokja_3_ketua'=> 'required|string|max:150',
            'pokja_4_ketua'=> 'required|string|max:150',
        ]);

        $cleanStr = function($str) {
            return trim(preg_replace('/[\x{FFFC}\x{FFFD}\x{0000}-\x{001F}\x{007F}]/u', '', (string)$str));
        };

        $data = [
            'nama_desa' => $cleanStr($validated['nama_desa']),
            'kecamatan' => $cleanStr($validated['kecamatan']),
            'kabupaten' => $cleanStr($validated['kabupaten']),
            'provinsi' => $cleanStr($validated['provinsi']),
            'periode' => $cleanStr($validated['periode']),
            'alamat' => $cleanStr($validated['alamat'] ?? ''),
            'telepon' => $cleanStr($validated['telepon'] ?? ''),
            'email' => $cleanStr($validated['email'] ?? ''),
            'visi' => $validated['visi'],
            'misi' => $validated['misi'],
            'struktur' => [
                'pembina' => [
                    'jabatan' => 'Pembina',
                    'nama'    => $cleanStr($validated['pembina_nama']),
                    'sub'     => $cleanStr($validated['pembina_sub'] ?? 'Kepala Desa Karang Tanjung'),
                ],
                'pengurus_inti' => [
                    ['jabatan' => 'Ketua', 'nama' => $cleanStr($validated['ketua_nama'])],
                    ['jabatan' => 'Wakil Ketua', 'nama' => $cleanStr($validated['wakil_nama'])],
                    ['jabatan' => 'Sekretaris I', 'nama' => $cleanStr($validated['sekretaris_1'])],
                    ['jabatan' => 'Sekretaris II', 'nama' => $cleanStr($validated['sekretaris_2'])],
                    ['jabatan' => 'Bendahara I', 'nama' => $cleanStr($validated['bendahara_1'])],
                    ['jabatan' => 'Bendahara II', 'nama' => $cleanStr($validated['bendahara_2'])],
                ],
                'pokja' => [
                    ['kode' => 'Pokja I', 'ketua' => $cleanStr($validated['pokja_1_ketua'])],
                    ['kode' => 'Pokja II', 'ketua' => $cleanStr($validated['pokja_2_ketua'])],
                    ['kode' => 'Pokja III', 'ketua' => $cleanStr($validated['pokja_3_ketua'])],
                    ['kode' => 'Pokja IV', 'ketua' => $cleanStr($validated['pokja_4_ketua'])],
                ],
            ],
        ];

        File::ensureDirectoryExists(storage_path('app'));
        File::put($this->getStoragePath(), json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return redirect()->route('admin.profil')
            ->with('success', 'Data profil & susunan struktur organisasi berhasil disimpan!');
    }
}
