@props([
    'editUrl' => null,
    'deleteUrl' => null,
    'previewUrl' => null,
    'confirmMessage' => 'Tindakan ini tidak dapat dibatalkan.',
    'align' => 'justify-end',
])

<div class="flex items-center gap-2 {{ $align }}">
    @if($previewUrl)
        <a href="{{ $previewUrl }}" target="_blank"
           class="w-8 h-8 bg-emerald-100 text-gray-500 hover:text-gray-700 hover:bg-emerald-200 rounded-lg flex items-center justify-center transition-colors"
           title="Preview">
            <i class="fa-solid fa-eye text-xs"></i>
        </a>
    @endif

    @if($editUrl)
        <a href="{{ $editUrl }}"
           class="w-8 h-8 bg-emerald-100 hover:bg-emerald-300 text-[#075B3C] rounded-lg flex items-center justify-center transition-colors"
           title="Edit">
            <i class="fa-solid fa-pen text-xs"></i>
        </a>
    @endif

    @if($deleteUrl)
        <form action="{{ $deleteUrl }}" method="POST" class="inline"
              data-confirm-message="{{ $confirmMessage }}">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="w-8 h-8 bg-red-50 hover:bg-red-100 text-red-500 rounded-lg flex items-center justify-center transition-colors cursor-pointer"
                    title="Hapus">
                <i class="fa-solid fa-trash text-xs"></i>
            </button>
        </form>
    @endif
</div>
