@props([
    'href',
    'text' => 'Kembali',
])

<a href="{{ $href }}"
    {{ $attributes->merge(['class' => 'inline-flex items-center gap-1.5 text-xs text-white font-medium bg-[#2F9B45] hover:bg-[#26863A] active:bg-[#075B3C] border border-transparent px-3 py-1.5 rounded-lg transition-all duration-150 shadow-xs cursor-pointer']) }}>
    <i class="fa-solid fa-arrow-left"></i>
    <span>{{ $text }}</span>
</a>
