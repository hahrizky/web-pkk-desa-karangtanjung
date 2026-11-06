@extends('layouts.admin')

@section('title', 'Kelola Galeri')
@section('page-title', 'Galeri Foto')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-800">Galeri Foto</h2>
        <p class="text-sm text-gray-500 mt-0.5">Total <strong>{{ count($galeriList) }}</strong> foto</p>
    </div>
    <a href="{{ route('admin.galeri.create') }}"
       class="inline-flex items-center gap-2 bg-[#075B3C] hover:bg-[#055030] text-white font-semibold text-sm px-5 py-2.5 rounded-xl transition-colors active:scale-95">
        <i class="fa-solid fa-plus"></i> Upload Foto
    </a>
</div>

{{-- Grid Gallery --}}
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    @foreach($galeriList as $foto)
        <div class="group relative bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all">
            <div class="aspect-square">
                <img src="{{ asset('images/' . $foto['gambar']) }}" alt="{{ $foto['judul'] }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            </div>
            {{-- Overlay on hover --}}
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                <p class="text-white text-sm font-semibold line-clamp-2">{{ $foto['judul'] }}</p>
                <p class="text-white/60 text-xs mt-1">{{ $foto['kategori'] ?? 'Kegiatan' }}</p>
                <div class="flex gap-2 mt-3">
                    <a href="{{ route('admin.galeri.edit', $foto['id']) }}"
                       class="w-8 h-8 bg-white/20 hover:bg-white/30 backdrop-blur text-white rounded-lg flex items-center justify-center transition-colors" title="Edit">
                        <i class="fa-solid fa-pen text-xs"></i>
                    </a>
                    <form action="{{ route('admin.galeri.destroy', $foto['id']) }}" method="POST" class="inline"
                          onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                        @csrf @method('DELETE')
                        <button type="submit"
                                class="w-8 h-8 bg-white/20 hover:bg-red-500/50 backdrop-blur text-white rounded-lg flex items-center justify-center transition-colors" title="Hapus">
                            <i class="fa-solid fa-trash text-xs"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>

@if(count($galeriList) === 0)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 text-center py-16 text-gray-400">
        <i class="fa-solid fa-images text-4xl mb-3 opacity-30"></i>
        <p class="font-medium">Belum ada foto</p>
        <a href="{{ route('admin.galeri.create') }}" class="text-sm text-[#075B3C] font-semibold hover:underline mt-2 inline-block">+ Upload sekarang</a>
    </div>
@endif
@endsection

