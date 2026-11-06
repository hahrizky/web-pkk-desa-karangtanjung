@extends('layouts.admin')

@section('title', isset($berita) ? 'Edit Berita' : 'Tambah Berita')
@section('page-title', isset($berita) ? 'Edit Berita' : 'Tambah Berita')

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('admin.berita.index') }}" class="hover:text-[#075B3C] transition-colors">Berita</a>
        <i class="fa-solid fa-chevron-right text-[10px]"></i>
        <span class="text-gray-700 font-medium">{{ isset($berita) ? 'Edit' : 'Tambah Baru' }}</span>
    </div>

    <form action="{{ isset($berita) ? route('admin.berita.update', $berita['id']) : route('admin.berita.store') }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($berita)) @method('PUT') @endif

        <div class="grid lg:grid-cols-3 gap-6">
            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-5">
                {{-- Judul --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Berita <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" value="{{ old('judul', $berita['judul'] ?? '') }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all"
                           placeholder="Masukkan judul berita..." required>
                    @error('judul') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                {{-- Ringkasan --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Ringkasan / Deskripsi Singkat <span class="text-red-500">*</span></label>
                    <textarea name="ringkasan" rows="3"
                              class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all resize-none"
                              placeholder="Deskripsi singkat yang tampil di halaman daftar berita...">{{ old('ringkasan', $berita['ringkasan'] ?? '') }}</textarea>
                    @error('ringkasan') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                {{-- Konten --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Konten Lengkap <span class="text-red-500">*</span></label>
                    <textarea name="konten" rows="12"
                              class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all font-mono"
                              placeholder="Tulis konten berita selengkapnya di sini...">{{ old('konten', $berita['konten'] ?? '') }}</textarea>
                    <p class="text-xs text-gray-400 mt-2"><i class="fa-solid fa-circle-info mr-1"></i> Konten mendukung format teks biasa</p>
                    @error('konten') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-5">
                {{-- Publish --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-sm font-semibold text-gray-700 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-paper-plane text-[#075B3C]"></i> Publikasi
                    </h3>
                    <div class="space-y-3">
                        <button type="submit"
                                class="w-full bg-[#075B3C] hover:bg-[#055030] text-white font-semibold py-2.5 rounded-xl transition-all active:scale-95 text-sm">
                            <i class="fa-solid fa-{{ isset($berita) ? 'floppy-disk' : 'upload' }} mr-2"></i>
                            {{ isset($berita) ? 'Simpan Perubahan' : 'Publikasikan' }}
                        </button>
                        <a href="{{ route('admin.berita.index') }}"
                           class="w-full border border-gray-200 hover:bg-gray-50 text-gray-600 font-medium py-2.5 rounded-xl transition-all text-sm flex items-center justify-center gap-2">
                            <i class="fa-solid fa-xmark"></i> Batal
                        </a>
                    </div>
                </div>

                {{-- Kategori & Tanggal --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-4">
                    <h3 class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                        <i class="fa-solid fa-tag text-[#075B3C]"></i> Informasi
                    </h3>

                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1.5">Kategori</label>
                        <select name="kategori"
                                class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all">
                            @php
                                $categories = ['PKK', 'Kesehatan', 'Pendidikan', 'Lingkungan', 'Ekonomi', 'Sosial'];
                                $current = old('kategori', $berita['kategori'] ?? 'PKK');
                            @endphp
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ $current === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1.5">Tanggal Publikasi</label>
                        <input type="date" name="tanggal"
                               value="{{ old('tanggal', isset($berita['tanggal_raw']) ? $berita['tanggal_raw'] : date('Y-m-d')) }}"
                               class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1.5">Penulis</label>
                        <input type="text" name="penulis" value="{{ old('penulis', $berita['penulis'] ?? 'Tim PKK') }}"
                               class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all"
                               placeholder="Nama penulis">
                    </div>
                </div>

                {{-- Gambar --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                        <i class="fa-solid fa-image text-[#075B3C]"></i> Gambar Utama
                    </h3>

                    @if(isset($berita['gambar']))
                        <img src="{{ asset('images/' . $berita['gambar']) }}" alt=""
                             class="w-full h-32 object-cover rounded-xl mb-3 bg-gray-100">
                    @endif

                    <label class="flex flex-col items-center gap-2 border-2 border-dashed border-gray-200 rounded-xl p-4 cursor-pointer hover:border-[#075B3C]/40 hover:bg-green-50/30 transition-all group">
                        <i class="fa-solid fa-cloud-arrow-up text-2xl text-gray-300 group-hover:text-[#075B3C]/50 transition-colors"></i>
                        <span class="text-xs text-gray-500 text-center">Klik untuk upload gambar<br><span class="text-gray-400">JPG, PNG, WEBP — maks 2MB</span></span>
                        <input type="file" name="gambar" accept="image/*" class="hidden" onchange="previewImage(this)">
                    </label>
                    <img id="preview-img" src="" alt="" class="hidden w-full h-32 object-cover rounded-xl mt-3">
                </div>
            </div>
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

