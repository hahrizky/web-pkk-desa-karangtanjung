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

        // Agenda mendatang: hanya tampilkan yang belum selesai (cek tanggal + waktu via accessor is_selesai)
        $today = now()->startOfDay()->toDateString();

        $upcomingAgenda = Agenda::where('tanggal', '>=', $today)
            ->orderBy('tanggal', 'asc')
            ->get()
            ->filter(function ($item) {
                return !$item->is_selesai;
            })
            ->take(4)
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'judul' => $item->judul,
                    'tanggal' => $item->tanggal ? $item->tanggal->format('Y-m-d') : date('Y-m-d'),
                    'lokasi' => $item->lokasi,
                ];
            })->values()->all();

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
