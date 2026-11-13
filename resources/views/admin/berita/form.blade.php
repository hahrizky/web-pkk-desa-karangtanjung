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
        <a href="{{ route('admin.berita.index') }}"
            class="inline-flex items-center gap-1.5 text-xs text-white font-medium border border-gray-200 bg-[#075B3C] hover:bg-[#087A50] active:bg-[#16A36A] px-3 py-1.5 rounded-lg transition-all duration-200">
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

    <form id="berita-form" action="{{ isset($berita) ? route('admin.berita.update', $berita['id']) : route('admin.berita.store') }}"
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
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Ringkasan Singkat
                        </label>
                        <span id="ringkasan-counter" class="text-[11px] font-medium text-gray-400">
                            0 / 160 karakter
                        </span>
                    </div>
                    <textarea name="ringkasan" id="ringkasan-input" rows="2"
                        class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all"
                        placeholder="Tulis ringkasan singkat untuk preview kartu berita...">{{ old('ringkasan', $berita['ringkasan'] ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                        Deskripsi Lengkap Berita <span class="text-red-500">*</span>
                    </label>
                    <textarea name="konten" id="editor-konten"
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
                    <p class="text-[11px] text-red-600 mb-2">
                        Ukuran file Maks. 5 MB
                    </p>

                    @if(!empty($berita['gambar']))
                    <div id="current-photo-container" class="mb-3">
                        <img src="{{ asset('images/' . $berita['gambar']) }}" alt="Foto saat ini"
                            class="w-full h-36 object-cover rounded-lg border border-gray-200">
                        <div class="flex items-center justify-between mt-1.5">
                            <span class="text-[11px] text-gray-500 truncate max-w-[160px]">Foto saat ini: {{ $berita['gambar'] }}</span>
                            <button type="button" onclick="toggleChangePhoto()"
                                class="inline-flex items-center gap-1 text-[11px] font-semibold text-[#075B3C] hover:text-[#055030] hover:underline cursor-pointer">
                                <i class="fa-solid fa-arrows-rotate"></i>
                                <span>Ganti Foto</span>
                            </button>
                        </div>
                    </div>

                    <div id="file-input-container" class="hidden">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-[11px] font-medium text-gray-600">Pilih foto baru:</span>
                            <button type="button" onclick="cancelChangePhoto()"
                                class="text-[11px] text-red-500 hover:text-red-700 hover:underline cursor-pointer">
                                Batal ganti
                            </button>
                        </div>
                        <input type="file" id="gambar-input" name="gambar" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                            class="block w-full text-xs text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-[#075B3C] hover:file:bg-emerald-100 cursor-pointer"
                            onchange="previewImage(this)">
                    </div>
                    @else
                    <input type="file" name="gambar" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                        class="block w-full text-xs text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-[#075B3C] hover:file:bg-emerald-100 cursor-pointer"
                        onchange="previewImage(this)">
                    @endif

                    <div id="preview-wrapper" class="hidden mt-2">
                        <span class="block text-[11px] text-emerald-700 font-medium mb-1">Pratinjau foto yang akan diunggah:</span>
                        <img id="preview-img" src="" alt="Pratinjau" class="w-full h-36 object-cover rounded-lg border border-emerald-300">
                    </div>
                </div>

                <div class="pt-3 border-t border-gray-100 space-y-2">
                    <button type="submit"
                        class="w-full bg-[#075B3C] hover:bg-[#055030] text-white font-semibold py-2.5 rounded-lg transition-all text-sm shadow-xs flex items-center justify-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>{{ isset($berita) ? 'Simpan Perubahan' : 'Publikasikan Berita' }}</span>
                    </button>
                    @if(isset($berita))
                    <button type="button" id="btn-cancel-edit" onclick="resetFormChanges()"
                        class="hidden w-full text-center bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-semibold py-2.5 rounded-lg transition-all text-xs shadow-sm hover:shadow flex items-center justify-center gap-1.5 cursor-pointer">
                        <i class="fa-solid fa-rotate-left"></i>
                        <span>Batalkan Perubahan</span>
                    </button>
                    @else
                    <a href="{{ route('admin.berita.index') }}"
                        class="w-full block text-center border border-gray-200 hover:bg-gray-50 text-gray-600 font-medium py-2 rounded-lg transition-all text-xs">
                        Batal
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
{{-- CKEditor 5 (Local assets untuk loading instan) --}}
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
<script>
    let ckEditorInstance = null;
    let initialFormData = {};

    // Inisialisasi CKEditor 5 pada textarea konten
    ClassicEditor
        .create(document.querySelector('#editor-konten'), {
            toolbar: [
                'bold', 'italic', '|',
                'bulletedList', 'numberedList', '|',
                'undo', 'redo'
            ],
            language: 'id',
            placeholder: 'Tuliskan berita lengkap kegiatan di sini...'
        })
        .then(editor => {
            ckEditorInstance = editor;
            initialFormData['konten'] = editor.getData();

            // Sinkronisasi data CKEditor ke textarea sebelum submit & deteksi perubahan
            editor.model.document.on('change:data', () => {
                document.querySelector('#editor-konten').value = editor.getData();
                checkFormDirty();
            });
        })
        .catch(error => {
            console.error('CKEditor gagal dimuat:', error);
        });

    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('berita-form');
        if (!form) return;

        // Inisialisasi counter ringkasan
        const ringkasanInput = document.getElementById('ringkasan-input');
        if (ringkasanInput) {
            updateRingkasanCounter(ringkasanInput.value);
            ringkasanInput.addEventListener('input', (e) => {
                updateRingkasanCounter(e.target.value);
            });
        }

        // Simpan nilai awal dari semua elemen form non-file
        const elements = form.querySelectorAll('input:not([type="file"]):not([name="_token"]):not([name="_method"]), textarea:not(#editor-konten), select');
        elements.forEach(el => {
            initialFormData[el.name] = el.value;
            el.addEventListener('input', checkFormDirty);
            el.addEventListener('change', checkFormDirty);
        });
    });

    function updateRingkasanCounter(text) {
        const counter = document.getElementById('ringkasan-counter');
        if (!counter) return;

        const count = text.length;
        counter.textContent = `${count} / 160 karakter`;

        if (count > 160) {
            counter.className = 'text-[11px] font-semibold text-amber-600';
        } else if (count >= 100) {
            counter.className = 'text-[11px] font-semibold text-emerald-700';
        } else {
            counter.className = 'text-[11px] font-medium text-gray-400';
        }
    }

    function checkFormDirty() {
        const cancelBtn = document.getElementById('btn-cancel-edit');
        if (!cancelBtn) return;

        const form = document.getElementById('berita-form');
        let isDirty = false;

        // Periksa field input/textarea/select biasa
        const elements = form.querySelectorAll('input:not([type="file"]):not([name="_token"]):not([name="_method"]), textarea:not(#editor-konten), select');
        for (const el of elements) {
            if (initialFormData[el.name] !== undefined && el.value !== initialFormData[el.name]) {
                isDirty = true;
                break;
            }
        }

        // Periksa CKEditor
        if (!isDirty && ckEditorInstance && initialFormData['konten'] !== undefined) {
            if (ckEditorInstance.getData() !== initialFormData['konten']) {
                isDirty = true;
            }
        }

        // Periksa file input gambar
        if (!isDirty) {
            const fileInput = document.getElementById('gambar-input') || form.querySelector('input[type="file"][name="gambar"]');
            if (fileInput && fileInput.files && fileInput.files.length > 0) {
                isDirty = true;
            }
        }

        if (isDirty) {
            cancelBtn.classList.remove('hidden');
        } else {
            cancelBtn.classList.add('hidden');
        }
    }

    function resetFormChanges() {
        const form = document.getElementById('berita-form');
        if (!form) return;

        // Kembalikan semua nilai input/textarea/select ke nilai awal
        const elements = form.querySelectorAll('input:not([type="file"]):not([name="_token"]):not([name="_method"]), textarea:not(#editor-konten), select');
        elements.forEach(el => {
            if (initialFormData[el.name] !== undefined) {
                el.value = initialFormData[el.name];
            }
        });

        // Kembalikan CKEditor ke konten awal
        if (ckEditorInstance && initialFormData['konten'] !== undefined) {
            ckEditorInstance.setData(initialFormData['konten']);
            document.querySelector('#editor-konten').value = initialFormData['konten'];
        }

        // Batalkan pemilihan foto jika ada
        cancelChangePhoto();

        // Sembunyikan tombol batal lagi
        const cancelBtn = document.getElementById('btn-cancel-edit');
        if (cancelBtn) {
            cancelBtn.classList.add('hidden');
        }
    }

    function toggleChangePhoto() {
        const inputContainer = document.getElementById('file-input-container');
        const photoContainer = document.getElementById('current-photo-container');
        if (inputContainer) {
            inputContainer.classList.remove('hidden');
        }
    }

    function cancelChangePhoto() {
        const inputContainer = document.getElementById('file-input-container');
        const input = document.getElementById('gambar-input');
        const previewWrapper = document.getElementById('preview-wrapper');
        const preview = document.getElementById('preview-img');

        if (input) input.value = '';
        if (preview) preview.src = '';
        if (previewWrapper) previewWrapper.classList.add('hidden');
        if (inputContainer) inputContainer.classList.add('hidden');
        checkFormDirty();
    }

    function previewImage(input) {
        const previewWrapper = document.getElementById('preview-wrapper');
        const preview = document.getElementById('preview-img');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                if (previewWrapper) previewWrapper.classList.remove('hidden');
                preview.classList.remove('hidden');
                checkFormDirty();
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            if (previewWrapper) previewWrapper.classList.add('hidden');
            checkFormDirty();
        }
    }
</script>
<style>
    /* Tinggi minimum editor CKEditor */
    .ck-editor__editable {
        min-height: 280px;
        font-size: 0.875rem;
        line-height: 1.7;
    }

    /* List bullets/numbers tetap di dalam area editor */
    .ck-editor__editable ul,
    .ck-editor__editable ol {
        padding-left: 1.5em !important;
    }

    .ck-editor__editable ul {
        list-style-type: disc !important;
    }

    .ck-editor__editable ol {
        list-style-type: decimal !important;
    }

    .ck-editor__editable strong,
    .ck-editor__editable b {
        font-weight: 700 !important;
    }

    /* Warna fokus toolbar selaras tema PKK */
    .ck.ck-toolbar {
        border-color: #e5e7eb !important;
        background: #f9fafb !important;
    }

    .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused) {
        border-color: #d1d5db !important;
    }

    .ck.ck-editor__main>.ck-editor__editable.ck-focused {
        border-color: #075B3C !important;
        box-shadow: 0 0 0 2px rgba(7, 91, 60, 0.15) !important;
    }
</style>
@endpush