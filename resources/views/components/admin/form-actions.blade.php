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
])

@if($floating)
{{-- Floating sticky bar --}}
<div class="sticky bottom-4 z-30 mt-6">
    <div class="bg-white/95 backdrop-blur-sm rounded-xl border border-gray-200 shadow-lg p-3 space-y-2">
        {{-- Tombol Submit / Simpan --}}
        <button type="submit" id="{{ $submitId }}" disabled
            class="w-full py-2.5 bg-gray-300 text-gray-500 cursor-not-allowed font-semibold rounded-lg transition-all duration-200 text-sm flex items-center justify-center gap-2">
            <i class="fa-solid fa-floppy-disk"></i>
            <span>{{ $submitText }}</span>
        </button>

        {{-- Tombol Batalkan Perubahan --}}
        @if($cancelAction)
            <button type="button" id="{{ $cancelId }}" onclick="{{ $cancelAction }}"
                class="hidden w-full py-2.5 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-semibold rounded-lg text-sm transition-colors shadow-sm hover:shadow flex items-center justify-center gap-1.5 cursor-pointer">
                <i class="fa-solid fa-rotate-left"></i>
                <span>{{ $cancelText }}</span>
            </button>
        @endif
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
