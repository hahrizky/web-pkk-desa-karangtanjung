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
                    <div class="bg-[#14633F] rounded-xl border border-[#14633F] p-5 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-200 flex flex-col justify-between group">
                        <div>
                            <!-- Header Kartu Agenda -->
                            <div class="flex items-start gap-4 mb-4">
                                <!-- Kotak Tanggal -->
                                <div class="w-16 h-16 rounded-xl bg-white/10 border border-white/20 flex flex-col items-center justify-center flex-shrink-0 text-center shadow-xs">
                                    <span class="text-2xl font-extrabold text-white leading-none">{{ $agenda['tanggal'] }}</span>
                                    <span class="text-[11px] font-bold text-emerald-200 uppercase tracking-wider mt-1">{{ $agenda['bulan'] }}</span>
                                </div>

                                <!-- Detail Kategori & Judul -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-wrap items-center gap-1.5 mb-1.5">
                                        <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-white/20 text-white border border-white/30">
                                            {{ $agenda['kategori'] }}
                                        </span>
                                        <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-medium bg-white/10 text-emerald-100 border border-white/20">
                                            {{ $agenda['status'] }}
                                        </span>
                                    </div>

                                    <h2 class="text-base font-bold text-white hover:text-emerald-200 transition-colors leading-snug line-clamp-2">
                                        <a href="{{ route('informasi.agenda.show', $agenda['id']) }}">
                                            {{ $agenda['judul'] }}
                                        </a>
                                    </h2>
                                </div>
                            </div>

                            <!-- Waktu & Lokasi -->
                            <div class="space-y-2 py-3 border-t border-white/15 text-xs text-emerald-100">
                                <div class="flex items-center gap-2.5">
                                    <i class="fa-regular fa-clock text-emerald-300 w-4 text-center"></i>
                                    <span>{{ $agenda['waktu'] }}</span>
                                </div>
                                <div class="flex items-center gap-2.5">
                                    <i class="fa-solid fa-location-dot text-emerald-300 w-4 text-center"></i>
                                    <span class="truncate">{{ $agenda['lokasi'] }}</span>
                                </div>
                            </div>

                            <!-- Deskripsi Singkat -->
                            <p class="text-xs text-emerald-100/90 leading-relaxed line-clamp-3 mt-1 mb-2">
                                {{ $agenda['deskripsi'] }}
                            </p>

                            <!-- Pelaksana & Link Pokja -->
                            <div class="text-[11px] text-emerald-200 flex items-center justify-between pb-3">
                                <span>Pelaksana: <strong class="text-white">{{ $agenda['pokja_label'] }}</strong></span>
                                <a href="{{ route('pokja') }}" class="text-emerald-200 hover:text-white hover:underline font-semibold transition-colors">
                                    Info Pokja &rarr;
                                </a>
                            </div>
                        </div>

                        <!-- Footer Kartu -->
                        <div class="pt-3 border-t border-white/15">
                            <a href="{{ route('informasi.agenda.show', $agenda['id']) }}"
                               class="inline-block text-center w-full px-4 py-2 rounded-lg text-xs font-bold text-[#14633F] bg-white hover:bg-emerald-50 active:scale-95 active:bg-emerald-100 transition-all duration-150 shadow-xs select-none">
                                Detail Agenda
                            </a>
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

