<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\PublicImagePath;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::latest('tanggal');

        // Pencarian judul / ringkasan jika ada parameter
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('judul', 'like', "%{$q}%")
                    ->orWhere('ringkasan', 'like', "%{$q}%");
            });
        }

        // Filter kategori jika dipilih
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $beritaList = $query->paginate(10)->withQueryString();

        return view('admin.berita.index', compact('beritaList'));
    }

    public function create()
    {
        return view('admin.berita.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules(true), $this->validationMessages());

        $validated['slug'] = Str::slug($validated['judul']).'-'.time();
        $validated['penulis'] = $validated['penulis'] ?? 'Sekretariat TP. PKK Karangtanjung';
        $validated['status'] = 'published';

        // Bersihkan tag paragraf kosong / &nbsp; dari editor
        $validated['konten'] = $this->cleanContent($validated['konten']);

        // Upload gambar jika ada
        $uploadedImage = null;
        $uploadFile = null;
        if ($request->hasFile('gambar')) {
            $uploadFile = $request->file('gambar');
            $filename = Str::uuid().'.'.$uploadFile->getClientOriginalExtension();
            $validated['gambar'] = $filename;
            $uploadedImage = $filename;
        }

        try {
            if ($uploadFile) {
                $uploadDir = PublicImagePath::directory();
                File::ensureDirectoryExists($uploadDir);
                $uploadFile->move($uploadDir, $uploadedImage);
            }
            Berita::create($validated);
        } catch (\Throwable $exception) {
            $this->deleteManagedImage($uploadedImage);
            throw $exception;
        }

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dipublikasikan!');
    }

    private function validationRules(bool $imageRequired): array
    {
        return [
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'tanggal' => 'required|date',
            'ringkasan' => 'required|string',
            'konten' => 'required|string',
            'penulis' => 'required|string|max:150',
            'gambar' => ($imageRequired ? 'required' : 'nullable').'|image|mimes:jpeg,png,jpg,webp|max:5120',
        ];
    }

    private function validationMessages(): array
    {
        return [
            'judul.required' => 'Judul berita wajib diisi.',
            'kategori.required' => 'Kategori kegiatan wajib dipilih.',
            'tanggal.required' => 'Tanggal kegiatan wajib diisi.',
            'ringkasan.required' => 'Ringkasan singkat wajib diisi.',
            'konten.required' => 'Deskripsi lengkap berita wajib diisi.',
            'penulis.required' => 'Penulis/pelapor berita wajib diisi.',
            'gambar.required' => 'Foto dokumentasi wajib diunggah.',
            'gambar.image' => 'File dokumentasi harus berupa gambar.',
            'gambar.mimes' => 'Format gambar yang didukung: JPG, JPEG, PNG, atau WEBP.',
            'gambar.max' => 'Ukuran gambar maksimal 5 MB.',
        ];
    }

    private function cleanContent(string $content): string
    {
        return preg_replace('/<p[^>]*>(\s|&nbsp;|<br\s*\/?\s*>)*<\/p>/i', '', $content) ?? $content;
    }

    public function edit(int|string $id)
    {
        $item = Berita::findOrFail($id);

        $berita = [
            'id' => $item->id,
            'judul' => $item->judul,
            'kategori' => $item->kategori,
            'tanggal' => $item->tanggal_formatted,
            'tanggal_raw' => $item->tanggal ? $item->tanggal->format('Y-m-d') : date('Y-m-d'),
            'ringkasan' => $item->ringkasan,
            'konten' => $item->konten,
            'gambar' => $item->gambar,
            'penulis' => $item->penulis,
        ];

        return view('admin.berita.form', compact('berita'));
    }

    public function update(Request $request, int|string $id)
    {
        $item = Berita::findOrFail($id);

        $validated = $request->validate($this->validationRules(false), $this->validationMessages());

        $uploadedImage = null;
        $uploadFile = null;
        $oldImage = $item->gambar;
        if ($request->hasFile('gambar')) {
            $uploadFile = $request->file('gambar');
            $filename = Str::uuid().'.'.$uploadFile->getClientOriginalExtension();
            $validated['gambar'] = $filename;
            $uploadedImage = $filename;
        }

        // Bersihkan tag paragraf kosong / &nbsp; dari editor
        $validated['konten'] = $this->cleanContent($validated['konten']);

        try {
            if ($uploadFile) {
                $uploadDir = PublicImagePath::directory();
                File::ensureDirectoryExists($uploadDir);
                $uploadFile->move($uploadDir, $uploadedImage);
            }
            $item->update($validated);
        } catch (\Throwable $exception) {
            $this->deleteManagedImage($uploadedImage);
            throw $exception;
        }

        if ($uploadedImage !== null) {
            $this->deleteManagedImage($oldImage);
        }

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(int|string $id)
    {
        $item = Berita::findOrFail($id);

        $oldImage = $item->gambar;
        $item->delete();
        $this->deleteManagedImage($oldImage);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus!');
    }

    private function deleteManagedImage(?string $image): void
    {
        if (! $image || basename($image) !== $image || preg_match('/^(?:[1-9]|1[0-2])\.webp$/', $image)) {
            return;
        }

        $path = PublicImagePath::file('images/'.$image);
        if (File::exists($path)) {
            File::delete($path);
        }
    }

}
