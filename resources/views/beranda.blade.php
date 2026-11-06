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
                    Kegiatan Terkini PKK
                </h2>
                <p class="text-sm sm:text-base text-gray-600">
                    Informasi terbaru mengenai kegiatan dan program TP. PKK Desa Karangtanjung.
                </p>
            </div>

            <div>
                <a href="{{ route('informasi.index') }}" class="hidden sm:inline-flex items-center gap-1.5 text-sm font-semibold text-emerald-700 hover:text-emerald-800 transition-colors">
                    <span>Lihat semua kegiatan</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>

        <!-- Area Carousel Slider dengan Tombol Navigasi Kiri & Kanan di Samping -->
        <div class="relative px-0 sm:px-6 lg:px-8 group/carousel">
            <!-- Tombol Navigasi Kiri (Previous) - Vertikal di Tengah Kartu (Hanya muncul di Tablet & Desktop) -->
            <button type="button"
                id="btn-slide-left"
                aria-label="Geser ke kiri"
                class="hidden sm:flex absolute -left-4 sm:-left-6 lg:-left-7 top-1/2 -translate-y-1/2 z-20 w-11 h-11 sm:w-12 sm:h-12 rounded-full border border-gray-200 bg-white hover:bg-emerald-600 text-gray-700 hover:text-white hover:border-emerald-600 active:scale-95 items-center justify-center transition-all duration-200 shadow-lg hover:shadow-xl cursor-pointer">
                <i class="fa-solid fa-chevron-left text-sm sm:text-base"></i>
            </button>

            <!-- Carousel Slider Kartu Kegiatan -->
            <div id="kegiatan-slider"
                class="flex gap-6 overflow-x-auto scroll-smooth snap-x snap-mandatory py-2 px-1 no-scrollbar"
                style="scrollbar-width: none; -ms-overflow-style: none;">
                @foreach ($kegiatan as $kg)
                <div class="snap-start flex-shrink-0 w-[85%] sm:w-[calc(50%-12px)] lg:w-[calc(25%-18px)] group self-stretch h-[490px] bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col">

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
                            <h3 class="font-bold text-gray-900 text-base leading-snug mb-2 min-h-[3rem] line-clamp-2 group-hover:text-emerald-700 transition-colors">
                                <a href="{{ route('informasi.show', $kg['id']) }}">{{ $kg['judul'] }}</a>
                            </h3>

                            <!-- Cuplikan Deskripsi -->
                            <p class="text-xs sm:text-sm text-gray-500 leading-relaxed min-h-[5rem] line-clamp-5 mb-4">
                                {{ $kg['ringkasan'] }}
                            </p>
                        </div>

                        <!-- Tombol Selengkapnya -->
                        <a href="{{ route('informasi.show', $kg['id']) }}" class="mt-auto inline-flex items-center justify-center gap-2 w-full py-2.5 px-4 rounded-xl text-xs sm:text-sm font-semibold text-emerald-700 bg-emerald-50 hover:bg-emerald-600 hover:text-white active:scale-95 transition-all duration-200">
                            <span>Selengkapnya</span>
                            <i class="fa-solid fa-angle-right text-xs"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Tombol Navigasi Kanan (Next) - Vertikal di Tengah Kartu (Hanya muncul di Tablet & Desktop) -->
            <button
                type="button"
                id="btn-slide-right"
                aria-label="Geser ke kanan"
                class="hidden sm:flex absolute -right-4 sm:-right-6 lg:-right-7 top-1/2 -translate-y-1/2 z-20 w-11 h-11 sm:w-12 sm:h-12 rounded-full border border-gray-200 bg-white hover:bg-emerald-600 text-gray-700 hover:text-white hover:border-emerald-600 active:scale-95 items-center justify-center transition-all duration-200 shadow-lg hover:shadow-xl cursor-pointer">
                <i class="fa-solid fa-chevron-right text-sm sm:text-base"></i>
            </button>
        </div>

        <!-- Link Mobile untuk Lihat Semua Kegiatan -->
        <div class="mt-4 text-center sm:hidden">
            <a href="{{ route('informasi.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-emerald-700 hover:text-emerald-800 transition-colors">
                <span>Lihat semua kegiatan</span>
                <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
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
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 items-stretch mb-10">
            @foreach ($pokja as $pk)
            <div class="bg-white rounded-2xl p-7 min-h-[300px] sm:min-h-[340px] shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition-all duration-200 flex flex-col justify-between">
                <div>
                    <!-- Badge Pokja -->
                    <div class="flex items-center justify-between mb-5">
                        <span class="px-3.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                            {{ $pk['kode'] }}
                        </span>
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl shadow-xs">
                            <i class="{{ $pk['icon'] }}"></i>
                        </div>
                    </div>

                    <!-- Nama Pokja -->
                    <h3 class="font-bold text-gray-900 text-base sm:text-lg leading-snug mb-5 h-[5rem]">
                        {{ $pk['nama'] }}
                    </h3>

                    <!-- Deskripsi Singkat Pokja -->
                    <p class="text-xs sm:text-sm text-gray-500 leading-relaxed">
                        {{ $pk['deskripsi'] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Tombol Menuju Halaman Pokja -->
        <div class="text-center">
            <a href="{{ route('pokja') }}" class="inline-flex items-center gap-2 px-7 py-3 rounded-xl font-semibold text-white bg-emerald-700 hover:bg-emerald-800 shadow-md hover:shadow-lg hover:-translate-y-0.5 active:scale-95 transition-all duration-200">
                <i class="fa-solid fa-users-gear text-sm"></i>
                <span>Pelajari Selengkapnya Tentang Pokja</span>
                <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>
    </div>
</section>

<!-- ================= 5. GALERI KEGIATAN ================= -->
<section id="galeri" class="py-16 bg-[#F3FBF6] border-t border-[#E2E8F0]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Judul Section -->
        <div class="text-center max-w-2xl mx-auto mb-10">

            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#1F2937] tracking-tight">
                Galeri Foto Kegiatan PKK
            </h2>
            <p class="text-xs sm:text-sm text-[#475569] mt-2">
                Kumpulan dokumentasi foto dari seluruh kegiatan dan program kerja TP. PKK Desa Karangtanjung.
            </p>
        </div>

        <!-- Grid Murni Foto Kegiatan dari Berita (2 Kolom Mobile, 3 Kolom Tablet, 4 Kolom Desktop) -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 sm:gap-4 lg:gap-5 mb-10">
            @foreach ($galeri as $index => $foto)
            <div class="group relative aspect-square rounded-2xl overflow-hidden bg-gray-900 shadow-xs hover:shadow-xl transition-all duration-300 cursor-pointer"
                 onclick="openGaleriModal({{ $index }})"
                 title="{{ $foto['judul'] }}">
                <!-- Foto Murni -->
                <img src="{{ asset('images/' . $foto['gambar']) }}"
                    alt="{{ $foto['judul'] }}"
                    loading="lazy"
                    class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-500 ease-out">

                <!-- Overlay Gradient Halus saat Hover -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-3 sm:p-4 z-10">
                    <!-- Badge Kategori -->
                    <span class="inline-block px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider text-white bg-[#075B3C]/90 backdrop-blur-sm self-start mb-1.5">
                        {{ $foto['kategori'] }}
                    </span>
                    <!-- Judul Foto Ringkas -->
                    <p class="text-xs sm:text-sm font-bold text-white line-clamp-2 leading-snug drop-shadow-sm">
                        {{ $foto['judul'] }}
                    </p>
                    <span class="text-[10px] text-emerald-200 mt-1 flex items-center gap-1">
                        <i class="fa-regular fa-calendar-days text-[9px]"></i>
                        {{ $foto['tanggal'] }}
                    </span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ================= MODAL LIGHTBOX PREVIEW FOTO ================= -->
<div id="galeri-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-3 sm:p-6 bg-black/85 backdrop-blur-sm transition-opacity duration-300" aria-modal="true" role="dialog">
    <!-- Area Klik Luar untuk Menutup -->
    <div class="absolute inset-0" onclick="closeGaleriModal()"></div>

    <!-- Kontainer Modal -->
    <div class="relative bg-white rounded-2xl shadow-2xl max-w-4xl w-full overflow-hidden z-10 max-h-[92vh] flex flex-col animate-fadeIn">
        
        <!-- Header Modal Ringkas -->
        <div class="flex items-center justify-between px-4 sm:px-6 py-3 border-b border-gray-100 bg-white">
            <div class="flex items-center gap-2">
                <span id="modal-kategori-badge" class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-[#166534] text-white">
                    Kategori
                </span>
                <span id="modal-counter" class="text-xs text-gray-400 font-semibold">1 / {{ count($galeri) }}</span>
            </div>

            <div class="flex items-center gap-2">
                <button type="button"
                        onclick="closeGaleriModal()"
                        class="w-8 h-8 rounded-full bg-gray-100 hover:bg-red-50 hover:text-red-600 text-gray-600 flex items-center justify-center text-sm transition-colors"
                        aria-label="Tutup Preview">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </div>

        <!-- Gambar Ukuran Besar & Navigasi -->
        <div class="relative bg-black flex items-center justify-center flex-1 min-h-[260px] sm:min-h-[420px] max-h-[65vh] overflow-hidden select-none">
            <img id="modal-img" src="" alt="" class="max-w-full max-h-[65vh] w-auto h-auto object-contain">

            <!-- Tombol Prev -->
            <button type="button"
                    onclick="prevGaleriModal()"
                    class="absolute left-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-black/50 hover:bg-black/80 text-white flex items-center justify-center text-sm backdrop-blur-md transition-all active:scale-95 shadow-md"
                    aria-label="Foto Sebelumnya">
                <i class="fa-solid fa-chevron-left"></i>
            </button>

            <!-- Tombol Next -->
            <button type="button"
                    onclick="nextGaleriModal()"
                    class="absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-black/50 hover:bg-black/80 text-white flex items-center justify-center text-sm backdrop-blur-md transition-all active:scale-95 shadow-md"
                    aria-label="Foto Selanjutnya">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>

        <!-- Keterangan Judul Foto Singkat di Bawah -->
        <div class="px-5 py-3.5 bg-white border-t border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <h3 id="modal-judul" class="text-sm sm:text-base font-bold text-gray-900 leading-snug">
                Judul Kegiatan
            </h3>
            <span id="modal-tanggal" class="text-xs text-gray-400 font-medium whitespace-nowrap">
                Tanggal
            </span>
        </div>

    </div>
</div>

<!-- Script Geser Carousel Slider Berita Kegiatan & Lightbox Galeri -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.getElementById('kegiatan-slider');
        const btnLeft = document.getElementById('btn-slide-left');
        const btnRight = document.getElementById('btn-slide-right');

        if (slider && btnLeft && btnRight) {
            btnLeft.addEventListener('click', function() {
                const cardWidth = slider.querySelector('.snap-start') ? slider.querySelector('.snap-start').offsetWidth + 24 : 300;
                slider.scrollBy({
                    left: -cardWidth,
                    behavior: 'smooth'
                });
            });

            btnRight.addEventListener('click', function() {
                const cardWidth = slider.querySelector('.snap-start') ? slider.querySelector('.snap-start').offsetWidth + 24 : 300;
                slider.scrollBy({
                    left: cardWidth,
                    behavior: 'smooth'
                });
            });
        }
    });

    // ================= JAVASCRIPT MODAL GALERI FOTO =================
    const galeriData = @json($galeri);
    let currentModalIndex = 0;

    function openGaleriModal(index) {
        currentModalIndex = index;
        updateModalContent();
        const modal = document.getElementById('galeri-modal');
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeGaleriModal() {
        const modal = document.getElementById('galeri-modal');
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }

    function updateModalContent() {
        const data = galeriData[currentModalIndex];
        if (!data) return;

        const assetUrl = "{{ asset('images') }}/" + data.gambar;
        document.getElementById('modal-img').src = assetUrl;
        document.getElementById('modal-img').alt = data.judul;

        document.getElementById('modal-kategori-badge').textContent = data.kategori;
        document.getElementById('modal-counter').textContent = (currentModalIndex + 1) + ' / ' + galeriData.length;
        document.getElementById('modal-tanggal').textContent = data.tanggal;
        document.getElementById('modal-judul').textContent = data.judul;
    }

    function nextGaleriModal() {
        currentModalIndex = (currentModalIndex + 1) % galeriData.length;
        updateModalContent();
    }

    function prevGaleriModal() {
        currentModalIndex = (currentModalIndex - 1 + galeriData.length) % galeriData.length;
        updateModalContent();
    }

    // Keyboard Shortcuts (Esc, Panah Kiri, Panah Kanan)
    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('galeri-modal');
        if (!modal || modal.classList.contains('hidden')) return;

        if (e.key === 'Escape') {
            closeGaleriModal();
        } else if (e.key === 'ArrowRight') {
            nextGaleriModal();
        } else if (e.key === 'ArrowLeft') {
            prevGaleriModal();
        }
    });
</script>

@endsection