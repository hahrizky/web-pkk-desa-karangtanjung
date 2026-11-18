@extends('layouts.admin')

@section('title', 'Ubah Jumlah Statistik')
@section('page-title', 'Ubah Jumlah Statistik Dasawisma')

@section('content')
<div class="max-w-2xl">
    <div class="mb-6">
        <x-admin.btn-back :href="route('admin.statistik.index')" />
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

            <x-admin.form-actions
                :is-edit="true"
                submit-id="btn-submit-statistik"
                submit-text="Simpan Jumlah"
                cancel-id="btn-cancel-statistik"
                cancel-action="resetStatistikForm()"
            />
        </form>
    </div>
</div>

@push('scripts')
<script>
    const initialNilai = document.getElementById('nilai')?.value ?? '';

    function checkStatistikDirty() {
        const input = document.getElementById('nilai');
        const cancelBtn = document.getElementById('btn-cancel-statistik');
        const submitBtn = document.getElementById('btn-submit-statistik');
        if (!input) return;

        const isDirty = input.value !== initialNilai;

        if (submitBtn) {
            submitBtn.disabled = !isDirty;
            submitBtn.className = isDirty
                ? 'px-5 py-2 text-xs bg-[#2F9B45] hover:bg-[#26863A] active:bg-[#075B3C] text-white shadow-xs cursor-pointer font-semibold rounded-lg transition-all duration-200 flex items-center gap-2'
                : 'px-5 py-2 text-xs bg-gray-300 text-gray-500 cursor-not-allowed font-semibold rounded-lg transition-all duration-200 flex items-center gap-2';
        }

        if (cancelBtn) {
            isDirty ? cancelBtn.classList.remove('hidden') : cancelBtn.classList.add('hidden');
        }
    }

    document.getElementById('nilai')?.addEventListener('input', checkStatistikDirty);

    function resetStatistikForm() {
        const input = document.getElementById('nilai');
        if (input) input.value = initialNilai;
        checkStatistikDirty();
    }
</script>
@endpush
@endsection