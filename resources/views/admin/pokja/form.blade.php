@extends('layouts.admin')

@section('title', 'Edit ' . $pokja['nama'])
@section('page-title', 'Edit ' . $pokja['nama'])

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-5">
        <div>
            <h2 class="text-lg font-bold text-gray-800">Edit Data {{ $pokja['nama'] }}</h2>
            <p class="text-xs text-gray-500 mt-0.5">Ubah nama ketua dan uraian program kerja pokja</p>
        </div>
        <a href="{{ route('admin.pokja.index') }}" class="inline-flex items-center gap-1.5 text-xs text-gray-600 hover:text-[#075B3C] font-medium border border-gray-200 bg-white px-3 py-1.5 rounded-lg transition-colors">
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

    <form action="{{ route('admin.pokja.update', $pokja['id']) }}" method="POST">
        @csrf @method('PUT')

        <div class="bg-white rounded-xl border border-gray-200 p-5 sm:p-6 shadow-xs space-y-4">
            <div>
                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                    Kelompok Kerja
                </label>
                <input type="text" name="nama" value="{{ $pokja['nama'] }}"
                       class="w-full border border-gray-200 rounded-lg px-3.5 py-2 text-sm bg-gray-50 text-gray-600 font-semibold"
                       readonly>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                    Nama Ketua Pokja <span class="text-red-500">*</span>
                </label>
                <input type="text" name="ketua" value="{{ old('ketua', $pokja['ketua']) }}"
                       class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all"
                       placeholder="Nama lengkap ketua pokja..." required>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                    Fokus &amp; Deskripsi Program Kerja <span class="text-red-500">*</span>
                </label>
                <textarea name="deskripsi" rows="5"
                          class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all leading-relaxed"
                          placeholder="Uraian fokus dan tugas pokok pokja..." required>{{ old('deskripsi', $pokja['deskripsi']) }}</textarea>
            </div>

            <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.pokja.index') }}"
                   class="px-4 py-2 border border-gray-300 hover:bg-gray-50 text-gray-600 font-medium rounded-lg text-xs transition-colors">
                    Batal
                </a>
                <button type="submit"
                        class="px-5 py-2 bg-[#075B3C] hover:bg-[#055030] text-white font-semibold rounded-lg text-xs transition-colors shadow-xs flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>Simpan Perubahan</span>
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
