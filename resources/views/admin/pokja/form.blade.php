@extends('layouts.admin')

@section('title', 'Edit Pokja')
@section('page-title', 'Edit Pokja')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('admin.pokja.index') }}" class="hover:text-[#075B3C] transition-colors">Pokja</a>
        <i class="fa-solid fa-chevron-right text-[10px]"></i>
        <span class="text-gray-700 font-medium">Edit {{ $pokja['nama'] }}</span>
    </div>

    <form action="{{ route('admin.pokja.update', $pokja['id']) }}" method="POST">
        @csrf @method('PUT')

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pokja</label>
                <input type="text" name="nama" value="{{ old('nama', $pokja['nama']) }}"
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all bg-gray-50"
                       readonly>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Ketua Pokja</label>
                <input type="text" name="ketua" value="{{ old('ketua', $pokja['ketua']) }}"
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all"
                       placeholder="Nama ketua pokja...">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi & Program Kerja</label>
                <textarea name="deskripsi" rows="6"
                          class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all resize-none"
                          placeholder="Deskripsi pokja dan program kerjanya...">{{ old('deskripsi', $pokja['deskripsi']) }}</textarea>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 mt-5">
            <a href="{{ route('admin.pokja.index') }}"
               class="px-6 py-2.5 border border-gray-200 hover:bg-gray-50 text-gray-600 font-medium rounded-xl transition-all text-sm">
                Batal
            </a>
            <button type="submit"
                    class="px-6 py-2.5 bg-[#075B3C] hover:bg-[#055030] text-white font-semibold rounded-xl transition-all active:scale-95 text-sm">
                <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

