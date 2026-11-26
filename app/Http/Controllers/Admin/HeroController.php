<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\PublicImagePath;
use App\Support\ProfilDataStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class HeroController extends Controller
{
    private function getProfilData(): array
    {
        return app(ProfilDataStore::class)->read();
    }

    private function deleteManagedHero(?string $hero): void
    {
        if (! $hero || ! str_starts_with($hero, 'images/hero/') || str_contains($hero, '..')) {
            return;
        }

        $path = PublicImagePath::file($hero);
        if (File::exists($path)) {
            File::delete($path);
        }
    }

    private function deleteManagedProfilFoto(?string $foto): void
    {
        if (! $foto || ! str_starts_with($foto, 'images/profil/') || str_contains($foto, '..')) {
            return;
        }

        $path = PublicImagePath::file($foto);
        if (File::exists($path)) {
            File::delete($path);
        }
    }

    public function index()
    {
        $data = $this->getProfilData();

        // Hero background beranda
        $customHero = $data['hero_background'] ?? null;
        $currentHero = 'images/5.webp';

        if (! empty($customHero) && File::exists(PublicImagePath::file($customHero))) {
            $currentHero = $customHero;
        }

        // Foto tim profil
        $customFotoTim = $data['foto_tim_profil'] ?? null;
        $currentFotoTim = 'images/5.webp';
        if (! empty($customFotoTim) && File::exists(PublicImagePath::file($customFotoTim))) {
            $currentFotoTim = $customFotoTim;
        }

        return view('admin.hero.index', compact('currentHero', 'currentFotoTim'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_background' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ], [
            'hero_background.image' => 'File yang diunggah harus berupa gambar.',
            'hero_background.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, webp.',
            'hero_background.max' => 'Ukuran gambar maksimal 5 MB.',
        ]);

        if ($request->hasFile('hero_background')) {
            $uploadDir = PublicImagePath::directory('hero');
            $file = $request->file('hero_background');
            $extension = $file->getClientOriginalExtension() ?: 'jpg';
            $filename = 'hero_bg_'.Str::uuid().'.'.$extension;
            $newHero = 'images/hero/'.$filename;
            try {
                File::ensureDirectoryExists($uploadDir);
                $file->move($uploadDir, $filename);
                $previous = app(ProfilDataStore::class)->update(['hero_background' => $newHero]);
            } catch (\Throwable $exception) {
                $this->deleteManagedHero($newHero);
                throw $exception;
            }
            $this->deleteManagedHero($previous['hero_background'] ?? null);

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
        ], [
            'foto_tim.image' => 'File yang diunggah harus berupa gambar.',
            'foto_tim.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, webp.',
            'foto_tim.max' => 'Ukuran gambar maksimal 5 MB.',
        ]);

        if ($request->hasFile('foto_tim')) {
            $uploadDir = PublicImagePath::directory('profil');
            $file = $request->file('foto_tim');
            $extension = $file->getClientOriginalExtension() ?: 'jpg';
            $filename = 'foto_tim_'.Str::uuid().'.'.$extension;
            $newFotoTim = 'images/profil/'.$filename;
            try {
                File::ensureDirectoryExists($uploadDir);
                $file->move($uploadDir, $filename);
                $previous = app(ProfilDataStore::class)->update(['foto_tim_profil' => $newFotoTim]);
            } catch (\Throwable $exception) {
                $this->deleteManagedProfilFoto($newFotoTim);
                throw $exception;
            }
            $this->deleteManagedProfilFoto($previous['foto_tim_profil'] ?? null);

            return redirect()->route('admin.hero.index')
                ->with('success', 'Foto tim halaman Profil berhasil diperbarui.');
        }

        return redirect()->route('admin.hero.index')
            ->with('info', 'Tidak ada perubahan foto tim yang dipilih.');
    }
}
