@extends('layouts.admin')

@section('title', 'Statistik Dasawisma')
@section('page-title', 'Statistik Dasawisma')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-800">Data Statistik Dasawisma</h2>
        <p class="text-sm text-gray-500 mt-0.5">Perbarui angka statistik yang ditampilkan di halaman beranda.</p>
    </div>
    <span class="inline-flex items-center gap-2 bg-emerald-50 text-[#075B3C] text-sm font-semibold px-4 py-2 rounded-xl border border-emerald-200">
        <i class="fa-solid fa-chart-simple"></i>
        {{ count($statistik) }} Indikator
    </span>
</div>

@if(session('success'))
    <div class="mb-5 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center justify-between">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700 transition">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
@endif

{{-- Preview Cards --}}
@php
    $warnaMap = [
        'green'  => ['bg' => 'bg-emerald-500', 'bg-light' => 'bg-emerald-50', 'text' => 'text-emerald-700'],
        'orange' => ['bg' => 'bg-amber-500',   'bg-light' => 'bg-amber-50',   'text' => 'text-amber-600'],
        'blue'   => ['bg' => 'bg-sky-500',      'bg-light' => 'bg-sky-50',     'text' => 'text-sky-600'],
    ];
@endphp
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    @foreach($statistik as $item)
    @php $w = $warnaMap[$item['warna']] ?? $warnaMap['green']; @endphp
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
        <div class="w-12 h-12 rounded-xl {{ $w['bg'] }} flex items-center justify-center text-white text-lg flex-shrink-0">
            <i class="{{ $item['icon'] }}"></i>
        </div>
        <div class="min-w-0">
            <p class="text-2xl font-bold text-gray-800 leading-tight">
                {{ $item['nilai'] === null ? '—' : number_format((float) $item['nilai'], 0, ',', '.') }}
                <span class="text-sm font-medium text-gray-400">{{ $item['satuan'] }}</span>
            </p>
            <p class="text-sm text-gray-500 truncate">{{ $item['judul'] }}</p>
        </div>
    </div>
    @endforeach
</div>

{{-- Table --}}
<div class="bg-white rounded-2xl shadow-sm border border-emerald-900/20 p-4 sm:p-5 overflow-hidden">
    <div class="bg-white rounded-xl shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b-2 border-[#075B3C] bg-[#075B3C]">
                        <th class="text-left font-semibold text-white px-6 py-3.5 text-xs uppercase tracking-wider w-10">#</th>
                        <th class="text-left font-semibold text-white px-6 py-3.5 text-xs uppercase tracking-wider">Indikator</th>
                        <th class="text-left font-semibold text-white px-4 py-3.5 text-xs uppercase tracking-wider hidden sm:table-cell">Deskripsi</th>
                        <th class="text-center font-semibold text-white px-4 py-3.5 text-xs uppercase tracking-wider">Jumlah</th>
                        <th class="text-center font-semibold text-white px-4 py-3.5 text-xs uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($statistik as $index => $item)
                    @php $w = $warnaMap[$item['warna']] ?? $warnaMap['green']; @endphp
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-[#075B3C] text-xs font-medium">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-lg {{ $w['bg'] }} flex items-center justify-center text-white text-sm flex-shrink-0">
                                    <i class="{{ $item['icon'] }}"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="font-semibold text-gray-800 leading-snug">{{ $item['judul'] }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5 sm:hidden">{{ $item['deskripsi'] }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4 text-xs text-gray-500 hidden sm:table-cell">
                            {{ $item['deskripsi'] }}
                        </td>
                        <td class="px-4 py-4 text-center">
                            <span class="inline-block px-3 py-1 bg-green-100 text-[#075B3C] font-bold rounded-lg text-sm">
                                {{ $item['nilai'] === null ? '—' : number_format((float) $item['nilai'], 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="px-4 py-4">
                            <div class="flex items-center justify-center">
                                <a href="{{ route('admin.statistik.edit', $item['id']) }}"
                                   class="w-8 h-8 bg-emerald-100 hover:bg-emerald-200 text-[#075B3C] rounded-lg flex items-center justify-center transition-colors" title="Edit Jumlah">
                                    <i class="fa-solid fa-pen text-xs"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Info Note --}}
<div class="mt-4 flex items-start gap-3 bg-blue-50 border border-blue-200 rounded-xl px-4 py-3">
    <i class="fa-solid fa-circle-info text-blue-400 mt-0.5"></i>
    <p class="text-xs text-blue-600 leading-relaxed">
        Indikator bersifat tetap. Dari halaman ini Anda hanya bisa mengubah <strong>jumlah/nilai</strong> masing-masing indikator.
    </p>
</div>
@endsection
