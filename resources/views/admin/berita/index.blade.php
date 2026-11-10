@extends('layouts.admin')

@section('title', 'Kelola Berita')
@section('page-title', 'Kelola Berita')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-800">Daftar Berita</h2>
        <p class="text-sm text-gray-500 mt-0.5">Total <strong>{{ count($beritaList) }}</strong> berita tersedia</p>
    </div>
    <a href="{{ route('admin.berita.create') }}"
       class="inline-flex items-center gap-2 bg-[#075B3C] hover:bg-[#055030] text-white font-semibold text-sm px-5 py-2.5 rounded-xl transition-colors active:scale-95">
        <i class="fa-solid fa-plus"></i> Tambah Berita
    </a>
</div>

{{-- Filter & Search --}}
<div class="bg-[#075B3C] rounded-2xl shadow-sm border border-emerald-900/20 p-4 mb-4">
    <div class="flex flex-col sm:flex-row gap-3">
        <div class="relative flex-1">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"><i class="fa-solid fa-search"></i></span>
            <input type="text" id="search-input" placeholder="Cari berita..." onkeyup="filterTable()"
                   class="w-full pl-9 pr-4 py-2 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-white/40 focus:border-white transition-all text-gray-800">
        </div>
        <select id="filter-kategori" onchange="filterTable()"
                class="bg-white border border-gray-200 rounded-xl px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-3 focus:ring-white/40 focus:border-white">
            <option value="">Semua Kategori</option>
            <option value="PKK">PKK</option>
            <option value="Kesehatan">Kesehatan</option>
            <option value="Pendidikan">Pendidikan</option>
            <option value="Lingkungan">Lingkungan</option>
            <option value="Ekonomi">Ekonomi</option>
        </select>
    </div>
</div>

{{-- Table --}}
<div class="bg-[#075B3C] rounded-2xl shadow-sm border border-emerald-900/20 p-4 sm:p-5 overflow-hidden">
    <div class="bg-white rounded-xl shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm" id="berita-table">
                <thead>
                    <tr class="border-b-4 border-white bg-emerald-100">
                        <th class="text-left font-semibold text-[#075B3C] px-6 py-3.5 text-xs uppercase tracking-wider w-10">No</th>
                        <th class="text-center font-semibold text-[#075B3C] px-6 py-3.5 text-xs uppercase tracking-wider">Berita</th>
                        <th class="text-left font-semibold text-[#075B3C] px-4 py-3.5 text-xs uppercase tracking-wider hidden md:table-cell">Kategori</th>
                        <th class="text-left font-semibold text-[#075B3C] px-4 py-3.5 text-xs uppercase tracking-wider hidden lg:table-cell">Tanggal</th>
                        <th class="text-center font-semibold text-[#075B3C] px-4 py-3.5 text-xs uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-[#075B3C]" id="table-body">
                    @foreach($beritaList as $index => $berita)
                        <tr class="hover:bg-gray-50 transition-colors table-row" data-judul="{{ strtolower($berita['judul']) }}" data-kategori="{{ $berita['kategori'] }}">
                            <td class="px-6 py-4 text-[#075B3C] text-xs">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset('images/' . $berita['gambar']) }}" alt=""
                                         class="w-12 h-12 rounded-xl object-cover bg-gray-100 flex-shrink-0">
                                    <div class="min-w-0">
                                        <p class="font-semibold text-gray-800 leading-snug line-clamp-2">{{ $berita['judul'] }}</p>
                                        <p class="text-xs text-gray-400 mt-0.5 md:hidden">{{ $berita['kategori'] }} &middot; {{ $berita['tanggal'] }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 hidden md:table-cell">
                                <span class="inline-block bg-[#075B3C] text-white px-2.5 py-1 rounded-full text-xs font-medium">{{ $berita['kategori'] }}</span>
                            </td>
                            <td class="px-4 py-4 text-[#075B3C] text-xs hidden lg:table-cell">{{ $berita['tanggal'] }}</td>
                            <td class="px-4 py-4">
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="{{ route('informasi.show', $berita['id']) }}" target="_blank"
                                       class="w-8 h-8 bg-gray-50 hover:bg-gray-100 text-gray-500 rounded-lg flex items-center justify-center transition-colors" title="Preview">
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>
                                    <a href="{{ route('admin.berita.edit', $berita['id']) }}"
                                       class="w-8 h-8 bg-emerald-100 hover:bg-emerald-300 text-[#075B3C] rounded-lg flex items-center justify-center transition-colors" title="Edit">
                                        <i class="fa-solid fa-pen text-xs"></i>
                                    </a>
                                    <form action="{{ route('admin.berita.destroy', $berita['id']) }}" method="POST" class="inline"
                                          data-confirm-message="Tindakan ini tidak dapat dibatalkan.">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="w-8 h-8 bg-emerald-100 hover:bg-emerald-300 text-red-500 rounded-lg flex items-center justify-center transition-colors" title="Hapus">
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

        @if(count($beritaList) === 0)
            <div class="text-center py-16 text-gray-400">
                <i class="fa-solid fa-newspaper text-4xl mb-3 opacity-30"></i>
                <p class="font-medium">Belum ada berita</p>
                <a href="{{ route('admin.berita.create') }}" class="text-sm text-[#075B3C] font-semibold hover:underline mt-2 inline-block">+ Tambah sekarang</a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
function filterTable() {
    const search = document.getElementById('search-input').value.toLowerCase();
    const kategori = document.getElementById('filter-kategori').value;
    const rows = document.querySelectorAll('.table-row');
    rows.forEach(row => {
        const judul = row.dataset.judul || '';
        const kat = row.dataset.kategori || '';
        const matchSearch = judul.includes(search);
        const matchKat = !kategori || kat === kategori;
        row.style.display = (matchSearch && matchKat) ? '' : 'none';
    });
}
</script>
@endpush

