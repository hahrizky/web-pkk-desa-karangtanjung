@extends('layouts.admin')

@section('title', 'Kelola Struktur Organisasi')
@section('page-title', 'Struktur Organisasi TP. PKK')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- Top Action / Intro Bar --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 bg-[#075B3C] p-5 rounded-2xl border border-gray-100 shadow-xs">
        <div>
            <div class="flex items-center gap-2">
                <h2 class="text-base font-bold text-white">Kelola Profil &amp; Foto Pengurus Organisasi<h2>
            </div>
            <p class="text-xs text-white mt-1">
                Perubahan otomatis tampil di bagan dan daftar profil pengurus halaman publik.
            </p>
        </div>
        <div class="flex items-center gap-2 flex-shrink-0">
            <a href="{{ route('profil') }}#struktur" target="_blank"
               class="inline-flex items-center gap-1.5 px-3 py-2 bg-[#ECFEF3] hover:bg-emerald-100 text-gray-700 text-xs font-semibold rounded-lg border border-gray-200 transition-colors">
                <i class="fa-solid fa-arrow-up-right-from-square text-[11px] text-gray-500"></i>
                <span>Lihat di Website</span>
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-xs flex items-center gap-2.5 shadow-xs">
            <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    @if (isset($errors) && $errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-xs">
            <p class="font-bold mb-1">Ada data yang belum terisi dengan benar:</p>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.struktur.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- 1. PEMBINA & PIMPINAN UTAMA --}}
        <div class="bg-[#075B3C] rounded-2xl border border-gray-100 p-5 sm:p-6 shadow-xs space-y-5">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <div class="flex items-center gap-2.5">
                    <div>
                        <h3 class="text-sm font-bold text-white">1. Pembina & Pimpinan Utama</h3>
                        <p class="text-[11px] text-white">Kepala Desa dan Pimpinan Tim Penggerak PKK</p>
                    </div>
                </div>
            </div>

            {{-- Periode --}}
            <div class="bg-[#ECFEF3] p-4 rounded-xl border border-gray-200/70">
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                    Periode Kepengurusan <span class="text-red-500">*</span>
                </label>
                <input type="text" name="periode"
                       value="{{ old('periode', $struktur['periode']) }}"
                       placeholder="Contoh: 2024 - 2029"
                       class="w-full bg-white border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600 font-medium text-gray-800" required>
                <p class="text-[11px] text-gray-400 mt-1">Ditampilkan di header bagan dan galeri profil organisasi</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {{-- Pembina --}}
                <div class="bg-[#ECFEF3] p-4 rounded-xl border border-amber-100/80 space-y-3">
                    <div class="flex items-center justify-between">
                        <label class="block text-xs font-bold text-amber-900 uppercase tracking-wider">
                            Nama Pembina <span class="text-red-500">*</span>
                        </label>
                        <span class="text-[10px] bg-[#075B3C] text-white font-semibold px-2 py-0.5 rounded">Kepala Desa</span>
                    </div>
                    <input type="text" name="pembina_nama"
                           value="{{ old('pembina_nama', $struktur['pembina_nama']) }}"
                           placeholder="Contoh: Atmo"
                           class="w-full bg-white border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600 font-medium text-gray-800" required>
                    <input type="hidden" name="pembina_sub" value="{{ $struktur['pembina_sub'] }}">

                    {{-- Upload Foto Pembina --}}
                    <div>
                        <label class="block text-[11px] font-semibold text-gray-600 mb-1">Foto Profil Pembina</label>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-12 rounded-md overflow-hidden bg-white border border-amber-200 flex-shrink-0 flex items-center justify-center shadow-2xs">
                                @if (!empty($struktur['pembina_foto']) && file_exists(public_path('images/' . $struktur['pembina_foto'])))
                                    <img src="{{ asset('images/' . $struktur['pembina_foto']) }}" class="w-full h-full object-cover">
                                @else
                                    <i class="fa-solid fa-user-tie text-xs text-amber-700"></i>
                                @endif
                            </div>
                            <input type="file" name="pembina_foto" accept="image/*" class="text-xs text-gray-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-md file:border-0 file:text-[11px] font-medium file:bg-emerald-100 file:text-emerald-800 hover:file:bg-emerald-200">
                        </div>
                    </div>
                </div>

                {{-- Ketua --}}
                <div class="bg-[#ECFEF3] p-4 rounded-xl border border-emerald-100 space-y-3">
                    <div class="flex items-center justify-between">
                        <label class="block text-xs font-bold text-emerald-900 uppercase tracking-wider">
                            Ketua TP. PKK <span class="text-red-500">*</span>
                        </label>
                        <span class="text-[10px] bg-[#075B3C] text-white font-semibold px-2 py-0.5 rounded">Ketua Umum</span>
                    </div>
                    <input type="text" name="ketua_nama"
                           value="{{ old('ketua_nama', $struktur['ketua_nama']) }}"
                           placeholder="Nama lengkap Ketua beserta gelar"
                           class="w-full bg-white border border-gray-300 rounded-lg px-2.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600 font-medium text-gray-800" required>

                    {{-- Upload Foto Ketua --}}
                    <div>
                        <label class="block text-[11px] font-semibold text-gray-600 mb-1">Foto Profil Ketua</label>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-12 rounded-md overflow-hidden bg-white border border-emerald-200 flex-shrink-0 flex items-center justify-center shadow-2xs">
                                @if (!empty($struktur['ketua_foto']) && file_exists(public_path('images/' . $struktur['ketua_foto'])))
                                    <img src="{{ asset('images/' . $struktur['ketua_foto']) }}" class="w-full h-full object-cover">
                                @else
                                    <i class="fa-solid fa-user-large text-xs text-emerald-700"></i>
                                @endif
                            </div>
                            <input type="file" name="ketua_foto" accept="image/*" class="text-xs text-gray-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-md file:border-0 file:text-[11px] font-medium file:bg-emerald-100 file:text-emerald-800 hover:file:bg-emerald-200">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Wakil Ketua --}}
            <div class="bg-[#ECFEF3] p-4 rounded-xl border border-emerald-100 space-y-3">
                <div class="flex items-center justify-between">
                    <label class="block text-xs font-bold text-emerald-900 uppercase tracking-wider">
                        Wakil Ketua TP. PKK <span class="text-red-500">*</span>
                    </label>
                    <span class="text-[10px] bg-[#075B3C] text-white font-semibold px-2 py-0.5 rounded">Wakil</span>
                </div>
                <input type="text" name="wakil_nama"
                       value="{{ old('wakil_nama', $struktur['wakil_nama']) }}"
                       placeholder="Nama lengkap Wakil Ketua"
                       class="w-full bg-white border border-gray-300 rounded-lg px-2.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600 font-medium text-gray-800" required>

                {{-- Upload Foto Wakil --}}
                <div>
                    <label class="block text-[11px] font-semibold text-gray-600 mb-1">Foto Profil Wakil Ketua</label>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-12 rounded-md overflow-hidden bg-white border border-emerald-200 flex-shrink-0 flex items-center justify-center shadow-2xs">
                            @if (!empty($struktur['wakil_foto']) && file_exists(public_path('images/' . $struktur['wakil_foto'])))
                                <img src="{{ asset('images/' . $struktur['wakil_foto']) }}" class="w-full h-full object-cover">
                            @else
                                <i class="fa-solid fa-user text-xs text-emerald-700"></i>
                            @endif
                        </div>
                        <input type="file" name="wakil_foto" accept="image/*" class="text-xs text-gray-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-md file:border-0 file:text-[11px] font-medium file:bg-emerald-100 file:text-emerald-800 hover:file:bg-emerald-200">
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. SEKRETARIAT & KEUANGAN --}}
        <div class="bg-[#075B3C] rounded-2xl border border-gray-100 p-5 sm:p-6 shadow-xs space-y-5">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <div class="flex items-center gap-2.5">
                    <div>
                        <h3 class="text-sm font-bold text-white">2. Sekretaris & Bendahara</h3>
                        <p class="text-[11px] text-white">Pengurus administrasi dan perbendaharaan PKK</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                {{-- Sekretaris I --}}
                <div class="p-4 rounded-xl border border-blue-100 bg-[#ECFEF3] space-y-2.5">
                    <label class="block text-xs font-bold text-blue-900 uppercase tracking-wider">
                        Sekretaris I <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="sekretaris_1"
                           value="{{ old('sekretaris_1', $struktur['sekretaris_1']) }}"
                           placeholder="Nama Sekretaris I"
                           class="w-full bg-white border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 font-medium text-gray-800" required>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-12 rounded-md overflow-hidden bg-white border border-blue-200 flex-shrink-0 flex items-center justify-center shadow-2xs">
                            @if (!empty($struktur['sekretaris_1_foto']) && file_exists(public_path('images/' . $struktur['sekretaris_1_foto'])))
                                <img src="{{ asset('images/' . $struktur['sekretaris_1_foto']) }}" class="w-full h-full object-cover">
                            @else
                                <i class="fa-solid fa-user text-xs text-blue-600"></i>
                            @endif
                        </div>
                        <input type="file" name="sekretaris_1_foto" accept="image/*" class="text-xs text-gray-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-md file:border-0 file:text-[11px] font-medium file:bg-emerald-100 file:text-emerald-800 hover:file:bg-emerald-200">
                    </div>
                </div>

                {{-- Sekretaris II --}}
                <div class="p-4 rounded-xl border border-blue-100 bg-[#ECFEF3] space-y-2.5">
                    <label class="block text-xs font-bold text-blue-900 uppercase tracking-wider">
                        Sekretaris II <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="sekretaris_2"
                           value="{{ old('sekretaris_2', $struktur['sekretaris_2']) }}"
                           placeholder="Nama Sekretaris II"
                           class="w-full bg-white border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 font-medium text-gray-800" required>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-12 rounded-md overflow-hidden bg-white border border-blue-200 flex-shrink-0 flex items-center justify-center shadow-2xs">
                            @if (!empty($struktur['sekretaris_2_foto']) && file_exists(public_path('images/' . $struktur['sekretaris_2_foto'])))
                                <img src="{{ asset('images/' . $struktur['sekretaris_2_foto']) }}" class="w-full h-full object-cover">
                            @else
                                <i class="fa-solid fa-user text-xs text-blue-600"></i>
                            @endif
                        </div>
                        <input type="file" name="sekretaris_2_foto" accept="image/*" class="text-xs text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-[11px] file:bg-emerald-100 file:text-emerald-800 hover:file:bg-emerald-200">
                    </div>
                </div>

                {{-- Bendahara I --}}
                <div class="p-4 rounded-xl border border-amber-100 bg-[#ECFEF3] space-y-2.5">
                    <label class="block text-xs font-bold text-amber-900 uppercase tracking-wider">
                        Bendahara I <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="bendahara_1"
                           value="{{ old('bendahara_1', $struktur['bendahara_1']) }}"
                           placeholder="Nama Bendahara I"
                           class="w-full bg-white border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 font-medium text-gray-800" required>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-12 rounded-md overflow-hidden bg-white border border-amber-200 flex-shrink-0 flex items-center justify-center shadow-2xs">
                            @if (!empty($struktur['bendahara_1_foto']) && file_exists(public_path('images/' . $struktur['bendahara_1_foto'])))
                                <img src="{{ asset('images/' . $struktur['bendahara_1_foto']) }}" class="w-full h-full object-cover">
                            @else
                                <i class="fa-solid fa-user text-xs text-amber-600"></i>
                            @endif
                        </div>
                        <input type="file" name="bendahara_1_foto" accept="image/*" class="text-xs text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-[11px] file:bg-emerald-100 file:text-emerald-800 hover:file:bg-emerald-200">
                    </div>
                </div>

                {{-- Bendahara II --}}
                <div class="p-4 rounded-xl border border-amber-100 bg-[#ECFEF3] space-y-2.5">
                    <label class="block text-xs font-bold text-amber-900 uppercase tracking-wider">
                        Bendahara II <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="bendahara_2"
                           value="{{ old('bendahara_2', $struktur['bendahara_2']) }}"
                           placeholder="Nama Bendahara II"
                           class="w-full bg-white border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 font-medium text-gray-800" required>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-12 rounded-md overflow-hidden bg-white border border-amber-200 flex-shrink-0 flex items-center justify-center shadow-2xs">
                            @if (!empty($struktur['bendahara_2_foto']) && file_exists(public_path('images/' . $struktur['bendahara_2_foto'])))
                                <img src="{{ asset('images/' . $struktur['bendahara_2_foto']) }}" class="w-full h-full object-cover">
                            @else
                                <i class="fa-solid fa-user text-xs text-amber-600"></i>
                            @endif
                        </div>
                        <input type="file" name="bendahara_2_foto" accept="image/*" class="text-xs text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-[11px] file:bg-emerald-100 file:text-emerald-800 hover:file:bg-emerald-200">
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. KETUA KELOMPOK KERJA (POKJA I - IV) --}}
        <div class="bg-[#075B3C] rounded-2xl border border-gray-100 p-5 sm:p-6 shadow-xs space-y-5">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <div class="flex items-center gap-2.5">
                    <div>
                        <h3 class="text-sm font-bold text-white">3. Ketua Kelompok Kerja (Pokja I – IV)</h3>
                        <p class="text-[11px] text-white">Pimpinan masing-masing bidang program kerja pokok PKK</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {{-- Pokja I --}}
                <div class="p-4 rounded-xl border border-gray-200 hover:border-emerald-300 transition-colors bg-[#ECFEF3] space-y-2.5">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">
                            POKJA I
                        </span>
                        <span class="text-[10px] text-gray-400">Karakter &amp; Gotong Royong</span>
                    </div>
                    <input type="text" name="pokja_1_ketua"
                           value="{{ old('pokja_1_ketua', $struktur['pokja_1_ketua']) }}"
                           placeholder="Nama Ketua Pokja I"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600 font-medium text-gray-800" required>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-12 rounded-md overflow-hidden bg-white border border-emerald-200 flex-shrink-0 flex items-center justify-center shadow-2xs">
                            @if (!empty($struktur['pokja_1_foto']) && file_exists(public_path('images/' . $struktur['pokja_1_foto'])))
                                <img src="{{ asset('images/' . $struktur['pokja_1_foto']) }}" class="w-full h-full object-cover">
                            @else
                                <i class="fa-solid fa-user text-xs text-emerald-700"></i>
                            @endif
                        </div>
                        <input type="file" name="pokja_1_foto" accept="image/*" class="text-xs text-gray-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-md file:border-0 file:text-[11px] font-medium file:bg-emerald-100 file:text-emerald-800 hover:file:bg-emerald-200">
                    </div>
                </div>

                {{-- Pokja II --}}
                <div class="p-4 rounded-xl border border-gray-200 hover:border-emerald-300 transition-colors bg-[#ECFEF3] space-y-2.5">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">
                            POKJA II
                        </span>
                        <span class="text-[10px] text-gray-400">Pendidikan &amp; Ekonomi UP2K</span>
                    </div>
                    <input type="text" name="pokja_2_ketua"
                           value="{{ old('pokja_2_ketua', $struktur['pokja_2_ketua']) }}"
                           placeholder="Nama Ketua Pokja II"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600 font-medium text-gray-800" required>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-12 rounded-md overflow-hidden bg-white border border-emerald-200 flex-shrink-0 flex items-center justify-center shadow-2xs">
                            @if (!empty($struktur['pokja_2_foto']) && file_exists(public_path('images/' . $struktur['pokja_2_foto'])))
                                <img src="{{ asset('images/' . $struktur['pokja_2_foto']) }}" class="w-full h-full object-cover">
                            @else
                                <i class="fa-solid fa-user text-xs text-emerald-700"></i>
                            @endif
                        </div>
                        <input type="file" name="pokja_2_foto" accept="image/*" class="text-xs text-gray-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-md file:border-0 file:text-[11px] font-medium file:bg-emerald-100 file:text-emerald-800 hover:file:bg-emerald-200">
                    </div>
                </div>

                {{-- Pokja III --}}
                <div class="p-4 rounded-xl border border-gray-200 hover:border-emerald-300 transition-colors bg-[#ECFEF3] space-y-2.5">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">
                            POKJA III
                        </span>
                        <span class="text-[10px] text-gray-400">Pangan (HATINYA PKK) &amp; Sandang</span>
                    </div>
                    <input type="text" name="pokja_3_ketua"
                           value="{{ old('pokja_3_ketua', $struktur['pokja_3_ketua']) }}"
                           placeholder="Nama Ketua Pokja III"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600 font-medium text-gray-800" required>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-12 rounded-md overflow-hidden bg-white border border-emerald-200 flex-shrink-0 flex items-center justify-center shadow-2xs">
                            @if (!empty($struktur['pokja_3_foto']) && file_exists(public_path('images/' . $struktur['pokja_3_foto'])))
                                <img src="{{ asset('images/' . $struktur['pokja_3_foto']) }}" class="w-full h-full object-cover">
                            @else
                                <i class="fa-solid fa-user text-xs text-emerald-700"></i>
                            @endif
                        </div>
                        <input type="file" name="pokja_3_foto" accept="image/*" class="text-xs text-gray-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-md file:border-0 file:text-[11px] font-medium file:bg-emerald-100 file:text-emerald-800 hover:file:bg-emerald-200">
                    </div>
                </div>

                {{-- Pokja IV --}}
                <div class="p-4 rounded-xl border border-gray-200 hover:border-emerald-300 transition-colors bg-[#ECFEF3] space-y-2.5">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">
                            POKJA IV
                        </span>
                        <span class="text-[10px] text-gray-400">Kesehatan, Posyandu &amp; Stunting</span>
                    </div>
                    <input type="text" name="pokja_4_ketua"
                           value="{{ old('pokja_4_ketua', $struktur['pokja_4_ketua']) }}"
                           placeholder="Nama Ketua Pokja IV"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600 font-medium text-gray-800" required>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-12 rounded-md overflow-hidden bg-white border border-emerald-200 flex-shrink-0 flex items-center justify-center shadow-2xs">
                            @if (!empty($struktur['pokja_4_foto']) && file_exists(public_path('images/' . $struktur['pokja_4_foto'])))
                                <img src="{{ asset('images/' . $struktur['pokja_4_foto']) }}" class="w-full h-full object-cover">
                            @else
                                <i class="fa-solid fa-user text-xs text-emerald-700"></i>
                            @endif
                        </div>
                        <input type="file" name="pokja_4_foto" accept="image/*" class="text-xs text-gray-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-md file:border-0 file:text-[11px] font-medium file:bg-emerald-100 file:text-emerald-800 hover:file:bg-emerald-200">
                    </div>
                </div>
            </div>
        </div>

        {{-- SUBMIT BAR --}}
        <div class="sticky bottom-4 z-10 bg-white/95 backdrop-blur-sm p-4 rounded-2xl border border-gray-200 shadow-md flex items-center justify-between gap-4">
            <div class="text-xs text-gray-500 hidden sm:block">
                <i class="fa-solid fa-circle-info text-emerald-600 mr-1"></i>
                Format foto yang didukung: JPG, PNG, WEBP (maksimal 2MB per foto).
            </div>
            <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
                <button type="submit"
                        class="w-full sm:w-auto px-6 py-2.5 bg-[#075B3C] hover:bg-[#055030] text-white font-semibold rounded-xl text-sm transition-all shadow-sm flex items-center justify-center gap-2 active:scale-95">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>Simpan Perubahan Struktur &amp; Foto</span>
                </button>
            </div>
        </div>

    </form>

</div>
@endsection
