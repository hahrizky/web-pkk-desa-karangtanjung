@extends('layouts.app')

@section('title', 'Beranda — TP PKK Desa Karangtanjung')

@section('content')

    <!-- ================= 1. HERO SECTION ================= -->
    <section id="beranda" class="relative min-h-[580px] lg:min-h-[640px] flex items-center justify-center overflow-hidden bg-emerald-950">
        <!-- Foto Dokumentasi Pelantikan PKK -->
        <img src="{{ asset('images/5.webp') }}"
             alt="Dokumentasi TP PKK Desa Karangtanjung"
             class="absolute inset-0 w-full h-full object-cover object-top filter brightness-[0.55] contrast-[1.05]">

        <!-- Overlay Gelap Emerald agar Teks Jelas Terbaca -->
        <div class="absolute inset-0 bg-gradient-to-b from-emerald-950/75 via-emerald-900/50 to-emerald-950/90"></div>

        <!-- Konten Utama Hero -->
        <div class="relative z-10 w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28 text-center">
            <!-- Judul Utama -->
            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-tight sm:leading-tight mb-6 drop-shadow-md">
                Tim Penggerak Pemberdayaan dan<br>
                Kesejahteraan Keluarga<br>
                <span class="text-amber-400">Desa Karangtanjung</span>
            </h1>

            <!-- Deskripsi Singkat -->
            <p class="text-base sm:text-lg lg:text-xl text-emerald-100/90 max-w-3xl mx-auto mb-10 leading-relaxed drop-shadow">
                Portal informasi kegiatan, program kerja, dan data statistik TP. PKK Desa Karangtanjung untuk mewujudkan keluarga yang sehat, mandiri, dan sejahtera.
            </p>

            <!-- Tombol Aksi (CTA) -->
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="#kegiatan" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl font-semibold text-white bg-emerald-600 hover:bg-emerald-700 shadow-lg shadow-emerald-950/40 transition-all duration-200 hover:-translate-y-0.5">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span>Lihat Kegiatan</span>
                </a>
                <a href="{{ route('profil') }}" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl font-semibold text-white bg-white/15 hover:bg-white hover:text-emerald-900 border border-white/40 backdrop-blur-md shadow-lg transition-all duration-200 hover:-translate-y-0.5">
                    <i class="fa-solid fa-circle-info"></i>
                    <span>Profil PKK</span>
                </a>
            </div>
        </div>
    </section>

    <!-- ================= 2. DATA STATISTIK DASAWISMA ================= -->
    <section id="profil" class="py-16 bg-gray-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Judul Section -->
            <div class="text-center max-w-2xl mx-auto mb-12">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
                    Data Singkat Dasawisma
                </h2>
                <p class="text-sm sm:text-base text-gray-600">
                    Informasi data keluarga dan masyarakat Desa Karangtanjung berdasarkan wilayah.
                </p>
            </div>

            <!-- Grid 3 Kartu Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                @foreach ($statistik as $item)
                    <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-1 transition-all duration-200">
                        <div class="flex items-start gap-5">
                            <!-- Icon Box -->
                            @if ($item['warna'] == 'green')
                                <div class="w-14 h-14 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl flex-shrink-0">
                                    <i class="{{ $item['icon'] }}"></i>
                                </div>
                            @elseif ($item['warna'] == 'orange')
                                <div class="w-14 h-14 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl flex-shrink-0">
                                    <i class="{{ $item['icon'] }}"></i>
                                </div>
                            @else
                                <div class="w-14 h-14 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center text-2xl flex-shrink-0">
                                    <i class="{{ $item['icon'] }}"></i>
                                </div>
                            @endif

                            <!-- Keterangan Angka -->
                            <div>
                                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">
                                    {{ $item['judul'] }}
                                </span>
                                <span class="block text-3xl sm:text-4xl font-extrabold @if($item['warna'] == 'green') text-emerald-700 @elseif($item['warna'] == 'orange') text-amber-600 @else text-sky-600 @endif mb-1">
                                    {{ $item['nilai'] }}
                                </span>
                                <p class="text-xs sm:text-sm text-gray-500">
                                    {{ $item['deskripsi'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ================= 3. DAFTAR KEGIATAN PKK ================= -->
    <section id="kegiatan" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 gap-4">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
                        Kegiatan PKK
                    </h2>
                    <p class="text-sm sm:text-base text-gray-600">
                        Informasi terbaru mengenai kegiatan dan program TP. PKK Desa Karangtanjung.
                    </p>
                </div>
                <div>
                    <a href="#" class="inline-flex items-center gap-1.5 text-sm font-semibold text-emerald-700 hover:text-emerald-800 transition-colors">
                        <span>Lihat semua kegiatan</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- Grid 4 Kartu Kegiatan -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($kegiatan as $kg)
                    <div class="group h-full bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col">
                        <!-- Gambar / Foto Header Kegiatan -->
                        <div class="h-48 overflow-hidden relative bg-gray-100 border-b border-gray-100">
                            @if (!empty($kg['gambar']))
                                <img src="{{ asset('images/' . $kg['gambar']) }}" 
                                     alt="{{ $kg['judul'] }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-60"></div>
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-emerald-50 via-teal-50 to-gray-50 flex items-center justify-center">
                                    <div class="w-16 h-16 rounded-2xl bg-white shadow-sm flex items-center justify-center text-emerald-700 text-2xl">
                                        <i class="fa-solid fa-people-roof"></i>
                                    </div>
                                </div>
                            @endif
                            <span class="absolute top-3 left-3 text-xs font-semibold px-2.5 py-1 rounded-full {{ $kg['badge_color'] }} shadow-sm backdrop-blur-md">
                                {{ $kg['kategori'] }}
                            </span>
                        </div>

                        <!-- Konten Kartu -->
                        <div class="p-5 flex-1 flex flex-col">
                            <div>
                                <!-- Tanggal Kegiatan -->
                                <div class="flex items-center gap-2 text-xs text-gray-500 mb-2.5">
                                    <i class="fa-regular fa-calendar text-emerald-600"></i>
                                    <span>{{ $kg['tanggal'] }}</span>
                                </div>

                                <!-- Judul Kegiatan -->
                                <h3 class="font-bold text-gray-900 text-base leading-snug mb-2 group-hover:text-emerald-700 transition-colors">
                                    <a href="#">{{ $kg['judul'] }}</a>
                                </h3>

                                <!-- Cuplikan Deskripsi -->
                                <p class="text-xs sm:text-sm text-gray-500 leading-relaxed line-clamp-3 mb-4">
                                    {{ $kg['ringkasan'] }}
                                </p>
                            </div>

                            <!-- Tombol Selengkapnya -->
                            <a href="#" class="mt-auto inline-flex items-center justify-center gap-2 w-full py-2.5 px-4 rounded-xl text-xs sm:text-sm font-semibold text-emerald-700 bg-emerald-50 hover:bg-emerald-600 hover:text-white transition-all duration-200">
                                <span>Selengkapnya</span>
                                <i class="fa-solid fa-angle-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ================= 4. KELOMPOK KERJA (POKJA) ================= -->
    <section id="pokja" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Judul Section -->
            <div class="text-center max-w-2xl mx-auto mb-12">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
                    Kelompok Kerja TP. PKK
                </h2>
                <p class="text-sm sm:text-base text-gray-600">
                    Kenali kelompok kerja dan bidang-bidang sektor TP. PKK Desa Karangtanjung.
                </p>
            </div>

            <!-- Grid 4 Kartu Pokja -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 items-stretch">
                @foreach ($pokja as $pk)
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition-all duration-200 flex flex-col justify-between">
                        <div>
                            <!-- Badge Pokja -->
                            <div class="flex items-center justify-between mb-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                    {{ $pk['kode'] }}
                                </span>
                                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-lg">
                                    <i class="{{ $pk['icon'] }}"></i>
                                </div>
                            </div>

                            <!-- Nama Pokja -->
                            <h3 class="font-bold text-gray-900 text-base leading-snug mb-3">
                                {{ $pk['nama'] }}
                            </h3>

                            <!-- Deskripsi Singkat Pokja -->
                            <p class="text-xs sm:text-sm text-gray-500 leading-relaxed mb-6">
                                {{ $pk['deskripsi'] }}
                            </p>
                        </div>

                        <!-- Tombol Aksi -->
                        <a href="#" class="inline-flex items-center justify-center gap-2 w-full py-2.5 px-4 rounded-xl text-xs sm:text-sm font-semibold text-emerald-700 border border-emerald-300 hover:bg-emerald-600 hover:text-white hover:border-emerald-600 transition-all duration-200">
                            <span>Lihat Kerja</span>
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ================= 5. GALERI KEGIATAN ================= -->
    <section id="galeri" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Judul Section -->
            <div class="text-center max-w-2xl mx-auto mb-12">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
                    Galeri Kegiatan
                </h2>
                <p class="text-sm sm:text-base text-gray-600">
                    Dokumentasi kegiatan dan momen kebersamaan TP. PKK Desa Karangtanjung.
                </p>
            </div>

            <!-- Grid 6 Foto / Dokumentasi -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                @foreach ($galeri as $item)
                    <div class="group relative rounded-2xl overflow-hidden border border-gray-100 shadow-sm bg-gray-50 aspect-video flex flex-col items-center justify-center p-6 hover:shadow-md transition-all duration-200">
                        <!-- Icon Placeholder Foto -->
                        <div class="w-16 h-16 rounded-2xl {{ $item['bg'] }} flex items-center justify-center text-2xl mb-3 group-hover:scale-110 transition-transform duration-200">
                            <i class="{{ $item['icon'] }}"></i>
                        </div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">
                            {{ $item['tag'] }}
                        </span>
                        <h4 class="text-sm font-bold text-gray-800 text-center px-4">
                            {{ $item['judul'] }}
                        </h4>

                        <!-- Overlay Hover -->
                        <div class="absolute inset-0 bg-emerald-900/60 opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center text-white">
                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-white/20 backdrop-blur-md text-xs font-semibold">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <span>Lihat Dokumentasi</span>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Tombol Lihat Semua Foto -->
            <div class="text-center">
                <a href="#" class="inline-flex items-center gap-2 px-7 py-3 rounded-xl font-semibold text-white bg-emerald-700 hover:bg-emerald-800 shadow-md hover:shadow-lg transition-all duration-200">
                    <i class="fa-solid fa-images"></i>
                    <span>Lihat Semua Foto</span>
                </a>
            </div>
        </div>
    </section>

@endsection
