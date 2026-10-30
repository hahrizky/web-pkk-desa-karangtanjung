@extends('layouts.app')

@section('title', 'Profil — TP PKK Desa Karangtanjung')

@section('content')

{{-- ═══════════════════════════════════════════════
         1. TENTANG KAMI  (teks kiri, foto kanan)
    ═══════════════════════════════════════════════ --}}
<section class="py-16 bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            {{-- Teks --}}
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4">
                    Tentang Kami
                </h2>
                <p class="text-sm sm:text-base text-gray-700 leading-relaxed mb-4">
                    <strong class="text-emerald-800">TP PKK (Tim Penggerak Pemberdayaan dan Kesejahteraan Keluarga) Desa Karangtanjung</strong>
                    merupakan gerakan pemberdayaan masyarakat yang bertujuan meningkatkan kesejahteraan keluarga melalui
                    berbagai program terencana, terpadu, dan berkelanjutan.
                </p>
                <p class="text-sm sm:text-base text-gray-600 leading-relaxed">
                    Berdiri di bawah naungan dan binaan Pemerintah Desa Karangtanjung, kami berkomitmen untuk mewujudkan
                    keluarga yang mandiri, berdaya saing, sehat, cerdas, dan berakhlak mulia di setiap lingkungan RW, RT,
                    serta kelompok Dasawisma.
                </p>


            </div>

            {{-- Foto --}}
            <div class="relative">
                <div class="relative overflow-hidden rounded-2xl border-4 border-white shadow-xl">
                    <img src="{{ asset('images/5.webp') }}"
                        alt="Pengurus TP PKK Desa Karangtanjung"
                        class="w-full h-72 sm:h-80 lg:h-96 object-cover hover:scale-105 transition-transform duration-500">
                    <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-emerald-950/85 to-transparent p-4">
                        <p class="text-xs sm:text-sm font-semibold text-white leading-snug">
                            Pengurus Tim Penggerak PKK Desa Karangtanjung
                        </p>
                        <p class="text-[11px] text-emerald-200">Kec. Candi, Kab. Sidoarjo</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
         2. VISI  (card hijau gelap penuh lebar)
    ═══════════════════════════════════════════════ --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Card VISI --}}
        <div class="relative rounded-2xl bg-emerald-800 text-white p-10 sm:p-14 text-center overflow-hidden mb-14">
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_rgba(16,185,129,0.25),_transparent_60%)] pointer-events-none"></div>
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom_left,_rgba(5,150,105,0.2),_transparent_60%)] pointer-events-none"></div>
            <div class="flex flex-col items-center text-center mb-5">
                <h2 class="text-2xl sm:text-3xl font-bold text-[#B8DCC8] mb-2">
                    VISI
                </h2>
                <div class="w-10 h-1 bg-emerald-600 rounded-full"></div>
            </div>
            <div class="relative z-10">
                <p class="text-base sm:text-lg font-bold text-white leading-relaxed max-w-2xl mx-auto">
                    {{ $visi }}
                </p>
            </div>
        </div>

        {{-- MISI KAMI --}}
        <div class="text-center mb-10">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">MISI KAMI</h2>
            <div class="w-14 h-1 bg-emerald-600 mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($misi as $item)
            <div class="bg-white rounded-2xl p-6 sm:p-8 border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl flex-shrink-0 border border-emerald-100">
                        <i class="{{ $item['icon'] }}"></i>
                    </div>
                    <span class="text-xs font-bold text-emerald-700 bg-emerald-100 px-3 py-1 rounded-full uppercase tracking-wider">
                        Misi {{ $item['nomor'] }}
                    </span>
                </div>
                <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-2 leading-snug">
                    {{ $item['judul'] }}
                </h3>
                <p class="text-sm text-gray-500 leading-relaxed">
                    {{ $item['deskripsi'] }}
                </p>
            </div>
            @endforeach
        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════
         3. STRUKTUR ORGANISASI (bagan hierarki)
    ═══════════════════════════════════════════════ --}}
