@extends('layouts.admin')

@section('title', 'Kelola Agenda')
@section('page-title', 'Agenda Kegiatan')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-800">Agenda Kegiatan</h2>
        <p class="text-sm text-gray-500 mt-0.5">Total <strong>{{ count($agendaList) }}</strong> agenda</p>
    </div>
    <a href="{{ route('admin.agenda.create') }}"
       class="inline-flex items-center gap-2 bg-[#075B3C] hover:bg-[#055030] text-white font-semibold text-sm px-5 py-2.5 rounded-xl transition-colors active:scale-95">
        <i class="fa-solid fa-plus"></i> Tambah Agenda
    </a>
</div>

{{-- Search --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-4">
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"><i class="fa-solid fa-search"></i></span>
        <input type="text" id="search-input" placeholder="Cari agenda..." onkeyup="filterRows()"
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
                    <th class="text-left font-semibold text-gray-600 px-6 py-3.5 text-xs uppercase tracking-wider">Agenda</th>
                    <th class="text-left font-semibold text-gray-600 px-4 py-3.5 text-xs uppercase tracking-wider hidden md:table-cell">Tanggal</th>
                    <th class="text-left font-semibold text-gray-600 px-4 py-3.5 text-xs uppercase tracking-wider hidden lg:table-cell">Lokasi</th>
                    <th class="text-left font-semibold text-gray-600 px-4 py-3.5 text-xs uppercase tracking-wider hidden lg:table-cell">Status</th>
                    <th class="text-center font-semibold text-gray-600 px-4 py-3.5 text-xs uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50" id="table-body">
                @foreach($agendaList as $index => $agenda)
                    <tr class="hover:bg-gray-50 transition-colors search-row" data-search="{{ strtolower($agenda['judul'] . ' ' . $agenda['lokasi']) }}">
                        <td class="px-6 py-4 text-gray-400 text-xs">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-11 h-11 bg-amber-50 rounded-xl flex flex-col items-center justify-center flex-shrink-0">
                                    <span class="text-xs font-bold text-amber-600 leading-none">{{ \Carbon\Carbon::parse($agenda['tanggal'])->format('d') }}</span>
                                    <span class="text-[9px] text-amber-500 uppercase">{{ \Carbon\Carbon::parse($agenda['tanggal'])->locale('id')->isoFormat('MMM') }}</span>
                                </div>
                                <div class="min-w-0">
                                    <p class="font-semibold text-gray-800 leading-snug">{{ $agenda['judul'] }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5 md:hidden">{{ $agenda['tanggal'] }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4 text-gray-500 text-xs hidden md:table-cell">{{ $agenda['tanggal'] }}</td>
                        <td class="px-4 py-4 hidden lg:table-cell">
                            <span class="text-xs text-gray-500"><i class="fa-solid fa-location-dot mr-1 text-gray-400"></i>{{ $agenda['lokasi'] }}</span>
                        </td>
                        <td class="px-4 py-4 hidden lg:table-cell">
                            @php
                                $isPast = \Carbon\Carbon::parse($agenda['tanggal'])->isPast();
                            @endphp
                            <span class="inline-block px-2.5 py-1 rounded-full text-xs font-medium {{ $isPast ? 'bg-gray-100 text-gray-500' : 'bg-green-50 text-green-700' }}">
                                {{ $isPast ? 'Selesai' : 'Mendatang' }}
                            </span>
                        </td>
                        <td class="px-4 py-4">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('admin.agenda.edit', $agenda['id']) }}"
                                   class="w-8 h-8 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center transition-colors" title="Edit">
                                    <i class="fa-solid fa-pen text-xs"></i>
                                </a>
                                <form action="{{ route('admin.agenda.destroy', $agenda['id']) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Yakin ingin menghapus agenda ini?')">
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

    @if(count($agendaList) === 0)
        <div class="text-center py-16 text-gray-400">
            <i class="fa-solid fa-calendar-days text-4xl mb-3 opacity-30"></i>
            <p class="font-medium">Belum ada agenda</p>
            <a href="{{ route('admin.agenda.create') }}" class="text-sm text-[#075B3C] font-semibold hover:underline mt-2 inline-block">+ Tambah sekarang</a>
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

