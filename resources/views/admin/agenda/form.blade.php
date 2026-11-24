@extends('layouts.admin')

@section('title', isset($agenda) ? 'Edit Agenda' : 'Tambah Agenda')
@section('page-title', isset($agenda) ? 'Edit Agenda' : 'Tambah Agenda')

@section('content')
<div class="max-w-3xl mx-auto">
    {{-- Header & Navigasi Kembali --}}
    <div class="flex items-center justify-between mb-5">
        <div>
            <h2 class="text-lg font-bold text-gray-800">{{ isset($agenda) ? 'Edit Agenda Kegiatan' : 'Tambah Agenda Baru' }}</h2>
            <p class="text-xs text-gray-500 mt-0.5">Jadwalkan kegiatan TP. PKK Desa Karangtanjung</p>
        </div>
        <x-admin.btn-back :href="route('admin.agenda.index')" />
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

    <div class="bg-white rounded-xl border border-gray-200 p-5 sm:p-6 shadow-xs">
        <form id="agenda-form" action="{{ isset($agenda) ? route('admin.agenda.update', $agenda['id']) : route('admin.agenda.store') }}"
              method="POST" class="space-y-4">
            @csrf
            @if(isset($agenda)) @method('PUT') @endif

            <div>
                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                    Nama Kegiatan <span class="text-red-500">*</span>
                </label>
                <input type="text" name="judul" value="{{ old('judul', $agenda['judul'] ?? '') }}"
                       class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all"
                       placeholder="Contoh: Rapat Koordinasi TP. PKK & Penimbangan Posyandu" required>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                        Kategori Kegiatan <span class="text-red-500">*</span>
                    </label>
                    <select name="kategori" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all">
                        @php
                            $categories = ['Umum', 'Pokja I', 'Pokja II', 'Pokja III', 'Pokja IV'];
                            $currentCat = old('kategori', $agenda['kategori'] ?? 'Umum');
                        @endphp
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ $currentCat === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                        Penyelenggara <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="penyelenggara" value="{{ old('penyelenggara', $agenda['penyelenggara'] ?? 'TP. PKK Desa Karangtanjung') }}"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all"
                           placeholder="Contoh: Pokja IV / Bidan Desa" required>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                        Hari &amp; Tanggal <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $agenda['tanggal'] ?? date('Y-m-d')) }}"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all" required>
                </div>
                <div>
                    @php
                        $rawWaktu = old('waktu', $agenda['waktu'] ?? '08:00 WIB - Selesai');
                        preg_match_all('/(\d{1,2})[:.](\d{2})/', $rawWaktu, $timeMatches);
                        $waktuMulai = !empty($timeMatches[0]) ? sprintf('%02d:%02d', (int)$timeMatches[1][0], (int)$timeMatches[2][0]) : '08:00';
                        $waktuSelesai = count($timeMatches[0]) > 1 ? sprintf('%02d:%02d', (int)$timeMatches[1][1], (int)$timeMatches[2][1]) : '';
                        $isSampaiSelesai = stripos($rawWaktu, 'selesai') !== false || empty($waktuSelesai);
                    @endphp

                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Waktu Pelaksanaan <span class="text-red-500">*</span>
                        </label>
                        <label class="inline-flex items-center gap-1.5 cursor-pointer text-xs text-gray-500 hover:text-gray-800 select-none">
                            <input type="checkbox" id="check_sampai_selesai" {{ $isSampaiSelesai ? 'checked' : '' }}
                                   class="w-3.5 h-3.5 rounded border-gray-300 text-[#075B3C] focus:ring-[#075B3C]/30 focus:ring-offset-0">
                            <span class="text-[11px] font-medium">Sampai Selesai</span>
                        </label>
                    </div>

                    <div class="flex items-center gap-2">
                        <!-- Input Jam Mulai -->
                        <div class="relative flex-1">
                            <input type="time" id="picker_waktu_mulai" value="{{ $waktuMulai }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-800 bg-white focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all cursor-pointer">
                        </div>

                        <!-- Separator s/d -->
                        <span id="separator_waktu" class="text-xs font-semibold text-gray-400 shrink-0 {{ $isSampaiSelesai ? 'hidden' : '' }}">
                            s/d
                        </span>

                        <!-- Input Jam Selesai -->
                        <div id="wrapper_waktu_selesai" class="relative flex-1 {{ $isSampaiSelesai ? 'hidden' : '' }}">
                            <input type="time" id="picker_waktu_selesai" value="{{ $waktuSelesai }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-800 bg-white focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all cursor-pointer">
                        </div>

                        <!-- Zona Waktu Badge -->
                        <span class="inline-flex items-center px-2.5 py-2 text-xs font-semibold text-gray-500 bg-gray-100 border border-gray-200 rounded-lg shrink-0 select-none">
                            WIB
                        </span>
                    </div>

                    <!-- Hidden input waktu yang dikirim ke controller -->
                    <input type="hidden" name="waktu" id="input_waktu" value="{{ $rawWaktu }}">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                    Lokasi / Tempat <span class="text-red-500">*</span>
                </label>
                <input type="text" name="lokasi" value="{{ old('lokasi', $agenda['lokasi'] ?? '') }}"
                       class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all"
                       placeholder="Contoh: Balai Pertemuan Desa Karangtanjung" required>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                    Rincian &amp; Teknis Pelaksanaan <span class="text-red-500">*</span>
                </label>
                <textarea name="deskripsi" id="editor-deskripsi" rows="4"
                          class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all"
                          placeholder="Jelaskan rincian teknis pelaksanaan kegiatan, sasaran peserta, atau hal yang perlu dibawa...">{{ old('deskripsi', $agenda['deskripsi'] ?? '') }}</textarea>
            </div>

            <x-admin.form-actions
                :is-edit="isset($agenda)"
                :disabled="true"
                submit-id="btn-submit-agenda"
                :submit-text="isset($agenda) ? 'Simpan Perubahan' : 'Simpan Agenda'"
                cancel-id="btn-cancel-agenda"
                cancel-action="resetAgendaForm()"
            />
        </form>
    </div>
