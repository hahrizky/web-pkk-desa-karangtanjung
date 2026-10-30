@extends('layouts.app')

@section('title', 'Pokja — TP PKK Desa Karangtanjung')

@section('content')

@foreach($pokja as $i => $p)

@php
    $isMintBg = ($i % 2 === 0);
    $sectionBg = $isMintBg ? 'bg-[#eefbf4]' : 'bg-white';
    $cardClass = $isMintBg 
        ? 'bg-white rounded-xl p-4 sm:p-5 shadow-sm border border-emerald-100/60' 
        : 'bg-[#eaf7ee] rounded-xl p-4 sm:p-5 border border-emerald-100/50';
@endphp

<section class="{{ $sectionBg }} py-10 sm:py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Badge Pokja (Pill) --}}
        <div class="mb-3">
            <span class="inline-block px-3.5 py-1 rounded-full text-xs font-bold tracking-wider uppercase {{ $p['badge_class'] }}">
                {{ $p['kode'] }}
            </span>
        </div>

        {{-- Judul Pokja --}}
        <h2 class="text-xl sm:text-2xl font-bold text-[#065f46] mb-3 leading-snug">
            {{ $p['nama'] }}
        </h2>

        {{-- Deskripsi Bidang --}}
        <p class="text-sm sm:text-[15px] text-gray-700 leading-relaxed mb-6 max-w-4xl">
            {{ $p['deskripsi'] }}
        </p>

        {{-- Sub-header --}}
        <h3 class="text-xs font-black tracking-widest text-gray-900 uppercase mb-4">
            TUGAS POKOK &amp; PROGRAM UMUM
        </h3>

        {{-- Grid Program (2 kolom) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($p['program'] as $prog)
            <div class="{{ $cardClass }}">
                {{-- Header kartu: Icon + Judul --}}
                <div class="flex items-center gap-2.5 mb-1.5">
                    <i class="{{ $prog['icon'] }} {{ $prog['icon_color'] }} text-base flex-shrink-0"></i>
                    <h4 class="font-bold text-sm sm:text-base text-gray-900 leading-snug">
                        {{ $prog['judul'] }}
                    </h4>
                </div>
                {{-- Deskripsi Program --}}
                <p class="text-xs sm:text-[13px] text-gray-600 leading-relaxed">
                    {{ $prog['deskripsi'] }}
                </p>
            </div>
            @endforeach
        </div>

    </div>
</section>

@endforeach

@endsection
