<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'tanggal' => 'required|date',
            'ringkasan' => 'nullable|string',
            'konten' => 'required|string',
            'penulis' => 'nullable|string|max:150',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $validated['slug'] = Str::slug($validated['judul']).'-'.time();
        $validated['penulis'] = $validated['penulis'] ?? 'Sekretariat TP. PKK Karangtanjung';
        $validated['status'] = 'published';

        // Bersihkan tag paragraf kosong / &nbsp; dari editor
        $validated['konten'] = preg_replace('/<p[^>]*>(\s|&nbsp;|<br\s*\/?>)*<\/p>/i', '', $validated['konten']);

        // Upload gambar jika ada
        $uploadedImage = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = Str::uuid().'.'.$file->getClientOriginalExtension();
            File::ensureDirectoryExists(public_path('images'));
            $file->move(public_path('images'), $filename);
            $validated['gambar'] = $filename;
            $uploadedImage = $filename;
        }

        try {
            Berita::create($validated);
        } catch (\Throwable $exception) {
            $this->deleteManagedImage($uploadedImage);
            throw $exception;
        }

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dipublikasikan!');
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

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'tanggal' => 'required|date',
            'ringkasan' => 'nullable|string',
            'konten' => 'required|string',
            'penulis' => 'nullable|string|max:150',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $uploadedImage = null;
        $oldImage = $item->gambar;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = Str::uuid().'.'.$file->getClientOriginalExtension();
            File::ensureDirectoryExists(public_path('images'));
            $file->move(public_path('images'), $filename);
            $validated['gambar'] = $filename;
            $uploadedImage = $filename;
        }

        // Bersihkan tag paragraf kosong / &nbsp; dari editor
        $validated['konten'] = preg_replace('/<p[^>]*>(\s|&nbsp;|<br\s*\/?>)*<\/p>/i', '', $validated['konten']);

        try {
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

        $path = public_path('images/'.$image);
        if (File::exists($path)) {
            File::delete($path);
        }
    }
}
