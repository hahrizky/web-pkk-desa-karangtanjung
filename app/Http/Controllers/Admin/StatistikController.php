<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StatistikDasawisma;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    public function index()
    {
        $statistik = StatistikDasawisma::orderBy('urutan', 'asc')->get();
        return view('admin.statistik.index', compact('statistik'));
    }

    public function create()
    {
        return view('admin.statistik.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'nilai' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
            'warna' => 'nullable|string|max:50',
            'icon' => 'nullable|string|max:50',
            'urutan' => 'nullable|integer',
        ]);

        StatistikDasawisma::create($validated);

        return redirect()->route('admin.statistik.index')->with('success', 'Data statistik berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = StatistikDasawisma::findOrFail($id);
        return view('admin.statistik.form', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = StatistikDasawisma::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'nilai' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
            'warna' => 'nullable|string|max:50',
            'icon' => 'nullable|string|max:50',
            'urutan' => 'nullable|integer',
        ]);

        $item->update($validated);

        return redirect()->route('admin.statistik.index')->with('success', 'Data statistik berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $item = StatistikDasawisma::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.statistik.index')->with('success', 'Data statistik berhasil dihapus.');
    }
}

