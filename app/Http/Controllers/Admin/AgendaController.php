<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
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
                    'status' => $item->is_selesai ? 'Selesai' : 'Mendatang',
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

        if (! $this->agendaStartsInFuture($validated['tanggal'], $validated['waktu'])) {
            return back()->withInput()
                ->with('error', 'Tanggal dan jam mulai agenda harus berada di waktu mendatang.');
        }

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

    private function agendaStartsInFuture(string $tanggal, string $waktu): bool
    {
        if (! preg_match('/(\d{1,2})[:.](\d{2})/', $waktu, $matches)) {
            return false;
        }

        try {
            $waktuMulai = Carbon::createFromFormat(
                'Y-m-d H:i',
                sprintf('%s %02d:%02d', $tanggal, (int) $matches[1], (int) $matches[2]),
                'Asia/Jakarta'
            );
        } catch (\Throwable $exception) {
            return false;
        }

        return $waktuMulai !== false && $waktuMulai->greaterThan(Carbon::now('Asia/Jakarta'));
    }
}
