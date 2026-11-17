@props([
    'href',
    'text' => 'Tambah Data',
    'icon' => 'fa-plus',
])

<a href="{{ $href }}"
    {{ $attributes->merge(['class' => 'inline-flex items-center gap-2 bg-[#2F9B45] hover:bg-[#26863A] active:bg-[#075B3C] text-white font-semibold text-sm px-5 py-2.5 rounded-xl transition-all active:scale-95 duration-100 shadow-xs cursor-pointer']) }}>
    <i class="fa-solid {{ $icon }}"></i>
    <span>{{ $text }}</span>
</a>
