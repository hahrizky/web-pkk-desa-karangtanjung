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
        $totalPengurus = 11; // 1 Pembina + 6 Pengurus Inti + 4 Pokja

        // Berita terbaru untuk tabel dashboard (ditambah jadi 7 agar seimbang mengisi ruang bawah)
        $recentBerita = Berita::latest('tanggal')->take(7)->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'judul' => $item->judul,
                'kategori' => $item->kategori,
                'tanggal' => $item->tanggal_formatted,
                'ringkasan' => $item->ringkasan,
                'gambar' => $item->gambar ?? '1.webp',
            ];
        })->all();

        // Agenda mendatang dari database (tanggal >= hari ini, jika kurang dari 4 ambil yang terdekat)
        $today = now()->startOfDay()->toDateString();
        $upcomingAgenda = Agenda::where('tanggal', '>=', $today)
            ->orderBy('tanggal', 'asc')
            ->take(4)
            ->get();

        // Jika agenda mendatang belum ada 4, lengkapi dengan agenda terbaru
        if ($upcomingAgenda->count() < 4) {
            $existingIds = $upcomingAgenda->pluck('id')->all();
            $moreAgenda = Agenda::whereNotIn('id', $existingIds)
                ->orderBy('tanggal', 'desc')
                ->take(4 - $upcomingAgenda->count())
                ->get();
            $upcomingAgenda = $upcomingAgenda->concat($moreAgenda);
        }

        $upcomingAgenda = $upcomingAgenda->map(function ($item) {
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
            'totalPengurus',
            'recentBerita',
            'upcomingAgenda'
        ));
    }
}
