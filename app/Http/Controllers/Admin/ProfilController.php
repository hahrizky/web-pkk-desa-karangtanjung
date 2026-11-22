<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\ProfilDataStore;
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
            'nama_desa' => '',
            'kecamatan' => '',
            'kabupaten' => '',
            'provinsi' => '',
            'periode' => '',
            'alamat' => '',
            'telepon' => '',
            'email' => '',
            'jam_layanan' => '',
            'visi' => 'Terwujudnya Keluarga Karangtanjung yang Beriman, Berakhlak Mulia, Sehat, Sejahtera, Maju, dan Mandiri Berbasis Ketahanan Desa yang Berkelanjutan',
            'misi' => [
                [
                    'judul' => 'Ketahanan Mental & Gotong Royong',
                    'deskripsi' => 'Meningkatkan kualitas keimanan, pengamalan nilai-nilai luhur Pancasila, pembinaan kesadaran bela negara, serta semangat gotong royong warga.',
                ],
                [
                    'judul' => 'Kualitas Pendidikan & Pola Asuh Anak',
                    'deskripsi' => 'Meningkatkan akses dan kualitas pendidikan formal, non-formal, keterampilan keluarga, serta pola asuh anak dan remaja yang bijak.',
                ],
                [
                    'judul' => 'Ketahanan Pangan & Kemandirian UP2K',
                    'deskripsi' => 'Mengembangkan ketahanan pangan keluarga lewat program AKU HATINYA PKK dan mendorong kemandirian ekonomi keluarga melalui UP2K.',
                ],
                [
                    'judul' => 'Kesehatan Keluarga & Kelestarian Lingkungan',
                    'deskripsi' => 'Meningkatkan derajat kesehatan keluarga melalui pencegahan stunting, optimalisasi posyandu, PHBS, serta kelestarian lingkungan hidup.',
                ],
            ],
            'struktur' => [
                'pembina' => [
                    'jabatan' => 'Pembina',
                    'nama' => 'Atmo',
                    'sub' => 'Kepala Desa Karang Tanjung',
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

    private function parseMisiFromString(string $rawMisi, ?callable $cleanStr = null): array
    {
        $defaultTitles = [
            'Ketahanan Mental & Gotong Royong',
            'Kualitas Pendidikan & Pola Asuh Anak',
            'Ketahanan Pangan & Kemandirian UP2K',
            'Kesehatan Keluarga & Kelestarian Lingkungan',
        ];
        $lines = preg_split('/\r\n|\r|\n/', trim($rawMisi));
        $converted = [];
        $i = 0;
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '') {
                continue;
            }
            $cleanLine = preg_replace('/^\s*(\d+[\.\)]|\-|\*)\s*/', '', $line);
            if (str_contains($cleanLine, ':')) {
                $parts = explode(':', $cleanLine, 2);
                $judul = trim($parts[0]);
                $deskripsi = trim($parts[1]);
            } elseif (str_contains($cleanLine, ' - ')) {
                $parts = explode(' - ', $cleanLine, 2);
                $judul = trim($parts[0]);
                $deskripsi = trim($parts[1]);
            } else {
                $judul = $defaultTitles[$i] ?? ('Program Misi '.sprintf('%02d', $i + 1));
                $deskripsi = $cleanLine;
            }

            if ($cleanStr) {
                $judul = $cleanStr($judul);
                $deskripsi = $cleanStr($deskripsi, true);
            }

            if ($judul !== '' || $deskripsi !== '') {
                $converted[] = [
                    'judul' => $judul !== '' ? $judul : 'Program Misi',
                    'deskripsi' => $deskripsi,
                ];
            }
            $i++;
        }

        return ! empty($converted) ? $converted : $this->getDefaultData()['misi'];
    }

    public function index()
    {
        $path = $this->getStoragePath();
        if (File::exists($path)) {
            $profil = json_decode(File::get($path), true) ?? $this->getDefaultData();
        } else {
            $profil = $this->getDefaultData();
        }

        // Konversi jika misi masih berupa string lama
        if (isset($profil['misi']) && is_string($profil['misi'])) {
            $profil['misi'] = $this->parseMisiFromString($profil['misi']);
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
            'misi' => 'nullable',
        ]);

        $cleanStr = function ($str, $preserveNewlines = false) {
            if ($preserveNewlines) {
                return trim(preg_replace('/[\x{FFFC}\x{FFFD}\x{0000}-\x{0008}\x{000B}\x{000C}\x{000E}-\x{001F}\x{007F}]/u', '', (string) $str));
            }

            return trim(preg_replace('/[\x{FFFC}\x{FFFD}\x{0000}-\x{001F}\x{007F}]/u', '', (string) $str));
        };

        $cleaned = [];
        foreach ($validated as $key => $val) {
            if ($key === 'misi') {
                continue;
            }
            $cleaned[$key] = is_string($val) ? $cleanStr($val, in_array($key, ['visi', 'alamat'])) : $val;
        }

        // Normalisasi field opsional agar selalu string
        $cleaned['alamat'] = $cleaned['alamat'] ?? '';
        $cleaned['telepon'] = $cleaned['telepon'] ?? '';
        $cleaned['email'] = $cleaned['email'] ?? '';
        $cleaned['jam_layanan'] = $cleaned['jam_layanan'] ?? '';

        // Pengolahan data Misi (Array Judul & Deskripsi)
        $misiList = [];
        $rawMisi = $request->input('misi');

        if (is_array($rawMisi)) {
            foreach ($rawMisi as $item) {
                $judul = isset($item['judul']) ? $cleanStr($item['judul']) : '';
                $deskripsi = isset($item['deskripsi']) ? $cleanStr($item['deskripsi'], true) : '';
                if ($judul !== '' || $deskripsi !== '') {
                    $misiList[] = [
                        'judul' => $judul !== '' ? $judul : 'Program Misi',
                        'deskripsi' => $deskripsi,
                    ];
                }
            }
        } elseif (is_string($rawMisi)) {
            $misiList = $this->parseMisiFromString($rawMisi, $cleanStr);
        }

        if (empty($misiList)) {
            $misiList = $this->getDefaultData()['misi'];
        }

        $cleaned['misi'] = $misiList;

        app(ProfilDataStore::class)->update($cleaned, $this->getDefaultData());

        return redirect()->route('admin.profil')
            ->with('success', 'Data profil desa & misi berhasil disimpan!');
    }
}
