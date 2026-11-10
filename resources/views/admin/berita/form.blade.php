@extends('layouts.admin')

@section('title', isset($berita) ? 'Edit Berita' : 'Tambah Berita')
@section('page-title', isset($berita) ? 'Edit Berita' : 'Tambah Berita')

@section('content')
<div class="max-w-5xl mx-auto">
    {{-- Header & Navigasi Kembali --}}
    <div class="flex items-center justify-between mb-5">
        <div>
            <h2 class="text-lg font-bold text-gray-800">{{ isset($berita) ? 'Edit Berita' : 'Tulis Berita Baru' }}</h2>
            <p class="text-xs text-gray-500 mt-0.5">Lengkapi formulir di bawah ini untuk mempublikasikan berita kegiatan</p>
        </div>
        <a href="{{ route('admin.berita.index') }}" class="inline-flex items-center gap-1.5 text-xs text-gray-600 hover:text-[#075B3C] font-medium border border-gray-200 bg-white px-3 py-1.5 rounded-lg transition-colors">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-5 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-xs">
            <p class="font-bold mb-1">Ada data yang belum terisi dengan benar:</p>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($berita) ? route('admin.berita.update', $berita['id']) : route('admin.berita.store') }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($berita)) @method('PUT') @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
            {{-- Kolom Kiri: Konten Utama --}}
            <div class="lg:col-span-2 bg-white rounded-xl border border-gray-200 p-5 sm:p-6 shadow-xs space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                        Judul Berita <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="judul" value="{{ old('judul', $berita['judul'] ?? '') }}"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all"
                           placeholder="Contoh: Kegiatan Posyandu Balita dan Lansia Desa Karangtanjung" required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                        Ringkasan Singkat
                    </label>
                    <textarea name="ringkasan" rows="2"
                              class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all"
                              placeholder="Deskripsi singkat untuk kartu berita di beranda...">{{ old('ringkasan', $berita['ringkasan'] ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                        Konten Berita Lengkap <span class="text-red-500">*</span>
                    </label>
                    <textarea name="konten" rows="12"
                              class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all leading-relaxed"
                              placeholder="Tuliskan berita lengkap kegiatan di sini..." required>{{ old('konten', $berita['konten'] ?? '') }}</textarea>
                </div>
            </div>

            {{-- Kolom Kanan: Pengaturan & Media --}}
            <div class="bg-white rounded-xl border border-gray-200 p-5 sm:p-6 shadow-xs space-y-4 h-fit">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                        Kategori Kegiatan <span class="text-red-500">*</span>
                    </label>
                    <select name="kategori"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all">
                        @php
                            $categories = ['Umum', 'Pokja I', 'Pokja II', 'Pokja III', 'Pokja IV'];
                            $current = old('kategori', $berita['kategori'] ?? 'Umum');
                        @endphp
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ $current === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                        Tanggal Kegiatan <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="tanggal"
                           value="{{ old('tanggal', isset($berita['tanggal_raw']) ? $berita['tanggal_raw'] : date('Y-m-d')) }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all" required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                        Penulis / Pelapor
                    </label>
                    <input type="text" name="penulis" value="{{ old('penulis', $berita['penulis'] ?? 'Sekretariat TP. PKK Karangtanjung') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                        Foto Dokumentasi
                    </label>
                    <p class="text-[11px] text-gray-500 mb-2">
                        PG, PNG, atau WebP · Maks. 5 MB. Disarankan menggunakan WebP untuk ukuran file lebih kecil
                    </p>

                    @if(!empty($berita['gambar']))
                        <div class="mb-2">
                            <img src="{{ asset('images/' . $berita['gambar']) }}" alt="Foto saat ini"
                                 class="w-full h-32 object-cover rounded-lg border border-gray-200">
                            <span class="block text-[11px] text-gray-400 mt-1">Foto saat ini: {{ $berita['gambar'] }}</span>
                        </div>
                    @endif

                    <input type="file" name="gambar" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                           class="block w-full text-xs text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-[#075B3C] hover:file:bg-emerald-100 cursor-pointer"
                           onchange="previewImage(this)">
                    <img id="preview-img" src="" alt="" class="hidden w-full h-32 object-cover rounded-lg mt-2 border border-emerald-300">
                </div>

                <div class="pt-3 border-t border-gray-100 space-y-2">
                    <button type="submit"
                            class="w-full bg-[#075B3C] hover:bg-[#055030] text-white font-semibold py-2.5 rounded-lg transition-all text-sm shadow-xs flex items-center justify-center gap-2">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>{{ isset($berita) ? 'Simpan Perubahan' : 'Publikasikan Berita' }}</span>
                    </button>
                    <a href="{{ route('admin.berita.index') }}"
                       class="w-full block text-center border border-gray-200 hover:bg-gray-50 text-gray-600 font-medium py-2 rounded-lg transition-all text-xs">
                        Batal
                    </a>
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
