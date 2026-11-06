@extends('layouts.admin')

@section('title', isset($foto) ? 'Edit Foto' : 'Upload Foto')
@section('page-title', isset($foto) ? 'Edit Foto' : 'Upload Foto')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('admin.galeri.index') }}" class="hover:text-[#075B3C] transition-colors">Galeri</a>
        <i class="fa-solid fa-chevron-right text-[10px]"></i>
        <span class="text-gray-700 font-medium">{{ isset($foto) ? 'Edit' : 'Upload Baru' }}</span>
    </div>

    <form action="{{ isset($foto) ? route('admin.galeri.update', $foto['id']) : route('admin.galeri.store') }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($foto)) @method('PUT') @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-5">
            {{-- Upload area --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Foto <span class="text-red-500">*</span></label>

                @if(isset($foto))
                    <img src="{{ asset('images/' . $foto['gambar']) }}" alt=""
                         class="w-full h-48 object-cover rounded-xl mb-3 bg-gray-100">
                @endif

                <label class="flex flex-col items-center gap-3 border-2 border-dashed border-gray-200 rounded-xl p-8 cursor-pointer hover:border-[#075B3C]/40 hover:bg-green-50/30 transition-all group">
                    <i class="fa-solid fa-cloud-arrow-up text-3xl text-gray-300 group-hover:text-[#075B3C]/50 transition-colors"></i>
                    <div class="text-center">
                        <span class="text-sm text-gray-600 font-medium">Klik untuk pilih foto</span>
                        <p class="text-xs text-gray-400 mt-1">JPG, PNG, WEBP — Maksimal 5MB</p>
                    </div>
                    <input type="file" name="gambar" accept="image/*" class="hidden" {{ isset($foto) ? '' : 'required' }}
                           onchange="previewImage(this)">
                </label>
                <img id="preview-img" src="" alt="" class="hidden w-full h-48 object-cover rounded-xl mt-3">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Judul / Keterangan <span class="text-red-500">*</span></label>
                <input type="text" name="judul" value="{{ old('judul', $foto['judul'] ?? '') }}"
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all"
                       placeholder="Keterangan foto..." required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                <select name="kategori"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all">
                    @php
                        $cats = ['Kegiatan', 'Posyandu', 'Pelatihan', 'Rapat', 'Lainnya'];
                        $cur = old('kategori', $foto['kategori'] ?? 'Kegiatan');
                    @endphp
                    @foreach($cats as $c)
                        <option value="{{ $c }}" {{ $cur === $c ? 'selected' : '' }}>{{ $c }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 mt-5">
            <a href="{{ route('admin.galeri.index') }}"
               class="px-6 py-2.5 border border-gray-200 hover:bg-gray-50 text-gray-600 font-medium rounded-xl transition-all text-sm">
                Batal
            </a>
            <button type="submit"
                    class="px-6 py-2.5 bg-[#075B3C] hover:bg-[#055030] text-white font-semibold rounded-xl transition-all active:scale-95 text-sm">
                <i class="fa-solid fa-floppy-disk mr-2"></i>
                {{ isset($foto) ? 'Simpan Perubahan' : 'Upload Foto' }}
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('preview-img');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush

