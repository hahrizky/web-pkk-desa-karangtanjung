<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        $agendaList = Agenda::orderBy('tanggal', 'asc')->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'judul' => $item->judul,
                'kategori' => $item->kategori,
                'tanggal' => $item->tanggal_formatted,
                'tanggal_raw' => $item->tanggal ? $item->tanggal->format('Y-m-d') : date('Y-m-d'),
                'waktu' => $item->waktu,
                'lokasi' => $item->lokasi,
                'deskripsi' => $item->deskripsi,
                'status' => $item->status,
            ];
        })->all();

        return view('admin.agenda.index', compact('agendaList'));
    }

    public function create()
    {
        return view('admin.agenda.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|string',
            'tanggal' => 'required|date',
            'waktu' => 'nullable|string|max:100',
            'lokasi' => 'required|string|max:255',
            'penyelenggara' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $validated['kategori'] = $validated['kategori'] ?? 'Umum';
        $validated['status'] = 'Mendatang';

        Agenda::create($validated);

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda kegiatan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $item = Agenda::findOrFail($id);

        $agenda = [
            'id' => $item->id,
            'judul' => $item->judul,
            'kategori' => $item->kategori,
            'tanggal' => $item->tanggal ? $item->tanggal->format('Y-m-d') : date('Y-m-d'),
            'waktu' => $item->waktu,
            'lokasi' => $item->lokasi,
            'penyelenggara' => $item->penyelenggara,
            'deskripsi' => $item->deskripsi,
            'status' => $item->status,
        ];

        return view('admin.agenda.form', compact('agenda'));
    }

    public function update(Request $request, $id)
    {
        $item = Agenda::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|string',
            'tanggal' => 'required|date',
            'waktu' => 'nullable|string|max:100',
            'lokasi' => 'required|string|max:255',
            'penyelenggara' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $item->update($validated);

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda kegiatan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $item = Agenda::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda kegiatan berhasil dihapus!');
    }
}
