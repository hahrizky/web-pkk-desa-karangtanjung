<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        $agendaList = Agenda::getSortedAgendas()
            ->map(function ($item) {
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
            'kategori' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'waktu' => 'required|string|max:100',
            'lokasi' => 'required|string|max:255',
            'penyelenggara' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ], [
            'judul.required' => 'Nama kegiatan wajib diisi.',
            'kategori.required' => 'Kategori kegiatan wajib dipilih.',
            'tanggal.required' => 'Hari & tanggal wajib diisi.',
            'waktu.required' => 'Waktu pelaksanaan wajib diisi.',
            'lokasi.required' => 'Lokasi / tempat wajib diisi.',
            'penyelenggara.required' => 'Penyelenggara kegiatan wajib diisi.',
            'deskripsi.required' => 'Rincian & teknis pelaksanaan wajib diisi.',
        ]);

        $validated['status'] = 'Mendatang';
        $validated['isi'] = $validated['deskripsi'];

        Agenda::create($validated);

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda kegiatan berhasil ditambahkan!');
    }

    public function edit(int|string $id)
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
            'deskripsi' => $item->isi ?: $item->deskripsi,
            'status' => $item->status,
        ];

        return view('admin.agenda.form', compact('agenda'));
    }

    public function update(Request $request, int|string $id)
    {
        $item = Agenda::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'waktu' => 'required|string|max:100',
            'lokasi' => 'required|string|max:255',
            'penyelenggara' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ], [
            'judul.required' => 'Nama kegiatan wajib diisi.',
            'kategori.required' => 'Kategori kegiatan wajib dipilih.',
            'tanggal.required' => 'Hari & tanggal wajib diisi.',
            'waktu.required' => 'Waktu pelaksanaan wajib diisi.',
            'lokasi.required' => 'Lokasi / tempat wajib diisi.',
            'penyelenggara.required' => 'Penyelenggara kegiatan wajib diisi.',
            'deskripsi.required' => 'Rincian & teknis pelaksanaan wajib diisi.',
        ]);

        $validated['isi'] = $validated['deskripsi'];

        $item->update($validated);

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda kegiatan berhasil diperbarui!');
    }

    public function destroy(int|string $id)
    {
        $item = Agenda::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda kegiatan berhasil dihapus!');
    }
}
