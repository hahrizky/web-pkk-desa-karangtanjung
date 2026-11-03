@extends('layouts.app')

@section('title', 'Pusat Informasi & Dokumentasi Kegiatan — TP. PKK Desa Karangtanjung')

@section('content')

    <!-- ================= 1. HERO SECTION & DESKRIPSI INFORMASI ================= -->
    <section class="bg-[#E8F7EF] pt-8 pb-12 sm:pt-10 sm:pb-14 border-b border-[#D1D5DB]/40">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Breadcrumb Navigasi Penghubung ke Beranda -->
            <nav class="flex items-center gap-2 text-xs text-gray-500 mb-3" aria-label="Breadcrumb">
                <a href="{{ route('beranda') }}" class="hover:text-[#075B3C] transition-colors flex items-center gap-1.5">
                    <i class="fa-solid fa-house text-[11px]"></i>
                    <span>Beranda</span>
                </a>
                <span class="text-gray-400">/</span>
                <span class="text-[#075B3C] font-semibold">Pusat Informasi &amp; Dokumentasi</span>
            </nav>

            <!-- Judul Utama H1 -->
            <h1 class="text-2xl sm:text-[28px] lg:text-[32px] font-extrabold text-[#075B3C] tracking-tight leading-snug mb-3 text-left">
                Pusat Informasi &amp; Dokumentasi Kegiatan TP. PKK Desa Karangtanjung
            </h1>

            <!-- Deskripsi Hero -->
            <p class="text-sm sm:text-[15px] text-[#475569] leading-relaxed max-w-5xl mb-6 text-left">
                Pusat rujukan informasi resmi seputar berita kegiatan pemberdayaan warga, agenda posyandu &amp; desa serta dokumen administrasi dasawisma di lingkungan Desa Karangtanjung, Kecamatan Candi, Kabupaten Sidoarjo.
            </p>

            <!-- Tautan Pintas Cepat ke Profil & Pokja Desa -->
            <div class="flex flex-wrap items-center gap-3 mb-6 text-xs text-emerald-900">
                <span class="font-bold text-[#075B3C]">Navigasi Terkait:</span>
                <a href="{{ route('profil') }}" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-white/80 hover:bg-white text-[#075B3C] border border-[#075B3C]/20 shadow-2xs transition-all">
                    <i class="fa-solid fa-id-card text-xs"></i>
                    <span>Profil &amp; Struktur Pengurus</span>
                </a>
                <a href="{{ route('pokja') }}" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-white/80 hover:bg-white text-[#075B3C] border border-[#075B3C]/20 shadow-2xs transition-all">
                    <i class="fa-solid fa-layer-group text-xs"></i>
                    <span>Tugas 4 Pokja PKK</span>
                </a>
            </div>

            <!-- ================= PANEL PENCARIAN & FILTER ================= -->
            <div class="bg-white rounded-2xl p-4 sm:p-5 shadow-sm border border-[#D1D5DB]/60">
                <form id="filter-form" action="{{ route('informasi.index') }}" method="GET" class="space-y-4">

                    <!-- Baris Atas: Input Pencarian, Dropdown Bulan & Tahun -->
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-3 sm:gap-4 items-center">

                        <!-- Input Pencarian (Cari berita, agenda, regulasi...) -->
                        <div class="md:col-span-8 relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                <i class="fa-solid fa-magnifying-glass text-sm"></i>
                            </div>
                            <input type="text"
                                   id="search-input"
                                   name="q"
                                   value="{{ request('q') }}"
                                   placeholder="Cari berita, agenda, regulasi..."
                                   class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 text-sm text-[#1F2937] placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#116B46] focus:border-transparent transition-all bg-[#F9FAFB]/50">
                        </div>

                        <!-- Filter Dropdown Bulan -->
                        <div class="md:col-span-2 relative">
                            <select name="bulan"
                                    id="bulan-select"
                                    class="w-full appearance-none bg-white border border-gray-300 text-gray-700 text-sm rounded-xl py-2.5 px-3.5 pr-8 focus:outline-none focus:ring-2 focus:ring-[#116B46] focus:border-transparent cursor-pointer transition-all">
                                <option value="">Semua bulan</option>
                                @foreach($bulanList as $key => $bln)
                                    <option value="{{ $key }}" {{ request('bulan') == $key ? 'selected' : '' }}>
                                        {{ $bln }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </div>
                        </div>

                        <!-- Filter Dropdown Tahun -->
                        <div class="md:col-span-2 relative">
                            <select name="tahun"
                                    id="tahun-select"
                                    class="w-full appearance-none bg-white border border-gray-300 text-gray-700 text-sm rounded-xl py-2.5 px-3.5 pr-8 focus:outline-none focus:ring-2 focus:ring-[#116B46] focus:border-transparent cursor-pointer transition-all">
                                @foreach($tahunList as $thn)
                                    <option value="{{ $thn }}" {{ (request('tahun', '2026') == $thn) ? 'selected' : '' }}>
                                        {{ $thn }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </div>
                        </div>

                    </div>

                    <!-- Baris Bawah: Filter Kategori Berbentuk Tombol Pill + Link ke Pokja -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2.5 pt-1">
                        <div class="flex items-center gap-2 sm:gap-2.5 overflow-x-auto pb-1 sm:pb-0 no-scrollbar">
                            <input type="hidden" name="kategori" id="kategori-input" value="{{ request('kategori', 'Semua') }}">

                            @foreach($kategoriList as $kat)
                                @php
                                    $isActive = (request('kategori', 'Semua') === $kat);
                                @endphp
                                <button type="button"
                                        onclick="filterByKategori('{{ $kat }}')"
                                        class="category-pill whitespace-nowrap px-4 sm:px-5 py-1.5 rounded-full text-xs sm:text-sm font-semibold transition-all duration-200 cursor-pointer
                                        {{ $isActive 
                                            ? 'bg-[#075B3C] text-white shadow-sm border border-[#075B3C]' 
                                            : 'bg-white text-[#075B3C] border border-[#075B3C] hover:bg-emerald-50' }}">
                                    {{ $kat }}
                                </button>
                            @endforeach
                        </div>

                        <div class="flex-shrink-0">
                            <a href="{{ route('pokja') }}" class="text-xs font-semibold text-[#075B3C] hover:underline inline-flex items-center gap-1">
                                <span>Lihat Rincian Program di Halaman Pokja</span>
                                <i class="fa-solid fa-angle-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </section>

    <!-- ================= 2. DAFTAR BERITA DAN KEGIATAN ================= -->
    <section class="py-12 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($beritaPaginated->count() > 0)
                <!-- Grid Berita 2 Kolom (Desktop) & 1 Kolom (Mobile) -->
                <div id="berita-grid" class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-7">
                    @foreach($beritaPaginated as $b)
                        <article class="bg-white rounded-[14px] border border-[#D1D5DB] overflow-hidden hover:shadow-md hover:border-[#116B46]/60 transition-all duration-200 flex flex-col sm:flex-row group h-full">

                            <!-- Bagian Kiri: Gambar Dokumentasi (Lebar ~40%) -->
                            <div class="sm:w-[40%] w-full h-48 sm:h-auto relative overflow-hidden bg-gray-100 flex-shrink-0">
                                <img src="{{ asset('images/' . $b['gambar']) }}"
                                     alt="{{ $b['judul'] }}"
                                     loading="lazy"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>

                            <!-- Bagian Kanan: Konten Informasi Berita (Lebar ~60%) -->
                            <div class="sm:w-[60%] w-full p-4 sm:p-5 flex flex-col justify-between">
                                <div>
                                    <!-- Header Card: Badge Kategori & Tanggal -->
                                    <div class="flex items-center gap-2.5 mb-2.5">
                                        <span class="inline-block px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-[#E8F7EF] text-[#075B3C] border border-[#075B3C]/20">
                                            {{ $b['kategori'] }}
                                        </span>
                                        <span class="text-xs text-gray-500 font-normal">
                                            {{ $b['tanggal'] }}
                                        </span>
                                    </div>

                                    <!-- Judul Berita (Maksimal 2-3 baris) -->
                                    <h2 class="text-base sm:text-[17px] font-bold text-[#1F2937] leading-snug mb-2 group-hover:text-[#075B3C] transition-colors line-clamp-2">
                                        <a href="{{ route('informasi.show', $b['id']) }}">
                                            {{ $b['judul'] }}
                                        </a>
                                    </h2>

                                    <!-- Deskripsi Cuplikan Berita -->
                                    <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-3 mb-4">
                                        {{ $b['deskripsi'] }}
                                    </p>
                                </div>

                                <!-- Footer Card: Tags & Link Baca Selengkapnya -->
                                <div>
                                    <!-- Tags Berita -->
                                    <div class="flex flex-wrap items-center gap-1.5 mb-3">
                                        @foreach($b['tags'] as $tag)
                                            <span class="px-2 py-0.5 rounded text-[11px] font-medium bg-gray-100 text-gray-600">
                                                #{{ $tag }}
                                            </span>
                                        @endforeach
                                    </div>

                                    <!-- Tombol Baca Selengkapnya -->
                                    <a href="{{ route('informasi.show', $b['id']) }}"
                                       class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-[#075B3C] hover:text-[#116B46] hover:underline transition-all">
                                        <span>Baca selengkapnya</span>
                                        <span class="text-base leading-none">&rarr;</span>
                                    </a>
                                </div>

                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- ================= 3. PAGINATION ================= -->
                <div class="mt-12 flex justify-center">
                    <nav class="flex items-center gap-1.5 sm:gap-2" aria-label="Pagination Berita">

                        {{-- Tombol Sebelumnya --}}
                        @if ($beritaPaginated->onFirstPage())
                            <span class="px-3.5 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-medium text-gray-400 bg-white border border-gray-200 cursor-not-allowed">
                                &larr; Sebelumnya
                            </span>
                        @else
                            <a href="{{ $beritaPaginated->previousPageUrl() }}"
                               class="px-3.5 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-medium text-gray-700 bg-white border border-[#D1D5DB] hover:bg-emerald-50 hover:text-[#075B3C] hover:border-[#075B3C] transition-colors">
                                &larr; Sebelumnya
                            </a>
                        @endif

                        {{-- Nomor Halaman (1, 2, 3...) --}}
                        @for ($page = 1; $page <= $beritaPaginated->lastPage(); $page++)
                            @if ($page == $beritaPaginated->currentPage())
                                <span class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg text-xs sm:text-sm font-bold flex items-center justify-center bg-[#075B3C] text-white shadow-sm border border-[#075B3C]">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $beritaPaginated->url($page) }}"
                                   class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg text-xs sm:text-sm font-medium flex items-center justify-center text-gray-700 bg-white border border-[#D1D5DB] hover:bg-emerald-50 hover:text-[#075B3C] hover:border-[#075B3C] transition-colors">
                                    {{ $page }}
                                </a>
                            @endif
                        @endfor

                        {{-- Tombol Berikutnya --}}
                        @if ($beritaPaginated->hasMorePages())
                            <a href="{{ $beritaPaginated->nextPageUrl() }}"
                               class="px-3.5 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-medium text-gray-700 bg-white border border-[#D1D5DB] hover:bg-emerald-50 hover:text-[#075B3C] hover:border-[#075B3C] transition-colors">
                                Berikutnya &rarr;
                            </a>
                        @else
                            <span class="px-3.5 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-medium text-gray-400 bg-white border border-gray-200 cursor-not-allowed">
                                Berikutnya &rarr;
                            </span>
                        @endif

                    </nav>
                </div>

            @else
                <!-- Tampilan Jika Hasil Pencarian / Filter Tidak Ditemukan -->
                <div class="text-center py-16 bg-[#F9FAFB] rounded-2xl border border-dashed border-gray-300 p-8">
                    <div class="w-16 h-16 rounded-full bg-emerald-50 text-[#075B3C] flex items-center justify-center text-2xl mx-auto mb-3">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <h3 class="text-base sm:text-lg font-bold text-gray-800 mb-1">
                        Informasi atau Berita Tidak Ditemukan
                    </h3>
                    <p class="text-xs sm:text-sm text-gray-500 max-w-md mx-auto mb-5">
                        Tidak ada arsip kegiatan yang sesuai dengan kata kunci pencarian atau filter yang Anda pilih.
                    </p>
                    <a href="{{ route('informasi.index') }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold bg-[#075B3C] text-white hover:bg-[#116B46] transition-all">
                        <i class="fa-solid fa-arrows-rotate text-xs"></i>
                        <span>Reset Semua Filter</span>
                    </a>
                </div>
            @endif

        </div>
    </section>

    <!-- ================= 4. SECTION AGENDA & JADWAL KEGIATAN PKK ================= -->
    <section class="py-14 bg-white border-t border-gray-100">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header Section Agenda -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
                <div>
                    <!-- Sub-judul Kecil -->
                    <span class="block text-xs sm:text-sm font-black tracking-widest text-[#075B3C] uppercase mb-1">
                        AGENDA KEGIATAN
                    </span>
                    <!-- Heading Utama -->
                    <h2 class="text-xl sm:text-2xl lg:text-[26px] font-extrabold text-[#1F2937] tracking-tight">
                        Agenda &amp; Jadwal Kegiatan TP. PKK Desa Karangtanjung
                    </h2>
                    <!-- Deskripsi -->
                    <p class="text-xs sm:text-sm text-[#475569] leading-relaxed max-w-3xl mt-1.5">
                        Informasi jadwal kegiatan, pertemuan kader, pelayanan Posyandu, dan program pemberdayaan masyarakat Desa Karangtanjung.
                    </p>
                </div>

                <!-- Tombol Lihat Semua Agenda -->
                <div class="flex-shrink-0">
                    <a href="{{ route('informasi.agenda.index') }}"
                       class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold text-[#075B3C] bg-[#E8F7EF] hover:bg-[#075B3C] hover:text-white border border-[#075B3C]/20 transition-all duration-200 shadow-sm">
                        <span>Lihat Semua Agenda</span>
                        <span class="text-base leading-none">&rarr;</span>
                    </a>
                </div>
            </div>

            <!-- Grid Kartu Agenda: 3 Kolom Desktop, 2 Tablet, 1 Mobile -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($agendaList as $agenda)
                    <div class="bg-white rounded-xl border border-[#E2E8F0] p-5 shadow-sm hover:shadow-md hover:border-[#116B46]/50 hover:-translate-y-1 transition-all duration-200 flex flex-col justify-between group">
                        
                        <div>
                            <!-- Bagian Atas: Tanggal & Informasi Singkat -->
                            <div class="flex items-start gap-4 mb-4">
                                <!-- Kotak Tanggal di Sebelah Kiri -->
                                <div class="w-16 h-16 rounded-xl bg-[#E8F7EF] border border-[#075B3C]/20 flex flex-col items-center justify-center flex-shrink-0 text-center shadow-xs">
                                    <span class="text-2xl font-extrabold text-[#075B3C] leading-none">{{ $agenda['tanggal'] }}</span>
                                    <span class="text-[11px] font-bold text-[#075B3C] uppercase tracking-wider mt-1">{{ $agenda['bulan'] }}</span>
                                </div>

                                <!-- Detail Kategori, Status & Nama Kegiatan -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-wrap items-center gap-1.5 mb-1.5">
                                        <!-- Badge Kategori -->
                                        <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider border {{ $agenda['badge_color'] }}">
                                            {{ $agenda['kategori'] }}
                                        </span>
                                        <!-- Badge Status -->
                                        <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-medium bg-gray-100 text-gray-600 border border-gray-200">
                                            {{ $agenda['status'] }}
                                        </span>
                                    </div>

                                    <!-- Nama Kegiatan -->
                                    <h3 class="text-base font-bold text-[#1F2937] group-hover:text-[#075B3C] transition-colors leading-snug line-clamp-2">
                                        <a href="{{ route('informasi.agenda.show', $agenda['id']) }}">
                                            {{ $agenda['judul'] }}
                                        </a>
                                    </h3>
                                </div>
                            </div>

                            <!-- Bagian Waktu & Lokasi -->
                            <div class="space-y-2 py-3 border-t border-gray-100 text-xs text-[#475569]">
                                <div class="flex items-center gap-2.5">
                                    <i class="fa-regular fa-clock text-[#116B46] w-4 text-center"></i>
                                    <span>{{ $agenda['waktu'] }}</span>
                                </div>
                                <div class="flex items-center gap-2.5">
                                    <i class="fa-solid fa-location-dot text-[#116B46] w-4 text-center"></i>
                                    <span class="truncate">{{ $agenda['lokasi'] }}</span>
                                </div>
                            </div>

                            <!-- Deskripsi Singkat Kegiatan -->
                            <p class="text-xs text-[#64748B] leading-relaxed line-clamp-2 mt-1 mb-2">
                                {{ $agenda['deskripsi'] }}
                            </p>

                            <!-- Keterangan Pelaksana Terhubung ke Pokja / Profil -->
                            <div class="text-[11px] text-gray-500 flex items-center justify-between pb-2">
                                <span>Pelaksana: <strong class="text-gray-700">{{ $agenda['pokja_label'] }}</strong></span>
                                <a href="{{ route('pokja') }}" class="text-[#075B3C] font-semibold hover:underline">
                                    Detail Pokja &rarr;
                                </a>
                            </div>
                        </div>

                        <!-- Bagian Bawah: Link Detail Agenda -->
                        <div class="pt-3 border-t border-gray-100 flex items-center justify-between">
                            <a href="{{ route('informasi.agenda.show', $agenda['id']) }}"
                               class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-[#075B3C] group-hover:text-[#116B46] transition-colors">
                                <span>Detail Agenda</span>
                                <span class="text-base leading-none">&rarr;</span>
                            </a>

                            <div class="w-8 h-8 rounded-full {{ $agenda['icon_bg'] }} {{ $agenda['icon_color'] }} flex items-center justify-center text-xs">
                                <i class="{{ $agenda['icon'] }}"></i>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- ================= 5. SECTION PENGUMUMAN & INFORMASI PENTING ================= -->
    <section class="py-14 bg-[#F3FBF6] border-t border-[#E2E8F0]">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header Section Pengumuman -->
            <div class="mb-8">
                <!-- Sub-judul Kecil -->
                <span class="block text-xs sm:text-sm font-black tracking-widest text-[#075B3C] uppercase mb-1">
                    INFORMASI TERKINI
                </span>
                <!-- Heading Utama -->
                <h2 class="text-xl sm:text-2xl lg:text-[26px] font-extrabold text-[#1F2937] tracking-tight">
                    Pengumuman &amp; Informasi Penting
                </h2>
                <!-- Deskripsi -->
                <p class="text-xs sm:text-sm text-[#475569] leading-relaxed max-w-3xl mt-1.5">
                    Informasi dan pemberitahuan terbaru seputar kegiatan, program kerja, pelayanan masyarakat, dan aktivitas TP. PKK Desa Karangtanjung.
                </p>
            </div>

            <!-- Layout Dua Kolom Desktop: 65% Daftar Pengumuman & 35% Panel Informasi Penting -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                <!-- KOLOM KIRI (65%): Daftar Pengumuman Card Horizontal -->
                <div class="lg:col-span-8 space-y-4">
                    @foreach($pengumumanList as $p)
                        <article class="bg-white rounded-xl border border-[#E2E8F0] p-5 shadow-sm hover:shadow-md hover:border-[#116B46]/50 transition-all duration-200 flex flex-col sm:flex-row gap-4 items-start group">
                            
                            <!-- Ikon Pengumuman -->
                            <div class="w-12 h-12 rounded-xl {{ $p['icon_bg'] }} {{ $p['icon_color'] }} flex items-center justify-center text-lg flex-shrink-0 shadow-xs">
                                <i class="{{ $p['icon'] }}"></i>
                            </div>

                            <!-- Detail Konten Pengumuman -->
                            <div class="flex-1 min-w-0">
                                <!-- Meta: Badge Kategori & Tanggal Publikasi -->
                                <div class="flex flex-wrap items-center gap-2 mb-1.5">
                                    <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider border {{ $p['badge_color'] }}">
                                        {{ $p['kategori'] }}
                                    </span>
                                    <span class="text-xs text-gray-500 flex items-center gap-1.5">
                                        <i class="fa-regular fa-calendar-days text-[#116B46] text-xs"></i>
                                        {{ $p['tanggal'] }}
                                    </span>
                                </div>

                                <!-- Judul Pengumuman -->
                                <h3 class="text-base sm:text-[17px] font-bold text-[#1F2937] group-hover:text-[#075B3C] transition-colors leading-snug mb-1.5">
                                    <a href="{{ route('informasi.pengumuman.show', $p['id']) }}">
                                        {{ $p['judul'] }}
                                    </a>
                                </h3>

                                <!-- Deskripsi Singkat -->
                                <p class="text-xs sm:text-[13px] text-[#475569] leading-relaxed line-clamp-2 mb-3">
                                    {{ $p['deskripsi'] }}
                                </p>

                                <div class="flex items-center justify-between pt-1">
                                    <!-- Link Baca Selengkapnya -->
                                    <a href="{{ route('informasi.pengumuman.show', $p['id']) }}"
                                       class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-[#075B3C] group-hover:text-[#116B46] transition-colors">
                                        <span>Baca selengkapnya</span>
                                        <span class="text-base leading-none">&rarr;</span>
                                    </a>

                                    <span class="text-[11px] text-gray-400">
                                        {{ $p['penulis'] }}
                                    </span>
                                </div>
                            </div>

                        </article>
                    @endforeach

                    <!-- Tombol Lihat Semua Pengumuman -->
                    <div class="pt-3">
                        <a href="{{ route('informasi.pengumuman.index') }}"
                           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold bg-[#075B3C] text-white hover:bg-[#116B46] transition-all shadow-sm">
                            <span>Lihat Semua Pengumuman</span>
                            <span class="text-base leading-none">&rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- KOLOM KANAN (35%): Panel Informasi Penting Terhubung ke Halaman Lain -->
                <div class="lg:col-span-4">
                    <div class="bg-white rounded-2xl border border-[#E2E8F0] shadow-sm p-6 sticky top-24">
                        
                        <!-- Header Panel Informasi Penting dengan Ikon Megaphone -->
                        <div class="flex items-center gap-2.5 mb-2">
                            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-[#075B3C] flex items-center justify-center text-sm">
                                <i class="fa-solid fa-bullhorn"></i>
                            </div>
                            <h3 class="text-base sm:text-lg font-bold text-[#1F2937]">
                                Informasi Penting
                            </h3>
                        </div>

                        <!-- Deskripsi Panel -->
                        <p class="text-xs text-[#64748B] leading-relaxed mb-4 pb-3 border-b border-gray-100">
                            Beberapa informasi yang perlu diperhatikan oleh kader dan masyarakat.
                        </p>

                        <!-- Daftar 4 Informasi Ringkas dengan Link ke Pokja, Profil & Beranda -->
                        <div class="space-y-3.5">
                            @foreach($infoPenting as $info)
                                <div class="flex items-start gap-3 pb-3.5 border-b border-gray-100 last:border-b-0 last:pb-0">
                                    <!-- Ikon Kecil Berwarna Hijau -->
                                    <div class="w-7 h-7 rounded-lg bg-emerald-50 text-[#075B3C] flex items-center justify-center text-xs flex-shrink-0 mt-0.5">
                                        <i class="{{ $info['icon'] }}"></i>
                                    </div>
                                    <!-- Judul, Deskripsi & Link Penjelas -->
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-xs sm:text-sm font-bold text-[#1F2937] leading-snug">
                                            {{ $info['judul'] }}
                                        </h4>
                                        <p class="text-[11px] sm:text-xs text-[#64748B] leading-relaxed mt-0.5 mb-1">
                                            {{ $info['deskripsi'] }}
                                        </p>
                                        <a href="{{ route($info['route']) }}" class="inline-flex items-center gap-1 text-[11px] font-bold text-[#075B3C] hover:underline">
                                            <span>{{ $info['link_label'] }}</span>
                                            <i class="fa-solid fa-angle-right text-[9px]"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Kotak Informasi Profil & Sekretariat Desa -->
                        <div class="mt-6 pt-4 border-t border-gray-100 bg-[#E8F7EF]/60 rounded-xl p-3.5 border border-[#075B3C]/15">
                            <div class="flex items-start gap-2.5">
                                <i class="fa-solid fa-circle-info text-[#075B3C] text-sm mt-0.5"></i>
                                <div>
                                    <span class="block text-xs font-bold text-[#075B3C]">Mengenal TP. PKK Desa</span>
                                    <p class="text-[11px] text-[#475569] leading-relaxed mt-0.5 mb-2">
                                        Pelajari visi-misi, susunan kepengurusan periode aktif, dan 10 program pokok di halaman profil.
                                    </p>
                                    <a href="{{ route('profil') }}" class="inline-flex items-center gap-1 text-xs font-bold text-[#075B3C] hover:underline">
                                        <span>Buka Profil TP. PKK &rarr;</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- Script JavaScript untuk Filter Interaktif Berita -->
    <script>
        // Filter Berdasarkan Kategori Pill
        function filterByKategori(kategori) {
            document.getElementById('kategori-input').value = kategori;
            document.getElementById('filter-form').submit();
        }

        // Auto submit ketika dropdown bulan atau tahun berubah
        document.getElementById('bulan-select').addEventListener('change', function() {
            document.getElementById('filter-form').submit();
        });

        document.getElementById('tahun-select').addEventListener('change', function() {
            document.getElementById('filter-form').submit();
        });
    </script>

@endsection
