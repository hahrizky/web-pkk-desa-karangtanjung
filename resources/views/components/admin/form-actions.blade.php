@props([
    'isEdit' => false,
    'submitId' => 'btn-submit',
    'submitText' => 'Simpan',
    'cancelId' => 'btn-cancel',
    'cancelAction' => null,
    'cancelText' => 'Batalkan Perubahan',
    'backUrl' => null,
    'backText' => 'Batal',
    'fullWidth' => false,
    'borderTop' => true,
    'floating' => false,
    'infoText' => 'Pastikan seluruh perubahan data sudah sesuai sebelum disimpan.',
])

@if($floating)
{{-- SUBMIT BAR (Floating Sticky persis seperti Struktur Organisasi) --}}
<div class="sticky bottom-4 z-10 bg-white/95 backdrop-blur-sm p-4 rounded-2xl border border-gray-200 shadow-md flex items-center justify-between gap-4 mt-6">
    <div class="text-xs text-gray-500 hidden sm:block">
        <i class="fa-solid fa-circle-info text-emerald-600 mr-1"></i>
        {{ $infoText }}
    </div>
    <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
        {{-- Tombol Batalkan Perubahan --}}
        @if($cancelAction)
            <button type="button" id="{{ $cancelId }}" onclick="{{ $cancelAction }}"
                class="hidden w-full sm:w-auto px-5 py-2.5 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-semibold rounded-xl text-sm transition-all shadow-sm flex items-center justify-center gap-1.5 cursor-pointer">
                <i class="fa-solid fa-rotate-left"></i>
                <span>{{ $cancelText }}</span>
            </button>
        @endif

        {{-- Tombol Submit / Simpan --}}
        <button type="submit" id="{{ $submitId }}" disabled
            class="w-full sm:w-auto px-6 py-2.5 bg-gray-300 text-gray-500 font-semibold rounded-xl text-sm transition-all duration-200 flex items-center justify-center gap-2 cursor-not-allowed">
            <i class="fa-solid fa-floppy-disk"></i>
            <span>{{ $submitText }}</span>
        </button>
    </div>
</div>
@else
<div class="{{ $fullWidth ? 'space-y-2' : 'flex items-center justify-end gap-3' }} {{ $borderTop ? 'pt-4 border-t border-gray-100' : 'pt-2' }}">
    {{-- Tombol Batalkan Perubahan (saat mode edit jika form dirty) --}}
    @if($cancelAction)
        <button type="button" id="{{ $cancelId }}" onclick="{{ $cancelAction }}"
            class="hidden {{ $fullWidth ? 'w-full justify-center py-2' : 'px-4 py-2' }} bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-semibold rounded-lg text-xs transition-colors shadow-sm hover:shadow flex items-center gap-1.5 cursor-pointer">
            <i class="fa-solid fa-rotate-left"></i>
            <span>{{ $cancelText }}</span>
        </button>
    @endif

    {{-- Tombol Batal/Kembali (hanya tampil jika bukan mode edit dan backUrl disediakan) --}}
    @if(!$isEdit && $backUrl)
        <a href="{{ $backUrl }}"
            class="{{ $fullWidth ? 'w-full block text-center' : '' }} px-4 py-2 border border-gray-200 hover:bg-gray-50 text-gray-600 font-medium rounded-lg text-xs transition-colors">
            {{ $backText }}
        </a>
    @endif

    {{-- Tombol Submit / Simpan --}}
    <button type="submit" id="{{ $submitId }}" {{ $isEdit ? 'disabled' : '' }}
        class="{{ $fullWidth ? 'w-full justify-center py-2.5 text-sm' : 'px-5 py-2 text-xs' }} {{ $isEdit ? 'bg-gray-300 text-gray-500 cursor-not-allowed' : 'bg-[#2F9B45] hover:bg-[#26863A] active:bg-[#075B3C] text-white shadow-xs cursor-pointer' }} font-semibold rounded-lg transition-all duration-200 flex items-center gap-2">
        <i class="fa-solid fa-floppy-disk"></i>
        <span>{{ $submitText }}</span>
    </button>
</div>
@endif
