@extends('layouts.app')

@section('title', $agenda['judul'] . ' — Agenda TP. PKK Desa Karangtanjung')

@section('content')

<!-- ================= KONTEN UTAMA DETAIL AGENDA ================= -->
<article class="py-10 sm:py-14 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-wrap items-center gap-2.5 mb-4">
            <span class="px-3 py-0.5 text-white rounded-full text-xs font-semibold {{ $agenda['badge_color'] }} border shadow-xs">
                {{ $agenda['kategori'] }}
            </span>
            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600 border border-gray-200">
                {{ $agenda['status'] }}
            </span>
            <span class="text-xs text-[#075B3C] font-medium flex items-center gap-1.5 ml-1">
                <i class="fa-regular fa-calendar-days text-[#075B3C]"></i>
                {{ $agenda['hari'] }}, {{ $agenda['tanggal_lengkap'] }}
            </span>
        </div>

        <!-- Judul Utama Kegiatan -->
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#1F2937] leading-tight mb-6">
            {{ $agenda['judul'] }}
        </h1>

        <!-- Kotak Ringkasan Jadwal & Lokasi Pelaksanaan -->
        <div class="bg-[#eefbf4] border border-[#E2E8F0] rounded-2xl p-5 sm:p-6 mb-8 shadow-xs">
            <h2 class="text-sm font-bold text-[#075B3C] uppercase tracking-wider mb-4 flex items-center gap-2">
                <i class="fa-regular fa-calendar-check"></i>
                <span>Informasi Pelaksanaan Kegiatan</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs sm:text-sm">
                <div class="flex items-start gap-3 bg-[#075B3C] p-3.5 rounded-xl border border-gray-100">
                    <div class="w-9 h-9 rounded-lg bg-white text-[#075B3C] flex items-center justify-center text-sm flex-shrink-0">
                        <i class="fa-regular fa-calendar"></i>
                    </div>
                    <div>
                        <span class="block text-white text-[11px] uppercase tracking-wider">Hari &amp; Tanggal</span>
                        <strong class="text-white font-semibold">{{ $agenda['hari'] }}, {{ $agenda['tanggal_lengkap'] }}</strong>
                    </div>
                </div>

                <div class="flex items-start gap-3 bg-[#075B3C] p-3.5 rounded-xl border border-gray-100">
                    <div class="w-9 h-9 rounded-lg bg-white text-[#075B3C] flex items-center justify-center text-sm flex-shrink-0">
                        <i class="fa-regular fa-clock"></i>
                    </div>
                    <div>
                        <span class="block text-white text-[11px] uppercase tracking-wider">Waktu Pelaksanaan</span>
                        <strong class="text-white font-semibold">{{ $agenda['waktu'] }}</strong>
                    </div>
                </div>

                <div class="flex items-start gap-3 bg-[#075B3C] p-3.5 rounded-xl border border-gray-100">
                    <div class="w-9 h-9 rounded-lg bg-white text-[#075B3C] flex items-center justify-center text-sm flex-shrink-0">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <span class="block text-white text-[11px] uppercase tracking-wider">Lokasi / Tempat</span>
                        <strong class="text-white font-semibold">{{ $agenda['lokasi'] }}</strong>
                    </div>
                </div>

                <div class="flex items-start gap-3 bg-[#075B3C] p-3.5 rounded-xl border border-gray-100">
                    <div class="w-9 h-9 rounded-lg bg-white text-[#075B3C] flex items-center justify-center text-sm flex-shrink-0">
                        <i class="fa-solid fa-user-group"></i>
                    </div>
                    <div>
                        <span class="block text-white text-[11px] uppercase tracking-wider">Penyelenggara</span>
                        <strong class="text-white font-semibold">{{ $agenda['penyelenggara'] }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deskripsi Lengkap & Narasi Pelaksanaan -->
        <div class="prose prose-sm sm:prose-base max-w-none text-[#1F2937] leading-relaxed mb-8
                    prose-headings:text-gray-900 prose-headings:font-bold
                    prose-p:mb-4 prose-p:leading-relaxed prose-a:text-[#075B3C] prose-a:underline
                    prose-ul:list-disc prose-ol:list-decimal
                    prose-blockquote:border-l-4 prose-blockquote:border-[#075B3C] prose-blockquote:pl-4 prose-blockquote:italic prose-blockquote:text-gray-600">
            <h3 class="text-lg font-bold text-[#1F2937] pt-2 mb-4">
                Rincian &amp; Teknis Pelaksanaan
            </h3>

            <div class="article-body text-left sm:text-justify leading-relaxed [text-justify:inter-word] [hyphens:auto]">
                {!! str_contains($agenda['isi'], '<') ? $agenda['isi'] : nl2br(e($agenda['isi'])) !!}
            </div>
        </div>

        <!-- Tombol Aksi & Navigasi -->
        <div class="pt-6 border-t border-gray-200 flex flex-wrap items-center justify-end gap-4 mb-12">
            <a href="{{ route('informasi.index') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold text-[#075B3C] bg-white border border-[#075B3C] hover:bg-[#075B3C] hover:text-white transition-all shadow-sm">
                <span>Kembali ke Informasi</span>
                <i class="fa-solid fa-arrow-right text-xs"></i>
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
                <div class="bg-[#075B3C] rounded-xl border border-[#075B3C] p-4 hover:bg-[#064B33] hover:shadow-md transition-all flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $al['badge_color'] }}">
                                {{ $al['kategori'] }}
                            </span>

                            <span class="text-xs font-bold text-emerald-200">
                                {{ $al['tanggal'] }} {{ $al['bulan'] }}
                            </span>
                        </div>

                        <h4 class="text-sm font-bold text-white group-hover:text-emerald-100 transition-colors leading-snug line-clamp-2 mb-2">
                            <a href="{{ route('informasi.agenda.show', $al['id']) }}">
                                {{ $al['judul'] }}
                            </a>
                        </h4>

                        <p class="text-xs text-emerald-50/80 line-clamp-2 mb-3">
                            {{ $al['deskripsi'] }}
                        </p>
                    </div>

                    <a href="{{ route('informasi.agenda.show', $al['id']) }}"
                        class="text-xs font-bold text-white hover:text-emerald-200 hover:underline inline-flex items-center gap-1 transition-colors">
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