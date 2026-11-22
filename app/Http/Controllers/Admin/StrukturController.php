<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\ProfilDataStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class StrukturController extends Controller
{
    private function getProfilPath()
    {
        return storage_path('app/profil_data.json');
    }

    private function getDefaultProfil()
    {
        return [
            'nama_desa' => 'Karangtanjung',
            'kecamatan' => 'Candi',
            'kabupaten' => 'Sidoarjo',
            'provinsi' => 'Jawa Timur',
            'periode' => '2024 - 2029',
            'alamat' => 'Jl. Sunan Giri No.1 Desa Karangtanjung, Kec. Candi, Kab. Sidoarjo, Jawa Timur',
            'telepon' => '+62 812-3456-7890',
            'email' => 'pkk.desakarangtanjung@gmail.com',
            'visi' => 'Terwujudnya Keluarga Karangtanjung yang Beriman, Berakhlak Mulia, Sehat, Sejahtera, Maju, dan Mandiri Berbasis Ketahanan Desa yang Berkelanjutan',
            'misi' => "Meningkatkan kualitas keimanan, pengamalan nilai-nilai luhur Pancasila, pembinaan kesadaran bela negara, serta semangat gotong royong warga.\nMeningkatkan akses dan kualitas pendidikan formal, non-formal, keterampilan keluarga, serta pola asuh anak dan remaja yang bijak.\nMengembangkan ketahanan pangan keluarga lewat program AKU HATINYA PKK dan mendorong kemandirian ekonomi keluarga melalui UP2K.\nMeningkatkan derajat kesehatan keluarga melalui pencegahan stunting, optimalisasi posyandu, PHBS, serta kelestarian lingkungan hidup.",
            'struktur' => [
                'pembina' => [
                    'jabatan' => 'Pembina',
                    'nama' => 'Atmo',
                    'sub' => 'Kepala Desa Karang Tanjung',
                    'foto' => null,
                ],
                'pengurus_inti' => [
                    ['jabatan' => 'Ketua', 'nama' => 'Hj. Sunariyah', 'foto' => null],
                    ['jabatan' => 'Wakil Ketua', 'nama' => 'Dwi Setyowati', 'foto' => null],
                    ['jabatan' => 'Sekretaris I', 'nama' => 'Alfianita Defi, S.Pd.', 'foto' => null],
                    ['jabatan' => 'Sekretaris II', 'nama' => 'Cicik Suyanti', 'foto' => null],
                    ['jabatan' => 'Bendahara I', 'nama' => 'Ita Susanti', 'foto' => null],
                    ['jabatan' => 'Bendahara II', 'nama' => 'Nuryanti', 'foto' => null],
                ],
                'pokja' => [
                    ['kode' => 'Pokja I', 'ketua' => "Mutma'innah, M.Pd.", 'foto' => null],
                    ['kode' => 'Pokja II', 'ketua' => 'Resti Duwi Rohmawati', 'foto' => null],
                    ['kode' => 'Pokja III', 'ketua' => 'Jazil Laturohmah', 'foto' => null],
                    ['kode' => 'Pokja IV', 'ketua' => 'Lilik Mutammimah', 'foto' => null],
                ],
            ],
        ];
    }

    /** Read the shared profile document without allowing malformed or partial data to break the CMS. */
    private function readProfil(): array
    {
        $path = $this->getProfilPath();
        if (! File::exists($path)) {
            return $this->getDefaultProfil();
        }

        $profil = json_decode(File::get($path), true);

        return is_array($profil) ? array_replace_recursive($this->getDefaultProfil(), $profil) : $this->getDefaultProfil();
    }

    private function deleteManagedPhoto(mixed $photo): void
    {
        if (! is_string($photo) || ! str_starts_with($photo, 'pengurus/') || str_contains($photo, '..') || str_contains($photo, 'default_pas_foto') || str_contains($photo, 'sample_pas_foto')) {
            return;
        }

        $path = public_path('images/'.$photo);
        if (File::exists($path)) {
            File::delete($path);
        }
    }

    private function deleteUploadedPhotos(array $photos): void
    {
        foreach ($photos as $photo) {
            $this->deleteManagedPhoto($photo);
        }
    }

    /**
     * Tampilkan formulir kelola struktur organisasi dan foto profil
     */
    public function index()
    {
        $profil = $this->readProfil();

        $struktur = [
            'periode' => $profil['periode'] ?? '2024 - 2029',

            'pembina_nama' => $profil['struktur']['pembina']['nama'] ?? 'Atmo',
            'pembina_sub' => $profil['struktur']['pembina']['sub'] ?? 'Kepala Desa Karang Tanjung',
            'pembina_foto' => $profil['struktur']['pembina']['foto'] ?? null,

            'ketua_nama' => $profil['struktur']['pengurus_inti'][0]['nama'] ?? 'Hj. Sunariyah',
            'ketua_foto' => $profil['struktur']['pengurus_inti'][0]['foto'] ?? null,

            'wakil_nama' => $profil['struktur']['pengurus_inti'][1]['nama'] ?? 'Dwi Setyowati',
            'wakil_foto' => $profil['struktur']['pengurus_inti'][1]['foto'] ?? null,

            'sekretaris_1' => $profil['struktur']['pengurus_inti'][2]['nama'] ?? 'Alfianita Defi, S.Pd.',
            'sekretaris_1_foto' => $profil['struktur']['pengurus_inti'][2]['foto'] ?? null,

            'sekretaris_2' => $profil['struktur']['pengurus_inti'][3]['nama'] ?? 'Cicik Suyanti',
            'sekretaris_2_foto' => $profil['struktur']['pengurus_inti'][3]['foto'] ?? null,

            'bendahara_1' => $profil['struktur']['pengurus_inti'][4]['nama'] ?? 'Ita Susanti',
            'bendahara_1_foto' => $profil['struktur']['pengurus_inti'][4]['foto'] ?? null,

            'bendahara_2' => $profil['struktur']['pengurus_inti'][5]['nama'] ?? 'Nuryanti',
            'bendahara_2_foto' => $profil['struktur']['pengurus_inti'][5]['foto'] ?? null,

            'pokja_1_ketua' => $profil['struktur']['pokja'][0]['ketua'] ?? "Mutma'innah, M.Pd.",
            'pokja_1_foto' => $profil['struktur']['pokja'][0]['foto'] ?? null,

            'pokja_2_ketua' => $profil['struktur']['pokja'][1]['ketua'] ?? 'Resti Duwi Rohmawati',
            'pokja_2_foto' => $profil['struktur']['pokja'][1]['foto'] ?? null,

            'pokja_3_ketua' => $profil['struktur']['pokja'][2]['ketua'] ?? 'Jazil Laturohmah',
            'pokja_3_foto' => $profil['struktur']['pokja'][2]['foto'] ?? null,

            'pokja_4_ketua' => $profil['struktur']['pokja'][3]['ketua'] ?? 'Lilik Mutammimah',
            'pokja_4_foto' => $profil['struktur']['pokja'][3]['foto'] ?? null,
        ];

        return view('admin.struktur.index', compact('struktur'));
    }

    /**
     * Simpan pembaruan nama dan foto struktur organisasi
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'periode' => 'required|string|max:50',
            'pembina_nama' => 'required|string|max:150',
            'pembina_sub' => 'nullable|string|max:150',
            'ketua_nama' => 'required|string|max:150',
            'wakil_nama' => 'required|string|max:150',
            'sekretaris_1' => 'required|string|max:150',
            'sekretaris_2' => 'required|string|max:150',
            'bendahara_1' => 'required|string|max:150',
            'bendahara_2' => 'required|string|max:150',
            'pokja_1_ketua' => 'required|string|max:150',
            'pokja_2_ketua' => 'required|string|max:150',
            'pokja_3_ketua' => 'required|string|max:150',
            'pokja_4_ketua' => 'required|string|max:150',

            // Validasi file foto
            'pembina_foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'ketua_foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'wakil_foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'sekretaris_1_foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'sekretaris_2_foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'bendahara_1_foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'bendahara_2_foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'pokja_1_foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'pokja_2_foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'pokja_3_foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'pokja_4_foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $profil = $this->readProfil();

        // Helper untuk memproses file upload
        $uploadDir = public_path('images/pengurus');
        File::ensureDirectoryExists($uploadDir);
        $uploadedPhotos = [];

        $handleUpload = function ($key, $existing) use ($request, $uploadDir, &$uploadedPhotos) {
            $deleteKey = 'hapus_'.$key;
            $shouldDelete = $request->input($deleteKey) === '1' || $request->input($deleteKey) === 1;

            if ($request->hasFile($key)) {
                $file = $request->file($key);
                $filename = $key.'_'.Str::uuid().'.'.$file->getClientOriginalExtension();
                $file->move($uploadDir, $filename);
                $uploadedPhotos[] = 'pengurus/'.$filename;

                return 'pengurus/'.$filename;
            }

            if ($shouldDelete) {
                return null;
            }

            return $existing;
        };

        try {
            $pembinaFoto = $handleUpload('pembina_foto', $profil['struktur']['pembina']['foto'] ?? null);
            $ketuaFoto = $handleUpload('ketua_foto', $profil['struktur']['pengurus_inti'][0]['foto'] ?? null);
            $wakilFoto = $handleUpload('wakil_foto', $profil['struktur']['pengurus_inti'][1]['foto'] ?? null);
            $sekretaris1Foto = $handleUpload('sekretaris_1_foto', $profil['struktur']['pengurus_inti'][2]['foto'] ?? null);
            $sekretaris2Foto = $handleUpload('sekretaris_2_foto', $profil['struktur']['pengurus_inti'][3]['foto'] ?? null);
            $bendahara1Foto = $handleUpload('bendahara_1_foto', $profil['struktur']['pengurus_inti'][4]['foto'] ?? null);
            $bendahara2Foto = $handleUpload('bendahara_2_foto', $profil['struktur']['pengurus_inti'][5]['foto'] ?? null);

            $pokja1Foto = $handleUpload('pokja_1_foto', $profil['struktur']['pokja'][0]['foto'] ?? null);
            $pokja2Foto = $handleUpload('pokja_2_foto', $profil['struktur']['pokja'][1]['foto'] ?? null);
            $pokja3Foto = $handleUpload('pokja_3_foto', $profil['struktur']['pokja'][2]['foto'] ?? null);
            $pokja4Foto = $handleUpload('pokja_4_foto', $profil['struktur']['pokja'][3]['foto'] ?? null);
        } catch (\Throwable $exception) {
            $this->deleteUploadedPhotos($uploadedPhotos);
            throw $exception;
        }

        // Update bagian struktur, foto, dan periode
        $cleanStr = function ($str) {
            return trim(preg_replace('/[\x{FFFC}\x{FFFD}\x{0000}-\x{001F}\x{007F}]/u', '', (string) $str));
        };

        $profil['periode'] = $cleanStr($validated['periode']);
        $profil['struktur'] = [
            'pembina' => [
                'jabatan' => 'Pembina',
                'nama' => $cleanStr($validated['pembina_nama']),
                'sub' => $cleanStr($validated['pembina_sub'] ?? 'Kepala Desa Karang Tanjung'),
                'foto' => $pembinaFoto,
            ],
            'pengurus_inti' => [
                ['jabatan' => 'Ketua', 'nama' => $cleanStr($validated['ketua_nama']), 'foto' => $ketuaFoto],
                ['jabatan' => 'Wakil Ketua', 'nama' => $cleanStr($validated['wakil_nama']), 'foto' => $wakilFoto],
                ['jabatan' => 'Sekretaris I', 'nama' => $cleanStr($validated['sekretaris_1']), 'foto' => $sekretaris1Foto],
                ['jabatan' => 'Sekretaris II', 'nama' => $cleanStr($validated['sekretaris_2']), 'foto' => $sekretaris2Foto],
                ['jabatan' => 'Bendahara I', 'nama' => $cleanStr($validated['bendahara_1']), 'foto' => $bendahara1Foto],
                ['jabatan' => 'Bendahara II', 'nama' => $cleanStr($validated['bendahara_2']), 'foto' => $bendahara2Foto],
            ],
            'pokja' => [
                ['kode' => 'Pokja I', 'ketua' => $cleanStr($validated['pokja_1_ketua']), 'foto' => $pokja1Foto],
                ['kode' => 'Pokja II', 'ketua' => $cleanStr($validated['pokja_2_ketua']), 'foto' => $pokja2Foto],
                ['kode' => 'Pokja III', 'ketua' => $cleanStr($validated['pokja_3_ketua']), 'foto' => $pokja3Foto],
                ['kode' => 'Pokja IV', 'ketua' => $cleanStr($validated['pokja_4_ketua']), 'foto' => $pokja4Foto],
            ],
        ];

        try {
            $previous = app(ProfilDataStore::class)->update([
                'periode' => $profil['periode'],
                'struktur' => $profil['struktur'],
            ], $this->getDefaultProfil());
        } catch (\Throwable $exception) {
            $this->deleteUploadedPhotos($uploadedPhotos);
            throw $exception;
        }

        $oldPhotos = [
            $previous['struktur']['pembina']['foto'] ?? null,
            $previous['struktur']['pengurus_inti'][0]['foto'] ?? null,
            $previous['struktur']['pengurus_inti'][1]['foto'] ?? null,
            $previous['struktur']['pengurus_inti'][2]['foto'] ?? null,
            $previous['struktur']['pengurus_inti'][3]['foto'] ?? null,
            $previous['struktur']['pengurus_inti'][4]['foto'] ?? null,
            $previous['struktur']['pengurus_inti'][5]['foto'] ?? null,
            $previous['struktur']['pokja'][0]['foto'] ?? null,
            $previous['struktur']['pokja'][1]['foto'] ?? null,
            $previous['struktur']['pokja'][2]['foto'] ?? null,
            $previous['struktur']['pokja'][3]['foto'] ?? null,
        ];

        // Remove replaced/deleted uploads only after the new profile document is safely in place.
        $newPhotos = [
            $pembinaFoto, $ketuaFoto, $wakilFoto, $sekretaris1Foto, $sekretaris2Foto,
            $bendahara1Foto, $bendahara2Foto, $pokja1Foto, $pokja2Foto, $pokja3Foto, $pokja4Foto,
        ];
        foreach ($oldPhotos as $index => $oldPhoto) {
            if ($oldPhoto !== $newPhotos[$index]) {
                $this->deleteManagedPhoto($oldPhoto);
            }
        }

        return redirect()->route('admin.struktur.index')
            ->with('success', 'Data profil pengurus dan susunan struktur organisasi berhasil disimpan!');
    }
}
