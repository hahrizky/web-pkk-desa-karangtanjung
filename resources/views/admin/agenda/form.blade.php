@extends('layouts.admin')

@section('title', isset($agenda) ? 'Edit Agenda' : 'Tambah Agenda')
@section('page-title', isset($agenda) ? 'Edit Agenda' : 'Tambah Agenda')

@section('content')
<div class="max-w-3xl mx-auto">
    {{-- Header & Navigasi Kembali --}}
    <div class="flex items-center justify-between mb-5">
        <div>
            <h2 class="text-lg font-bold text-gray-800">{{ isset($agenda) ? 'Edit Agenda Kegiatan' : 'Tambah Agenda Baru' }}</h2>
            <p class="text-xs text-gray-500 mt-0.5">Jadwalkan kegiatan TP. PKK Desa Karangtanjung</p>
        </div>
        <a href="{{ route('admin.agenda.index') }}" class="inline-flex items-center gap-1.5 text-xs text-gray-600 hover:text-[#075B3C] font-medium border border-gray-200 bg-white px-3 py-1.5 rounded-lg transition-colors">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-5 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-xs">
            <p class="font-bold mb-1">Ada data yang belum terisi dengan benar:</p>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-xl border border-gray-200 p-5 sm:p-6 shadow-xs">
        <form action="{{ isset($agenda) ? route('admin.agenda.update', $agenda['id']) : route('admin.agenda.store') }}"
              method="POST" class="space-y-4">
            @csrf
            @if(isset($agenda)) @method('PUT') @endif

            <div>
                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                    Nama / Judul Kegiatan <span class="text-red-500">*</span>
                </label>
                <input type="text" name="judul" value="{{ old('judul', $agenda['judul'] ?? '') }}"
                       class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all"
                       placeholder="Contoh: Rapat Koordinasi TP. PKK & Penimbangan Posyandu" required>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                        Kategori Kegiatan
                    </label>
                    <select name="kategori"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all">
                        @php
                            $categories = ['Umum', 'Pokja I', 'Pokja II', 'Pokja III', 'Pokja IV'];
                            $currentCat = old('kategori', $agenda['kategori'] ?? 'Umum');
                        @endphp
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ $currentCat === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                        Penyelenggara / Penanggung Jawab
                    </label>
                    <input type="text" name="penyelenggara" value="{{ old('penyelenggara', $agenda['penyelenggara'] ?? 'TP. PKK Desa Karangtanjung') }}"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all"
                           placeholder="Contoh: Pokja IV / Bidan Desa">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                        Tanggal Pelaksanaan <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $agenda['tanggal'] ?? date('Y-m-d')) }}"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                        Waktu Kegiatan
                    </label>
                    <input type="text" name="waktu" value="{{ old('waktu', $agenda['waktu'] ?? '08:00 WIB - Selesai') }}"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all"
                           placeholder="Contoh: 08:30 - 11:30 WIB">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                    Lokasi Kegiatan <span class="text-red-500">*</span>
                </label>
                <input type="text" name="lokasi" value="{{ old('lokasi', $agenda['lokasi'] ?? '') }}"
                       class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all"
                       placeholder="Contoh: Balai Pertemuan Desa Karangtanjung" required>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                    Deskripsi / Catatan Agenda
                </label>
                <textarea name="deskripsi" rows="4"
                          class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all"
                          placeholder="Jelaskan agenda kegiatan, sasaran peserta, atau hal yang perlu dibawa...">{{ old('deskripsi', $agenda['deskripsi'] ?? '') }}</textarea>
            </div>

            <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.agenda.index') }}"
                   class="px-4 py-2 border border-gray-300 hover:bg-gray-50 text-gray-600 font-medium rounded-lg text-xs transition-colors">
                    Batal
                </a>
                <button type="submit"
                        class="px-5 py-2 bg-[#075B3C] hover:bg-[#055030] text-white font-semibold rounded-lg text-xs transition-colors shadow-xs flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>{{ isset($agenda) ? 'Simpan Perubahan' : 'Simpan Agenda' }}</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
