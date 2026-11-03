@extends('layouts.app')

@section('title', $berita['judul'] . ' — TP. PKK Desa Karangtanjung')

@section('content')

    <!-- ================= BREADCRUMB & HEADER ================= -->
    <div class="bg-[#E8F7EF] py-6 border-b border-[#D1D5DB]/50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-xs sm:text-sm text-gray-500 mb-3" aria-label="Breadcrumb">
                <a href="{{ route('beranda') }}" class="hover:text-[#075B3C] transition-colors">Beranda</a>
                <span class="text-gray-400">/</span>
                <a href="{{ route('informasi.index') }}" class="hover:text-[#075B3C] transition-colors">Informasi</a>
                <span class="text-gray-400">/</span>
                <span class="text-[#075B3C] font-semibold truncate max-w-[200px] sm:max-w-xs">{{ $berita['judul'] }}</span>
            </nav>

            <div class="flex items-center gap-3">
                <span class="px-3 py-0.5 rounded-full text-xs font-semibold bg-white text-[#075B3C] border border-[#075B3C]/30 shadow-sm">
                    {{ $berita['kategori'] }}
                </span>
                <span class="text-xs text-gray-600 flex items-center gap-1.5">
                    <i class="fa-regular fa-calendar text-[#116B46]"></i>
                    {{ $berita['tanggal'] }}
                </span>
                <span class="text-xs text-gray-400 hidden sm:inline">•</span>
                <span class="text-xs text-gray-600 hidden sm:flex items-center gap-1.5">
                    <i class="fa-regular fa-user text-[#116B46]"></i>
                    {{ $berita['penulis'] }}
                </span>
            </div>
        </div>
    </div>

    <!-- ================= KONTEN UTAMA DETAIL BERITA ================= -->
    <article class="py-10 sm:py-14 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Judul Utama Berita -->
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#1F2937] leading-tight mb-6">
                {{ $berita['judul'] }}
            </h1>

            <!-- Gambar Utama Dokumentasi -->
            <div class="rounded-2xl overflow-hidden border border-[#D1D5DB] shadow-sm mb-8 bg-gray-100 max-h-[460px]">
                <img src="{{ asset('images/' . $berita['gambar']) }}"
                     alt="{{ $berita['judul'] }}"
                     class="w-full h-full object-cover">
            </div>

            <!-- Isi Berita -->
            <div class="prose max-w-none text-[#1F2937] leading-relaxed space-y-4 text-sm sm:text-base mb-10">
                <p class="font-medium text-base sm:text-lg text-gray-700 leading-relaxed border-l-4 border-[#075B3C] pl-4 italic bg-[#F3FBF6] py-3 rounded-r-xl">
                    {{ $berita['deskripsi'] }}
                </p>

                <p>
                    {{ $berita['isi'] }}
                </p>

                <p>
                    Kegiatan ini menjadi momentum penting dalam memperkuat sinergi antara Tim Penggerak PKK Desa Karangtanjung, kader dasawisma di setiap rukun warga (RW), serta masyarakat umum demi terwujudnya ketahanan keluarga yang berkesinambungan di Kabupaten Sidoarjo.
                </p>
            </div>

            <!-- Kotak Keterhubungan Program Kerja Desa -->
            <div class="mb-10 p-5 rounded-2xl bg-[#F3FBF6] border border-[#075B3C]/20 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-[#075B3C] flex items-center justify-center text-lg flex-shrink-0 mt-0.5">
                        <i class="fa-solid fa-hands-holding-circle"></i>
                    </div>
                    <div>
                        <h4 class="text-xs sm:text-sm font-bold text-gray-900">Program Kerja TP. PKK Desa Karangtanjung</h4>
                        <p class="text-xs text-gray-600 leading-relaxed mt-0.5">
                            Kegiatan ini dinaungi oleh kepengurusan resmi desa. Pelajari tupoksi bidang di halaman Pokja atau kenali susunan pengurus di halaman Profil.
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-2 flex-shrink-0">
                    <a href="{{ route('pokja') }}" class="px-3.5 py-2 rounded-lg text-xs font-bold text-[#075B3C] bg-white border border-[#075B3C]/30 hover:bg-[#075B3C] hover:text-white transition-all shadow-2xs">
                        Lihat Pokja &rarr;
                    </a>
                    <a href="{{ route('profil') }}" class="px-3.5 py-2 rounded-lg text-xs font-bold text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 transition-all shadow-2xs">
                        Profil Pengurus
                    </a>
                </div>
            </div>

            <!-- Tags Berita -->
            <div class="pt-6 border-t border-gray-200 flex flex-wrap items-center justify-between gap-4 mb-12">
                <div class="flex items-center gap-2">
                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider mr-1">Tagar:</span>
                    @foreach($berita['tags'] as $tag)
                        <span class="px-3 py-1 rounded-lg text-xs font-semibold bg-[#E8F7EF] text-[#075B3C] border border-[#075B3C]/20">
                            #{{ $tag }}
                        </span>
                    @endforeach
                </div>

                <!-- Tombol Kembali ke Informasi -->
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
                                    <img src="{{ asset('images/' . $bl['gambar']) }}"
                                         alt="{{ $bl['judul'] }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
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

