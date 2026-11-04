@extends('layouts.app')

@section('title', 'Pusat Informasi & Dokumentasi Kegiatan — TP. PKK Desa Karangtanjung')

@section('content')

    <!-- ================= 1. HERO SECTION & DESKRIPSI INFORMASI ================= -->
    <section class="bg-[#E8F7EF] pt-8 pb-12 sm:pt-10 sm:pb-14 border-b border-[#D1D5DB]/40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Judul Utama H1 -->
            <h1 class="text-2xl sm:text-[28px] lg:text-[32px] font-extrabold text-[#075B3C] tracking-tight leading-snug mb-3 text-left">
                Pusat Informasi &amp; Dokumentasi Kegiatan TP. PKK Desa Karangtanjung
            </h1>

            <!-- Deskripsi Hero -->
            <p class="text-sm sm:text-[15px] text-[#475569] leading-relaxed max-w-5xl mb-6 text-left">
                Pusat rujukan informasi resmi seputar berita kegiatan pemberdayaan warga, agenda posyandu &amp; desa serta dokumen administrasi dasawisma di lingkungan Desa Karangtanjung, Kecamatan Candi, Kabupaten Sidoarjo.
            </p>

            <!-- ================= PANEL PENCARIAN & FILTER ================= -->
            <div class="bg-white rounded-2xl p-4 sm:p-5 shadow-sm border border-[#D1D5DB]/60">
                <form id="filter-form" action="{{ route('informasi.index') }}" method="GET" class="space-y-4">

                    <!-- Baris Atas: Input Pencarian, Dropdown Bulan & Tahun -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-12 gap-3 sm:gap-4 items-center">

                        <!-- Input Pencarian (Cari berita, agenda, regulasi...) -->
                        <div class="sm:col-span-2 md:col-span-8 relative">
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
                        <div class="sm:col-span-1 md:col-span-2 relative">
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
                        <div class="sm:col-span-1 md:col-span-2 relative">
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

                    <!-- Baris Bawah: Filter Kategori (Dropdown di Mobile, Tombol Pill di Tablet & Desktop) -->
                    <div class="pt-1">
                        <input type="hidden" name="kategori" id="kategori-input" value="{{ request('kategori', 'Semua') }}">

                        <!-- Tampilan Mobile (< 640px): Dropdown Select -->
                        <div class="block sm:hidden">
                            <label for="kategori-select-mobile" class="block text-xs font-semibold text-gray-600 mb-1.5">
                                Kategori Informasi:
                            </label>
                            <div class="relative">
                                <select id="kategori-select-mobile"
                                        onchange="filterByKategori(this.value)"
                                        class="w-full appearance-none bg-white border border-gray-300 text-gray-800 text-sm font-medium rounded-xl py-2.5 px-3.5 pr-8 focus:outline-none focus:ring-2 focus:ring-[#116B46] focus:border-transparent cursor-pointer transition-all">
                                    @foreach($kategoriList as $kat)
                                        <option value="{{ $kat }}" {{ request('kategori', 'Semua') === $kat ? 'selected' : '' }}>
                                            {{ $kat === 'Semua' ? 'Semua Kategori' : $kat }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                    <i class="fa-solid fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Tampilan Tablet & Desktop (>= 640px): Tombol Pill Horizontal -->
                        <div class="hidden sm:flex items-center gap-2 sm:gap-2.5 overflow-x-auto pb-1 scrollbar-thin scroll-smooth -mx-1 px-1">
                            @foreach($kategoriList as $kat)
                                @php
                                    $isActive = (request('kategori', 'Semua') === $kat);
                                @endphp
                                <button type="button"
                                        onclick="filterByKategori('{{ $kat }}')"
                                        class="category-pill whitespace-nowrap flex-shrink-0 px-4 sm:px-5 py-1.5 rounded-full text-xs sm:text-sm font-semibold transition-all duration-200 cursor-pointer
                                        {{ $isActive 
                                            ? 'bg-[#075B3C] text-white shadow-sm border border-[#075B3C]' 
                                            : 'bg-white text-[#075B3C] border border-[#075B3C] hover:bg-emerald-50' }}">
                                    {{ $kat }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </section>

    <!-- ================= 2. DAFTAR BERITA DAN KEGIATAN ================= -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header Section Berita -->
            <div class="mb-8">
                <span class="block text-xs sm:text-sm font-black tracking-widest text-[#075B3C] uppercase mb-1">
                    KABAR &amp; DOKUMENTASI
                </span>
                <h2 class="text-xl sm:text-2xl lg:text-[26px] font-extrabold text-[#1F2937] tracking-tight">
                    Kegiatan PKK
                </h2>
                <p class="text-xs sm:text-sm text-[#475569] leading-relaxed max-w-3xl mt-1.5">
                    Kumpulan berita, liputan acara, dan dokumentasi program pemberdayaan TP. PKK Desa Karangtanjung.
                </p>
            </div>

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
                                    <div class="pt-1">
                                        <a href="{{ route('informasi.show', $b['id']) }}"
                                           class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-xs font-semibold text-[#075B3C] bg-[#E8F7EF] border border-[#075B3C]/20 hover:bg-[#075B3C] hover:text-white hover:border-transparent active:scale-95 transition-all duration-150 shadow-2xs select-none">
                                            <span>Baca selengkapnya</span>
                                            <span class="text-xs leading-none">&rarr;</span>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- ================= 3. PAGINATION ================= -->
                <div class="mt-12 flex justify-center overflow-x-auto pb-2 -mx-2 px-2">
                    <nav class="flex items-center gap-1 sm:gap-2 flex-nowrap" aria-label="Pagination Berita">

                        {{-- Tombol Sebelumnya --}}
                        @if ($beritaPaginated->onFirstPage())
                            <span class="px-2.5 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-medium text-gray-400 bg-white border border-gray-200 cursor-not-allowed whitespace-nowrap">
                                &larr; Prev
                            </span>
                        @else
                            <a href="{{ $beritaPaginated->previousPageUrl() }}"
                               class="px-2.5 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-medium text-gray-700 bg-white border border-[#D1D5DB] hover:bg-emerald-50 hover:text-[#075B3C] hover:border-[#075B3C] transition-colors whitespace-nowrap">
                                &larr; Prev
                            </a>
                        @endif

                        {{-- Nomor Halaman (1, 2, 3...) --}}
                        @for ($page = 1; $page <= $beritaPaginated->lastPage(); $page++)
                            @if ($page == $beritaPaginated->currentPage())
                                <span class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg text-xs sm:text-sm font-bold flex items-center justify-center bg-[#075B3C] text-white shadow-sm border border-[#075B3C] flex-shrink-0">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $beritaPaginated->url($page) }}"
                                   class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg text-xs sm:text-sm font-medium flex items-center justify-center text-gray-700 bg-white border border-[#D1D5DB] hover:bg-emerald-50 hover:text-[#075B3C] hover:border-[#075B3C] transition-colors flex-shrink-0">
                                    {{ $page }}
                                </a>
                            @endif
                        @endfor

                        {{-- Tombol Berikutnya --}}
                        @if ($beritaPaginated->hasMorePages())
                            <a href="{{ $beritaPaginated->nextPageUrl() }}"
                               class="px-2.5 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-medium text-gray-700 bg-white border border-[#D1D5DB] hover:bg-emerald-50 hover:text-[#075B3C] hover:border-[#075B3C] transition-colors whitespace-nowrap">
                                Next &rarr;
                            </a>
                        @else
                            <span class="px-2.5 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-medium text-gray-400 bg-white border border-gray-200 cursor-not-allowed whitespace-nowrap">
                                Next &rarr;
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header Section Agenda -->
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
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
                       class="inline-flex items-center justify-center w-full sm:w-auto gap-2 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold text-[#075B3C] bg-[#E8F7EF] hover:bg-[#075B3C] hover:text-white border border-[#075B3C]/20 transition-all duration-200 shadow-sm">
                        <span>Lihat Semua Agenda</span>
                        <span class="text-base leading-none">&rarr;</span>
                    </a>
                </div>
            </div>

            <!-- Grid Kartu Agenda: 3 Kolom Desktop, 2 Tablet, 1 Mobile -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($agendaList as $agenda)
                    <div class="bg-[#14633F] rounded-xl border border-[#14633F] p-5 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-200 flex flex-col justify-between group">
                        
                        <div>
                            <!-- Bagian Atas: Tanggal & Informasi Singkat -->
                            <div class="flex items-start gap-4 mb-4">
                                <!-- Kotak Tanggal di Sebelah Kiri -->
                                <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-xl bg-white/10 border border-white/20 flex flex-col items-center justify-center flex-shrink-0 text-center shadow-xs">
                                    <span class="text-xl sm:text-2xl font-extrabold text-white leading-none">{{ $agenda['tanggal'] }}</span>
                                    <span class="text-[10px] sm:text-[11px] font-bold text-emerald-200 uppercase tracking-wider mt-1">{{ $agenda['bulan'] }}</span>
                                </div>

                                <!-- Detail Kategori, Status & Nama Kegiatan -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-wrap items-center gap-1.5 mb-1.5">
                                        <!-- Badge Kategori -->
                                        <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-white/20 text-white border border-white/30">
                                            {{ $agenda['kategori'] }}
                                        </span>
                                    </div>

                                    <!-- Nama Kegiatan -->
                                    <h3 class="text-base font-bold text-white hover:text-emerald-200 transition-colors leading-snug line-clamp-2">
                                        <a href="{{ route('informasi.agenda.show', $agenda['id']) }}">
                                            {{ $agenda['judul'] }}
                                        </a>
                                    </h3>
                                </div>
                            </div>

                            <!-- Bagian Waktu & Lokasi -->
                            <div class="space-y-2 py-3 border-t border-white/15 text-xs text-emerald-100">
                                <div class="flex items-center gap-2.5">
                                    <i class="fa-regular fa-clock text-emerald-300 w-4 text-center"></i>
                                    <span class="font-medium">{{ $agenda['waktu'] }}</span>
                                </div>
                                <div class="flex items-center gap-2.5">
                                    <i class="fa-solid fa-location-dot text-emerald-300 w-4 text-center"></i>
                                    <span class="truncate font-medium">{{ $agenda['lokasi'] }}</span>
                                </div>
                            </div>
                            
                            <!-- Keterangan Pelaksana Terhubung ke Pokja / Profil -->
                            <div class="text-[11px] text-emerald-200 flex items-center justify-between pb-2">
                                <span>Pelaksana: <strong class="text-white">{{ $agenda['pokja_label'] }}</strong></span>
                            </div>
                        </div>

                        <!-- Bagian Bawah: Link Detail Agenda -->
                        <div class="pt-3 border-t border-white/15">
                            <a href="{{ route('informasi.agenda.show', $agenda['id']) }}"
                               class="inline-block text-center w-full px-4 py-2 rounded-lg text-xs font-bold text-[#14633F] bg-white hover:bg-emerald-50 active:scale-95 active:bg-emerald-100 transition-all duration-150 shadow-xs select-none">
                                Detail Agenda
                            </a>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- Script JavaScript untuk Filter Interaktif Berita -->
    <script>
        // Filter Berdasarkan Kategori Pill Berita
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
