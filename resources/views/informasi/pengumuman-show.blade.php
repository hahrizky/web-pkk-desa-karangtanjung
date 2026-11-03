@extends('layouts.app')

@section('title', $pengumuman['judul'] . ' — TP. PKK Desa Karangtanjung')

@section('content')

    <!-- ================= BREADCRUMB & HEADER ================= -->
    <div class="bg-[#E8F7EF] py-6 border-b border-[#D1D5DB]/50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-xs sm:text-sm text-gray-500 mb-3" aria-label="Breadcrumb">
                <a href="{{ route('beranda') }}" class="hover:text-[#075B3C] transition-colors">Beranda</a>
                <span class="text-gray-400">/</span>
                <a href="{{ route('informasi.index') }}" class="hover:text-[#075B3C] transition-colors">Informasi</a>
                <span class="text-gray-400">/</span>
                <a href="{{ route('informasi.pengumuman.index') }}" class="hover:text-[#075B3C] transition-colors">Pengumuman</a>
                <span class="text-gray-400">/</span>
                <span class="text-[#075B3C] font-semibold truncate max-w-[200px] sm:max-w-xs">{{ $pengumuman['judul'] }}</span>
            </nav>

            <div class="flex flex-wrap items-center gap-3">
                <span class="px-3 py-0.5 rounded-full text-xs font-semibold {{ $pengumuman['badge_color'] }} border shadow-xs">
                    {{ $pengumuman['kategori'] }}
                </span>
                <span class="text-xs text-gray-600 flex items-center gap-1.5">
                    <i class="fa-regular fa-calendar-days text-[#116B46]"></i>
                    {{ $pengumuman['tanggal'] }}
                </span>
                <span class="text-xs text-gray-400 hidden sm:inline">•</span>
                <span class="text-xs text-gray-600 hidden sm:flex items-center gap-1.5">
                    <i class="fa-regular fa-user text-[#116B46]"></i>
                    {{ $pengumuman['penulis'] }}
                </span>
            </div>
        </div>
    </div>

    <!-- ================= KONTEN UTAMA DETAIL PENGUMUMAN ================= -->
    <article class="py-10 sm:py-14 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Judul Pengumuman -->
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#1F2937] leading-tight mb-6">
                {{ $pengumuman['judul'] }}
            </h1>

            <!-- Ringkasan / Deskripsi Awal -->
            <div class="p-4 sm:p-5 rounded-2xl bg-[#F3FBF6] border-l-4 border-[#075B3C] mb-8">
                <p class="text-sm sm:text-base font-medium text-gray-700 leading-relaxed italic">
                    {{ $pengumuman['deskripsi'] }}
                </p>
            </div>

            <!-- Isi Lengkap Pengumuman -->
            <div class="prose max-w-none text-[#1F2937] leading-relaxed text-sm sm:text-base mb-10">
                <div class="space-y-4 text-gray-800 whitespace-pre-line leading-relaxed">
{{ $pengumuman['isi'] }}
                </div>
            </div>

            <!-- Catatan Pengesahan / Tanda Tangan Virtual -->
            <div class="mt-8 pt-6 border-t border-gray-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4 text-xs text-gray-500">
                <div>
                    <span class="block font-semibold text-gray-700">Diterbitkan oleh:</span>
                    <span>{{ $pengumuman['penulis'] }}</span>
                </div>
                <div class="sm:text-right">
                    <span class="block font-semibold text-gray-700">Wilayah:</span>
                    <span>Desa Karangtanjung, Kec. Candi, Kab. Sidoarjo</span>
                </div>
            </div>

            <!-- Banner Disclaimer Catatan Data Contoh -->
            <div class="mt-6 p-4 rounded-xl bg-amber-50 border border-amber-200 flex items-start gap-3">
                <i class="fa-solid fa-triangle-exclamation text-amber-600 text-sm mt-0.5"></i>
                <div class="text-xs text-amber-900 leading-relaxed">
                    <strong>Pemberitahuan:</strong> Seluruh naskah pengumuman ini merupakan contoh data untuk rancangan tampilan website TP. PKK Desa Karangtanjung dan bukan surat edaran resmi yang dikeluarkan oleh Pemerintah Desa.
                </div>
            </div>

            <!-- Tombol Navigasi -->
            <div class="mt-8 pt-6 border-t border-gray-200 flex flex-wrap items-center justify-between gap-4">
                <a href="{{ route('informasi.index') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold text-[#075B3C] bg-white border border-[#075B3C] hover:bg-[#075B3C] hover:text-white transition-all shadow-sm">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    <span>Kembali ke Informasi</span>
                </a>

                <a href="{{ route('informasi.pengumuman.index') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold text-white bg-[#075B3C] hover:bg-[#116B46] transition-all shadow-sm">
                    <span>Lihat Semua Pengumuman</span>
                    <span class="text-base leading-none">&rarr;</span>
                </a>
            </div>

            <!-- ================= PENGUMUMAN LAINNYA ================= -->
            @if(isset($pengumumanLainnya) && $pengumumanLainnya->count() > 0)
                <div class="mt-12 pt-8 border-t border-gray-200">
                    <h3 class="text-lg sm:text-xl font-bold text-[#1F2937] mb-6">
                        Pengumuman Terkait Lainnya
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                        @foreach($pengumumanLainnya as $pl)
                            <div class="bg-white rounded-xl border border-gray-200 p-4 hover:shadow-md hover:border-[#116B46]/40 transition-all flex flex-col justify-between group">
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $pl['badge_color'] }}">
                                            {{ $pl['kategori'] }}
                                        </span>
                                        <span class="text-[11px] text-gray-500">
                                            {{ $pl['tanggal'] }}
                                        </span>
                                    </div>
                                    <h4 class="text-sm font-bold text-[#1F2937] group-hover:text-[#075B3C] transition-colors leading-snug line-clamp-2 mb-2">
                                        <a href="{{ route('informasi.pengumuman.show', $pl['id']) }}">
                                            {{ $pl['judul'] }}
                                        </a>
                                    </h4>
                                    <p class="text-xs text-gray-500 line-clamp-2 mb-3">
                                        {{ $pl['deskripsi'] }}
                                    </p>
                                </div>
                                <a href="{{ route('informasi.pengumuman.show', $pl['id']) }}"
                                   class="text-xs font-bold text-[#075B3C] hover:underline inline-flex items-center gap-1">
                                    <span>Baca Pengumuman</span>
                                    <span>&rarr;</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </article>

@endsection

