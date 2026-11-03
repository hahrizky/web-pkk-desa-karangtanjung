@extends('layouts.app')

@section('title', 'Agenda & Jadwal Kegiatan — TP. PKK Desa Karangtanjung')

@section('content')

    <!-- ================= BREADCRUMB & HERO HEADER ================= -->
    <section class="bg-[#E8F7EF] py-8 sm:py-10 border-b border-[#D1D5DB]/40">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb Nav -->
            <nav class="flex items-center gap-2 text-xs sm:text-sm text-gray-500 mb-4" aria-label="Breadcrumb">
                <a href="{{ route('beranda') }}" class="hover:text-[#075B3C] transition-colors">Beranda</a>
                <span class="text-gray-400">/</span>
                <a href="{{ route('informasi.index') }}" class="hover:text-[#075B3C] transition-colors">Informasi</a>
                <span class="text-gray-400">/</span>
                <span class="text-[#075B3C] font-semibold">Agenda Kegiatan</span>
            </nav>

            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <span class="block text-xs sm:text-sm font-black tracking-widest text-[#075B3C] uppercase mb-1">
                        AGENDA &amp; JADWAL KEGIATAN
                    </span>
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#075B3C] tracking-tight leading-tight">
                        Agenda &amp; Jadwal Kegiatan TP. PKK Desa Karangtanjung
                    </h1>
                    <p class="text-xs sm:text-sm text-[#475569] leading-relaxed max-w-3xl mt-2">
                        Daftar jadwal kegiatan berkala, pertemuan kader dasawisma, pelayanan posyandu balita &amp; lansia, serta agenda pembinaan masyarakat Desa Karangtanjung.
                    </p>
                </div>

                <div class="flex-shrink-0">
                    <a href="{{ route('informasi.index') }}"
                       class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold text-[#075B3C] bg-white border border-[#075B3C] hover:bg-[#075B3C] hover:text-white transition-all shadow-sm">
                        <i class="fa-solid fa-arrow-left text-xs"></i>
                        <span>Kembali ke Informasi</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= DAFTAR LENGKAP AGENDA ================= -->
    <section class="py-12 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Banner Pemberitahuan Contoh Data -->
            <div class="mb-8 p-4 rounded-xl bg-amber-50 border border-amber-200 flex items-start gap-3">
                <i class="fa-solid fa-circle-exclamation text-amber-600 text-base mt-0.5"></i>
                <div class="text-xs sm:text-sm text-amber-800 leading-relaxed">
                    <strong class="font-semibold">Catatan Pengembangan:</strong> Tanggal dan jadwal kegiatan di bawah ini merupakan data contoh untuk tampilan pengembangan website TP. PKK Desa Karangtanjung dan belum menjadi jadwal resmi yang ditetapkan pemerintah desa.
                </div>
            </div>

            <!-- Grid Agenda (3 Kolom Desktop, 2 Kolom Tablet, 1 Kolom Mobile) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($agendas as $agenda)
                    <div class="bg-white rounded-xl border border-[#E2E8F0] p-5 shadow-sm hover:shadow-md hover:border-[#116B46]/50 hover:-translate-y-1 transition-all duration-200 flex flex-col justify-between group">
                        <div>
                            <!-- Header Kartu Agenda -->
                            <div class="flex items-start gap-4 mb-4">
                                <!-- Kotak Tanggal -->
                                <div class="w-16 h-16 rounded-xl bg-[#E8F7EF] border border-[#075B3C]/20 flex flex-col items-center justify-center flex-shrink-0 text-center shadow-xs">
                                    <span class="text-2xl font-extrabold text-[#075B3C] leading-none">{{ $agenda['tanggal'] }}</span>
                                    <span class="text-[11px] font-bold text-[#075B3C] uppercase tracking-wider mt-1">{{ $agenda['bulan'] }}</span>
                                </div>

                                <!-- Detail Kategori & Judul -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-wrap items-center gap-1.5 mb-1.5">
                                        <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider border {{ $agenda['badge_color'] }}">
                                            {{ $agenda['kategori'] }}
                                        </span>
                                        <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-medium bg-gray-100 text-gray-600 border border-gray-200">
                                            {{ $agenda['status'] }}
                                        </span>
                                    </div>

                                    <h2 class="text-base font-bold text-[#1F2937] group-hover:text-[#075B3C] transition-colors leading-snug line-clamp-2">
                                        <a href="{{ route('informasi.agenda.show', $agenda['id']) }}">
                                            {{ $agenda['judul'] }}
                                        </a>
                                    </h2>
                                </div>
                            </div>

                            <!-- Waktu & Lokasi -->
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

                            <!-- Deskripsi Singkat -->
                            <p class="text-xs text-[#64748B] leading-relaxed line-clamp-3 mt-1 mb-2">
                                {{ $agenda['deskripsi'] }}
                            </p>

                            <!-- Pelaksana & Link Pokja -->
                            <div class="text-[11px] text-gray-500 flex items-center justify-between pb-3">
                                <span>Pelaksana: <strong class="text-gray-700">{{ $agenda['pokja_label'] }}</strong></span>
                                <a href="{{ route('pokja') }}" class="text-[#075B3C] font-semibold hover:underline">
                                    Info Pokja &rarr;
                                </a>
                            </div>
                        </div>

                        <!-- Footer Kartu -->
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

            <!-- Navigasi Bawah -->
            <div class="mt-12 text-center">
                <a href="{{ route('informasi.index') }}"
                   class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-xs sm:text-sm font-bold text-white bg-[#075B3C] hover:bg-[#116B46] transition-all shadow-sm">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    <span>Kembali ke Pusat Informasi</span>
                </a>
            </div>

        </div>
    </section>

@endsection

