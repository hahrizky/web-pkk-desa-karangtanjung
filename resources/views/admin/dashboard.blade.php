@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
{{-- Welcome Banner --}}
<div class="bg-gradient-to-r from-[#075B3C] to-[#14633F] rounded-2xl p-6 mb-6 text-white">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold">Selamat Datang, {{ session('admin_name', 'Administrator') }}! 👋</h2>
            <p class="text-green-100 text-sm mt-1">{{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY • HH:mm') }} WIB</p>
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
            ['label' => 'Total Berita', 'value' => $totalBerita, 'icon' => 'fa-newspaper', 'color' => 'bg-emerald-50 text-emerald-600', 'route' => 'admin.berita.index'],
            ['label' => 'Agenda Kegiatan', 'value' => $totalAgenda, 'icon' => 'fa-calendar-days', 'color' => 'bg-amber-50 text-amber-600', 'route' => 'admin.agenda.index'],
            ['label' => 'Statistik Dasawisma', 'value' => $totalStatistik, 'icon' => 'fa-chart-pie', 'color' => 'bg-blue-50 text-blue-600', 'route' => 'admin.statistik.index'],
            ['label' => 'Kelompok Kerja (Pokja)', 'value' => $totalPokja, 'icon' => 'fa-layer-group', 'color' => 'bg-purple-50 text-purple-600', 'route' => 'admin.pokja.index'],
        ];
    @endphp

    @foreach($stats as $stat)
        <a href="{{ route($stat['route']) }}" class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-0.5 transition-all group">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs text-gray-500 font-medium">{{ $stat['label'] }}</p>
                    <p class="text-3xl font-extrabold text-gray-800 mt-1">{{ $stat['value'] }}</p>
                </div>
                <div class="w-10 h-10 {{ $stat['color'] }} rounded-xl flex items-center justify-center">
                    <i class="fa-solid {{ $stat['icon'] }} text-sm"></i>
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-3 group-hover:text-[#075B3C] transition-colors">
                Lihat semua <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </p>
        </a>
    @endforeach
</div>

{{-- Main Grid --}}
<div class="grid lg:grid-cols-3 gap-6">

    {{-- Recent Berita --}}
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <div class="flex items-center gap-2">
                <div class="w-1 h-5 bg-[#075B3C] rounded-full"></div>
                <h3 class="font-semibold text-gray-800">Berita Terbaru</h3>
            </div>
            <a href="{{ route('admin.berita.index') }}" class="text-xs text-[#075B3C] font-semibold hover:underline">Lihat Semua</a>
        </div>
        <div class="divide-y divide-gray-50">
            @foreach($recentBerita as $berita)
                <div class="flex items-start gap-4 px-6 py-4 hover:bg-gray-50 transition-colors group">
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
                    <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity flex-shrink-0">
                        <a href="{{ route('admin.berita.edit', $berita['id']) }}"
                           class="w-7 h-7 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center transition-colors">
                            <i class="fa-solid fa-pen text-[10px]"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Right Panel --}}
    <div class="space-y-6">
        {{-- Agenda Upcoming --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <div class="flex items-center gap-2">
                    <div class="w-1 h-5 bg-amber-400 rounded-full"></div>
                    <h3 class="font-semibold text-gray-800 text-sm">Agenda Mendatang</h3>
                </div>
                <a href="{{ route('admin.agenda.index') }}" class="text-xs text-[#075B3C] font-semibold hover:underline">Semua</a>
            </div>
            <div class="divide-y divide-gray-50">
                @foreach($upcomingAgenda as $agenda)
                    <div class="flex items-start gap-3 px-5 py-3.5 hover:bg-gray-50 transition-colors">
                        <div class="w-10 h-10 bg-amber-50 rounded-xl flex flex-col items-center justify-center flex-shrink-0">
                            <span class="text-xs font-bold text-amber-600 leading-none">{{ \Carbon\Carbon::parse($agenda['tanggal'])->format('d') }}</span>
                            <span class="text-[9px] text-amber-500 uppercase">{{ \Carbon\Carbon::parse($agenda['tanggal'])->locale('id')->isoFormat('MMM') }}</span>
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
                   class="flex flex-col items-center gap-2 p-3 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 rounded-xl transition-colors text-center active:scale-95">
                    <i class="fa-solid fa-newspaper text-lg"></i>
                    <span class="text-xs font-medium">Berita Baru</span>
                </a>
                <a href="{{ route('admin.agenda.create') }}"
                   class="flex flex-col items-center gap-2 p-3 bg-amber-50 hover:bg-amber-100 text-amber-700 rounded-xl transition-colors text-center active:scale-95">
                    <i class="fa-solid fa-calendar-plus text-lg"></i>
                    <span class="text-xs font-medium">Agenda Baru</span>
                </a>
                <a href="{{ route('admin.statistik.create') }}"
                   class="flex flex-col items-center gap-2 p-3 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-xl transition-colors text-center active:scale-95">
                    <i class="fa-solid fa-chart-line text-lg"></i>
                    <span class="text-xs font-medium">Statistik Baru</span>
                </a>
                <a href="{{ route('admin.profil') }}"
                   class="flex flex-col items-center gap-2 p-3 bg-purple-50 hover:bg-purple-100 text-purple-700 rounded-xl transition-colors text-center active:scale-95">
                    <i class="fa-solid fa-id-card text-lg"></i>
                    <span class="text-xs font-medium">Profil Desa</span>
                </a>
                <a href="{{ route('admin.struktur.index') }}"
                   class="flex flex-col items-center gap-2 p-3 bg-teal-50 hover:bg-teal-100 text-teal-700 rounded-xl transition-colors text-center active:scale-95 col-span-2">
                    <i class="fa-solid fa-sitemap text-lg"></i>
                    <span class="text-xs font-semibold">Ganti Nama Struktur Organisasi</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

