<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $beritaList = Berita::latest('tanggal')->get()->map(function ($item) {
            return [
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
        })->all();

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

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time().'_'.Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $validated['gambar'] = $filename;
        }

        Berita::create($validated);

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

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time().'_'.Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $validated['gambar'] = $filename;
        }

        $item->update($validated);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(int|string $id)
    {
        $item = Berita::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus!');
    }
}
