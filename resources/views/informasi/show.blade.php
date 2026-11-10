@extends('layouts.app')

@section('title', $berita['judul'] . ' — TP. PKK Desa Karangtanjung')

@section('content')

    <!-- ================= KONTEN UTAMA DETAIL BERITA ================= -->
    <article class="pt-8 sm:pt-10 pb-12 sm:pb-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Meta Berita (Kategori, Tanggal, Penulis) -->
            <div class="flex flex-wrap items-center gap-3 mb-4">
                <span class="px-3 py-0.5 rounded-full text-xs font-semibold bg-[#E8F7EF] text-[#075B3C] border border-[#075B3C]/25 shadow-2xs">
                    {{ $berita['kategori'] }}
                </span>
                <span class="text-xs text-gray-600 flex items-center gap-1.5">
                    <i class="fa-regular fa-calendar text-[#075B3C]"></i>
                    {{ $berita['tanggal'] }}
                </span>
                <span class="text-xs text-gray-400 hidden sm:inline">•</span>
                <span class="text-xs text-gray-600 hidden sm:flex items-center gap-1.5">
                    <i class="fa-regular fa-user text-[#075B3C]"></i>
                    {{ $berita['penulis'] }}
                </span>
            </div>

            <!-- Judul Utama Berita -->
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#1F2937] leading-tight mb-6 sm:mb-8">
                {{ $berita['judul'] }}
            </h1>

            <!-- Gambar Utama Dokumentasi -->
            @if (!empty($berita['gambar']))
            <div class="rounded-2xl overflow-hidden border border-[#D1D5DB] shadow-sm mb-8 bg-gray-100 max-h-[460px]">
                <img src="{{ asset('images/' . $berita['gambar']) }}"
                     alt="{{ $berita['judul'] }}"
                     class="w-full h-full object-cover">
            </div>
            @endif

            <!-- Isi Berita -->
            <div class="prose max-w-none text-[#1F2937] leading-relaxed space-y-4 text-sm sm:text-base mb-10">
                <p class="font-medium text-base sm:text-lg text-gray-700 leading-relaxed border-l-4 border-[#075B3C] pl-4 italic bg-[#F3FBF6] py-3 rounded-r-xl">
                    {{ $berita['deskripsi'] }}
                </p>

                <p>
                    {{ $berita['isi'] }}
                </p>

            </div>

            <!-- Tombol Kembali ke Informasi -->
            <div class="pt-6 flex items-center justify-end mb-12">
                <a href="{{ route('informasi.index') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold text-[#075B3C] bg-white border border-[#075B3C] hover:bg-[#075B3C] hover:text-white transition-all shadow-sm">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    <span>Kembali ke Informasi</span>
                </a>
            </div>

            <!-- ================= REKOMENDASI BERITA LAINNYA ================= -->
            @if(isset($beritaLainnya) && $beritaLainnya->count() > 0)
                <div class="pt-8 border-t border-gray-200">
                    <h3 class="text-lg sm:text-xl font-bold text-[#1F2937] mb-6">
                        Informasi &amp; Berita Terkait Lainnya
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        @foreach($beritaLainnya as $bl)
                            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-md transition-all flex flex-col group">
                                <div class="h-36 overflow-hidden bg-gray-100">
                                    @if (!empty($bl['gambar']))
                                    <img src="{{ asset('images/' . $bl['gambar']) }}"
                                         alt="{{ $bl['judul'] }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    @endif
                                </div>
                                <div class="p-4 flex-1 flex flex-col justify-between">
                                    <div>
                                        <span class="text-[10px] font-semibold text-[#075B3C] uppercase tracking-wider">
                                            {{ $bl['kategori'] }}
                                        </span>
                                        <h4 class="font-bold text-sm text-[#1F2937] leading-snug line-clamp-2 mt-1 mb-2 group-hover:text-[#075B3C] transition-colors">
                                            <a href="{{ route('informasi.show', $bl['id']) }}">
                                                {{ $bl['judul'] }}
                                            </a>
                                        </h4>
                                    </div>
                                    <span class="text-[11px] text-gray-500">
                                        {{ $bl['tanggal'] }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </article>

@endsection