</div>

@push('scripts')
{{-- CKEditor 5 (Local assets untuk loading instan) --}}
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
<script>
    const isEditModeAgenda = document.querySelector('input[name="_method"]') !== null;
    let ckEditorAgendaInstance = null;
    let initialAgendaValues = {};

    // Inisialisasi CKEditor 5 pada field deskripsi / rincian agenda
    ClassicEditor
        .create(document.querySelector('#editor-deskripsi'), {
            toolbar: [
                'heading', '|',
                'bold', 'italic', '|',
                'bulletedList', 'numberedList', '|',
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
            placeholder: 'Jelaskan rincian teknis pelaksanaan kegiatan, sasaran peserta, atau hal yang perlu dibawa...'
        })
        .then(editor => {
            ckEditorAgendaInstance = editor;
            initialAgendaValues['deskripsi'] = editor.getData();

            editor.model.document.on('change:data', () => {
                document.querySelector('#editor-deskripsi').value = editor.getData();
                checkAgendaDirty();
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

            checkAgendaDirty();
        })
        .catch(error => {
            console.error('CKEditor gagal dimuat:', error);
        });

    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('agenda-form');
        if (!form) return;

        const inputs = form.querySelectorAll('input:not([name="_token"]):not([name="_method"]), select, textarea:not(#editor-deskripsi)');
        inputs.forEach(el => {
            initialAgendaValues[el.name] = el.value;
            el.addEventListener('input', checkAgendaDirty);
            el.addEventListener('change', checkAgendaDirty);
        });

        // Setup Time Picker & Waktu sync
        const pickerMulai = document.getElementById('picker_waktu_mulai');
        const pickerSelesai = document.getElementById('picker_waktu_selesai');
        const checkSelesai = document.getElementById('check_sampai_selesai');
        const wrapperSelesai = document.getElementById('wrapper_waktu_selesai');
        const separatorWaktu = document.getElementById('separator_waktu');
        const inputWaktu = document.getElementById('input_waktu');

        if (pickerMulai) initialAgendaValues['_picker_mulai'] = pickerMulai.value;
        if (pickerSelesai) initialAgendaValues['_picker_selesai'] = pickerSelesai.value;
        if (checkSelesai) initialAgendaValues['_check_selesai'] = checkSelesai.checked;

        function updateWaktuString() {
            if (!inputWaktu || !pickerMulai) return;
            const mulai = pickerMulai.value || '08:00';
            let result = '';

            if (checkSelesai && checkSelesai.checked) {
                result = `${mulai} WIB - Selesai`;
            } else {
                const selesai = pickerSelesai ? pickerSelesai.value : '';
                if (selesai) {
                    result = `${mulai} - ${selesai} WIB`;
                } else {
                    result = `${mulai} WIB - Selesai`;
                }
            }

            inputWaktu.value = result;
            checkAgendaDirty();
        }

        if (pickerMulai) {
            pickerMulai.addEventListener('input', updateWaktuString);
            pickerMulai.addEventListener('change', updateWaktuString);
        }
        if (pickerSelesai) {
            pickerSelesai.addEventListener('input', updateWaktuString);
            pickerSelesai.addEventListener('change', updateWaktuString);
        }
        if (checkSelesai) {
            checkSelesai.addEventListener('change', () => {
                if (checkSelesai.checked) {
                    if (wrapperSelesai) wrapperSelesai.classList.add('hidden');
                    if (separatorWaktu) separatorWaktu.classList.add('hidden');
                } else {
                    if (wrapperSelesai) wrapperSelesai.classList.remove('hidden');
                    if (separatorWaktu) separatorWaktu.classList.remove('hidden');
                    if (pickerSelesai && !pickerSelesai.value) {
                        const [h, m] = (pickerMulai.value || '08:00').split(':').map(Number);
                        const endH = String(Math.min(h + 2, 23)).padStart(2, '0');
                        const endM = String(m || 0).padStart(2, '0');
                        pickerSelesai.value = `${endH}:${endM}`;
                    }
                }
                updateWaktuString();
            });
        }

        // Sinkronisasi CKEditor sebelum form submit & proteksi validasi
        form.addEventListener('submit', (e) => {
            if (ckEditorAgendaInstance) {
                document.querySelector('#editor-deskripsi').value = ckEditorAgendaInstance.getData();
            }

            const judul = (form.querySelector('input[name="judul"]')?.value || '').trim();
            const kategori = (form.querySelector('select[name="kategori"]')?.value || '').trim();
            const penyelenggara = (form.querySelector('input[name="penyelenggara"]')?.value || '').trim();
            const tanggal = (form.querySelector('input[name="tanggal"]')?.value || '').trim();
            const waktu = (form.querySelector('input[name="waktu"]')?.value || '').trim();
            const lokasi = (form.querySelector('input[name="lokasi"]')?.value || '').trim();

            let deskripsiText = '';
            if (ckEditorAgendaInstance) {
                const raw = ckEditorAgendaInstance.getData();
                deskripsiText = raw.replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim();
            } else {
                const el = form.querySelector('textarea[name="deskripsi"]');
                deskripsiText = el ? el.value.trim() : '';
            }

            if (!judul || !kategori || !penyelenggara || !tanggal || !waktu || !lokasi || !deskripsiText) {
                e.preventDefault();
                if (typeof showAdminAlert === 'function') {
                    showAdminAlert({
                        title: 'Form Belum Lengkap',
                        message: 'Semua kolom pada agenda wajib diisi sebelum menyimpan.'
                    });
                } else {
                    alert('Semua kolom pada agenda wajib diisi sebelum menyimpan.');
                }
                return false;
            }
        });

        checkAgendaDirty();
    });

    function checkAgendaDirty() {
        const cancelBtn = document.getElementById('btn-cancel-agenda');
        const submitBtn = document.getElementById('btn-submit-agenda');
        const form = document.getElementById('agenda-form');
        if (!form) return;

        const judul = (form.querySelector('input[name="judul"]')?.value || '').trim();
        const kategori = (form.querySelector('select[name="kategori"]')?.value || '').trim();
        const penyelenggara = (form.querySelector('input[name="penyelenggara"]')?.value || '').trim();
        const tanggal = (form.querySelector('input[name="tanggal"]')?.value || '').trim();
        const waktu = (form.querySelector('input[name="waktu"]')?.value || '').trim();
        const lokasi = (form.querySelector('input[name="lokasi"]')?.value || '').trim();

        let deskripsiText = '';
        if (ckEditorAgendaInstance) {
            const raw = ckEditorAgendaInstance.getData();
            deskripsiText = raw.replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim();
        } else {
            const el = form.querySelector('textarea[name="deskripsi"]');
            deskripsiText = el ? el.value.trim() : '';
        }

        const isAllFilled = (judul !== '') &&
                            (kategori !== '') &&
                            (penyelenggara !== '') &&
                            (tanggal !== '') &&
                            (waktu !== '') &&
                            (lokasi !== '') &&
                            (deskripsiText !== '');

        if (!isEditModeAgenda) {
            // Mode Tambah Agenda: Tombol Simpan HANYA aktif jika SEMUA field terisi
            if (submitBtn) {
                submitBtn.disabled = !isAllFilled;
                if (isAllFilled) {
                    submitBtn.className = 'px-5 py-2 bg-[#2F9B45] hover:bg-[#26863A] active:bg-[#075B3C] text-white font-semibold rounded-lg text-xs transition-colors shadow-xs flex items-center gap-2 cursor-pointer';
                } else {
                    submitBtn.className = 'px-5 py-2 bg-gray-300 text-gray-500 font-semibold rounded-lg text-xs transition-colors flex items-center gap-2 cursor-not-allowed';
                }
            }

            // Tombol batalkan/reset muncul jika ada field yang diisi
            const isAnyFieldFilled = (judul !== '') ||
                                     (lokasi !== '') ||
                                     (deskripsiText !== '') ||
                                     (penyelenggara !== (initialAgendaValues['penyelenggara'] || 'TP. PKK Desa Karangtanjung')) ||
                                     (kategori !== (initialAgendaValues['kategori'] || 'Umum')) ||
                                     (tanggal !== (initialAgendaValues['tanggal'] || '')) ||
                                     (waktu !== (initialAgendaValues['waktu'] || '08:00 WIB - Selesai'));

            if (cancelBtn) {
                if (isAnyFieldFilled) {
                    cancelBtn.classList.remove('hidden');
                } else {
                    cancelBtn.classList.add('hidden');
                }
            }
        } else {
            // Mode Edit Agenda: Cek apakah form dirty (ada perubahan)
            let isDirty = false;
            const inputs = form.querySelectorAll('input:not([name="_token"]):not([name="_method"]), select, textarea:not(#editor-deskripsi)');
            for (const el of inputs) {
                if (initialAgendaValues[el.name] !== undefined && el.value !== initialAgendaValues[el.name]) {
                    isDirty = true;
                    break;
                }
            }

            if (!isDirty && ckEditorAgendaInstance) {
                const currentEditorData = ckEditorAgendaInstance.getData().trim();
                const initialEditorData = (initialAgendaValues['deskripsi'] || '').trim();
                if (currentEditorData !== initialEditorData) {
                    isDirty = true;
                }
            }

            // Tombol Simpan Perubahan hanya aktif jika form dirty DAN seluruh field tetap terisi lengkap
            const canSubmitEdit = isDirty && isAllFilled;
            if (submitBtn) {
                submitBtn.disabled = !canSubmitEdit;
                if (canSubmitEdit) {
                    submitBtn.className = 'px-5 py-2 bg-[#2F9B45] hover:bg-[#26863A] active:bg-[#075B3C] text-white font-semibold rounded-lg text-xs transition-colors shadow-xs flex items-center gap-2 cursor-pointer';
                } else {
                    submitBtn.className = 'px-5 py-2 bg-gray-300 text-gray-500 font-semibold rounded-lg text-xs transition-colors flex items-center gap-2 cursor-not-allowed';
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
    }

    function resetAgendaForm() {
        const form = document.getElementById('agenda-form');
        if (!form) return;

        const pickerMulai = document.getElementById('picker_waktu_mulai');
        const pickerSelesai = document.getElementById('picker_waktu_selesai');
        const checkSelesai = document.getElementById('check_sampai_selesai');
        const wrapperSelesai = document.getElementById('wrapper_waktu_selesai');
        const separatorWaktu = document.getElementById('separator_waktu');

        if (!isEditModeAgenda) {
            // Mode Tambah Agenda: kosongkan kembali field
            const judulInput = form.querySelector('input[name="judul"]');
            if (judulInput) judulInput.value = '';

            const lokasiInput = form.querySelector('input[name="lokasi"]');
            if (lokasiInput) lokasiInput.value = '';

            const waktuInput = form.querySelector('input[name="waktu"]');
            if (waktuInput) waktuInput.value = '08:00 WIB - Selesai';

            if (pickerMulai) pickerMulai.value = '08:00';
            if (pickerSelesai) pickerSelesai.value = '';
            if (checkSelesai) {
                checkSelesai.checked = true;
                if (wrapperSelesai) wrapperSelesai.classList.add('hidden');
                if (separatorWaktu) separatorWaktu.classList.add('hidden');
            }

            const kategoriSelect = form.querySelector('select[name="kategori"]');
            if (kategoriSelect) kategoriSelect.value = 'Umum';

            const penyelenggaraInput = form.querySelector('input[name="penyelenggara"]');
            if (penyelenggaraInput) penyelenggaraInput.value = 'TP. PKK Desa Karangtanjung';

            const tanggalInput = form.querySelector('input[name="tanggal"]');
            if (tanggalInput) tanggalInput.value = initialAgendaValues['tanggal'] || '';

            if (ckEditorAgendaInstance) {
                ckEditorAgendaInstance.setData('');
            }
            const deskripsiEl = document.querySelector('#editor-deskripsi');
            if (deskripsiEl) deskripsiEl.value = '';
        } else {
            // Mode Edit Agenda: kembalikan ke nilai awal
            const inputs = form.querySelectorAll('input:not([name="_token"]):not([name="_method"]), select, textarea:not(#editor-deskripsi)');
            inputs.forEach(el => {
                if (initialAgendaValues[el.name] !== undefined) {
                    el.value = initialAgendaValues[el.name];
                }
            });

            if (pickerMulai && initialAgendaValues['_picker_mulai'] !== undefined) {
                pickerMulai.value = initialAgendaValues['_picker_mulai'];
            }
            if (pickerSelesai && initialAgendaValues['_picker_selesai'] !== undefined) {
                pickerSelesai.value = initialAgendaValues['_picker_selesai'];
            }
            if (checkSelesai && initialAgendaValues['_check_selesai'] !== undefined) {
                checkSelesai.checked = initialAgendaValues['_check_selesai'];
                if (checkSelesai.checked) {
                    if (wrapperSelesai) wrapperSelesai.classList.add('hidden');
                    if (separatorWaktu) separatorWaktu.classList.add('hidden');
                } else {
                    if (wrapperSelesai) wrapperSelesai.classList.remove('hidden');
                    if (separatorWaktu) separatorWaktu.classList.remove('hidden');
                }
            }

            if (ckEditorAgendaInstance && initialAgendaValues['deskripsi'] !== undefined) {
                ckEditorAgendaInstance.setData(initialAgendaValues['deskripsi']);
                const deskripsiEl = document.querySelector('#editor-deskripsi');
                if (deskripsiEl) deskripsiEl.value = initialAgendaValues['deskripsi'];
            }
        }

        checkAgendaDirty();
    }
</script>
<style>
    /* Tinggi minimum editor CKEditor */
    .ck-editor__editable {
        min-height: 220px;
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

    /* Warna toolbar dan fokus selaras tema PKK */
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
@endsection
