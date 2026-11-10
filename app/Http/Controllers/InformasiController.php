<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class InformasiController extends Controller
{
    private function getBeritaData()
    {
        try {
            return Berita::where('status', 'published')
                ->latest('tanggal')
                ->orderByDesc('id')
                ->get()
                ->map(fn ($item) => [
                    'id' => $item->id,
                    'slug' => $item->slug,
                    'judul' => $item->judul,
                    'kategori' => $item->kategori,
                    'pokja' => $item->kategori,
                    'pokja_nama' => $item->kategori,
                    'tanggal' => $item->tanggal_formatted,
                    'bulan' => $item->tanggal?->format('m') ?? '01',
                    'tahun' => $item->tanggal?->format('Y') ?? '',
                    'deskripsi' => $item->ringkasan ?? '',
                    'isi' => $item->konten,
                    'gambar' => $item->gambar,
                    'tags' => $item->tags ?? [],
                    'penulis' => $item->penulis,
                ])->all();
        } catch (\Throwable $e) {
            return [];
        }
    }

    private function getAgendaData()
    {
        try {
            return Agenda::orderBy('tanggal')
                ->get()
                ->map(fn ($item) => [
                    'id' => $item->id,
                    'judul' => $item->judul,
                    'kategori' => $item->kategori,
                    'pokja_label' => $item->penyelenggara ?? $item->kategori,
                    'tanggal' => $item->hari_tanggal,
                    'bulan' => $item->bulan_singkat,
                    'tahun' => $item->tanggal?->format('Y') ?? '',
                    'tanggal_lengkap' => $item->tanggal_formatted,
                    'hari' => $item->hari,
                    'waktu' => $item->waktu,
                    'lokasi' => $item->lokasi,
                    'penyelenggara' => $item->penyelenggara ?? $item->kategori,
                    'deskripsi' => $item->deskripsi ?? '',
                    'isi' => $item->isi ?? $item->deskripsi ?? '',
                    'status' => $item->status,
                    'icon' => 'fa-solid fa-calendar-check',
                    'icon_color' => 'text-emerald-700',
                    'icon_bg' => 'bg-emerald-50',
                    'badge_color' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
                ])->all();
        } catch (\Throwable $e) {
            return [];
        }
    }

    public function index(Request $request)
    {
        $allBerita = collect($this->getBeritaData());

        if ($request->filled('q')) {
            $q = mb_strtolower($request->input('q'));
            $allBerita = $allBerita->filter(fn ($item) => str_contains(mb_strtolower($item['judul']), $q) ||
                str_contains(mb_strtolower($item['deskripsi']), $q) ||
                str_contains(mb_strtolower($item['kategori']), $q) ||
                str_contains(mb_strtolower(implode(' ', $item['tags'])), $q)
            );
        }

        if ($request->filled('kategori') && $request->input('kategori') !== 'Semua') {
            $kategori = $request->input('kategori');
            $allBerita = $allBerita->filter(fn ($item) => strcasecmp($item['kategori'], $kategori) === 0);
        }

        foreach (['bulan', 'tahun'] as $filter) {
            if ($request->filled($filter)) {
                $value = $request->input($filter);
                $allBerita = $allBerita->filter(fn ($item) => $item[$filter] == $value);
            }
        }

        $perPage = 4;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $beritaPaginated = new LengthAwarePaginator(
            $allBerita->slice(($currentPage - 1) * $perPage, $perPage)->values(),
            $allBerita->count(),
            $perPage,
            $currentPage,
            ['path' => route('informasi.index'), 'query' => $request->query()]
        );

        $kategoriList = ['Semua', 'Pokja I', 'Pokja II', 'Pokja III', 'Pokja IV', 'Umum'];
        $bulanList = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember',
        ];
        // List tahun: selalu ada data (minimal dari 2024 s/d tahun berjalan)
        // Dan otomatis bertambah tiap pergantian tahun baru (date('Y'))
        $startYear = 2024;
        $currentYear = (int) date('Y');
        $dbYears = collect($this->getBeritaData())->pluck('tahun')->filter()->map(fn ($y) => (int) $y)->all();
        $minYear = ! empty($dbYears) ? min(min($dbYears), $startYear) : $startYear;
        $maxYear = ! empty($dbYears) ? max(max($dbYears), $currentYear) : $currentYear;
        $tahunList = range($maxYear, $minYear);
        $agendaList = $this->getAgendaData();
        $pengumumanList = [];
        $infoPenting = [];

        return view('informasi.index', compact(
            'beritaPaginated', 'kategoriList', 'bulanList', 'tahunList',
            'agendaList', 'pengumumanList', 'infoPenting'
        ));
    }

    public function show(int|string $id)
    {
        $allBerita = collect($this->getBeritaData());
        $berita = $allBerita->firstWhere('id', (int) $id);
        abort_if(! $berita, 404, 'Berita atau kegiatan tidak ditemukan');

        $beritaLainnya = $allBerita->where('id', '!=', (int) $id)->take(3);

        return view('informasi.show', compact('berita', 'beritaLainnya'));
    }

    public function agendaIndex()
    {
        $agendas = $this->getAgendaData();

        return view('informasi.agenda-index', compact('agendas'));
    }

    public function agendaShow(int|string $id)
    {
        $allAgenda = collect($this->getAgendaData());
        $agenda = $allAgenda->firstWhere('id', (int) $id);
        abort_if(! $agenda, 404, 'Agenda kegiatan tidak ditemukan');

        $agendaLainnya = $allAgenda->where('id', '!=', (int) $id)->take(3);

        return view('informasi.agenda-show', compact('agenda', 'agendaLainnya'));
    }

    public function pengumumanIndex()
    {
        return redirect()->route('informasi.index');
    }

    public function pengumumanShow(int|string $id)
    {
        return redirect()->route('informasi.index');
    }
}
