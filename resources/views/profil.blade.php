@extends('layouts.app')

@section('title', 'Profil — TP. PKK Desa Karangtanjung')

@section('content')

    <!-- ================= 1. TENTANG KAMI ================= -->
    <section class="py-14 sm:py-16 bg-white border-b border-gray-100">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-12 items-center">

                <!-- Teks Tentang Kami -->
                <div>
                    <span class="text-xs font-bold text-[#075B3C] uppercase tracking-wider block mb-1">
                        PROFIL ORGANISASI
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 mb-4 leading-tight">
                        Tim Penggerak PKK Desa Karangtanjung
                    </h1>
                    <p class="text-sm sm:text-[15px] text-gray-700 leading-relaxed mb-4">
                        <strong class="text-emerald-800">TP. PKK Desa Karangtanjung</strong> adalah organisasi kemasyarakatan perempuan di bawah naungan Pemerintah Desa Karangtanjung, Kecamatan Candi, Kabupaten Sidoarjo. 
                    </p>
                    <p class="text-xs sm:text-sm text-gray-600 leading-relaxed mb-6">
                        Kami berfokus pada aksi nyata pelayanan masyarakat: menghidupkan kelompok Dasawisma di tiap RT/RW, menjaga kesehatan balita &amp; lansia melalui Posyandu, membina usaha rumahan (UP2K), serta melestarikan budaya gotong royong warga desa.
                    </p>

                    <!-- Tombol Cepat ke Agenda Kegiatan -->
                    <div class="flex flex-wrap items-center gap-3">
                        <a href="{{ route('informasi.index') }}" 
                           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-xs sm:text-sm text-white bg-[#075B3C] hover:bg-[#116B46] shadow-sm transition-all duration-200">
                            <i class="fa-solid fa-calendar-days text-xs"></i>
                            <span>Lihat Kegiatan &amp; Agenda Desa</span>
                        </a>
                        <a href="{{ route('pokja') }}" 
                           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-xs sm:text-sm text-[#075B3C] bg-emerald-50 hover:bg-emerald-100 border border-[#075B3C]/20 transition-all duration-200">
                            <i class="fa-solid fa-users-viewfinder text-xs"></i>
                            <span>Bidang Pokja</span>
                        </a>
                    </div>
                </div>

                <!-- Foto Pengurus -->
                <div class="relative">
                    <div class="relative overflow-hidden rounded-2xl border-4 border-white shadow-xl bg-gray-100">
                        <img src="{{ asset('images/5.webp') }}"
                             alt="Pengurus TP. PKK Desa Karangtanjung"
                             class="w-full h-72 sm:h-80 lg:h-96 object-cover hover:scale-105 transition-transform duration-500">
                        <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-emerald-950/90 via-emerald-950/50 to-transparent p-4 sm:p-5">
                            <p class="text-xs sm:text-sm font-bold text-white leading-snug">
                                Pengurus Tim Penggerak PKK Desa Karangtanjung
                            </p>
                            <p class="text-[11px] text-emerald-200 mt-0.5">Kecamatan Candi, Kabupaten Sidoarjo</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ================= 2. VISI & MISI ================= -->
    <section class="py-14 sm:py-16 bg-[#F3FBF6] border-b border-gray-100">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Card VISI -->
            <div class="relative rounded-2xl bg-[#075B3C] text-white p-8 sm:p-12 text-center overflow-hidden mb-12 shadow-md">
                <div class="relative z-10 max-w-3xl mx-auto">
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold tracking-widest text-emerald-200 uppercase bg-white/10 border border-white/20 mb-3">
                        VISI UTAMA
                    </span>
                    <h2 class="text-base sm:text-xl font-bold text-white leading-relaxed">
                        &ldquo;{{ $visi }}&rdquo;
                    </h2>
                </div>
            </div>

            <!-- MISI KAMI -->
            <div class="text-center mb-8">
                <span class="text-xs font-bold text-[#075B3C] uppercase tracking-wider block mb-1">
                    ARAH KERJA
                </span>
                <h3 class="text-xl sm:text-2xl font-bold text-gray-900">
                    4 Misi Penggerak PKK Desa
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                @foreach ($misi as $item)
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-xs hover:shadow-md transition-all duration-200 flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-emerald-50 text-[#075B3C] flex items-center justify-center text-xl flex-shrink-0 border border-emerald-100/60 mt-0.5">
                            <i class="{{ $item['icon'] }}"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <span class="text-[10px] font-bold text-[#075B3C] bg-emerald-50 px-2.5 py-0.5 rounded-full uppercase tracking-wider inline-block mb-1.5 border border-[#075B3C]/15">
                                Misi {{ $item['nomor'] }}
                            </span>
                            <h4 class="text-sm sm:text-base font-bold text-gray-900 mb-1 leading-snug">
                                {{ $item['judul'] }}
                            </h4>
                            <p class="text-xs sm:text-[13px] text-gray-600 leading-relaxed">
                                {{ $item['deskripsi'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- ================= 3. STRUKTUR PENGURUS DESA ================= -->
    <section class="py-14 sm:py-16 bg-white border-b border-gray-100">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-10">
                <span class="text-xs font-bold text-[#075B3C] uppercase tracking-wider block mb-1">
                    SUSUNAN KEPENGURUSAN
                </span>
                <h2 class="text-xl sm:text-2xl font-bold text-gray-900">
                    Struktur Organisasi TP. PKK Desa Karangtanjung
                </h2>
                <p class="text-xs sm:text-sm text-gray-500 mt-1">
                    Pengurus resmi masa bakti aktif yang bertugas melayani warga Desa Karangtanjung.
                </p>
            </div>

            <!-- Bagan Hierarki -->
            <div class="flex flex-col items-center">

                <!-- LEVEL 1: PEMBINA (Kades) -->
                <div class="flex flex-col items-center w-full">
                    <div class="bg-amber-50 border-2 border-amber-300 rounded-2xl px-6 py-3.5 text-center shadow-xs min-w-[220px]">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-amber-700 mb-0.5">{{ $struktur['pembina']['jabatan'] }}</p>
                        <p class="text-sm font-bold text-gray-900">{{ $struktur['pembina']['nama'] }}</p>
                        <p class="text-xs text-gray-500">{{ $struktur['pembina']['sub'] }}</p>
                    </div>
                    <div class="w-[2px] h-7 bg-gray-300"></div>
                </div>

                <!-- LEVEL 2: KETUA TP. PKK -->
                <div class="flex flex-col items-center w-full">
                    @php $ketua = $struktur['pengurus_inti'][0]; @endphp
                    <div class="bg-[#075B3C] text-white rounded-2xl px-8 py-3.5 text-center shadow-sm min-w-[240px]">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-emerald-200 mb-0.5">{{ $ketua['jabatan'] }}</p>
                        <p class="text-sm sm:text-base font-bold">{{ $ketua['nama'] }}</p>
                    </div>
                    <div class="w-[2px] h-7 bg-gray-300"></div>
                </div>

                <!-- LEVEL 3: WAKIL KETUA -->
                <div class="flex flex-col items-center w-full">
                    @php $wakil = $struktur['pengurus_inti'][1]; @endphp
                    <div class="bg-emerald-50 border border-emerald-300 rounded-2xl px-6 py-3 text-center shadow-xs min-w-[220px]">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-[#075B3C] mb-0.5">{{ $wakil['jabatan'] }}</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $wakil['nama'] }}</p>
                    </div>
                </div>

                <!-- LEVEL 4: SEKRETARIS & BENDAHARA -->
                <div class="w-full max-w-3xl mt-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <!-- Sekretaris -->
                        <div class="space-y-2.5">
                            @foreach (array_slice($struktur['pengurus_inti'], 2, 2) as $sek)
                                <div class="bg-blue-50/70 border border-blue-200 rounded-xl px-4 py-2.5 text-center">
                                    <p class="text-[10px] font-bold uppercase tracking-widest text-blue-700">
                                        {{ $sek['jabatan'] }}
                                    </p>
                                    <p class="text-xs sm:text-sm font-semibold text-gray-900 mt-0.5">
                                        {{ $sek['nama'] }}
                                    </p>
                                </div>
                            @endforeach
                        </div>

                        <!-- Bendahara -->
                        <div class="space-y-2.5">
                            @foreach (array_slice($struktur['pengurus_inti'], 4, 2) as $ben)
                                <div class="bg-amber-50/70 border border-amber-200 rounded-xl px-4 py-2.5 text-center">
                                    <p class="text-[10px] font-bold uppercase tracking-widest text-amber-700">
                                        {{ $ben['jabatan'] }}
                                    </p>
                                    <p class="text-xs sm:text-sm font-semibold text-gray-900 mt-0.5">
                                        {{ $ben['nama'] }}
                                    </p>
                                </div>
                            @endforeach
                        </div>

                    </div>

                    <!-- LEVEL 5: KETUA POKJA I - IV -->
                    <div class="mt-6 pt-5 border-t border-gray-200">
                        <span class="block text-center text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">
                            Koordinator Kelompok Kerja (Pokja)
                        </span>

                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                            @foreach ($struktur['pokja'] as $pk)
                                <div class="bg-white border-2 border-emerald-100 rounded-xl p-3 text-center hover:border-[#075B3C] transition-colors">
                                    <span class="inline-block bg-emerald-50 text-[#075B3C] text-[10px] font-bold uppercase px-2 py-0.5 rounded-full mb-1">
                                        {{ $pk['kode'] }}
                                    </span>
                                    <p class="text-xs font-bold text-gray-900">
                                        {{ $pk['ketua'] }}
                                    </p>
                                    <p class="text-[10px] text-gray-500 mt-0.5">
                                        {{ $pk['bidang'] }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>

    <!-- ================= 4. FOKUS AKSI & KEGIATAN NYATA PKK ================= -->
    <section class="py-14 sm:py-16 bg-[#F3FBF6] border-b border-gray-100">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-3">
                <div>
                    <span class="text-xs font-bold text-[#075B3C] uppercase tracking-wider block mb-1">
                        AKSI NYATA DI DESA
                    </span>
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900">
                        Fokus Utama Kegiatan TP. PKK Karangtanjung
                    </h2>
                    <p class="text-xs sm:text-sm text-gray-500 mt-1">
                        Empat bidang prioritas yang langsung dirasakan manfaatnya oleh warga dan keluarga.
                    </p>
                </div>
                <div>
                    <a href="{{ route('informasi.index') }}" 
                       class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-[#075B3C] hover:underline">
                        <span>Lihat Semua Berita &amp; Agenda</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- Grid 4 Fokus Kegiatan Nyata -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach ($fokus_kegiatan as $fokus)
                    <div class="bg-white rounded-2xl p-5 border border-gray-200/80 shadow-xs hover:shadow-md hover:border-[#075B3C]/50 hover:-translate-y-1 transition-all duration-200 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-xs font-bold text-[#075B3C] bg-emerald-50 px-2.5 py-0.5 rounded-full border border-[#075B3C]/20">
                                    {{ $fokus['pokja'] }}
                                </span>
                                <div class="w-9 h-9 rounded-xl bg-emerald-50 text-[#075B3C] flex items-center justify-center text-sm">
                                    <i class="{{ $fokus['icon'] }}"></i>
                                </div>
                            </div>

                            <h3 class="text-sm sm:text-[15px] font-bold text-gray-900 mb-2 leading-snug">
                                {{ $fokus['judul'] }}
                            </h3>

                            <p class="text-xs text-gray-500 leading-relaxed mb-5">
                                {{ $fokus['deskripsi'] }}
                            </p>
                        </div>

                        <a href="{{ route('informasi.index', ['kategori' => $fokus['kategori_filter']]) }}" 
                           class="inline-flex items-center justify-center gap-1.5 w-full py-2 px-3 rounded-xl text-xs font-bold text-[#075B3C] bg-emerald-50 hover:bg-[#075B3C] hover:text-white transition-all duration-200">
                            <span>Lihat Bukti Kegiatan</span>
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- ================= 5. 10 PROGRAM POKOK PKK ================= -->
    <section class="py-14 sm:py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-xs font-bold text-[#075B3C] uppercase tracking-wider block mb-1">
                    PEDOMAN RESMI NASIONAL
                </span>
                <h2 class="text-xl sm:text-2xl font-bold text-gray-900">
                    10 Program Pokok PKK
                </h2>
                <p class="text-xs sm:text-sm text-gray-500 mt-1">
                    Landasan kerja resmi yang dijalankan oleh kader PKK Desa Karangtanjung.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach ($program_pokok as $item)
                    <div class="bg-gray-50/80 rounded-xl p-4 border border-gray-200/80 shadow-xs flex flex-col justify-between hover:bg-emerald-50/40 hover:border-[#075B3C]/40 transition-all">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="w-6 h-6 rounded-md bg-[#075B3C] text-white text-[11px] font-bold flex items-center justify-center">
                                    {{ $item['nomor'] }}
                                </span>
                                <span class="text-[9px] font-bold text-gray-500 bg-white border border-gray-200 px-1.5 py-0.5 rounded">
                                    {{ $item['pokja'] }}
                                </span>
                            </div>

                            <h4 class="text-xs sm:text-[13px] font-bold text-gray-900 leading-snug mb-1.5">
                                {{ $item['judul'] }}
                            </h4>

                            <p class="text-[11px] text-gray-500 leading-relaxed mb-3">
                                {{ $item['deskripsi'] }}
                            </p>
                        </div>

                        <div class="pt-2 border-t border-gray-200/60 flex justify-end text-emerald-700 text-xs">
                            <i class="{{ $item['icon'] }}"></i>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

@endsection
