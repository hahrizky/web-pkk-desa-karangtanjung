@extends('layouts.admin')

@section('title', 'Kelola Struktur Organisasi')
@section('page-title', 'Struktur Organisasi TP. PKK')

@section('content')
<style>
    .photo-preview-box img.hidden,
    .photo-preview-box .photo-icon.hidden {
        display: none !important;
    }
</style>

<div class="max-w-4xl mx-auto space-y-6">

    {{-- Top Action / Intro Bar --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 bg-[#2F9B45] p-5 rounded-2xl border border-gray-100 shadow-xs">
        <div>
            <div class="flex items-center gap-2">
                <h2 class="text-base font-bold text-white">Kelola Profil &amp; Foto Pengurus Organisasi</h2>
            </div>
            <p class="text-xs text-white mt-1">
                Perubahan otomatis tampil di bagan dan daftar profil pengurus halaman publik.
            </p>
        </div>
        <div class="flex items-center gap-2 flex-shrink-0">
            <a href="{{ route('profil') }}#struktur" target="_blank"
                class="inline-flex items-center gap-1.5 px-3 py-2 bg-[#ECFEF3] hover:bg-emerald-100 text-gray-700 text-xs font-semibold rounded-lg border border-gray-200 transition-colors">
                <i class="fa-solid fa-arrow-up-right-from-square text-[11px] text-gray-500"></i>
                <span>Lihat di Website</span>
            </a>
        </div>
    </div>

    @if (isset($errors) && $errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-xs">
        <p class="font-bold mb-1">Ada data yang belum terisi dengan benar:</p>
        <ul class="list-disc list-inside space-y-0.5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form id="struktur-form" action="{{ route('admin.struktur.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- 1. PEMBINA & PIMPINAN UTAMA --}}
        <div class="bg-[#2F9B45] rounded-2xl border border-gray-100 p-5 sm:p-6 shadow-xs space-y-5">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <div class="flex items-center gap-2.5">
                    <div>
                        <h3 class="text-sm font-bold text-white">1. Pembina &amp; Pimpinan Utama</h3>
                        <p class="text-[11px] text-white">Kepala Desa dan Pimpinan Tim Penggerak PKK</p>
                    </div>
                </div>
            </div>

            {{-- Periode --}}
            <div class="bg-[#ECFEF3] p-4 rounded-xl border border-gray-200/70">
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                    Periode Kepengurusan <span class="text-red-500">*</span>
                </label>
                <input type="text" name="periode"
                    value="{{ old('periode', $struktur['periode']) }}"
                    placeholder="Contoh: 2024 - 2029"
                    class="w-full bg-white border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600 font-medium text-gray-800" required>
                <p class="text-[11px] text-gray-400 mt-1">Ditampilkan di header bagan dan galeri profil organisasi</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {{-- Pembina --}}
                <div class="bg-[#ECFEF3] p-4 rounded-xl border border-amber-100/80 space-y-3">
                    <div class="flex items-center justify-between">
                        <label class="block text-xs font-bold text-amber-900 uppercase tracking-wider">
                            Nama Pembina <span class="text-red-500">*</span>
                        </label>
                        <span class="text-[10px] bg-[#2F9B45] text-white font-semibold px-2 py-0.5 rounded">Kepala Desa</span>
                    </div>
                    <input type="text" name="pembina_nama"
                        value="{{ old('pembina_nama', $struktur['pembina_nama']) }}"
                        placeholder="Contoh: Atmo"
                        class="w-full bg-white border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600 font-medium text-gray-800" required>
                    <input type="hidden" name="pembina_sub" value="{{ $struktur['pembina_sub'] }}">

                    @include('admin.struktur._foto_field', [
                        'field' => 'pembina_foto',
                        'label' => 'Foto Profil Pembina',
                        'borderColor' => 'border-amber-200',
                        'iconClass' => 'fa-user-large text-amber-700',
                    ])
                </div>

                {{-- Ketua --}}
                <div class="bg-[#ECFEF3] p-4 rounded-xl border border-emerald-100 space-y-3">
                    <div class="flex items-center justify-between">
                        <label class="block text-xs font-bold text-emerald-900 uppercase tracking-wider">
                            Ketua TP. PKK <span class="text-red-500">*</span>
                        </label>
                        <span class="text-[10px] bg-[#2F9B45] text-white font-semibold px-2 py-0.5 rounded">Ketua Umum</span>
                    </div>
                    <input type="text" name="ketua_nama"
                        value="{{ old('ketua_nama', $struktur['ketua_nama']) }}"
                        placeholder="Nama lengkap Ketua beserta gelar"
                        class="w-full bg-white border border-gray-300 rounded-lg px-2.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600 font-medium text-gray-800" required>

                    @include('admin.struktur._foto_field', [
                        'field' => 'ketua_foto',
                        'label' => 'Foto Profil Ketua',
                        'borderColor' => 'border-emerald-200',
                        'iconClass' => 'fa-user-large text-emerald-700',
                    ])
                </div>
            </div>

            {{-- Wakil Ketua --}}
            <div class="bg-[#ECFEF3] p-4 rounded-xl border border-emerald-100 space-y-3">
                <div class="flex items-center justify-between">
                    <label class="block text-xs font-bold text-emerald-900 uppercase tracking-wider">
                        Wakil Ketua TP. PKK <span class="text-red-500">*</span>
                    </label>
                    <span class="text-[10px] bg-[#2F9B45] text-white font-semibold px-2 py-0.5 rounded">Wakil</span>
                </div>
                <input type="text" name="wakil_nama"
                    value="{{ old('wakil_nama', $struktur['wakil_nama']) }}"
                    placeholder="Nama lengkap Wakil Ketua"
                    class="w-full bg-white border border-gray-300 rounded-lg px-2.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600 font-medium text-gray-800" required>

                @include('admin.struktur._foto_field', [
                    'field' => 'wakil_foto',
                    'label' => 'Foto Profil Wakil Ketua',
                    'borderColor' => 'border-emerald-200',
                    'iconClass' => 'fa-user-large text-emerald-700',
                ])
            </div>
        </div>

        {{-- 2. SEKRETARIAT & KEUANGAN --}}
        <div class="bg-[#2F9B45] rounded-2xl border border-gray-100 p-5 sm:p-6 shadow-xs space-y-5">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <div class="flex items-center gap-2.5">
                    <div>
                        <h3 class="text-sm font-bold text-white">2. Sekretaris &amp; Bendahara</h3>
                        <p class="text-[11px] text-white">Pengurus administrasi dan perbendaharaan PKK</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {{-- Sekretaris I --}}
                <div class="p-4 rounded-xl border border-blue-100 bg-[#ECFEF3] space-y-2.5">
                    <label class="block text-xs font-bold text-blue-900 uppercase tracking-wider">
                        Sekretaris I <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="sekretaris_1"
                        value="{{ old('sekretaris_1', $struktur['sekretaris_1']) }}"
                        placeholder="Nama Sekretaris I"
                        class="w-full bg-white border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 font-medium text-gray-800" required>

                    @include('admin.struktur._foto_field', [
                        'field' => 'sekretaris_1_foto',
                        'label' => 'Foto Profil Sekretaris I',
                        'borderColor' => 'border-blue-200',
                        'iconClass' => 'fa-user-large text-blue-600',
                    ])
                </div>

                {{-- Sekretaris II --}}
                <div class="p-4 rounded-xl border border-blue-100 bg-[#ECFEF3] space-y-2.5">
                    <label class="block text-xs font-bold text-blue-900 uppercase tracking-wider">
                        Sekretaris II <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="sekretaris_2"
                        value="{{ old('sekretaris_2', $struktur['sekretaris_2']) }}"
                        placeholder="Nama Sekretaris II"
                        class="w-full bg-white border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 font-medium text-gray-800" required>

                    @include('admin.struktur._foto_field', [
                        'field' => 'sekretaris_2_foto',
                        'label' => 'Foto Profil Sekretaris II',
                        'borderColor' => 'border-blue-200',
                        'iconClass' => 'fa-user-large text-blue-600',
                    ])
                </div>

                {{-- Bendahara I --}}
                <div class="p-4 rounded-xl border border-amber-100 bg-[#ECFEF3] space-y-2.5">
                    <label class="block text-xs font-bold text-amber-900 uppercase tracking-wider">
                        Bendahara I <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="bendahara_1"
                        value="{{ old('bendahara_1', $struktur['bendahara_1']) }}"
                        placeholder="Nama Bendahara I"
                        class="w-full bg-white border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 font-medium text-gray-800" required>

                    @include('admin.struktur._foto_field', [
                        'field' => 'bendahara_1_foto',
                        'label' => 'Foto Profil Bendahara I',
                        'borderColor' => 'border-amber-200',
                        'iconClass' => 'fa-user-large text-amber-600',
                    ])
                </div>

                {{-- Bendahara II --}}
                <div class="p-4 rounded-xl border border-amber-100 bg-[#ECFEF3] space-y-2.5">
                    <label class="block text-xs font-bold text-amber-900 uppercase tracking-wider">
                        Bendahara II <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="bendahara_2"
                        value="{{ old('bendahara_2', $struktur['bendahara_2']) }}"
                        placeholder="Nama Bendahara II"
                        class="w-full bg-white border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 font-medium text-gray-800" required>

                    @include('admin.struktur._foto_field', [
                        'field' => 'bendahara_2_foto',
                        'label' => 'Foto Profil Bendahara II',
                        'borderColor' => 'border-amber-200',
                        'iconClass' => 'fa-user-large text-amber-600',
                    ])
                </div>
            </div>
        </div>

        {{-- 3. KETUA KELOMPOK KERJA (POKJA I - IV) --}}
        <div class="bg-[#2F9B45] rounded-2xl border border-gray-100 p-5 sm:p-6 shadow-xs space-y-5">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <div class="flex items-center gap-2.5">
                    <div>
                        <h3 class="text-sm font-bold text-white">3. Ketua Kelompok Kerja (Pokja I – IV)</h3>
                        <p class="text-[11px] text-white">Pimpinan masing-masing bidang program kerja pokok PKK</p>
                    </div>
                </div>
            </div>

            @php
                $pokjaList = [
                    ['kode' => 'POKJA I', 'field' => 'pokja_1', 'nama' => 'pokja_1_ketua', 'desc' => 'Karakter & Gotong Royong'],
                    ['kode' => 'POKJA II', 'field' => 'pokja_2', 'nama' => 'pokja_2_ketua', 'desc' => 'Pendidikan & Ekonomi UP2K'],
                    ['kode' => 'POKJA III', 'field' => 'pokja_3', 'nama' => 'pokja_3_ketua', 'desc' => 'Pangan (HATINYA PKK) & Sandang'],
                    ['kode' => 'POKJA IV', 'field' => 'pokja_4', 'nama' => 'pokja_4_ketua', 'desc' => 'Kesehatan, Posyandu & Stunting'],
                ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach ($pokjaList as $pk)
                <div class="p-4 rounded-xl border border-gray-200 hover:border-emerald-300 transition-colors bg-[#ECFEF3] space-y-2.5">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">
                            {{ $pk['kode'] }}
                        </span>
                        <span class="text-[10px] text-gray-400">{{ $pk['desc'] }}</span>
                    </div>
                    <input type="text" name="{{ $pk['nama'] }}"
                        value="{{ old($pk['nama'], $struktur[$pk['nama']]) }}"
                        placeholder="Nama Ketua {{ $pk['kode'] }}"
                        class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600 font-medium text-gray-800" required>

                    @include('admin.struktur._foto_field', [
                        'field' => $pk['field'] . '_foto',
                        'label' => 'Foto Profil Ketua ' . $pk['kode'],
                        'borderColor' => 'border-emerald-200',
                        'iconClass' => 'fa-user-large text-emerald-700',
                    ])
                </div>
                @endforeach
            </div>
        </div>

        {{-- SUBMIT BAR --}}
        <div class="sticky bottom-4 z-10 bg-white/95 backdrop-blur-sm p-4 rounded-2xl border border-gray-200 shadow-md flex items-center justify-between gap-4">
            <div class="text-xs text-gray-500 hidden sm:block">
                <i class="fa-solid fa-circle-info text-emerald-600 mr-1"></i>
                Format foto yang didukung: JPG, PNG, WEBP (maksimal 5MB per foto).
            </div>
            <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
                <button type="button" id="btn-cancel-struktur" onclick="resetStrukturForm()"
                    class="hidden w-full sm:w-auto px-5 py-2.5 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-semibold rounded-xl text-sm transition-all shadow-sm flex items-center justify-center gap-1.5 cursor-pointer">
                    <i class="fa-solid fa-rotate-left"></i>
                    <span>Batalkan Perubahan</span>
                </button>
                <button type="submit" id="btn-submit-struktur" disabled
                    class="w-full sm:w-auto px-6 py-2.5 bg-gray-300 text-gray-500 font-semibold rounded-xl text-sm transition-all duration-200 flex items-center justify-center gap-2 cursor-not-allowed">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>Simpan Perubahan Struktur &amp; Foto</span>
                </button>
            </div>
        </div>

    </form>

</div>

@push('scripts')
<script>
    let initialStrukturValues = {};
    let initialPreviewHTML = {};

    function hideIconShowImage(previewBox, src) {
        let img = previewBox.querySelector('img');
        if (!img) {
            img = document.createElement('img');
            img.className = 'photo-img w-full h-full object-cover';
            previewBox.prepend(img);
        }
        if (src) img.src = src;
        img.classList.remove('hidden');
        img.style.setProperty('display', 'block', 'important');

        const icon = previewBox.querySelector('.photo-icon') || previewBox.querySelector('i');
        if (icon) {
            icon.classList.add('hidden');
            icon.style.setProperty('display', 'none', 'important');
        }
    }

    function showIconHideImage(previewBox) {
        const img = previewBox.querySelector('img');
        if (img) {
            img.classList.add('hidden');
            img.style.setProperty('display', 'none', 'important');
        }
        const icon = previewBox.querySelector('.photo-icon') || previewBox.querySelector('i');
        if (icon) {
            icon.classList.remove('hidden');
            icon.style.removeProperty('display');
            icon.style.setProperty('display', 'inline-block', 'important');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('struktur-form');
        if (!form) return;

        // Simpan nilai awal semua input teks dan hidden
        const inputs = form.querySelectorAll('input:not([name="_token"]):not([name="_method"])');
        inputs.forEach(el => {
            if (el.type !== 'file') {
                initialStrukturValues[el.name] = el.value;
            }
            el.addEventListener('input', checkStrukturDirty);
            el.addEventListener('change', checkStrukturDirty);
        });

        // Simpan markup awal kotak preview, sembunyikan icon jika ada foto, dan pasang listener file
        document.querySelectorAll('.photo-field-wrapper').forEach(wrapper => {
            const field = wrapper.dataset.field;
            const previewBox = wrapper.querySelector('.photo-preview-box');
            if (previewBox) {
                const img = previewBox.querySelector('img');
                const icon = previewBox.querySelector('.photo-icon') || previewBox.querySelector('i');
                if (img && !img.classList.contains('hidden')) {
                    if (icon) {
                        icon.classList.add('hidden');
                        icon.style.setProperty('display', 'none', 'important');
                    }
                }
            }
            if (previewBox && field) {
                initialPreviewHTML[field] = previewBox.innerHTML;
            }

            const fileInput = wrapper.querySelector('.photo-file-input');
            if (fileInput && field) {
                fileInput.addEventListener('change', function() {
                    handlePhotoPreview(this, field);
                });
            }
        });
    });

    // Helper untuk membersihkan dan me-reset elemen input file secara total
    function clearFileInput(input) {
        if (!input) return null;
        input.value = '';
        try { input.value = null; } catch (e) {}

        const clone = input.cloneNode(true);
        clone.value = '';
        input.parentNode.replaceChild(clone, input);

        const wrapper = clone.closest('.photo-field-wrapper');
        const field = wrapper ? wrapper.dataset.field : null;
        if (field) {
            clone.addEventListener('change', function() {
                handlePhotoPreview(this, field);
            });
        }
        clone.addEventListener('input', checkStrukturDirty);
        clone.addEventListener('change', checkStrukturDirty);
        return clone;
    }

    // Reset bidang foto kembali ke kondisi semula
    function resetPhotoField(field) {
        const wrapper = document.querySelector(`.photo-field-wrapper[data-field="${field}"]`);
        if (!wrapper) return;

        const fileInput = wrapper.querySelector('.photo-file-input');
        clearFileInput(fileInput);

        const deleteFlag = wrapper.querySelector('.delete-flag-input');
        if (deleteFlag) deleteFlag.value = '0';

        const hasPhoto = wrapper.dataset.hasPhoto === '1';
        const existingActions = wrapper.querySelector('.photo-existing-actions');
        const uploadActions = wrapper.querySelector('.photo-upload-actions');

        if (hasPhoto) {
            if (existingActions) existingActions.classList.remove('hidden');
            if (uploadActions) uploadActions.classList.add('hidden');
        } else {
            if (uploadActions) uploadActions.classList.remove('hidden');
        }

        const previewBox = wrapper.querySelector('.photo-preview-box');
        if (previewBox && initialPreviewHTML[field]) {
            previewBox.innerHTML = initialPreviewHTML[field];
            const img = previewBox.querySelector('img');
            if (img) {
                hideIconShowImage(previewBox);
            } else {
                showIconHideImage(previewBox);
            }
            previewBox.classList.remove('ring-2', 'ring-emerald-500', 'ring-red-400/50', 'border-red-300');
        }
    }

    // 1. Konfirmasi Hapus Foto dengan Alert Dialog Modal
    function confirmDeletePhoto(field) {
        if (typeof showAdminConfirm === 'function') {
            showAdminConfirm({
                title: 'Hapus Foto Pengurus?',
                message: 'Yakin ingin menghapus foto pengurus ini? Anda dapat memilih foto pengganti atau membiarkannya kosong.',
                confirmText: 'Ya, Hapus Foto',
                onConfirm: () => {
                    executeDeletePhoto(field);
                }
            });
        } else {
            if (confirm('Yakin ingin menghapus foto pengurus ini?')) {
                executeDeletePhoto(field);
            }
        }
    }

    function executeDeletePhoto(field) {
        const wrapper = document.querySelector(`.photo-field-wrapper[data-field="${field}"]`);
        if (!wrapper) return;

        const deleteFlag = wrapper.querySelector('.delete-flag-input');
        if (deleteFlag) deleteFlag.value = '1';

        const existingActions = wrapper.querySelector('.photo-existing-actions');
        if (existingActions) existingActions.classList.add('hidden');

        const uploadActions = wrapper.querySelector('.photo-upload-actions');
        if (uploadActions) uploadActions.classList.remove('hidden');

        const previewBox = wrapper.querySelector('.photo-preview-box');
        if (previewBox) {
            showIconHideImage(previewBox);
            previewBox.classList.add('ring-2', 'ring-red-400/50', 'border-red-300');
        }

        checkStrukturDirty();
    }

    // 2. Pratinjau Langsung saat File Baru Dipilih
    function handlePhotoPreview(input, field) {
        const wrapper = input.closest('.photo-field-wrapper');
        if (!wrapper) return;

        const previewBox = wrapper.querySelector('.photo-preview-box');
        if (!previewBox) return;

        const file = input.files && input.files[0];

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                hideIconShowImage(previewBox, e.target.result);
                previewBox.classList.remove('ring-red-400/50', 'border-red-300');
                previewBox.classList.add('ring-2', 'ring-emerald-500');
            };
            reader.readAsDataURL(file);
        }

        checkStrukturDirty();
    }

    // 3. Cek Perubahan Form (Aktifkan Simpan / Batalkan)
    function checkStrukturDirty() {
        const cancelBtn = document.getElementById('btn-cancel-struktur');
        if (!cancelBtn) return;

        const form = document.getElementById('struktur-form');
        let isDirty = false;

        const inputs = form.querySelectorAll('input:not([name="_token"]):not([name="_method"])');
        for (const el of inputs) {
            if (el.type === 'file') {
                if (el.files && el.files.length > 0) {
                    isDirty = true;
                    break;
                }
            } else {
                if (initialStrukturValues[el.name] !== undefined && el.value !== initialStrukturValues[el.name]) {
                    isDirty = true;
                    break;
                }
            }
        }

        const submitBtn = document.getElementById('btn-submit-struktur');

        if (isDirty) {
            cancelBtn.classList.remove('hidden');
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.className = 'w-full sm:w-auto px-6 py-2.5 bg-[#2F9B45] hover:bg-[#26863A] active:bg-[#075B3C] text-white font-semibold rounded-xl text-sm transition-all duration-200 shadow-sm flex items-center justify-center gap-2 active:scale-95 cursor-pointer';
            }
        } else {
            cancelBtn.classList.add('hidden');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.className = 'w-full sm:w-auto px-6 py-2.5 bg-gray-300 text-gray-500 font-semibold rounded-xl text-sm transition-all duration-200 flex items-center justify-center gap-2 cursor-not-allowed';
            }
        }
    }

    // 4. Reset seluruh form kembali ke kondisi semula (Satu tombol Batalkan Perubahan)
    function resetStrukturForm() {
        const form = document.getElementById('struktur-form');
        if (!form) return;

        // Reset native form
        form.reset();

        // Reset setiap wrapper foto secara total
        document.querySelectorAll('.photo-field-wrapper').forEach(wrapper => {
            const field = wrapper.dataset.field;
            if (field) {
                resetPhotoField(field);
            }
        });

        // Pastikan nilai teks kembali persis ke awal
        const inputs = form.querySelectorAll('input:not([name="_token"]):not([name="_method"])');
        inputs.forEach(el => {
            if (el.type !== 'file' && initialStrukturValues[el.name] !== undefined) {
                el.value = initialStrukturValues[el.name];
            }
        });

        checkStrukturDirty();
    }
</script>
@endpush
@endsection
