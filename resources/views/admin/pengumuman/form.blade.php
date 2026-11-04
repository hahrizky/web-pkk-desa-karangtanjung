@extends('layouts.admin')

@section('title', isset($pengumuman) ? 'Edit Pengumuman' : 'Tambah Pengumuman')
@section('page-title', isset($pengumuman) ? 'Edit Pengumuman' : 'Tambah Pengumuman')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('admin.pengumuman.index') }}" class="hover:text-[#075B3C] transition-colors">Pengumuman</a>
        <i class="fa-solid fa-chevron-right text-[10px]"></i>
        <span class="text-gray-700 font-medium">{{ isset($pengumuman) ? 'Edit' : 'Tambah Baru' }}</span>
    </div>

    <form action="{{ isset($pengumuman) ? route('admin.pengumuman.update', $pengumuman['id']) : route('admin.pengumuman.store') }}"
          method="POST">
        @csrf
        @if(isset($pengumuman)) @method('PUT') @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Pengumuman <span class="text-red-500">*</span></label>
                <input type="text" name="judul" value="{{ old('judul', $pengumuman['judul'] ?? '') }}"
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all"
                       placeholder="Masukkan judul pengumuman..." required>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $pengumuman['tanggal_raw'] ?? date('Y-m-d')) }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Prioritas</label>
                    <select name="prioritas"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all">
                        <option value="Normal" {{ (old('prioritas', $pengumuman['prioritas'] ?? 'Normal')) === 'Normal' ? 'selected' : '' }}>Normal</option>
                        <option value="Penting" {{ (old('prioritas', $pengumuman['prioritas'] ?? '')) === 'Penting' ? 'selected' : '' }}>Penting</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Ringkasan</label>
                <textarea name="ringkasan" rows="3"
                          class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all resize-none"
                          placeholder="Ringkasan singkat pengumuman...">{{ old('ringkasan', $pengumuman['ringkasan'] ?? '') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Isi Pengumuman <span class="text-red-500">*</span></label>
                <textarea name="konten" rows="8"
                          class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all resize-none"
                          placeholder="Isi lengkap pengumuman..." required>{{ old('konten', $pengumuman['konten'] ?? '') }}</textarea>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 mt-5">
            <a href="{{ route('admin.pengumuman.index') }}"
               class="px-6 py-2.5 border border-gray-200 hover:bg-gray-50 text-gray-600 font-medium rounded-xl transition-all text-sm">
                Batal
            </a>
            <button type="submit"
                    class="px-6 py-2.5 bg-[#075B3C] hover:bg-[#055030] text-white font-semibold rounded-xl transition-all active:scale-95 text-sm">
                <i class="fa-solid fa-floppy-disk mr-2"></i>
                {{ isset($pengumuman) ? 'Simpan Perubahan' : 'Simpan Pengumuman' }}
            </button>
        </div>
    </form>
</div>
@endsection

