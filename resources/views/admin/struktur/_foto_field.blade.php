@php
    $photoValue = $struktur[$field] ?? null;
    $hasPhoto = !empty($photoValue) && file_exists(public_path('images/' . $photoValue));
    $borderColor = $borderColor ?? 'border-emerald-200';
    $iconClass = $iconClass ?? 'fa-user text-emerald-700';
@endphp

<div class="photo-field-wrapper space-y-1.5" data-field="{{ $field }}">
    <label class="block text-[11px] font-semibold text-gray-600">{{ $label }}</label>
    <div class="flex flex-wrap items-center gap-3">
        <div class="photo-preview-box w-10 h-12 rounded-md overflow-hidden bg-white {{ $borderColor }} flex-shrink-0 flex items-center justify-center shadow-2xs transition-all">
            @if ($hasPhoto)
                <img src="{{ asset('images/' . $photoValue) }}" class="photo-img w-full h-full object-cover">
                <i class="photo-icon fa-solid {{ $iconClass }} text-xs hidden" style="display: none !important;"></i>
            @else
                <i class="photo-icon fa-solid {{ $iconClass }} text-xs"></i>
            @endif
        </div>

        <input type="hidden" name="hapus_{{ $field }}" value="0" class="delete-flag-input">

        @if ($hasPhoto)
            <div class="photo-existing-actions flex items-center gap-2">
                <button type="button" onclick="confirmDeletePhoto('{{ $field }}')"
                    class="px-2.5 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-700 border border-red-200 rounded-lg text-xs font-semibold transition-colors flex items-center gap-1.5 cursor-pointer shadow-2xs">
                    <i class="fa-solid fa-trash-can text-[11px]"></i>
                    <span>Hapus Foto</span>
                </button>
            </div>
            <div class="photo-upload-actions hidden flex flex-wrap items-center gap-2">
                <input type="file" name="{{ $field }}" accept="image/*"
                    class="photo-file-input text-xs text-gray-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-md file:border-0 file:text-[11px] font-medium file:bg-emerald-100 file:text-emerald-800 hover:file:bg-emerald-200 cursor-pointer">
            </div>
        @else
            <div class="photo-upload-actions flex flex-wrap items-center gap-2">
                <input type="file" name="{{ $field }}" accept="image/*"
                    class="photo-file-input text-xs text-gray-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-md file:border-0 file:text-[11px] font-medium file:bg-emerald-100 file:text-emerald-800 hover:file:bg-emerald-200 cursor-pointer">
            </div>
        @endif
    </div>
</div>
