@extends('layouts.admin')

@section('title', 'Ubah Jumlah Statistik')
@section('page-title', 'Ubah Jumlah Statistik Dasawisma')

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
            <p class="font-semibold text-sm mb-1">Masukkan jumlah yang valid:</p>
            <ul class="list-disc list-inside text-xs space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="mb-5">
            <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Indikator tetap</p>
            <h2 class="mt-1 text-lg font-bold text-gray-800">{{ $meta['judul'] }}</h2>
            <p class="mt-1 text-sm text-gray-500">{{ $meta['deskripsi'] }}</p>
        </div>

        <form id="statistik-form" action="{{ route('admin.statistik.update', $id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="nilai" class="block text-sm font-semibold text-gray-700 mb-1">
                Jumlah ({{ $meta['satuan'] }})
            </label>
            <input id="nilai" type="number" name="nilai" value="{{ old('nilai', $nilai) }}"
                   min="0" step="1" required autofocus
                   class="w-full px-3.5 py-3 border border-gray-300 rounded-lg text-base focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]">

            <div class="mt-6 pt-5 border-t border-gray-100 flex items-center justify-end gap-3">
                <button type="button" id="btn-cancel-statistik" onclick="resetStatistikForm()"
                        class="hidden px-4 py-2 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-semibold rounded-lg text-xs transition-colors shadow-sm flex items-center gap-1.5 cursor-pointer">
                    <i class="fa-solid fa-rotate-left"></i>
                    <span>Batalkan Perubahan</span>
                </button>
                <button type="submit" class="bg-[#075B3C] text-white px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-[#064e33] transition shadow-sm cursor-pointer">
                    Simpan Jumlah
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    const initialNilai = document.getElementById('nilai')?.value ?? '';

    document.getElementById('nilai')?.addEventListener('input', (e) => {
        const cancelBtn = document.getElementById('btn-cancel-statistik');
        if (!cancelBtn) return;
        if (e.target.value !== initialNilai) {
            cancelBtn.classList.remove('hidden');
        } else {
            cancelBtn.classList.add('hidden');
        }
    });

    function resetStatistikForm() {
        const input = document.getElementById('nilai');
        if (input) {
            input.value = initialNilai;
        }
        const cancelBtn = document.getElementById('btn-cancel-statistik');
        if (cancelBtn) {
            cancelBtn.classList.add('hidden');
        }
    }
</script>
@endpush
@endsection
