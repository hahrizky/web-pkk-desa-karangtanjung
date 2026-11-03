@extends('layouts.app')

@section('title', 'Beranda — TP. PKK Desa Karangtanjung')

@section('content')

    <!-- ================= 1. HERO SECTION ================= -->
    <section id="beranda" class="relative min-h-[540px] lg:min-h-[600px] flex items-center justify-center overflow-hidden bg-emerald-950">
        <!-- Foto Dokumentasi PKK -->
        <img src="{{ asset('images/5.webp') }}"
             alt="Dokumentasi TP. PKK Desa Karangtanjung"
             class="absolute inset-0 w-full h-full object-cover object-top filter brightness-[0.55] contrast-[1.05]">

        <!-- Overlay Gradasi Emerald -->
        <div class="absolute inset-0 bg-gradient-to-b from-emerald-950/80 via-emerald-900/60 to-emerald-950/90"></div>

        <!-- Konten Utama Hero -->
        <div class="relative z-10 w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 text-center">
            
            <span class="inline-block px-3.5 py-1 rounded-full text-xs font-semibold uppercase tracking-wider text-emerald-200 bg-white/10 backdrop-blur-md border border-white/20 mb-4">
                Pemberdayaan Kesejahteraan Keluarga
            </span>

            <!-- Judul Utama -->
            <h1 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight sm:leading-tight mb-4 drop-shadow-md">
                Pusat Informasi &amp; Kegiatan<br>
                <span class="text-amber-400">TP. PKK Desa Karangtanjung</span>
            </h1>

            <!-- Deskripsi Singkat & Membumi -->
            <p class="text-sm sm:text-base lg:text-lg text-emerald-100/90 max-w-3xl mx-auto mb-8 leading-relaxed drop-shadow">
                Wadah informasi resmi seputar kegiatan posyandu balita &amp; lansia, pembinaan dasawisma, pelatihan ekonomi keluarga, dan gotong royong warga di lingkungan Desa Karangtanjung, Candi, Sidoarjo.
            </p>

            <!-- Tombol Aksi (CTA) Tersambung Penuh -->
            <div class="flex flex-wrap items-center justify-center gap-3.5">
                <a href="{{ route('informasi.index') }}" 
                   class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-sm text-white bg-emerald-600 hover:bg-emerald-700 shadow-lg shadow-emerald-950/40 transition-all duration-200 hover:-translate-y-0.5">
                    <i class="fa-solid fa-calendar-days text-sm"></i>
                    <span>Jadwal &amp; Kegiatan PKK</span>
                </a>
                <a href="{{ route('pokja') }}" 
                   class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-sm text-white bg-white/15 hover:bg-white hover:text-emerald-900 border border-white/30 backdrop-blur-md shadow-lg transition-all duration-200 hover:-translate-y-0.5">
                    <i class="fa-solid fa-layer-group text-sm"></i>
                    <span>Program Pokja</span>
                </a>
            </div>
        </div>
    </section>

    <!-- ================= 2. DATA STATISTIK KEGIATAN PKK ================= -->
    <section class="py-14 bg-gray-50 border-b border-gray-100">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Judul Section -->
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-xs font-bold text-[#075B3C] uppercase tracking-wider block mb-1">
                    CAPAIAN &amp; BASIS DATA PKK
                </span>
                <h2 class="text-xl sm:text-2xl font-bold text-gray-900">
                    Data Penggerak Kegiatan Desa
                </h2>
                <p class="text-xs sm:text-sm text-gray-500 mt-1">
                    Cakupan kegiatan kader dan posyandu yang menjangkau seluruh keluarga di Desa Karangtanjung.
                </p>
            </div>

            <!-- Grid 3 Kartu Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                @foreach ($statistik as $item)
                    <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100 hover:shadow-md hover:-translate-y-1 transition-all duration-200">
                        <div class="flex items-start gap-4">
                            <!-- Icon Box -->
                            @if ($item['warna'] == 'green')
                                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl flex-shrink-0">
                                    <i class="{{ $item['icon'] }}"></i>
                                </div>
                            @elseif ($item['warna'] == 'orange')
                                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center text-xl flex-shrink-0">
                                    <i class="{{ $item['icon'] }}"></i>
                                </div>
                            @else
                                <div class="w-12 h-12 rounded-xl bg-sky-50 text-sky-700 flex items-center justify-center text-xl flex-shrink-0">
                                    <i class="{{ $item['icon'] }}"></i>
                                </div>
                            @endif

                            <!-- Keterangan Angka -->
                            <div class="flex-1 min-w-0">
                                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">
                                    {{ $item['judul'] }}
                                </span>
                                <span class="block text-3xl font-extrabold @if($item['warna'] == 'green') text-emerald-700 @elseif($item['warna'] == 'orange') text-amber-600 @else text-sky-600 @endif mb-1">
                                    {{ $item['nilai'] }}
                                </span>
                                <p class="text-xs text-gray-500 leading-relaxed">
                                    {{ $item['deskripsi'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ================= 3. KEGIATAN PKK TERBARU ================= -->
    <section id="kegiatan" class="py-14 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 gap-3">
                <div>
                    <span class="text-xs font-bold text-[#075B3C] uppercase tracking-wider block mb-1">
                        DOKUMENTASI TERKINI
                    </span>
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900">
                        Kegiatan Terbaru TP. PKK
                    </h2>
                    <p class="text-xs sm:text-sm text-gray-500 mt-1">
                        Dokumentasi pelaksanaan program pemberdayaan dan pelayanan masyarakat desa.
                    </p>
                </div>
                <div>
                    <a href="{{ route('informasi.index') }}" 
                       class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-[#075B3C] hover:text-emerald-700 transition-colors">
                        <span>Lihat Semua Kegiatan</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- Grid 4 Kartu Kegiatan -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach ($kegiatan as $kg)
                    <article class="bg-white rounded-2xl overflow-hidden border border-gray-200/80 shadow-xs hover:shadow-md hover:border-[#116B46]/50 hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                        
                        <!-- Gambar Kegiatan -->
                        <div class="h-44 overflow-hidden relative bg-gray-100 border-b border-gray-100">
                            <img src="{{ asset('images/' . $kg['gambar']) }}" 
                                 alt="{{ $kg['judul'] }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            
                            <span class="absolute top-3 left-3 text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full {{ $kg['badge_color'] }} shadow-xs">
                                {{ $kg['kategori'] }}
                            </span>
                        </div>

                        <!-- Konten Kartu -->
                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <div>
                                <!-- Tanggal -->
                                <div class="flex items-center gap-1.5 text-xs text-gray-500 mb-2">
                                    <i class="fa-regular fa-calendar text-[#116B46] text-xs"></i>
                                    <span>{{ $kg['tanggal'] }}</span>
                                </div>

                                <!-- Judul Kegiatan -->
                                <h3 class="font-bold text-gray-900 text-sm sm:text-[15px] leading-snug mb-2 group-hover:text-[#075B3C] transition-colors line-clamp-2">
                                    <a href="{{ route('informasi.show', $kg['id']) }}">
                                        {{ $kg['judul'] }}
                                    </a>
                                </h3>

                                <!-- Cuplikan -->
                                <p class="text-xs text-gray-500 leading-relaxed line-clamp-3 mb-4">
                                    {{ $kg['ringkasan'] }}
                                </p>
                            </div>

                            <!-- Tombol Selengkapnya Nyambung ke Detail -->
                            <a href="{{ route('informasi.show', $kg['id']) }}" 
                               class="inline-flex items-center justify-center gap-1.5 w-full py-2 px-3 rounded-xl text-xs font-bold text-[#075B3C] bg-emerald-50 hover:bg-[#075B3C] hover:text-white transition-all duration-200">
                                <span>Baca Selengkapnya</span>
                                <i class="fa-solid fa-angle-right text-xs"></i>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ================= 4. KELOMPOK KERJA (POKJA) ================= -->
    <section id="pokja" class="py-14 bg-[#F3FBF6] border-t border-[#E2E8F0]">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Judul Section -->
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-xs font-bold text-[#075B3C] uppercase tracking-wider block mb-1">
                    BIDANG KERJA
                </span>
                <h2 class="text-xl sm:text-2xl font-bold text-gray-900">
                    4 Kelompok Kerja (Pokja) PKK
                </h2>
                <p class="text-xs sm:text-sm text-gray-500 mt-1">
                    Setiap Pokja mengemban tugas spesifik untuk melayani dan memberdayakan warga desa.
                </p>
            </div>

            <!-- Grid 4 Kartu Pokja -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach ($pokja as $pk)
                    <div class="bg-white rounded-2xl p-5 shadow-xs border border-gray-100 hover:shadow-md hover:border-[#116B46]/40 hover:-translate-y-1 transition-all duration-200 flex flex-col justify-between">
                        <div>
                            <!-- Header Kartu -->
                            <div class="flex items-center justify-between mb-3">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-emerald-50 text-[#075B3C] border border-[#075B3C]/20">
                                    {{ $pk['kode'] }}
                                </span>
                                <div class="w-9 h-9 rounded-xl bg-emerald-50 text-[#075B3C] flex items-center justify-center text-sm">
                                    <i class="{{ $pk['icon'] }}"></i>
                                </div>
                            </div>

                            <!-- Nama Pokja -->
                            <h3 class="font-bold text-gray-900 text-sm sm:text-base leading-snug mb-2">
                                {{ $pk['nama'] }}
                            </h3>

                            <!-- Deskripsi -->
                            <p class="text-xs text-gray-500 leading-relaxed mb-5">
                                {{ $pk['deskripsi'] }}
                            </p>
                        </div>

                        <!-- Tombol Langsung ke Filter Kegiatan Pokja -->
                        <div class="pt-3 border-t border-gray-100 space-y-2">
                            <a href="{{ route('informasi.index', ['kategori' => $pk['kategori_filter']]) }}" 
                               class="inline-flex items-center justify-center gap-1.5 w-full py-2 px-3 rounded-xl text-xs font-bold text-white bg-[#075B3C] hover:bg-[#116B46] transition-all">
                                <span>Lihat Kegiatan {{ $pk['kode'] }}</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Tombol Rincian Program Pokja -->
            <div class="mt-8 text-center">
                <a href="{{ route('pokja') }}" 
                   class="inline-flex items-center gap-2 text-xs sm:text-sm font-bold text-[#075B3C] hover:underline">
                    <span>Lihat Rincian Seluruh Program Kerja Pokja I – IV</span>
                    <i class="fa-solid fa-angle-right text-xs"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- ================= 5. DOKUMENTASI KEGIATAN KADER ================= -->
    <section class="py-14 bg-white border-t border-gray-100">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Judul Section -->
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-xs font-bold text-[#075B3C] uppercase tracking-wider block mb-1">
                    GALERI AKTIVITAS
                </span>
                <h2 class="text-xl sm:text-2xl font-bold text-gray-900">
                    Aktivitas &amp; Pelayanan Kader
                </h2>
                <p class="text-xs sm:text-sm text-gray-500 mt-1">
                    Dokumentasi nyata peran aktif kader PKK di posyandu, pertemuan dasawisma, dan pelatihan desa.
                </p>
            </div>

            <!-- Grid 6 Foto / Dokumentasi -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-8">
                @foreach ($galeri as $item)
                    <div class="group relative rounded-2xl overflow-hidden border border-gray-200/80 shadow-xs bg-gray-100 aspect-video flex flex-col justify-end">
                        <img src="{{ asset('images/' . $item['gambar']) }}" 
                             alt="{{ $item['judul'] }}"
                             class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/40 to-transparent"></div>

                        <!-- Info Teks di atas Foto -->
                        <div class="relative z-10 p-4">
                            <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-white/20 backdrop-blur-md text-emerald-200 mb-1">
                                {{ $item['tag'] }}
                            </span>
                            <h4 class="text-xs sm:text-sm font-bold text-white leading-snug">
                                {{ $item['judul'] }}
                            </h4>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Tombol Aksi Menuju Pusat Informasi & Agenda -->
            <div class="text-center">
                <a href="{{ route('informasi.index') }}" 
                   class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-xs sm:text-sm text-white bg-[#075B3C] hover:bg-[#116B46] shadow-sm transition-all duration-200">
                    <i class="fa-solid fa-bullhorn text-xs"></i>
                    <span>Buka Pusat Informasi, Berita &amp; Agenda PKK</span>
                </a>
            </div>
        </div>
    </section>

@endsection
