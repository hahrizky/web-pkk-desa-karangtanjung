<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HeroController extends Controller
{
    private function getStoragePath(): string
    {
        return storage_path('app/profil_data.json');
    }

    private function getProfilData(): array
    {
        $path = $this->getStoragePath();
        if (File::exists($path)) {
            return json_decode(File::get($path), true) ?? [];
        }
        return [];
    }

    private function saveProfilData(array $data): void
    {
        $path = $this->getStoragePath();
        File::ensureDirectoryExists(dirname($path));
        File::put($path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }

    public function index()
    {
        $data = $this->getProfilData();

        // Hero background beranda
        $customHero = $data['hero_background'] ?? null;
        $isCustom = false;
        $currentHero = 'images/5.webp';
        if (!empty($customHero) && File::exists(public_path($customHero))) {
            $currentHero = $customHero;
            $isCustom = true;
        }

        // Foto tim profil
        $customFotoTim = $data['foto_tim_profil'] ?? null;
        $isCustomFotoTim = false;
        $currentFotoTim = 'images/5.webp';
        if (!empty($customFotoTim) && File::exists(public_path($customFotoTim))) {
            $currentFotoTim = $customFotoTim;
            $isCustomFotoTim = true;
        }

        return view('admin.hero.index', compact('currentHero', 'isCustom', 'currentFotoTim', 'isCustomFotoTim'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_background' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'reset_default' => 'nullable|in:0,1',
        ], [
            'hero_background.image' => 'File yang diunggah harus berupa gambar.',
            'hero_background.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, webp.',
            'hero_background.max' => 'Ukuran gambar maksimal 5 MB.',
        ]);

        $data = $this->getProfilData();
        $existing = $data['hero_background'] ?? null;

        // Opsi 1: Reset ke Foto Default Awal
        if ($request->input('reset_default') === '1' || $request->input('reset_default') === 1) {
            if ($existing && $existing !== 'images/5.webp') {
                $oldPath = public_path($existing);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            $data['hero_background'] = null;
            $this->saveProfilData($data);

            return redirect()->route('admin.hero.index')
                ->with('success', 'Foto background beranda berhasil dikembalikan ke foto bawaan (default).');
        }

        // Opsi 2: Upload Foto Kustom Baru
        if ($request->hasFile('hero_background')) {
            $uploadDir = public_path('images/hero');
            File::ensureDirectoryExists($uploadDir);

            // Hapus file custom lama jika ada
            if ($existing && $existing !== 'images/5.webp') {
                $oldPath = public_path($existing);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            $file = $request->file('hero_background');
            $extension = $file->getClientOriginalExtension() ?: 'jpg';
            $filename = 'hero_bg_' . time() . '.' . $extension;
            $file->move($uploadDir, $filename);

            $data['hero_background'] = 'images/hero/' . $filename;
            $this->saveProfilData($data);

            return redirect()->route('admin.hero.index')
                ->with('success', 'Foto background beranda berhasil diperbarui.');
        }

        return redirect()->route('admin.hero.index')
            ->with('info', 'Tidak ada perubahan foto yang dipilih.');
    }

    public function updateFotoTim(Request $request)
    {
        $request->validate([
            'foto_tim' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'reset_foto_tim' => 'nullable|in:0,1',
        ], [
            'foto_tim.image'  => 'File yang diunggah harus berupa gambar.',
            'foto_tim.mimes'  => 'Format gambar yang diperbolehkan: jpeg, png, jpg, webp.',
            'foto_tim.max'    => 'Ukuran gambar maksimal 5 MB.',
        ]);

        $data     = $this->getProfilData();
        $existing = $data['foto_tim_profil'] ?? null;

        // Reset ke default
        if ($request->input('reset_foto_tim') === '1') {
            if ($existing && $existing !== 'images/5.webp') {
                $oldPath = public_path($existing);
                if (File::exists($oldPath)) File::delete($oldPath);
            }
            $data['foto_tim_profil'] = null;
            $this->saveProfilData($data);

            return redirect()->route('admin.hero.index')
                ->with('success', 'Foto tim profil berhasil dikembalikan ke foto bawaan (default).');
        }

        // Upload foto baru
        if ($request->hasFile('foto_tim')) {
            $uploadDir = public_path('images/profil');
            File::ensureDirectoryExists($uploadDir);

            if ($existing && $existing !== 'images/5.webp') {
                $oldPath = public_path($existing);
                if (File::exists($oldPath)) File::delete($oldPath);
            }

            $file      = $request->file('foto_tim');
            $extension = $file->getClientOriginalExtension() ?: 'jpg';
            $filename  = 'foto_tim_' . time() . '.' . $extension;
            $file->move($uploadDir, $filename);

            $data['foto_tim_profil'] = 'images/profil/' . $filename;
            $this->saveProfilData($data);

            return redirect()->route('admin.hero.index')
                ->with('success', 'Foto tim halaman Profil berhasil diperbarui.');
        }

        return redirect()->route('admin.hero.index')
            ->with('info', 'Tidak ada perubahan foto tim yang dipilih.');
    }
}

