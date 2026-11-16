@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
{{-- Welcome Banner --}}
<div class="bg-[#2F9B45] rounded-2xl p-6 mb-6 text-white">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold">Selamat Datang, {{ session('admin_name', 'Administrator') }}! 👋</h2>
            <p class="text-green-100 text-sm mt-1">{{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.berita.create') }}"
                class="inline-flex items-center gap-2 bg-white text-[#075B3C] font-semibold text-sm px-4 py-2 rounded-xl hover:bg-green-50 transition-colors active:scale-95">
                <i class="fa-solid fa-plus"></i> Tambah Berita
            </a>
        </div>
    </div>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    @php
    $stats = [
    ['label' => 'Total Berita', 'value' => $totalBerita, 'icon' => 'fa-newspaper', 'color' => 'bg-white text-amber-500', 'route' => 'admin.berita.index'],

    ['label' => 'Agenda Kegiatan', 'value' => $totalAgenda, 'icon' => 'fa-calendar-days', 'color' => 'bg-white text-sky-500', 'route' => 'admin.agenda.index'],

    ['label' => 'Statistik Dasawisma', 'value' => $totalStatistik, 'icon' => 'fa-chart-pie', 'color' => 'bg-white text-purple-500', 'route' => 'admin.statistik.index'],

    ['label' => 'Struktur Organisasi', 'value' => $totalPengurus, 'icon' => 'fa-sitemap', 'color' => 'bg-white text-cyan-600', 'route' => 'admin.struktur.index'],
    ];
    @endphp

    @foreach($stats as $stat)
    <a href="{{ route($stat['route']) }}" class="bg-[#2F9B45] rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-0.5 transition-all group">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs text-white font-medium">{{ $stat['label'] }}</p>
                <p class="text-3xl font-extrabold text-white mt-1">{{ $stat['value'] }}</p>
            </div>
            <div class="w-10 h-10 {{ $stat['color'] }} rounded-xl flex items-center justify-center">
                <i class="fa-solid {{ $stat['icon'] }} text-sm"></i>
            </div>
        </div>
        <p class="text-xs text-white mt-3 group-hover:text-[#075B3C] transition-colors">
            Lihat semua <i class="fa-solid fa-arrow-right text-[10px]"></i>
        </p>
    </a>
    @endforeach
</div>

{{-- Main Grid --}}
<div class="grid lg:grid-cols-3 gap-6">

    {{-- Recent Berita --}}
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="bg-[#2F9B45] flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <div class="flex items-center gap-2">
                <div class="w-1 h-5 bg-white rounded-full"></div>
                <h3 class="font-semibold text-white">Berita Terbaru</h3>
            </div>
            <a href="{{ route('admin.berita.index') }}" class="text-xs text-white font-semibold hover:underline">Lihat Semua</a>
        </div>
        <div class="divide-y divide-gray-50">
            @foreach($recentBerita as $berita)
            <div class="flex items-start gap-4 px-6 py-4 hover:bg-gray-50 transition-colors">
                <img src="{{ asset('images/' . $berita['gambar']) }}" alt="{{ $berita['judul'] }}"
                    class="w-14 h-14 rounded-xl object-cover flex-shrink-0 bg-gray-100">
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-800 leading-snug truncate">{{ $berita['judul'] }}</p>
                    <p class="text-xs text-gray-400 mt-1">
                        <span class="inline-block bg-green-50 text-green-700 px-2 py-0.5 rounded-full text-[10px] font-medium mr-2">{{ $berita['kategori'] }}</span>
                        {{ $berita['tanggal'] }}
                    </p>
                    <p class="text-xs text-gray-500 mt-1 line-clamp-1">{{ $berita['ringkasan'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Right Panel --}}
    <div class="space-y-6">
        {{-- Agenda Upcoming --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-[#2F9B45] flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <div class="flex items-center gap-2">
                    <div class="w-1 h-5 bg-white rounded-full"></div>
                    <h3 class="font-semibold text-white text-sm">Agenda Mendatang</h3>
                </div>
                <a href="{{ route('admin.agenda.index') }}" class="text-xs text-white font-semibold hover:underline">Semua</a>
            </div>
            <div class="divide-y divide-gray-50">
                @foreach($upcomingAgenda as $agenda)
                <div class="flex items-start gap-3 px-5 py-3.5 hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 bg-[#075B3C] rounded-xl flex flex-col items-center justify-center flex-shrink-0 shadow-2xs">
                        <span class="text-xs font-bold text-white leading-none">{{ \Carbon\Carbon::parse($agenda['tanggal'])->format('d') }}</span>
                        <span class="text-[9px] text-white uppercase">{{ \Carbon\Carbon::parse($agenda['tanggal'])->locale('id')->isoFormat('MMM') }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-semibold text-gray-800 leading-snug">{{ $agenda['judul'] }}</p>
                        <p class="text-[11px] text-gray-400 mt-0.5 truncate">{{ $agenda['lokasi'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <div class="flex items-center gap-2 mb-4">
                <div class="w-1 h-5 bg-purple-400 rounded-full"></div>
                <h3 class="font-semibold text-gray-800 text-sm">Aksi Cepat</h3>
            </div>
            <div class="grid grid-cols-2 gap-2">
                <a href="{{ route('admin.berita.create') }}"
                    class="flex flex-col items-center gap-2 p-3 bg-[#2F9B45] hover:bg-[#26863A] active:bg-[#075B3C] text-white rounded-xl transition-all duration-200 text-center active:scale-95 shadow-sm cursor-pointer">
                    <i class="fa-solid fa-newspaper text-lg text-amber-300"></i>
                    <span class="text-xs font-semibold">Berita Baru</span>
                </a>

                <a href="{{ route('admin.agenda.create') }}"
                    class="flex flex-col items-center gap-2 p-3 bg-[#2F9B45] hover:bg-[#26863A] active:bg-[#075B3C] text-white rounded-xl transition-all duration-200 text-center active:scale-95 shadow-sm cursor-pointer">
                    <i class="fa-solid fa-calendar-plus text-lg text-sky-300"></i>
                    <span class="text-xs font-semibold">Agenda Baru</span>
                </a>

                <a href="{{ route('admin.statistik.index') }}"
                    class="flex flex-col items-center gap-2 p-3 bg-[#2F9B45] hover:bg-[#26863A] active:bg-[#075B3C] text-white rounded-xl transition-all duration-200 text-center active:scale-95 shadow-sm cursor-pointer">
                    <i class="fa-solid fa-chart-line text-lg text-purple-300"></i>
                    <span class="text-xs font-semibold">Ubah Statistik</span>
                </a>

                <a href="{{ route('admin.profil') }}"
                    class="flex flex-col items-center gap-2 p-3 bg-[#2F9B45] hover:bg-[#26863A] active:bg-[#075B3C] text-white rounded-xl transition-all duration-200 text-center active:scale-95 shadow-sm cursor-pointer">
                    <i class="fa-solid fa-id-card text-lg text-orange-300"></i>
                    <span class="text-xs font-semibold">Profil Desa</span>
                </a>

                <a href="{{ route('admin.struktur.index') }}"
                    class="flex flex-col items-center gap-2 p-3 bg-[#2F9B45] hover:bg-[#26863A] active:bg-[#075B3C] text-white rounded-xl transition-all duration-200 text-center active:scale-95 shadow-sm cursor-pointer">
                    <i class="fa-solid fa-sitemap text-lg text-cyan-300"></i>
                    <span class="text-xs font-semibold">Struktur Organisasi</span>
                </a>

                <a href="{{ route('admin.hero.index') }}"
                    class="flex flex-col items-center gap-2 p-3 bg-[#2F9B45] hover:bg-[#26863A] active:bg-[#075B3C] text-white rounded-xl transition-all duration-200 text-center active:scale-95 shadow-sm cursor-pointer">
                    <i class="fa-solid fa-image text-lg text-emerald-200"></i>
                    <span class="text-xs font-semibold">Background Beranda</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection