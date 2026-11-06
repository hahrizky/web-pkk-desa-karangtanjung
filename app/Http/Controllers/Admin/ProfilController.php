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
            'jam_layanan' => 'Senin - Jumat (08.00 - 15.00 WIB)',
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
            'alamat' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:100',
            'jam_layanan' => 'nullable|string|max:150',
            'visi' => 'required|string',
            'misi' => 'required|string',
        ]);

        $cleanStr = function($str) {
            return trim(preg_replace('/[\x{FFFC}\x{FFFD}\x{0000}-\x{001F}\x{007F}]/u', '', (string)$str));
        };

        $cleaned = [];
        foreach ($validated as $key => $val) {
            $cleaned[$key] = is_string($val) ? $cleanStr($val) : $val;
        }

        $path = $this->getStoragePath();
        $data = File::exists($path)
            ? (json_decode(File::get($path), true) ?? $this->getDefaultData())
            : $this->getDefaultData();

        $data = array_merge($data, $cleaned, [
            'alamat' => $cleaned['alamat'] ?? '',
            'telepon' => $cleaned['telepon'] ?? '',
            'email' => $cleaned['email'] ?? '',
            'jam_layanan' => $cleaned['jam_layanan'] ?? '',
        ]);

        File::ensureDirectoryExists(storage_path('app'));
        File::put($path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return redirect()->route('admin.profil')
            ->with('success', 'Data profil desa berhasil disimpan!');
    }
}
