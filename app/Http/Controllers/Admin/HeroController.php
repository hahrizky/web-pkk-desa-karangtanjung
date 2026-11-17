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
        $customHero = $data['hero_background'] ?? null;
        $isCustom = false;
        $currentHero = 'images/5.webp';

        if (!empty($customHero) && File::exists(public_path($customHero))) {
            $currentHero = $customHero;
            $isCustom = true;
        }

        return view('admin.hero.index', compact('currentHero', 'isCustom'));
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
}

