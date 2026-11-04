@extends('layouts.admin')

@section('title', 'Statistik Dasawisma')
@section('page-title', 'Statistik Dasawisma')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h2 class="text-xl font-bold text-gray-800">Data Statistik Dasawisma</h2>
        <p class="text-sm text-gray-500">Kelola angka statistik dan capaian Dasawisma yang tampil di Beranda.</p>
    </div>
    <a href="{{ route('admin.statistik.create') }}"
       class="inline-flex items-center gap-2 bg-[#075B3C] text-white px-4 py-2.5 rounded-lg text-sm font-semibold hover:bg-[#064e33] transition shadow-sm self-start sm:self-auto">
        <i class="fa-solid fa-plus"></i>
        <span>Tambah Statistik</span>
    </a>
</div>

@if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center justify-between">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100 text-gray-600 font-semibold">
                    <th class="py-3.5 px-4 text-center w-12">No</th>
                    <th class="py-3.5 px-4">Judul Indikator</th>
                    <th class="py-3.5 px-4">Nilai / Angka</th>
                    <th class="py-3.5 px-4">Deskripsi</th>
                    <th class="py-3.5 px-4 text-center">Urutan</th>
                    <th class="py-3.5 px-4 text-center w-28">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($statistik as $index => $row)
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="py-3.5 px-4 text-center text-gray-400 font-medium">{{ $index + 1 }}</td>
                    <td class="py-3.5 px-4 font-semibold text-gray-800">
                        <div class="flex items-center gap-2">
                            @if($row->icon)
                                <span class="w-8 h-8 rounded-lg bg-green-50 text-[#075B3C] flex items-center justify-center text-xs">
                                    <i class="{{ $row->icon }}"></i>
                                </span>
                            @endif
                            <span>{{ $row->judul }}</span>
                        </div>
                    </td>
                    <td class="py-3.5 px-4">
                        <span class="px-2.5 py-1 bg-green-100 text-[#075B3C] font-bold rounded-md text-xs">
                            {{ $row->nilai }}
                        </span>
                    </td>
                    <td class="py-3.5 px-4 text-gray-500 text-xs max-w-xs truncate">
                        {{ $row->deskripsi ?? '-' }}
                    </td>
                    <td class="py-3.5 px-4 text-center text-gray-600 font-medium">
                        {{ $row->urutan ?? 0 }}
                    </td>
                    <td class="py-3.5 px-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.statistik.edit', $row->id) }}"
                               class="w-8 h-8 rounded bg-amber-50 text-amber-600 hover:bg-amber-100 flex items-center justify-center transition"
                               title="Edit">
                                <i class="fa-solid fa-pen text-xs"></i>
                            </a>
                            <form action="{{ route('admin.statistik.destroy', $row->id) }}" method="POST"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus statistik ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-8 h-8 rounded bg-red-50 text-red-600 hover:bg-red-100 flex items-center justify-center transition"
                                        title="Hapus">
                                    <i class="fa-solid fa-trash text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-8 text-center text-gray-400">
                        <i class="fa-solid fa-chart-pie text-3xl mb-2 block"></i>
                        Belum ada data statistik.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

