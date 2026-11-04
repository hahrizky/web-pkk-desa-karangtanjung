@extends('layouts.admin')

@section('title', 'Kelola Pengumuman')
@section('page-title', 'Pengumuman')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-800">Daftar Pengumuman</h2>
        <p class="text-sm text-gray-500 mt-0.5">Total <strong>{{ count($pengumumanList) }}</strong> pengumuman</p>
    </div>
    <a href="{{ route('admin.pengumuman.create') }}"
       class="inline-flex items-center gap-2 bg-[#075B3C] hover:bg-[#055030] text-white font-semibold text-sm px-5 py-2.5 rounded-xl transition-colors active:scale-95">
        <i class="fa-solid fa-plus"></i> Tambah Pengumuman
    </a>
</div>

{{-- Search --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-4">
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"><i class="fa-solid fa-search"></i></span>
        <input type="text" id="search-input" placeholder="Cari pengumuman..." onkeyup="filterRows()"
               class="w-full pl-9 pr-4 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all">
    </div>
</div>

{{-- Table --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100 bg-gray-50">
                    <th class="text-left font-semibold text-gray-600 px-6 py-3.5 text-xs uppercase tracking-wider w-10">#</th>
                    <th class="text-left font-semibold text-gray-600 px-6 py-3.5 text-xs uppercase tracking-wider">Pengumuman</th>
                    <th class="text-left font-semibold text-gray-600 px-4 py-3.5 text-xs uppercase tracking-wider hidden md:table-cell">Tanggal</th>
                    <th class="text-left font-semibold text-gray-600 px-4 py-3.5 text-xs uppercase tracking-wider hidden lg:table-cell">Prioritas</th>
                    <th class="text-center font-semibold text-gray-600 px-4 py-3.5 text-xs uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($pengumumanList as $index => $item)
                    <tr class="hover:bg-gray-50 transition-colors search-row" data-search="{{ strtolower($item['judul']) }}">
                        <td class="px-6 py-4 text-gray-400 text-xs">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-purple-50 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fa-solid fa-bullhorn text-purple-500 text-sm"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="font-semibold text-gray-800 leading-snug line-clamp-1">{{ $item['judul'] }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5 line-clamp-1">{{ Str::limit($item['ringkasan'] ?? $item['konten'] ?? '-', 60) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4 text-gray-500 text-xs hidden md:table-cell">{{ $item['tanggal'] }}</td>
                        <td class="px-4 py-4 hidden lg:table-cell">
                            @php
                                $prioritas = $item['prioritas'] ?? 'Normal';
                                $prioClass = $prioritas === 'Penting' ? 'bg-red-50 text-red-600' : 'bg-gray-100 text-gray-500';
                            @endphp
                            <span class="inline-block px-2.5 py-1 rounded-full text-xs font-medium {{ $prioClass }}">{{ $prioritas }}</span>
                        </td>
                        <td class="px-4 py-4">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('admin.pengumuman.edit', $item['id']) }}"
                                   class="w-8 h-8 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center transition-colors" title="Edit">
                                    <i class="fa-solid fa-pen text-xs"></i>
                                </a>
                                <form action="{{ route('admin.pengumuman.destroy', $item['id']) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="w-8 h-8 bg-red-50 hover:bg-red-100 text-red-500 rounded-lg flex items-center justify-center transition-colors" title="Hapus">
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

    @if(count($pengumumanList) === 0)
        <div class="text-center py-16 text-gray-400">
            <i class="fa-solid fa-bullhorn text-4xl mb-3 opacity-30"></i>
            <p class="font-medium">Belum ada pengumuman</p>
            <a href="{{ route('admin.pengumuman.create') }}" class="text-sm text-[#075B3C] font-semibold hover:underline mt-2 inline-block">+ Tambah sekarang</a>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
function filterRows() {
    const q = document.getElementById('search-input').value.toLowerCase();
    document.querySelectorAll('.search-row').forEach(row => {
        row.style.display = row.dataset.search.includes(q) ? '' : 'none';
    });
}
</script>
@endpush

