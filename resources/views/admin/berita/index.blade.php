@extends('layouts.admin')

@section('title', 'Kelola Berita')
@section('page-title', 'Kelola Berita')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-800">Daftar Berita</h2>
        <p class="text-sm text-gray-500 mt-0.5">Total <strong>{{ $beritaList->total() }}</strong> berita tersedia</p>
    </div>
    <a href="{{ route('admin.berita.create') }}"
       class="inline-flex items-center gap-2 bg-[#2F9B45] active:bg-[#075B3C] text-white font-semibold text-sm px-5 py-2.5 rounded-xl transition-all active:scale-95 duration-50">
        <i class="fa-solid fa-plus"></i> Tambah Berita
    </a>
</div>

{{-- Filter & Search Form --}}
<form method="GET" action="{{ route('admin.berita.index') }}" class="bg-[#2F9B45] rounded-2xl shadow-sm border border-emerald-900/20 p-4 mb-4">
    <div class="flex flex-col sm:flex-row gap-3">
        <div class="relative flex-1">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"><i class="fa-solid fa-search"></i></span>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul berita..."
                   class="w-full pl-9 pr-4 py-2 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-white/40 focus:border-white transition-all text-gray-800">
        </div>
        <select name="kategori" onchange="this.form.submit()"
                class="bg-white border border-gray-200 rounded-xl px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-3 focus:ring-white/40 focus:border-white cursor-pointer">
            <option value="">Semua Kategori</option>
            @foreach(['Umum', 'PKK', 'Pokja I', 'Pokja II', 'Pokja III', 'Pokja IV', 'Kesehatan', 'Pendidikan', 'Lingkungan', 'Ekonomi'] as $cat)
                <option value="{{ $cat }}" {{ request('kategori') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
            @endforeach
        </select>
        @if(request('q') || request('kategori'))
            <a href="{{ route('admin.berita.index') }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-xl text-sm font-semibold transition-colors">
                <i class="fa-solid fa-rotate-left mr-1.5"></i> Reset
            </a>
        @endif
    </div>
</form>

{{-- Table --}}
    <div class="bg-white rounded-xl shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm" id="berita-table">
                <thead>
                    <tr class="border-b-4 border-white bg-[#2F9B45]">
                        <th class="text-left font-semibold text-white px-6 py-3.5 text-xs uppercase tracking-wider w-10">No</th>
                        <th class="text-center font-semibold text-white px-6 py-3.5 text-xs uppercase tracking-wider">Berita</th>
                        <th class="text-left font-semibold text-white px-4 py-3.5 text-xs uppercase tracking-wider hidden md:table-cell">Kategori</th>
                        <th class="text-left font-semibold text-white px-4 py-3.5 text-xs uppercase tracking-wider hidden lg:table-cell">Tanggal</th>
                        <th class="text-center font-semibold text-white px-4 py-3.5 text-xs uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#075B3C]" id="table-body">
                    @foreach($beritaList as $index => $berita)
                        <tr class="hover:bg-gray-200 transition-colors table-row">
                            <td class="px-6 py-4 text-[#075B3C] text-xs font-semibold">{{ $beritaList->firstItem() + $index }}</td>
                            
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset('images/' . $berita->gambar) }}" alt=""
                                         class="w-12 h-12 rounded-xl object-cover bg-gray-100 flex-shrink-0">
                                    <div class="min-w-0">
                                        <p class="font-semibold text-gray-800 leading-snug line-clamp-2">{{ $berita->judul }}</p>
                                        <p class="text-xs text-gray-400 mt-0.5 md:hidden">{{ $berita->kategori }} &middot; {{ $berita->tanggal_formatted }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-4 hidden md:table-cell">
                                <span class="inline-block bg-[#075B3C] text-white px-2.5 py-1 rounded-full text-xs font-medium">{{ $berita->kategori }}</span>
                            </td>

                            <td class="px-4 py-4 text-[#075B3C] text-xs hidden lg:table-cell">{{ $berita->tanggal_formatted }}
                            </td>

                            <td class="px-4 py-4">
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="{{ route('informasi.show', $berita->id) }}" target="_blank"
                                       class="w-8 h-8 bg-emerald-100 text-gray-500 rounded-lg flex items-center justify-center transition-colors" title="Preview">
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>

                                    <a href="{{ route('admin.berita.edit', $berita->id) }}"
                                       class="w-8 h-8 bg-emerald-100 hover:bg-emerald-300 text-[#075B3C] rounded-lg flex items-center justify-center transition-colors" title="Edit">
                                        <i class="fa-solid fa-pen text-xs"></i>
                                    </a>
                                    <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" class="inline"
                                          data-confirm-message="Tindakan ini tidak dapat dibatalkan.">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="w-8 h-8 bg-emerald-100 hover:bg-emerald-300 text-red-500 rounded-lg flex items-center justify-center transition-colors cursor-pointer" title="Hapus">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($beritaList->count() === 0)
            <div class="text-center py-16 text-gray-400">
                <i class="fa-solid fa-newspaper text-4xl mb-3 opacity-30"></i>
                <p class="font-medium">Belum ada berita ditemukan</p>
                @if(request('q') || request('kategori'))
                    <a href="{{ route('admin.berita.index') }}" class="text-sm text-[#075B3C] font-semibold hover:underline mt-2 inline-block">Reset filter</a>
                @else
                    <a href="{{ route('admin.berita.create') }}" class="text-sm text-[#075B3C] font-semibold hover:underline mt-2 inline-block">+ Tambah sekarang</a>
                @endif
            </div>
        @endif

        {{-- Pagination Bar Langsung di Halaman --}}
        @if($beritaList->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50 flex flex-col sm:flex-row items-center justify-between gap-3">
                <p class="text-xs text-gray-600">
                    Menampilkan
                    <strong class="font-bold text-[#075B3C]">{{ $beritaList->lastItem() ?? 0 }}</strong>
                    dari
                    <strong class="font-bold text-gray-800">{{ $beritaList->total() }}</strong>
                    berita
                </p>

                <div class="flex items-center gap-1">
                    {{-- Tombol Sebelumnya --}}
                    @if ($beritaList->onFirstPage())
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-xs text-gray-300 bg-gray-100 cursor-not-allowed">
                            <i class="fa-solid fa-chevron-left text-[10px]"></i>
                        </span>
                    @else
                        <a href="{{ $beritaList->previousPageUrl() }}"
                           class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-xs font-semibold text-gray-700 bg-white border border-gray-200 hover:border-[#2F9B45] hover:text-[#075B3C] hover:bg-emerald-50 transition-all shadow-2xs">
                            <i class="fa-solid fa-chevron-left text-[10px]"></i>
                        </a>
                    @endif

                    {{-- Tombol Nomor Halaman --}}
                    @for ($page = 1; $page <= $beritaList->lastPage(); $page++)
                        @if ($page == $beritaList->currentPage())
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-xs font-bold text-white bg-[#2F9B45] shadow-xs cursor-default">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $beritaList->url($page) }}"
                               class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-xs font-semibold text-gray-700 bg-white border border-gray-200 hover:border-[#2F9B45] hover:text-[#075B3C] hover:bg-emerald-50 transition-all shadow-2xs">
                                {{ $page }}
                            </a>
                        @endif
                    @endfor

                    {{-- Tombol Berikutnya --}}
                    @if ($beritaList->hasMorePages())
                        <a href="{{ $beritaList->nextPageUrl() }}"
                           class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-xs font-semibold text-gray-700 bg-white border border-gray-200 hover:border-[#2F9B45] hover:text-[#075B3C] hover:bg-emerald-50 transition-all shadow-2xs">
                            <i class="fa-solid fa-chevron-right text-[10px]"></i>
                        </a>
                    @else
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-xs text-gray-300 bg-gray-100 cursor-not-allowed">
                            <i class="fa-solid fa-chevron-right text-[10px]"></i>
                        </span>
                    @endif
                </div>
            </div>
        @endif
    </div>
@endsection

