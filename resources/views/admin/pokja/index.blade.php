@extends('layouts.admin')

@section('title', 'Kelola Pokja')
@section('page-title', 'Pokja')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-800">Kelompok Kerja (Pokja)</h2>
        <p class="text-sm text-gray-500 mt-0.5">Kelola informasi pokja PKK</p>
    </div>
</div>

<div class="grid md:grid-cols-2 gap-5">
    @foreach($pokjaList as $pokja)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-[#075B3C] rounded-xl flex items-center justify-center flex-shrink-0">
                    <span class="text-white font-bold text-sm">{{ $pokja['nomor'] }}</span>
                </div>
                <div class="flex-1">
                    <h3 class="font-bold text-gray-800">{{ $pokja['nama'] }}</h3>
                    <p class="text-sm text-gray-500 mt-1">{{ $pokja['ketua'] }}</p>
                    <p class="text-xs text-gray-400 mt-2 line-clamp-2">{{ $pokja['deskripsi'] }}</p>
                    <div class="flex gap-2 mt-3">
                        <a href="{{ route('admin.pokja.edit', $pokja['id']) }}"
                           class="text-xs bg-blue-50 hover:bg-blue-100 text-blue-600 px-3 py-1.5 rounded-lg font-medium transition-colors">
                            <i class="fa-solid fa-pen mr-1"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

