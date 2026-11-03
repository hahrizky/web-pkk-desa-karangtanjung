@extends('layouts.app')

@section('title', 'Pengumuman & Informasi Penting — TP. PKK Desa Karangtanjung')

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
                <span class="text-[#075B3C] font-semibold">Pengumuman</span>
            </nav>

            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <span class="block text-xs sm:text-sm font-black tracking-widest text-[#075B3C] uppercase mb-1">
                        INFORMASI TERKINI &amp; PENGUMUMAN
                    </span>
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#075B3C] tracking-tight leading-tight">
                        Pengumuman &amp; Informasi Penting TP. PKK
                    </h1>
                    <p class="text-xs sm:text-sm text-[#475569] leading-relaxed max-w-3xl mt-2">
                        Pemberitahuan resmi mengenai kegiatan kader, pelayanan masyarakat posyandu, bimbingan program kerja pokja, dan pengumuman desa.
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

    <!-- ================= DAFTAR LENGKAP PENGUMUMAN ================= -->
    <section class="py-12 bg-[#F3FBF6]">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Banner Catatan Data Contoh -->
            <div class="mb-8 p-4 rounded-xl bg-amber-50 border border-amber-200 flex items-start gap-3">
                <i class="fa-solid fa-circle-exclamation text-amber-600 text-base mt-0.5"></i>
                <div class="text-xs sm:text-sm text-amber-800 leading-relaxed">
                    <strong class="font-semibold">Catatan Pengembangan:</strong> Seluruh tanggal dan materi pengumuman di bawah ini merupakan data contoh untuk keperluan desain dan pengembangan website, bukan pengumuman resmi dari Pemerintah Desa Karangtanjung.
                </div>
            </div>

            <!-- Grid 2 Kolom (Kiri: Daftar Pengumuman 65%, Kanan: Panel Info Penting 35%) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                <!-- KOLOM KIRI (Daftar Pengumuman) -->
                <div class="lg:col-span-8 space-y-4">
                    @foreach($pengumumans as $p)
                        <article class="bg-white rounded-xl border border-[#E2E8F0] p-5 sm:p-6 shadow-sm hover:shadow-md hover:border-[#116B46]/50 transition-all duration-200 flex flex-col sm:flex-row gap-4 items-start group">
                            
                            <!-- Ikon Pengumuman -->
                            <div class="w-12 h-12 rounded-xl {{ $p['icon_bg'] }} {{ $p['icon_color'] }} flex items-center justify-center text-lg flex-shrink-0 shadow-xs">
                                <i class="{{ $p['icon'] }}"></i>
                            </div>

                            <!-- Detail Konten -->
                            <div class="flex-1 min-w-0">
                                <div class="flex flex-wrap items-center gap-2 mb-2">
                                    <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider border {{ $p['badge_color'] }}">
                                        {{ $p['kategori'] }}
                                    </span>
                                    <span class="text-xs text-gray-500 flex items-center gap-1.5">
                                        <i class="fa-regular fa-calendar-days text-[#116B46] text-xs"></i>
                                        {{ $p['tanggal'] }}
                                    </span>
                                </div>

                                <h2 class="text-base sm:text-lg font-bold text-[#1F2937] group-hover:text-[#075B3C] transition-colors leading-snug mb-2">
                                    <a href="{{ route('informasi.pengumuman.show', $p['id']) }}">
                                        {{ $p['judul'] }}
                                    </a>
                                </h2>

                                <p class="text-xs sm:text-sm text-[#475569] leading-relaxed mb-4">
                                    {{ $p['deskripsi'] }}
                                </p>

                                <div class="flex items-center justify-between pt-2 border-t border-gray-100 text-xs">
                                    <span class="text-gray-400 italic">
                                        Oleh: {{ $p['penulis'] }}
                                    </span>
                                    <a href="{{ route('informasi.pengumuman.show', $p['id']) }}"
                                       class="font-bold text-[#075B3C] group-hover:text-[#116B46] transition-colors inline-flex items-center gap-1">
                                        <span>Baca selengkapnya</span>
                                        <span>&rarr;</span>
                                    </a>
                                </div>
                            </div>

                        </article>
                    @endforeach

                    <!-- Tombol Kembali Bawah -->
                    <div class="pt-4">
                        <a href="{{ route('informasi.index') }}"
                           class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-xs sm:text-sm font-bold text-white bg-[#075B3C] hover:bg-[#116B46] transition-all shadow-sm">
                            <i class="fa-solid fa-arrow-left text-xs"></i>
                            <span>Kembali ke Halaman Informasi</span>
                        </a>
                    </div>
                </div>

                <!-- KOLOM KANAN (Panel Informasi Penting) -->
                <div class="lg:col-span-4">
                    <div class="bg-white rounded-2xl border border-[#E2E8F0] shadow-sm p-6 sticky top-24">
                        
                        <div class="flex items-center gap-2.5 mb-2">
                            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-[#075B3C] flex items-center justify-center text-sm">
                                <i class="fa-solid fa-bullhorn"></i>
                            </div>
                            <h3 class="text-base sm:text-lg font-bold text-[#1F2937]">
                                Informasi Penting
                            </h3>
                        </div>

                        <p class="text-xs text-[#64748B] leading-relaxed mb-4 pb-3 border-b border-gray-100">
                            Beberapa informasi yang perlu diperhatikan oleh kader dan masyarakat.
                        </p>

                        <div class="space-y-3.5">
                            @foreach($infoPenting as $info)
                                <div class="flex items-start gap-3 pb-3.5 border-b border-gray-100 last:border-b-0 last:pb-0">
                                    <div class="w-7 h-7 rounded-lg bg-emerald-50 text-[#075B3C] flex items-center justify-center text-xs flex-shrink-0 mt-0.5">
                                        <i class="{{ $info['icon'] }}"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-xs sm:text-sm font-bold text-[#1F2937] leading-snug">
                                            {{ $info['judul'] }}
                                        </h4>
                                        <p class="text-[11px] sm:text-xs text-[#64748B] leading-relaxed mt-0.5">
                                            {{ $info['deskripsi'] }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Kotak Informasi Layanan Kader -->
                        <div class="mt-6 pt-4 border-t border-gray-100 bg-[#E8F7EF]/60 rounded-xl p-3.5 border border-[#075B3C]/15">
                            <div class="flex items-start gap-2.5">
                                <i class="fa-solid fa-circle-info text-[#075B3C] text-sm mt-0.5"></i>
                                <div>
                                    <span class="block text-xs font-bold text-[#075B3C]">Sekretariat PKK Desa</span>
                                    <p class="text-[11px] text-[#475569] leading-relaxed mt-0.5">
                                        Pemberitahuan tertulis dan formulir kegiatan dapat dikoordinasikan langsung ke kantor Balai Desa Karangtanjung.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection

