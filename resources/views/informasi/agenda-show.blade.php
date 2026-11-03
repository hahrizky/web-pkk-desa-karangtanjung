@extends('layouts.app')

@section('title', $agenda['judul'] . ' — Agenda TP. PKK Desa Karangtanjung')

@section('content')

    <!-- ================= BREADCRUMB & HEADER ================= -->
    <div class="bg-[#E8F7EF] py-6 border-b border-[#D1D5DB]/50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-xs sm:text-sm text-gray-500 mb-3" aria-label="Breadcrumb">
                <a href="{{ route('beranda') }}" class="hover:text-[#075B3C] transition-colors">Beranda</a>
                <span class="text-gray-400">/</span>
                <a href="{{ route('informasi.index') }}" class="hover:text-[#075B3C] transition-colors">Informasi</a>
                <span class="text-gray-400">/</span>
                <a href="{{ route('informasi.agenda.index') }}" class="hover:text-[#075B3C] transition-colors">Agenda</a>
                <span class="text-gray-400">/</span>
                <span class="text-[#075B3C] font-semibold truncate max-w-[200px] sm:max-w-xs">{{ $agenda['judul'] }}</span>
            </nav>

            <div class="flex flex-wrap items-center gap-2.5">
                <span class="px-3 py-0.5 rounded-full text-xs font-semibold {{ $agenda['badge_color'] }} border shadow-xs">
                    {{ $agenda['kategori'] }}
                </span>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600 border border-gray-200">
                    {{ $agenda['status'] }}
                </span>
                <span class="text-xs text-gray-600 flex items-center gap-1.5 ml-1">
                    <i class="fa-regular fa-calendar-days text-[#116B46]"></i>
                    {{ $agenda['hari'] }}, {{ $agenda['tanggal_lengkap'] }}
                </span>
            </div>
        </div>
    </div>

    <!-- ================= KONTEN UTAMA DETAIL AGENDA ================= -->
    <article class="py-10 sm:py-14 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Judul Utama Kegiatan -->
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#1F2937] leading-tight mb-6">
                {{ $agenda['judul'] }}
            </h1>

            <!-- Kotak Ringkasan Jadwal & Lokasi Pelaksanaan -->
            <div class="bg-[#F8FAFC] border border-[#E2E8F0] rounded-2xl p-5 sm:p-6 mb-8 shadow-xs">
                <h2 class="text-sm font-bold text-[#075B3C] uppercase tracking-wider mb-4 flex items-center gap-2">
                    <i class="fa-regular fa-calendar-check"></i>
                    <span>Informasi Pelaksanaan Kegiatan</span>
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs sm:text-sm">
                    <div class="flex items-start gap-3 bg-white p-3.5 rounded-xl border border-gray-100">
                        <div class="w-9 h-9 rounded-lg bg-emerald-50 text-[#075B3C] flex items-center justify-center text-sm flex-shrink-0">
                            <i class="fa-regular fa-calendar"></i>
                        </div>
                        <div>
                            <span class="block text-gray-400 text-[11px] uppercase tracking-wider">Hari &amp; Tanggal</span>
                            <strong class="text-gray-800 font-semibold">{{ $agenda['hari'] }}, {{ $agenda['tanggal_lengkap'] }}</strong>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 bg-white p-3.5 rounded-xl border border-gray-100">
                        <div class="w-9 h-9 rounded-lg bg-emerald-50 text-[#075B3C] flex items-center justify-center text-sm flex-shrink-0">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                        <div>
                            <span class="block text-gray-400 text-[11px] uppercase tracking-wider">Waktu Pelaksanaan</span>
                            <strong class="text-gray-800 font-semibold">{{ $agenda['waktu'] }}</strong>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 bg-white p-3.5 rounded-xl border border-gray-100">
                        <div class="w-9 h-9 rounded-lg bg-emerald-50 text-[#075B3C] flex items-center justify-center text-sm flex-shrink-0">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <span class="block text-gray-400 text-[11px] uppercase tracking-wider">Lokasi / Tempat</span>
                            <strong class="text-gray-800 font-semibold">{{ $agenda['lokasi'] }}</strong>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 bg-white p-3.5 rounded-xl border border-gray-100">
                        <div class="w-9 h-9 rounded-lg bg-emerald-50 text-[#075B3C] flex items-center justify-center text-sm flex-shrink-0">
                            <i class="fa-solid fa-user-group"></i>
                        </div>
                        <div>
                            <span class="block text-gray-400 text-[11px] uppercase tracking-wider">Penyelenggara</span>
                            <strong class="text-gray-800 font-semibold">{{ $agenda['penyelenggara'] }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deskripsi Lengkap & Narasi Pelaksanaan -->
            <div class="prose max-w-none text-[#1F2937] leading-relaxed space-y-4 text-sm sm:text-base mb-8">
                <p class="font-medium text-base sm:text-lg text-gray-700 leading-relaxed border-l-4 border-[#075B3C] pl-4 italic bg-[#F3FBF6] py-3.5 rounded-r-xl">
                    {{ $agenda['deskripsi'] }}
                </p>

                <h3 class="text-lg font-bold text-[#1F2937] pt-2">
                    Rincian &amp; Teknis Pelaksanaan
                </h3>

                <p>
                    {{ $agenda['isi'] }}
                </p>

                <p>
                    Kader diharapkan hadir 15 menit sebelum acara dimulai guna mempersiapkan perlengkapan administrasi dan koordinasi teknis bersama tim pelaksana. Partisipasi aktif seluruh warga dan kader dasawisma sangat diharapkan demi kelancaran program pemberdayaan ini.
                </p>
            </div>

            <!-- Banner Disclaimer Catatan Data Contoh -->
            <div class="p-4 rounded-xl bg-amber-50 border border-amber-200 flex items-start gap-3 mb-10">
                <i class="fa-solid fa-triangle-exclamation text-amber-600 text-sm mt-0.5"></i>
                <div class="text-xs text-amber-900 leading-relaxed">
                    <strong>Pemberitahuan:</strong> Jadwal dan waktu pelaksanaan kegiatan di atas merupakan contoh data pada tahap perancangan sistem informasi PKK Desa Karangtanjung. Konfirmasi resmi jadwal kegiatan dapat dicek secara berkala melalui surat edaran desa atau pengumuman kader di masing-masing RW.
                </div>
            </div>

            <!-- Tombol Aksi & Navigasi -->
            <div class="pt-6 border-t border-gray-200 flex flex-wrap items-center justify-between gap-4 mb-12">
                <a href="{{ route('informasi.index') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold text-[#075B3C] bg-white border border-[#075B3C] hover:bg-[#075B3C] hover:text-white transition-all shadow-sm">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    <span>Kembali ke Halaman Informasi</span>
                </a>

                <a href="{{ route('informasi.agenda.index') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold text-white bg-[#075B3C] hover:bg-[#116B46] transition-all shadow-sm">
                    <span>Lihat Semua Agenda</span>
                    <span class="text-base leading-none">&rarr;</span>
                </a>
            </div>

            <!-- ================= AGENDA LAINNYA ================= -->
            @if(isset($agendaLainnya) && $agendaLainnya->count() > 0)
                <div class="pt-8 border-t border-gray-200">
                    <h3 class="text-lg sm:text-xl font-bold text-[#1F2937] mb-6">
                        Agenda Kegiatan Lainnya
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                        @foreach($agendaLainnya as $al)
                            <div class="bg-white rounded-xl border border-gray-200 p-4 hover:shadow-md hover:border-[#116B46]/40 transition-all flex flex-col justify-between group">
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $al['badge_color'] }}">
                                            {{ $al['kategori'] }}
                                        </span>
                                        <span class="text-xs font-bold text-[#075B3C]">
                                            {{ $al['tanggal'] }} {{ $al['bulan'] }}
                                        </span>
                                    </div>
                                    <h4 class="text-sm font-bold text-[#1F2937] group-hover:text-[#075B3C] transition-colors leading-snug line-clamp-2 mb-2">
                                        <a href="{{ route('informasi.agenda.show', $al['id']) }}">
                                            {{ $al['judul'] }}
                                        </a>
                                    </h4>
                                    <p class="text-xs text-gray-500 line-clamp-2 mb-3">
                                        {{ $al['deskripsi'] }}
                                    </p>
                                </div>
                                <a href="{{ route('informasi.agenda.show', $al['id']) }}"
                                   class="text-xs font-bold text-[#075B3C] hover:underline inline-flex items-center gap-1">
                                    <span>Lihat Detail</span>
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