<section class="py-16 bg-white border-b border-gray-100">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-10">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
                Struktur Organisasi TP. PKK Desa Karangtanjung
            </h2>
            <p class="text-sm text-gray-500">Pengurus Inti TP PKK Periode Aktif</p>
        </div>

        {{-- ── Bagan Org ── --}}
        <div class="flex flex-col items-center gap-0">

            {{-- LEVEL 1: PEMBINA --}}
            <div class="flex flex-col items-center w-full">
                <div class="bg-amber-50 border-2 border-amber-300 rounded-2xl px-6 py-3 text-center shadow-sm min-w-[200px]">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-amber-600 mb-1">{{ $struktur['pembina']['jabatan'] }}</p>
                    <p class="text-sm font-bold text-gray-800">{{ $struktur['pembina']['nama'] }}</p>
                    <p class="text-xs text-gray-500">{{ $struktur['pembina']['sub'] }}</p>
                </div>
                {{-- konektor ke bawah --}}
                <div class="w-[2px] h-8 bg-gray-300"></div>
            </div>

            {{-- LEVEL 2: KETUA (full width card besar) --}}
            <div class="flex flex-col items-center w-full">
                @php $ketua = $struktur['pengurus_inti'][0]; @endphp
                <div class="bg-emerald-700 text-white rounded-2xl px-8 py-3 text-center shadow-md min-w-[220px]">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-emerald-200 mb-1">{{ $ketua['jabatan'] }}</p>
                    <p class="text-sm font-bold">{{ $ketua['nama'] }}</p>
                </div>
                {{-- konektor ke bawah --}}
                <div class="w-[2px] h-8 bg-gray-300"></div>
            </div>

            {{-- LEVEL 3: WAKIL KETUA --}}
            <div class="flex flex-col items-center w-full">
                @php $wakil = $struktur['pengurus_inti'][1]; @endphp
                <div class="bg-emerald-50 border border-emerald-200 rounded-2xl px-6 py-3 text-center shadow-sm min-w-[200px]">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-emerald-700 mb-1">{{ $wakil['jabatan'] }}</p>
                    <p class="text-sm font-semibold text-gray-800">{{ $wakil['nama'] }}</p>
                </div>
                {{-- konektor horizontal ke Sekretaris & Bendahara --}}
                <div class="w-[2px] h-8 bg-gray-300"></div>
            </div>

            {{-- LEVEL 4: KONEKTOR SEKRETARIS DAN BENDAHARA --}}
            <div class="w-full max-w-3xl">

                {{-- Garis dari Wakil Ketua menuju Sekretaris dan Bendahara --}}
                <div class="relative h-6">

                    {{-- Garis vertikal dari Wakil Ketua --}}
                    <div class="absolute left-1/2 -top-4 h-49.5 w-[2px] -translate-x-1/2 bg-gray-300"></div>

                    {{-- Garis horizontal --}}
                    <div class="absolute left-1/4 right-1/4 top-3 h-[2px] bg-gray-300"></div>

                    {{-- Garis turun ke Sekretaris --}}
                    <div class="absolute left-1/4 top-3 h-3 w-[2px] -translate-x-1/2 bg-gray-300"></div>

                    {{-- Garis turun ke Bendahara --}}
                    <div class="absolute right-1/4 top-3 h-3 w-[2px] translate-x-1/2 bg-gray-300"></div>

                </div>

                {{-- Kartu Sekretaris dan Bendahara --}}
                <div class="grid grid-cols-2 gap-6">

                    <div class="flex flex-col gap-3">
                        @foreach (array_slice($struktur['pengurus_inti'], 2, 2) as $sek)
                        <div class="bg-blue-50 border border-blue-200 rounded-xl px-4 py-3 text-center">
                            <p class="text-[10px] font-bold uppercase tracking-widest text-blue-700 mb-1">
                                {{ $sek['jabatan'] }}
                            </p>
                            <p class="text-sm font-semibold text-gray-800">
                                {{ $sek['nama'] }}
                            </p>
                        </div>
                        @endforeach
                    </div>

                    <div class="flex flex-col gap-3">
                        @foreach (array_slice($struktur['pengurus_inti'], 4, 2) as $ben)
                        <div class="bg-amber-50 border border-amber-200 rounded-xl px-4 py-3 text-center">
                            <p class="text-[10px] font-bold uppercase tracking-widest text-amber-700 mb-1">
                                {{ $ben['jabatan'] }}
                            </p>
                            <p class="text-sm font-semibold text-gray-800">
                                {{ $ben['nama'] }}
                            </p>
                        </div>
                        @endforeach
                    </div>

                </div>

                {{-- Konektor gabungan menuju Pokja --}}
                <div class="relative h-10">

                    {{-- Garis horizontal yang menghubungkan keempat Pokja --}}
                    <div class="absolute left-[12.5%] right-[12.5%] top-4 border-t-2 border-gray-300"></div>

                    {{-- Garis vertikal menuju masing-masing Pokja --}}
                    <div class="absolute left-[12.5%] top-4 h-6 border-l-2 border-gray-300"></div>
                    <div class="absolute left-[37.5%] top-4 h-6 border-l-2 border-gray-300"></div>
                    <div class="absolute left-[62.5%] top-4 h-6 border-l-2 border-gray-300"></div>
                    <div class="absolute left-[87.5%] top-4 h-6 border-l-2 border-gray-300"></div>

                </div>

                {{-- Kartu Pokja --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                    @foreach ($struktur['pokja'] as $pk)
                    <div class="bg-white border-2 border-emerald-200 rounded-xl px-3 py-3 text-center hover:border-emerald-400 hover:shadow-md transition-all duration-200">

                        <span class="inline-block bg-emerald-100 text-emerald-800 text-[10px] font-bold uppercase tracking-wide rounded-full px-2 py-0.5 mb-2">
                            {{ $pk['kode'] }}
                        </span>

                        <p class="text-xs font-semibold text-gray-700">
                            {{ $pk['ketua'] }}
                        </p>

                    </div>
                    @endforeach

                </div>

            </div>

        </div>

    </div>
</section>


{{-- ═══════════════════════════════════════════════
         4. 4 PILAR PERAN STRATEGIS
    ═══════════════════════════════════════════════ --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-10">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
                4 Pilar Peran Strategis TP. PKK Desa
            </h2>
            <p class="text-sm sm:text-base text-gray-600">
                Fokus fundamental TP. PKK Desa Karangtanjung dalam mendorong kemajuan keluarga dan desa.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($pilar as $item)
            @php
            $iconBg = match($item['color']) {
            'blue' => 'bg-blue-600',
            'amber' => 'bg-amber-500',
            'teal' => 'bg-teal-700',
            default => 'bg-emerald-600'
            };
            @endphp
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-200 flex flex-col">
                <div class="w-10 h-10 rounded-full {{ $iconBg }} text-white flex items-center justify-center text-base mb-4 flex-shrink-0">
                    <i class="{{ $item['icon'] }}"></i>
                </div>
                <h3 class="text-base font-bold text-gray-900 mb-2 leading-snug">
                    {{ $item['nomor'] }}. {{ $item['judul'] }}
                </h3>
                <p class="text-sm text-gray-500 leading-relaxed">
                    {{ $item['deskripsi'] }}
                </p>
            </div>
            @endforeach
        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════
         5. TUGAS DAN FUNGSI TP. PKK
    ═══════════════════════════════════════════════ --}}
<section class="py-16 bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-10">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
                Tugas dan Fungsi TP. PKK
            </h2>
            <p class="text-sm sm:text-base text-gray-600">
                Mengacu pada regulasi kepengurusan dan manajemen pemberdayaan masyarakat desa.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($tugas_fungsi as $item)
            <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 rounded-xl bg-emerald-800 text-white flex items-center justify-center text-sm flex-shrink-0">
                        <i class="{{ $item['icon'] }}"></i>
                    </div>
                    <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-md">
                        {{ $item['tipe'] }}
                    </span>
                </div>
                <h4 class="text-base font-bold text-gray-900 mb-2 leading-snug">
                    {{ $item['judul'] }}
                </h4>
                <p class="text-sm text-gray-500 leading-relaxed">
                    {{ $item['deskripsi'] }}
                </p>
            </div>
            @endforeach
        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════
         6. 10 PROGRAM POKOK PKK
    ═══════════════════════════════════════════════ --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-10">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
                10 Program Pokok PKK
            </h2>
            <p class="text-sm sm:text-base text-gray-600">
                Sepuluh program utama yang menjadi landasan kegiatan TP. PKK di Desa Karangtanjung.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5">
            @foreach ($program_pokok as $item)
            <div class="group bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 flex flex-col">
                {{-- Header: nomor + badge pokja --}}
                <div class="flex items-center justify-between mb-3">
                    <span class="w-7 h-7 rounded-lg bg-emerald-100 text-emerald-800 text-xs font-extrabold flex items-center justify-center flex-shrink-0">
                        {{ $item['nomor'] }}
                    </span>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider bg-gray-100 px-2 py-0.5 rounded-full">
                        {{ $item['pokja'] }}
                    </span>
                </div>

                <h4 class="text-sm font-bold text-gray-900 leading-snug mb-2 group-hover:text-emerald-700 transition-colors flex-1">
                    {{ $item['judul'] }}
                </h4>

                <p class="text-xs text-gray-500 leading-relaxed mb-4">
                    {{ $item['deskripsi'] }}
                </p>

                {{-- Footer ikon --}}
                <div class="pt-3 border-t border-gray-100 flex justify-end">
                    <div class="w-7 h-7 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center text-xs group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                        <i class="{{ $item['icon'] }}"></i>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>

@endsection