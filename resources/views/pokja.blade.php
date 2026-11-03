@extends('layouts.app')

@section('title', 'Kelompok Kerja (Pokja) — TP. PKK Desa Karangtanjung')

@section('content')

    <!-- ================= HERO HEADER POKJA ================= -->
    <section class="bg-[#E8F7EF] py-10 sm:py-12 border-b border-[#D1D5DB]/40">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="block text-xs sm:text-sm font-black tracking-widest text-[#075B3C] uppercase mb-1">
                KELOMPOK KERJA TP. PKK
            </span>
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#075B3C] tracking-tight leading-tight">
                Program &amp; Aksi 4 Pokja Desa Karangtanjung
            </h1>
            <p class="text-xs sm:text-sm text-[#475569] leading-relaxed max-w-3xl mt-2">
                Setiap Kelompok Kerja (Pokja) memiliki mandat nyata dalam menggerakkan posyandu, ketahanan pangan keluarga, pelatihan wirausaha ibu, dan kerja bakti kebersihan desa.
            </p>
        </div>
    </section>

    <!-- ================= RINCIAN POKJA I - IV ================= -->
    @foreach($pokja as $i => $p)
        @php
            $isMintBg = ($i % 2 === 0);
            $sectionBg = $isMintBg ? 'bg-[#F9FDFB]' : 'bg-white';
            $cardClass = $isMintBg 
                ? 'bg-white rounded-xl p-4 sm:p-5 shadow-xs border border-emerald-100/80 hover:shadow-sm transition-all' 
                : 'bg-[#F3FBF6] rounded-xl p-4 sm:p-5 border border-emerald-100/70 hover:shadow-sm transition-all';
        @endphp

        <section class="{{ $sectionBg }} py-12 sm:py-14 border-b border-gray-100">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Header Pokja -->
                <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-6">
                    <div class="max-w-3xl">
                        <!-- Badge Pokja -->
                        <div class="mb-2.5">
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase {{ $p['badge_class'] }} border border-emerald-200/50">
                                {{ $p['kode'] }}
                            </span>
                        </div>

                        <!-- Judul Pokja -->
                        <h2 class="text-xl sm:text-2xl font-extrabold text-[#065f46] mb-2 leading-snug">
                            {{ $p['nama'] }}
                        </h2>

                        <!-- Deskripsi Bidang -->
                        <p class="text-xs sm:text-sm text-gray-700 leading-relaxed">
                            {{ $p['deskripsi'] }}
                        </p>
                    </div>

                    <!-- Tombol Cepat Menuju Dokumentasi Kegiatan Pokja Terkait -->
                    <div class="flex-shrink-0 pt-1">
                        <a href="{{ route('informasi.index', ['kategori' => $p['filter_kategori']]) }}"
                           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold text-white bg-[#075B3C] hover:bg-[#116B46] shadow-xs transition-all">
                            <span>Lihat Berita Kegiatan {{ $p['kode'] }}</span>
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>

                <!-- Info Aksi Nyata Singkat -->
                <div class="mb-6 p-3.5 rounded-xl bg-white border border-emerald-200/60 flex items-center gap-3 text-xs text-gray-700 shadow-xs">
                    <i class="fa-solid fa-circle-check text-[#075B3C] text-sm flex-shrink-0"></i>
                    <span><strong>Fokus Aksi di Desa:</strong> {{ $p['ringkasan_kegiatan'] }}</span>
                </div>

                <!-- Sub-header Program -->
                <h3 class="text-xs font-black tracking-widest text-gray-900 uppercase mb-4">
                    PROGRAM KERJA &amp; TUGAS POKOK
                </h3>

                <!-- Grid Program 3 Kolom -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($p['program'] as $prog)
                        <div class="{{ $cardClass }} flex flex-col justify-between">
                            <div>
                                <!-- Header kartu: Icon + Judul -->
                                <div class="flex items-center gap-2.5 mb-2">
                                    <div class="w-8 h-8 rounded-lg bg-emerald-50 {{ $prog['icon_color'] }} flex items-center justify-center text-sm flex-shrink-0">
                                        <i class="{{ $prog['icon'] }}"></i>
                                    </div>
                                    <h4 class="font-bold text-sm text-gray-900 leading-snug">
                                        {{ $prog['judul'] }}
                                    </h4>
                                </div>
                                <!-- Deskripsi Program -->
                                <p class="text-xs text-gray-600 leading-relaxed">
                                    {{ $prog['deskripsi'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>
    @endforeach

    <!-- ================= AJAKAN BERPARTISIPASI / FOOTER CTA ================= -->
    <section class="py-12 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="bg-[#F3FBF6] border border-[#075B3C]/20 rounded-2xl p-8 shadow-xs">
                <i class="fa-solid fa-calendar-check text-[#075B3C] text-3xl mb-3"></i>
                <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2">
                    Ingin Mengetahui Jadwal Kegiatan PKK Berikutnya?
                </h3>
                <p class="text-xs sm:text-sm text-gray-600 max-w-xl mx-auto mb-6 leading-relaxed">
                    Lihat jadwal posyandu balita, pertemuan rutin kader dasawisma, pelatihan olahan pangan, serta pengumuman terbaru di halaman Informasi.
                </p>
                <div class="flex flex-wrap items-center justify-center gap-3">
                    <a href="{{ route('informasi.agenda.index') }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-xs sm:text-sm text-white bg-[#075B3C] hover:bg-[#116B46] shadow-sm transition-all">
                        <i class="fa-solid fa-clock text-xs"></i>
                        <span>Buka Jadwal Agenda Kegiatan</span>
                    </a>
                    <a href="{{ route('informasi.index') }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-xs sm:text-sm text-[#075B3C] bg-white border border-[#075B3C] hover:bg-emerald-50 transition-all">
                        <span>Pusat Berita &amp; Dokumentasi</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
