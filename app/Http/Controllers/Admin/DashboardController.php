<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\StatistikDasawisma;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBerita = Berita::count();
        $totalAgenda = Agenda::count();
        $totalStatistik = min(StatistikDasawisma::count(), 3);
        $totalPokja = 4;

        // 5 berita terbaru untuk tabel dashboard
        $recentBerita = Berita::latest('tanggal')->take(5)->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'judul' => $item->judul,
                'kategori' => $item->kategori,
                'tanggal' => $item->tanggal_formatted,
                'ringkasan' => $item->ringkasan,
                'gambar' => $item->gambar ?? '1.webp',
            ];
        })->all();

        // Agenda mendatang dari database
        $upcomingAgenda = Agenda::orderBy('tanggal', 'asc')->take(4)->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'judul' => $item->judul,
                'tanggal' => $item->tanggal ? $item->tanggal->format('Y-m-d') : date('Y-m-d'),
                'lokasi' => $item->lokasi,
            ];
        })->all();

        return view('admin.dashboard', compact(
            'totalBerita',
            'totalAgenda',
            'totalStatistik',
            'totalPokja',
            'recentBerita',
            'upcomingAgenda'
        ));
    }
}
