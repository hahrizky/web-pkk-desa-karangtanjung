@extends('layouts.app')

@section('title', 'Pusat Informasi & Dokumentasi Kegiatan — TP. PKK Desa Karangtanjung')

@section('content')

<!-- ================= 1. HERO SECTION & DESKRIPSI INFORMASI ================= -->
<section class="bg-[#E8F7EF] pt-8 pb-12 sm:pt-10 sm:pb-14 border-b border-emerald-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Judul Utama H1 -->
        <h1 class="text-2xl sm:text-[28px] lg:text-[32px] font-extrabold text-[#075B3C] tracking-tight leading-snug mb-3 text-left">
            Pusat Informasi &amp; Dokumentasi Kegiatan TP. PKK Desa Karangtanjung
        </h1>

        <!-- Deskripsi Hero -->
        <p class="text-sm sm:text-[15px] text-gray-600 leading-relaxed max-w-5xl mb-6 text-left">
            Pusat rujukan informasi resmi seputar berita kegiatan pemberdayaan warga, agenda posyandu &amp; desa serta dokumen administrasi dasawisma di lingkungan Desa Karangtanjung, Kecamatan Candi, Kabupaten Sidoarjo.
        </p>

        <!-- ================= PANEL PENCARIAN & FILTER ================= -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 shadow-sm border border-emerald-100/80">
            <form id="filter-form" action="{{ route('informasi.index') }}#berita" method="GET" class="space-y-4">

                <!-- Baris Atas: Input Pencarian, Dropdown Bulan & Tahun -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-12 gap-3 sm:gap-4 items-center">

                    <!-- Input Pencarian (Cari berita, agenda, regulasi...) -->
                    <div class="sm:col-span-2 md:col-span-8 relative flex items-center">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <i class="fa-solid fa-magnifying-glass text-sm"></i>
                        </div>
                        <input type="text"
                            id="search-input"
                            name="q"
                            value="{{ request('q') }}"
                            placeholder="Cari berita..."
                            class="w-full pl-10 pr-28 py-2.5 rounded-xl border border-gray-200 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#075B3C] focus:border-transparent transition-all bg-[#F9FAFB]/60">

                        <!-- Tombol Cari & Tombol Reset (x) -->
                        <div class="absolute right-1.5 flex items-center gap-1">
                            <button type="button"
                                id="clear-search-btn"
                                title="Hapus pencarian"
                                class="{{ request('q') ? '' : 'hidden' }} p-1.5 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition-colors text-xs flex items-center justify-center cursor-pointer">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                            <button type="submit"
                                class="px-3.5 py-1.5 bg-[#075B3C] hover:bg-[#064e33] active:scale-95 text-white text-xs font-semibold rounded-lg transition-all shadow-xs flex items-center gap-1.5 cursor-pointer">
                                <span>Cari</span>
                            </button>
                        </div>
                    </div>

                    <!-- Filter Dropdown Bulan -->
                    <div class="sm:col-span-1 md:col-span-2 relative">
                        <select name="bulan"
                            id="bulan-select"
                            class="w-full appearance-none bg-white border border-gray-200 text-gray-700 text-sm rounded-xl py-2.5 px-3.5 pr-8 focus:outline-none focus:ring-2 focus:ring-[#075B3C] focus:border-transparent cursor-pointer transition-all">
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
                            class="w-full appearance-none bg-white border border-gray-200 text-gray-700 text-sm rounded-xl py-2.5 px-3.5 pr-8 focus:outline-none focus:ring-2 focus:ring-[#075B3C] focus:border-transparent cursor-pointer transition-all">
                            <option value="">Semua tahun</option>
                            @foreach($tahunList as $thn)
                            <option value="{{ $thn }}" {{ request('tahun') == $thn ? 'selected' : '' }}>
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
                                class="w-full appearance-none bg-white border border-gray-200 text-gray-800 text-sm font-medium rounded-xl py-2.5 px-3.5 pr-8 focus:outline-none focus:ring-2 focus:ring-[#075B3C] focus:border-transparent cursor-pointer transition-all">
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
                    <div class="hidden sm:flex items-center gap-2 sm:gap-2.5 overflow-x-auto pb-1 scroll-smooth -mx-1 px-1">
                        @foreach($kategoriList as $kat)
                        @php
                        $isActive = (request('kategori', 'Semua') === $kat);
                        @endphp
                        <button type="button"
                            onclick="filterByKategori('{{ $kat }}')"
                            class="whitespace-nowrap flex-shrink-0 px-4 sm:px-5 py-1.5 rounded-full text-xs sm:text-sm font-semibold transition-all duration-200 cursor-pointer
                                        {{ $isActive 
                                            ? 'bg-[#075B3C] text-white shadow-sm border border-[#075B3C]' 
                                            : 'bg-white text-gray-700 border border-gray-200 hover:bg-emerald-50 hover:text-[#075B3C] hover:border-emerald-300' }}">
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
<section id="berita" class="py-12 bg-white scroll-mt-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header Section Berita -->
        <div class="mb-8">
            <span class="block text-xs sm:text-sm font-black tracking-widest text-[#075B3C] uppercase mb-1">
                KABAR &amp; DOKUMENTASI
            </span>
            <h2 class="text-xl sm:text-2xl lg:text-[26px] font-extrabold text-gray-900 tracking-tight">
                Kegiatan PKK
            </h2>
            <p class="text-xs sm:text-sm text-gray-600 leading-relaxed max-w-3xl mt-1.5">
                Kumpulan berita, liputan acara, dan dokumentasi program pemberdayaan TP. PKK Desa Karangtanjung.
            </p>
        </div>

        <div id="berita-container" class="transition-opacity duration-200">
            @if($beritaPaginated->count() > 0)
            <!-- Grid Berita 2 Kolom (Desktop) & 1 Kolom (Mobile) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-7">
                @foreach($beritaPaginated as $b)
                <article class="bg-white rounded-2xl border border-gray-200 overflow-hidden hover:shadow-lg hover:border-emerald-300 transition-all duration-300 flex flex-col sm:flex-row group h-full">

                    <!-- Bagian Kiri: Gambar Dokumentasi (Lebar ~40%) -->
                    <div class="sm:w-[40%] w-full h-48 sm:h-auto relative overflow-hidden bg-gray-100 flex-shrink-0">
                        @if (!empty($b['gambar']))
                        <img src="{{ asset('images/' . $b['gambar']) }}"
                            alt="{{ $b['judul'] }}"
                            loading="lazy"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                        <div class="w-full h-full flex items-center justify-center text-emerald-700"><i class="fa-regular fa-image text-3xl"></i></div>
                        @endif
                    </div>

                    <!-- Bagian Kanan: Konten Informasi Berita (Lebar ~60%) -->
                    <div class="sm:w-[60%] w-full p-4 sm:p-5 flex flex-col justify-between">
                        <div>
                            <!-- Header Card: Badge Kategori & Tanggal -->
                            <div class="flex items-center gap-2.5 mb-2.5">
                                <span class="inline-block px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-[#075B3C] text-white border border-emerald-200">
                                    {{ $b['kategori'] }}
                                </span>
                                <span class="text-xs text-gray-500 font-normal">
                                    {{ $b['tanggal'] }}
                                </span>
                            </div>

                            <!-- Judul Berita (Maksimal 2-3 baris) -->
                            <h2 class="text-base sm:text-[17px] font-bold text-gray-900 leading-snug mb-2 group-hover:text-[#075B3C] transition-colors line-clamp-2">
                                <a href="{{ route('informasi.show', $b['id']) }}">
                                    {{ $b['judul'] }}
                                </a>
                            </h2>

                            <!-- Deskripsi Cuplikan Berita -->
                            <p class="text-xs sm:text-[13px] text-gray-600 leading-relaxed line-clamp-3 mb-4">
                                {{ $b['deskripsi'] }}
                            </p>
                        </div>

                        <!-- Footer Card: Tombol Baca Selengkapnya -->
                        <div class="pt-2">
                            <a href="{{ route('informasi.show', $b['id']) }}"
                                class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-xs font-semibold text-white bg-[#075B3C] border border-[#075B3C] hover:bg-[#064B32] hover:border-[#064B32] active:scale-95 transition-all duration-150 shadow-sm select-none">
                                <span>Baca selengkapnya</span>
                                <span class="text-xs leading-none">&rarr;</span>
                            </a>
                        </div>

                    </div>
                </article>
                @endforeach
            </div>

            @if ($beritaPaginated->hasPages())
            <!-- ================= 3. PAGINATION (Tampil jika berita lebih dari 4) ================= -->
            <div class="mt-12 flex justify-center overflow-x-auto pb-2 -mx-2 px-2">
                <nav class="flex items-center gap-1 sm:gap-2 flex-nowrap" aria-label="Pagination Berita">

                    {{-- Tombol Sebelumnya --}}
                    @if ($beritaPaginated->onFirstPage())
                    <span class="px-2.5 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-bold text-gray-400 bg-white border border-gray-200 cursor-not-allowed whitespace-nowrap">
                        &larr;
                    </span>
                    @else
                    <a href="{{ $beritaPaginated->previousPageUrl() }}"
                        class="px-2.5 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-bold text-gray-700 bg-white border border-gray-200 hover:bg-emerald-50 hover:text-[#075B3C] hover:border-[#075B3C] transition-colors whitespace-nowrap">
                        &larr;
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
                            class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg text-xs sm:text-sm font-medium flex items-center justify-center text-gray-700 bg-white border border-gray-200 hover:bg-emerald-50 hover:text-[#075B3C] hover:border-[#075B3C] transition-colors flex-shrink-0">
                            {{ $page }}
                        </a>
                        @endif
                        @endfor

                        {{-- Tombol Berikutnya --}}
                        @if ($beritaPaginated->hasMorePages())
                        <a href="{{ $beritaPaginated->nextPageUrl() }}"
                            class="px-2.5 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-bold text-gray-700 bg-white border border-gray-200 hover:bg-emerald-50 hover:text-[#075B3C] hover:border-[#075B3C] transition-colors whitespace-nowrap">
                            &rarr;
                        </a>
                        @else
                        <span class="px-2.5 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-bold text-gray-400 bg-white border border-gray-200 cursor-not-allowed whitespace-nowrap">
                            &rarr;
                        </span>
                        @endif

                </nav>
            </div>
            @endif

            @else
            <!-- Empty State ketika Berita Kegiatan Kosong -->
            <div class="bg-white border-2 border-emerald-200 rounded-2xl p-8 sm:p-12 text-center max-w-full mx-auto my-4 shadow-sm">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#075B3C] text-white border border-[#075B3C] mb-3">
                    Informasi Belum Tersedia
                </span>
                <p class="text-sm sm:text-base text-gray-700 leading-relaxed max-w-md mx-auto">
                    Kabar terbaru seputar kegiatan, agenda, dan program kerja TP. PKK Desa Karangtanjung akan segera dipublikasikan di sini.
                </p>
            </div>
            @endif
        </div>

    </div>
</section>

<!-- ================= 4. SECTION AGENDA & JADWAL KEGIATAN PKK ================= -->
<section id="agenda" class="scroll-mt-24 py-14 sm:py-16 bg-[#F4F9F6] border-t border-emerald-100/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header Section Agenda -->
        <div class="mb-8">
            <!-- Sub-judul Kecil -->
            <span class="block text-xs sm:text-sm font-black tracking-widest text-[#075B3C] uppercase mb-1">
                AGENDA KEGIATAN
            </span>
            <!-- Heading Utama -->
            <h2 class="text-xl sm:text-2xl lg:text-[26px] font-extrabold text-gray-900 tracking-tight">
                Agenda &amp; Jadwal Kegiatan TP. PKK Desa Karangtanjung
            </h2>
            <!-- Deskripsi -->
            <p class="text-xs sm:text-sm text-gray-600 leading-relaxed max-w-3xl mt-1.5">
                Informasi jadwal kegiatan, pertemuan kader, pelayanan Posyandu, dan program pemberdayaan masyarakat Desa Karangtanjung.
            </p>
        </div>

        <div id="agenda-container">
            @if(count($agendaList) > 0)
            <!-- Grid Kartu Agenda: 3 Kolom Desktop, 2 Tablet, 1 Mobile -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($agendaList as $agenda)
                <div class="bg-[#075B3C] rounded-2xl border border-[#075B3C] p-5 sm:p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group">

                    <div>
                        <!-- Bagian Atas: Tanggal & Informasi Singkat -->
                        <div class="flex items-start gap-4 mb-4">
                            <!-- Kotak Tanggal di Sebelah Kiri -->
                            <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-xl bg-white/15 border border-white/20 flex flex-col items-center justify-center flex-shrink-0 text-center shadow-xs">
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
                            class="inline-block text-center w-full px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold text-[#075B3C] bg-white hover:bg-emerald-50 active:scale-95 active:bg-emerald-100 transition-all duration-150 shadow-xs select-none">
                            Detail Agenda
                        </a>
                    </div>

                </div>
                @endforeach
            </div>

            @if ($agendaPaginated->hasPages())
            <!-- Pagination Agenda (Tampil jika agenda lebih dari 6) -->
            <div class="mt-12 flex justify-center overflow-x-auto pb-2 -mx-2 px-2">
                <nav class="flex items-center gap-1 sm:gap-2 flex-nowrap" aria-label="Pagination Agenda">

                    {{-- Tombol Sebelumnya --}}
                    @if ($agendaPaginated->onFirstPage())
                    <span class="px-2.5 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-bold text-gray-400 bg-white border border-gray-200 cursor-not-allowed whitespace-nowrap">
                        &larr;
                    </span>
                    @else
                    <a href="{{ $agendaPaginated->previousPageUrl() }}"
                        class="px-2.5 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-bold text-gray-700 bg-white border border-gray-200 hover:bg-emerald-50 hover:text-[#075B3C] hover:border-[#075B3C] transition-colors whitespace-nowrap">
                        &larr;
                    </a>
                    @endif

                    {{-- Nomor Halaman (1, 2, 3...) --}}
                    @for ($page = 1; $page <= $agendaPaginated->lastPage(); $page++)
                        @if ($page == $agendaPaginated->currentPage())
                        <span class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg text-xs sm:text-sm font-bold flex items-center justify-center bg-[#075B3C] text-white shadow-sm border border-[#075B3C] flex-shrink-0">
                            {{ $page }}
                        </span>
                        @else
                        <a href="{{ $agendaPaginated->url($page) }}"
                            class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg text-xs sm:text-sm font-medium flex items-center justify-center text-gray-700 bg-white border border-gray-200 hover:bg-emerald-50 hover:text-[#075B3C] hover:border-[#075B3C] transition-colors flex-shrink-0">
                            {{ $page }}
                        </a>
                        @endif
                    @endfor

                    {{-- Tombol Berikutnya --}}
                    @if ($agendaPaginated->hasMorePages())
                    <a href="{{ $agendaPaginated->nextPageUrl() }}"
                        class="px-2.5 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-bold text-gray-700 bg-white border border-gray-200 hover:bg-emerald-50 hover:text-[#075B3C] hover:border-[#075B3C] transition-colors whitespace-nowrap">
                        &rarr;
                    </a>
                    @else
                    <span class="px-2.5 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-bold text-gray-400 bg-white border border-gray-200 cursor-not-allowed whitespace-nowrap">
                        &rarr;
                    </span>
                    @endif

                </nav>
            </div>
            @endif

            @else
            <!-- Empty State jika belum ada agenda -->
            <div class="bg-white border-2 border-emerald-200 rounded-2xl p-8 sm:p-12 text-center max-w-full mx-auto my-2 shadow-sm">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#075B3C] text-white border border-[#075B3C] mb-3">
                    Agenda Belum Tersedia
                </span>
                <p class="text-sm sm:text-base text-gray-700 leading-relaxed max-w-md mx-auto">
                    Jadwal kegiatan berkala, pertemuan kader, dan pelayanan Posyandu akan diumumkan melalui portal ini jika sudah dijadwalkan.
                </p>
            </div>
            @endif
        </div>

    </div>
</section>

<!-- Script JavaScript untuk Filter Interaktif Berita -->
<script>
    // Toggle tombol 'x' pada input pencarian saat mengetik maupun saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-input');
        const clearSearchBtn = document.getElementById('clear-search-btn');

        if (searchInput && clearSearchBtn) {
            function toggleClearBtn() {
                if (searchInput.value.trim().length > 0) {
                    clearSearchBtn.classList.remove('hidden');
                } else {
                    clearSearchBtn.classList.add('hidden');
                }
            }

            // Jalankan saat mengetik / mengubah teks
            searchInput.addEventListener('input', toggleClearBtn);

            // Tindakan saat tombol 'x' diklik
            clearSearchBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const hadQueryParam = new URLSearchParams(window.location.search).has('q') && new URLSearchParams(window.location.search).get('q') !== '';
                searchInput.value = '';
                toggleClearBtn();

                // Jika sedang dalam kondisi hasil pencarian, reload/submit form untuk mereset hasil pencarian
                if (hadQueryParam) {
                    document.getElementById('filter-form').submit();
                } else {
                    searchInput.focus();
                }
            });
        }
    });

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

    // AJAX Pagination untuk daftar berita & agenda agar halaman tidak melompat ke atas saat ganti page
    document.addEventListener('DOMContentLoaded', function() {
        function setupAjaxPagination(sectionId, containerId, paginationSelector, defaultNavHeight) {
            const section = document.getElementById(sectionId);
            if (!section) return;

            section.addEventListener('click', function(e) {
                const link = e.target.closest(paginationSelector);
                if (!link) return;

                const url = link.getAttribute('href');
                if (!url || url.startsWith('#')) return;

                e.preventDefault();

                const container = document.getElementById(containerId);
                if (container) {
                    container.classList.add('opacity-40', 'pointer-events-none');
                }

                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => {
                        if (!res.ok) throw new Error('Network response error');
                        return res.text();
                    })
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newContainer = doc.getElementById(containerId);

                        if (newContainer && container) {
                            container.innerHTML = newContainer.innerHTML;
                            container.classList.remove('opacity-40', 'pointer-events-none');

                            window.history.pushState({
                                path: url
                            }, '', url);

                            const pagination = container.querySelector(paginationSelector.replace(' a', ''));
                            if (pagination) {
                                const navHeight = defaultNavHeight || 90;
                                const paginationTop = pagination.getBoundingClientRect().top + window.pageYOffset;
                                const targetTop = paginationTop - window.innerHeight + pagination.offsetHeight + navHeight + 16;
                                const sectionTop = section.getBoundingClientRect().top + window.pageYOffset - navHeight;
                                const nextScrollTop = Math.max(sectionTop, targetTop);

                                if (Math.abs(window.pageYOffset - nextScrollTop) > 24) {
                                    window.scrollTo({
                                        top: nextScrollTop,
                                        behavior: 'smooth'
                                    });
                                }
                            }
                        } else {
                            window.location.href = url;
                        }
                    })
                    .catch(() => {
                        window.location.href = url;
                    });
            });
        }

        setupAjaxPagination('berita', 'berita-container', 'nav[aria-label="Pagination Berita"] a', 90);
        setupAjaxPagination('agenda', 'agenda-container', 'nav[aria-label="Pagination Agenda"] a', 90);

        window.addEventListener('popstate', function() {
            window.location.reload();
        });
    });
</script>

@endsection