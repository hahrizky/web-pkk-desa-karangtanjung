@extends('layouts.admin')

@section('title', isset($item) ? 'Edit Statistik' : 'Tambah Statistik')
@section('page-title', isset($item) ? 'Edit Statistik Dasawisma' : 'Tambah Statistik Dasawisma')

@section('content')
<div class="max-w-2xl">
    <div class="mb-6">
        <a href="{{ route('admin.statistik.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-[#075B3C] transition">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Data Statistik</span>
        </a>
    </div>

    @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
            <p class="font-semibold text-sm mb-1">Periksa kesalahan input berikut:</p>
            <ul class="list-disc list-inside text-xs space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <form action="{{ isset($item) ? route('admin.statistik.update', $item->id) : route('admin.statistik.store') }}" method="POST">
            @csrf
            @if(isset($item))
                @method('PUT')
            @endif

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Judul Indikator <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" value="{{ old('judul', $item->judul ?? '') }}" required
                           placeholder="Contoh: Jumlah Dasawisma Aktif"
                           class="w-full px-3.5 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nilai / Angka <span class="text-red-500">*</span></label>
                        <input type="text" name="nilai" value="{{ old('nilai', $item->nilai ?? '') }}" required
                               placeholder="Contoh: 18 Kelompok atau 95%"
                               class="w-full px-3.5 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Urutan Tampil</label>
                        <input type="number" name="urutan" value="{{ old('urutan', $item->urutan ?? 1) }}"
                               class="w-full px-3.5 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Font Awesome Icon Class</label>
                    <input type="text" name="icon" value="{{ old('icon', $item->icon ?? 'fa-solid fa-users') }}"
                           placeholder="Contoh: fa-solid fa-users, fa-solid fa-heart-pulse"
                           class="w-full px-3.5 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]">
                    <p class="text-xs text-gray-400 mt-1">Gunakan class icon Font Awesome v6 (misal: <code>fa-solid fa-users</code>).</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi / Keterangan Singkat</label>
                    <textarea name="deskripsi" rows="3"
                              placeholder="Keterangan singkat tentang indikator ini..."
                              class="w-full px-3.5 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]">{{ old('deskripsi', $item->deskripsi ?? '') }}</textarea>
                </div>
            </div>

            <div class="mt-6 pt-5 border-t border-gray-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.statistik.index') }}" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800">Batal</a>
                <button type="submit" class="bg-[#075B3C] text-white px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-[#064e33] transition shadow-sm">
                    {{ isset($item) ? 'Simpan Perubahan' : 'Tambah Statistik' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

