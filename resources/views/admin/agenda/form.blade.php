@extends('layouts.admin')

@section('title', isset($agenda) ? 'Edit Agenda' : 'Tambah Agenda')
@section('page-title', isset($agenda) ? 'Edit Agenda' : 'Tambah Agenda')

@section('content')
<div class="max-w-3xl mx-auto">
    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('admin.agenda.index') }}" class="hover:text-[#075B3C] transition-colors">Agenda</a>
        <i class="fa-solid fa-chevron-right text-[10px]"></i>
        <span class="text-gray-700 font-medium">{{ isset($agenda) ? 'Edit' : 'Tambah Baru' }}</span>
    </div>

    <form action="{{ isset($agenda) ? route('admin.agenda.update', $agenda['id']) : route('admin.agenda.store') }}"
          method="POST">
        @csrf
        @if(isset($agenda)) @method('PUT') @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Agenda <span class="text-red-500">*</span></label>
                <input type="text" name="judul" value="{{ old('judul', $agenda['judul'] ?? '') }}"
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all"
                       placeholder="Masukkan judul agenda..." required>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $agenda['tanggal'] ?? date('Y-m-d')) }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Waktu</label>
                    <input type="text" name="waktu" value="{{ old('waktu', $agenda['waktu'] ?? '08:00 - Selesai') }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all"
                           placeholder="Contoh: 08:00 - 12:00 WIB">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Lokasi <span class="text-red-500">*</span></label>
                <input type="text" name="lokasi" value="{{ old('lokasi', $agenda['lokasi'] ?? '') }}"
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all"
                       placeholder="Lokasi kegiatan..." required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="5"
                          class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all resize-none"
                          placeholder="Detail agenda kegiatan...">{{ old('deskripsi', $agenda['deskripsi'] ?? '') }}</textarea>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 mt-5">
            <a href="{{ route('admin.agenda.index') }}"
               class="px-6 py-2.5 border border-gray-200 hover:bg-gray-50 text-gray-600 font-medium rounded-xl transition-all text-sm">
                Batal
            </a>
            <button type="submit"
                    class="px-6 py-2.5 bg-[#075B3C] hover:bg-[#055030] text-white font-semibold rounded-xl transition-all active:scale-95 text-sm">
                <i class="fa-solid fa-floppy-disk mr-2"></i>
                {{ isset($agenda) ? 'Simpan Perubahan' : 'Simpan Agenda' }}
            </button>
        </div>
    </form>
</div>
@endsection

