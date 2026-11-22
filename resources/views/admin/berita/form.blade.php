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
        <x-admin.btn-back :href="route('admin.berita.index')" />
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
                            Ringkasan Singkat <span class="text-red-500">*</span>
                        </label>
                        <span id="ringkasan-counter" class="text-[11px] font-medium text-gray-400">
                            0 / 160 karakter
                        </span>
                    </div>
                    <textarea name="ringkasan" id="ringkasan-input" rows="2"
                        class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all"
                        placeholder="Tulis ringkasan singkat untuk preview kartu berita..." required>{{ old('ringkasan', $berita['ringkasan'] ?? '') }}</textarea>
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
                    <select name="kategori" required
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
                        Penulis / Pelapor <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="penulis" value="{{ old('penulis', $berita['penulis'] ?? 'Sekretariat TP. PKK Karangtanjung') }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all" required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                        Foto Dokumentasi @if(!isset($berita))<span class="text-red-500">*</span>@endif
                    </label>
                    <p class="text-[11px] text-red-600 mb-2">
                        Ukuran file Maks. 5 MB @if(!isset($berita))(Wajib diunggah)@endif
                    </p>

                    @if(!empty($berita['gambar']))
                    <div class="mb-3">
                        <img id="current-photo-img" src="{{ asset('images/' . $berita['gambar']) }}" alt="Foto saat ini"
                            class="w-full h-36 object-cover rounded-lg border border-gray-200">
                        <span class="block text-[11px] text-gray-500 mt-1 truncate">Foto saat ini: {{ $berita['gambar'] }}</span>
                    </div>
                    @endif

                    <input type="file" id="gambar-input" name="gambar" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                        class="block w-full text-xs text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-[#075B3C] hover:file:bg-emerald-100 cursor-pointer"
                        onchange="previewImage(this)" {{ !isset($berita) ? 'required' : '' }}>

                    <div id="preview-wrapper" class="hidden mt-2">
                        <span class="block text-[11px] text-emerald-700 font-medium mb-1">Pratinjau foto baru:</span>
                        <img id="preview-img" src="" alt="Pratinjau" class="w-full h-36 object-cover rounded-lg border border-emerald-300">
                    </div>
                </div>

                <x-admin.form-actions
                    :is-edit="isset($berita)"
                    :disabled="true"
                    submit-id="btn-submit-berita"
                    :submit-text="isset($berita) ? 'Simpan Perubahan' : 'Publikasikan Berita'"
                    cancel-id="btn-cancel-edit"
                    cancel-action="resetFormChanges()"
                    :full-width="true" />
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
{{-- CKEditor 5 (Local assets untuk loading instan) --}}
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
<script>
    const isEditModeBerita = document.querySelector('input[name="_method"]') !== null;
    let ckEditorInstance = null;
    let initialFormData = {};

    // Inisialisasi CKEditor 5 pada textarea konten
    ClassicEditor
        .create(document.querySelector('#editor-konten'), {
            toolbar: [
                'heading', '|',
                'bold', 'italic', '|',
                'bulletedList', 'numberedList', '|',
                'outdent', 'indent', '|',
                'undo', 'redo'
            ],
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraf (Normal)', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h2', title: 'Judul Besar (H2)', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h3', title: 'Judul Sedang (H3)', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h4', title: 'Judul Kecil (H4)', class: 'ck-heading_heading3' }
                ]
            },
            language: 'id',
            placeholder: 'Tuliskan berita lengkap kegiatan di sini...'
        })
        .then(editor => {
            ckEditorInstance = editor;
            initialFormData['konten'] = editor.getData();

            // Sinkronisasi data CKEditor ke textarea sebelum submit & deteksi perubahan
            editor.model.document.on('change:data', () => {
                document.querySelector('#editor-konten').value = editor.getData();
                updateFormState();
            });

            // Menangani tombol Backspace pada bullet/number list kosong agar keluar dari list dan kembali ke paragraf normal
            editor.editing.view.document.on('delete', (evt, data) => {
                if (data.direction === 'backward') {
                    const selection = editor.model.document.selection;
                    if (selection.isCollapsed) {
                        const pos = selection.getFirstPosition();
                        const block = pos ? pos.parent : null;
                        if (block && block.is('element', 'listItem') && block.isEmpty) {
                            editor.execute('outdentList');
                            data.preventDefault();
                            evt.stop();
                        }
                    }
                }
            }, { priority: 'high' });

            updateFormState();
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

        // Event listener ke semua input/textarea/select
        const elements = form.querySelectorAll('input:not([name="_token"]):not([name="_method"]), textarea:not(#editor-konten), select');
        elements.forEach(el => {
            if (el.type !== 'file') {
                initialFormData[el.name] = el.value;
            }
            el.addEventListener('input', updateFormState);
            el.addEventListener('change', updateFormState);
        });

        updateFormState();
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

    function checkCreateFormValid() {
        const cancelBtn = document.getElementById('btn-cancel-edit');
        const submitBtn = document.getElementById('btn-submit-berita');
        const form = document.getElementById('berita-form');
        if (!form || !submitBtn) return;

        const judul = form.querySelector('input[name="judul"]')?.value.trim() || '';
        const ringkasan = form.querySelector('textarea[name="ringkasan"]')?.value.trim() || '';
        const kategori = form.querySelector('select[name="kategori"]')?.value.trim() || '';
        const tanggal = form.querySelector('input[name="tanggal"]')?.value.trim() || '';
        const penulis = form.querySelector('input[name="penulis"]')?.value.trim() || '';

        // Cek konten CKEditor: bersihkan tag HTML, newline, dan spasi kosong
        let kontenText = '';
        if (ckEditorInstance) {
            const raw = ckEditorInstance.getData();
            kontenText = raw.replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim();
        } else {
            const el = form.querySelector('textarea[name="konten"]');
            kontenText = el ? el.value.trim() : '';
        }

        // Cek foto dokumentasi: wajib ada file gambar terpilih
        const fileInput = document.getElementById('gambar-input') || form.querySelector('input[type="file"][name="gambar"]');
        const hasImage = fileInput && fileInput.files && fileInput.files.length > 0;

        // Cek apakah ada field yang sudah terisi untuk memunculkan tombol batalkan perubahan
        const isAnyFieldFilled = (judul !== '') ||
                                 (ringkasan !== '') ||
                                 (kontenText !== '') ||
                                 (penulis !== (initialFormData['penulis'] || '')) ||
                                 (tanggal !== (initialFormData['tanggal'] || '')) ||
                                 (kategori !== (initialFormData['kategori'] || 'Umum')) ||
                                 hasImage;

        if (cancelBtn) {
            if (isAnyFieldFilled) {
                cancelBtn.classList.remove('hidden');
            } else {
                cancelBtn.classList.add('hidden');
            }
        }

        const isValid = (judul !== '') &&
                        (ringkasan !== '') &&
                        (kontenText !== '') &&
                        (kategori !== '') &&
                        (tanggal !== '') &&
                        (penulis !== '') &&
                        hasImage;

        submitBtn.disabled = !isValid;
        if (isValid) {
            submitBtn.className = 'w-full bg-[#2F9B45] hover:bg-[#26863A] active:bg-[#075B3C] text-white font-semibold py-2.5 rounded-lg transition-all duration-200 text-sm shadow-sm flex items-center justify-center gap-2 cursor-pointer';
        } else {
            submitBtn.className = 'w-full bg-gray-300 text-gray-500 font-semibold py-2.5 rounded-lg transition-all duration-200 text-sm flex items-center justify-center gap-2 cursor-not-allowed';
        }
    }

    function checkFormDirty() {
        const cancelBtn = document.getElementById('btn-cancel-edit');
        const submitBtn = document.getElementById('btn-submit-berita');
        const form = document.getElementById('berita-form');
        if (!form) return;

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

        if (submitBtn) {
            submitBtn.disabled = !isDirty;
            if (isDirty) {
                submitBtn.className = 'w-full bg-[#2F9B45] hover:bg-[#26863A] active:bg-[#075B3C] text-white font-semibold py-2.5 rounded-lg transition-all duration-200 text-sm shadow-sm flex items-center justify-center gap-2 cursor-pointer';
            } else {
                submitBtn.className = 'w-full bg-gray-300 text-gray-500 font-semibold py-2.5 rounded-lg transition-all duration-200 text-sm flex items-center justify-center gap-2 cursor-not-allowed';
            }
        }

        if (cancelBtn) {
            if (isDirty) {
                cancelBtn.classList.remove('hidden');
            } else {
                cancelBtn.classList.add('hidden');
            }
        }
    }

    function updateFormState() {
        if (isEditModeBerita) {
            checkFormDirty();
        } else {
            checkCreateFormValid();
        }
    }

    function resetFormChanges() {
        const form = document.getElementById('berita-form');
        if (!form) return;

        if (!isEditModeBerita) {
            // Mode Tambah Berita: kosongkan seluruh field input
            const judulInput = form.querySelector('input[name="judul"]');
            if (judulInput) judulInput.value = '';

            const ringkasanInput = form.querySelector('textarea[name="ringkasan"]');
            if (ringkasanInput) {
                ringkasanInput.value = '';
                updateRingkasanCounter('');
            }

            if (ckEditorInstance) {
                ckEditorInstance.setData('');
            }
            const kontenEl = document.querySelector('#editor-konten');
            if (kontenEl) kontenEl.value = '';

            const kategoriSelect = form.querySelector('select[name="kategori"]');
            if (kategoriSelect) kategoriSelect.value = initialFormData['kategori'] || 'Umum';

            const tanggalInput = form.querySelector('input[name="tanggal"]');
            if (tanggalInput) tanggalInput.value = initialFormData['tanggal'] || '';

            const penulisInput = form.querySelector('input[name="penulis"]');
            if (penulisInput) penulisInput.value = initialFormData['penulis'] || 'Sekretariat TP. PKK Karangtanjung';

            const input = document.getElementById('gambar-input');
            const previewWrapper = document.getElementById('preview-wrapper');
            const preview = document.getElementById('preview-img');
            if (input) input.value = '';
            if (preview) preview.src = '';
            if (previewWrapper) previewWrapper.classList.add('hidden');
        } else {
            // Mode Edit Berita: kembalikan semua nilai input ke data awal
            const elements = form.querySelectorAll('input:not([type="file"]):not([name="_token"]):not([name="_method"]), textarea:not(#editor-konten), select');
            elements.forEach(el => {
                if (initialFormData[el.name] !== undefined) {
                    el.value = initialFormData[el.name];
                }
            });

            const ringkasanInput = form.querySelector('textarea[name="ringkasan"]');
            if (ringkasanInput) updateRingkasanCounter(ringkasanInput.value);

            if (ckEditorInstance && initialFormData['konten'] !== undefined) {
                ckEditorInstance.setData(initialFormData['konten']);
                document.querySelector('#editor-konten').value = initialFormData['konten'];
            }

            const input = document.getElementById('gambar-input');
            const previewWrapper = document.getElementById('preview-wrapper');
            const preview = document.getElementById('preview-img');
            if (input) input.value = '';
            if (preview) preview.src = '';
            if (previewWrapper) previewWrapper.classList.add('hidden');
        }

        updateFormState();
    }

    function previewImage(input) {
        const previewWrapper = document.getElementById('preview-wrapper');
        const preview = document.getElementById('preview-img');
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const maxBytes = 5 * 1024 * 1024; // 5 MB

            if (file.size > maxBytes) {
                const currentMB = (file.size / (1024 * 1024)).toFixed(2);
                if (typeof showAdminAlert === 'function') {
                    showAdminAlert({
                        title: 'Ukuran Foto Terlalu Besar',
                        message: `Foto dokumentasi yang Anda pilih berukuran ${currentMB} MB, melebihi batas maksimal yang diizinkan (5 MB). Silakan pilih foto dengan ukuran lebih kecil.`
                    });
                } else {
                    alert(`Ukuran foto (${currentMB} MB) melebihi batas maksimal 5 MB.`);
                }
                input.value = '';
                if (previewWrapper) previewWrapper.classList.add('hidden');
                if (preview) preview.src = '';
                updateFormState();
                return;
            }

            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                if (previewWrapper) previewWrapper.classList.remove('hidden');
                preview.classList.remove('hidden');
                updateFormState();
            };
            reader.readAsDataURL(file);
        } else {
            if (previewWrapper) previewWrapper.classList.add('hidden');
            updateFormState();
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

    /* List bullets/numbers di area editor */
    .ck-editor__editable ul,
    .ck-editor__editable ol {
        padding-left: 1.5em !important;
        margin-top: 0.5em !important;
        margin-bottom: 0.5em !important;
    }

    .ck-editor__editable ul {
        list-style-type: disc !important;
    }

    .ck-editor__editable ol {
        list-style-type: decimal !important;
    }

    .ck-editor__editable ul ul {
        list-style-type: circle !important;
    }

    .ck-editor__editable ol ol {
        list-style-type: lower-alpha !important;
    }

    .ck-editor__editable li {
        margin-bottom: 0.25em !important;
    }

    /* Paragraf normal di dalam editor TIDAK boleh mewarisi indentasi list */
    .ck-editor__editable > p {
        margin-bottom: 0.75em !important;
        padding-left: 0 !important;
        margin-left: 0 !important;
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