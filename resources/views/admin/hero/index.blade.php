@extends('layouts.admin')

@section('title', 'Form Kelola Foto Background Beranda dan Profil Tim Pengurus')
@section('page-title', 'Form Kelola Foto Background Beranda dan Profil Tim Pengurus')

@section('content')
<div class="space-y-6">

    {{-- Header & Penjelasan Singkat (Sesuai format Data Statistik Dasawisma) --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Kelola Foto Background Beranda</h2>
            <p class="text-sm text-gray-500 mt-0.5">Perbarui foto background yang ditampilkan di halaman beranda.</p>
        </div>
        <div>
            <a href="{{ url('/') }}" target="_blank"
                class="inline-flex items-center gap-2 bg-emerald-50 hover:bg-emerald-100 text-[#075B3C] text-sm font-semibold px-4 py-2 rounded-xl border border-emerald-200 transition-colors shadow-2xs">
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                <span>Lihat di Website</span>
            </a>
        </div>
    </div>

    {{-- Alert Notifikasi --}}
    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3.5 rounded-xl text-sm flex items-start gap-3 shadow-2xs">
        <i class="fa-solid fa-circle-check text-emerald-600 mt-0.5 text-base flex-shrink-0"></i>
        <div class="flex-1 font-medium">{{ session('success') }}</div>
    </div>
    @endif

    @if(session('info'))
    <div class="bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3.5 rounded-xl text-sm flex items-start gap-3 shadow-2xs">
        <i class="fa-solid fa-circle-info text-blue-600 mt-0.5 text-base flex-shrink-0"></i>
        <div class="flex-1 font-medium">{{ session('info') }}</div>
    </div>
    @endif

    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3.5 rounded-xl text-sm shadow-2xs">
        <div class="flex items-center gap-2 font-bold mb-1">
            <i class="fa-solid fa-triangle-exclamation text-red-600"></i>
            <span>Gagal memperbarui foto:</span>
        </div>
        <ul class="list-disc list-inside text-xs space-y-1 text-red-700">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Grid Konten Utama: Pratinjau & Form Upload --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        {{-- Kolom Kiri: Pratinjau Langsung (Live Mockup) --}}
        <div class="lg:col-span-7 space-y-4">
            {{-- Kotak Tabel/Card Warna Hijau persis Struktur Organisasi --}}
            <div class="bg-[#2F9B45] rounded-2xl border border-gray-100 p-5 sm:p-6 shadow-xs space-y-4">
                <div class="flex items-center justify-between border-b border-white/20 pb-3">
                    <div>
                        <h3 class="text-sm font-bold text-white">Pratinjau Tampilan Saat Ini</h3>
                        <p class="text-[11px] text-white">Tampilan foto latar belakang pada bagian Halaman Beranda</p>
                    </div>
                </div>

                {{-- Mockup Visual Hero Beranda di dalam inner box mint (#ECFEF3) --}}
                <div class="bg-[#ECFEF3] p-3 sm:p-4 rounded-xl border border-emerald-100">
                    <div class="relative w-full h-64 sm:h-72 rounded-xl overflow-hidden shadow-inner bg-emerald-950 flex items-center justify-center border border-gray-200">
                        {{-- Foto Background Aktif --}}
                        <img id="live-hero-img" src="{{ asset($currentHero) }}"
                            alt="Hero Background TP PKK Desa Karangtanjung"
                            class="absolute inset-0 w-full h-full object-cover object-top filter brightness-[0.55] contrast-[1.05] transition-all duration-300">

                        {{-- Gradient Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-b from-emerald-950/75 via-emerald-900/50 to-emerald-950/90"></div>

                        {{-- Mockup Teks Hero --}}
                        <div class="relative z-10 px-4 text-center max-w-md mx-auto pointer-events-none select-none">
                            <span class="inline-block text-[10px] font-bold text-emerald-200 uppercase tracking-widest bg-emerald-900/80 px-2 py-0.5 rounded-md mb-2 border border-emerald-500/30">
                                TP PKK DESA KARANGTANJUNG
                            </span>
                            <h3 class="text-base sm:text-lg font-extrabold text-white leading-snug drop-shadow-sm">
                                Tim Penggerak Pemberdayaan dan Kesejahteraan Keluarga <span class="text-amber-300">Desa Karangtanjung</span>
                            </h3>
                            <p class="text-[11px] text-emerald-100/80 mt-1.5 line-clamp-2 leading-relaxed">
                                Portal informasi kegiatan, program kerja, dan data statistik TP. PKK Desa Karangtanjung.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tips Panduan Foto yang Bagus --}}
            <div class="bg-[#ECFEF3] rounded-2xl border border-emerald-200 p-5 shadow-xs">
                <h3 class="text-xs font-bold text-[#075B3C] uppercase tracking-wider mb-2 flex items-center gap-1.5">
                    <i class="fa-solid fa-lightbulb text-amber-500"></i>
                    <span>Panduan Pemilihan Foto Background</span>
                </h3>
                <ul class="text-xs text-emerald-900 space-y-1.5 leading-relaxed list-disc list-inside">
                    <li>Pilih foto dengan <strong>orientasi horizontal (landscape / mendatar)</strong> seperti rasio 16:9.</li>
                    <li>Rekomendasi resolusi minimal <strong>1920 &times; 1080 piksel</strong> agar tidak pecah/blur saat dibuka di layar komputer atau laptop.</li>
                </ul>
            </div>
        </div>

        {{-- Kolom Kanan: Form Unggah Foto Baru --}}
        <div class="lg:col-span-5">
            {{-- Kotak Tabel/Card Warna Hijau persis Struktur Organisasi --}}
            <div class="bg-[#2F9B45] rounded-2xl border border-gray-100 p-5 sm:p-6 shadow-xs space-y-4 sticky top-6">
                <div class="flex items-center justify-between border-b border-white/20 pb-3">
                    <div>
                        <h3 class="text-sm font-bold text-white">Unggah Background Baru</h3>
                        <p class="text-[11px] text-white">Pilih file gambar untuk mengganti background</p>
                    </div>
                </div>

                <form id="hero-upload-form" action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    {{-- Area Upload Drag & Drop di dalam inner box mint (#ECFEF3) --}}
                    <div class="bg-[#ECFEF3] p-4 rounded-xl border border-emerald-100 space-y-2">
                        <label for="hero_background" class="block text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Pilih File Gambar <span class="text-red-500">*</span>
                        </label>

                        <div id="dropzone"
                            onclick="document.getElementById('hero_background').click()"
                            class="relative border-2 border-dashed border-emerald-300 hover:border-emerald-600 rounded-xl p-5 text-center cursor-pointer transition-colors bg-white hover:bg-emerald-50/50 group">

                            <input type="file" id="hero_background" name="hero_background" accept="image/jpeg,image/png,image/jpg,image/webp" class="hidden" required>

                            {{-- Tampilan Kosong (Belum Memilih File) --}}
                            <div id="upload-placeholder" class="space-y-2">
                                <div class="w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 mx-auto flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-camera"></i>
                                </div>
                                <div class="text-xs text-gray-700 font-medium">
                                    <span class="text-[#075B3C] font-bold group-hover:underline">Klik di sini untuk memilih foto</span>
                                </div>
                                <p class="text-[11px] text-gray-500">
                                    Format: JPG, JPEG, PNG, atau WEBP (Maks. 5 MB)
                                </p>
                            </div>

                            {{-- Pratinjau File yang Baru Dipilih (Awalnya Sembunyi) --}}
                            <div id="new-preview-container" class="hidden space-y-2">
                                <div class="w-full h-40 rounded-lg overflow-hidden bg-black/5 relative border border-gray-200">
                                    <img id="new-preview-img" src="" alt="Pratinjau File Baru" class="w-full h-full object-cover object-top">
                                </div>
                                <div class="flex items-center justify-between text-xs pt-1">
                                    <span id="new-file-name" class="font-semibold text-gray-800 truncate max-w-[200px]">file.jpg</span>
                                    <span id="new-file-size" class="text-gray-500 text-[11px]">0 KB</span>
                                </div>
                                <p class="text-[11px] text-[#075B3C] font-medium">
                                    <i class="fa-solid fa-arrows-rotate mr-1"></i> Klik untuk mengganti file lain
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Informasi Spesifikasi --}}
                    <div class="bg-[#ECFEF3] rounded-xl p-3.5 border border-emerald-100 text-[11px] text-gray-700 space-y-1.5 font-medium">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Maksimal Ukuran:</span>
                            <span class="font-bold text-gray-900">5 MB</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Format yang didukung:</span>
                            <span class="font-bold text-gray-900">JPG, PNG, WEBP</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Orientasi:</span>
                            <span class="font-bold text-gray-900">Landscape (Mendatar)</span>
                        </div>
                    </div>

                    {{-- Tombol Aksi Simpan & Batalkan --}}
                    <div class="pt-2 flex flex-col sm:flex-row items-center gap-2">
                        <button type="button" id="btn-cancel-hero" onclick="resetHeroForm()"
                            class="hidden w-full sm:w-auto flex-1 py-2.5 px-4 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white text-xs sm:text-sm font-semibold rounded-xl shadow-sm hover:shadow transition-all flex items-center justify-center gap-1.5 cursor-pointer">
                            <i class="fa-solid fa-rotate-left"></i>
                            <span>Batalkan Perubahan</span>
                        </button>

                        <button type="submit" id="btn-submit" disabled
                            class="w-full sm:w-auto flex-1 py-2.5 px-5 bg-white/70 text-gray-400 font-semibold rounded-xl text-sm transition-all duration-200 flex items-center justify-center gap-2 cursor-not-allowed">
                            <i class="fa-solid fa-floppy-disk"></i>
                            <span>Simpan Foto Background</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    {{-- ══════════════════════════════════════════════════════
         SECTION 2: FOTO TIM "TENTANG KAMI" (HALAMAN PROFIL)
    ══════════════════════════════════════════════════════ --}}
    <div class="mt-12 pt-8 border-t border-gray-200">
        {{-- Header & Penjelasan Singkat (Sesuai format Data Statistik Dasawisma & Hero Beranda) --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Kelola Foto Background Profil Tim Pengurus</h2>
                <p class="text-sm text-gray-500 mt-0.5">Perbarui foto background profil tim pengurus yang ditampilkan di halaman profil.</p>
            </div>
            <div>
                <a href="{{ url('/profil') }}" target="_blank"
                    class="inline-flex items-center gap-2 bg-emerald-50 hover:bg-emerald-100 text-[#075B3C] text-sm font-semibold px-4 py-2 rounded-xl border border-emerald-200 transition-colors shadow-2xs">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    <span>Lihat di Website</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            {{-- Kolom Kiri: Pratinjau Foto Tim --}}
            <div class="lg:col-span-7 space-y-4">
                {{-- Kotak Tabel/Card Warna Hijau persis Struktur Organisasi & Hero Beranda --}}
                <div class="bg-[#2F9B45] rounded-2xl border border-gray-100 p-5 sm:p-6 shadow-xs space-y-4">
                    <div class="flex items-center justify-between border-b border-white/20 pb-3">
                        <div>
                            <h3 class="text-sm font-bold text-white">Pratinjau Tampilan Saat Ini</h3>
                            <p class="text-[11px] text-white">Tampilan foto latar belakang pada bagian Halaman Profil</p>
                        </div>
                    </div>

                    {{-- Mockup Visual Profil di dalam inner box mint (#ECFEF3) --}}
                    <div class="bg-[#ECFEF3] p-3 sm:p-4 rounded-xl border border-emerald-100">
                        <div class="relative w-full h-64 sm:h-72 rounded-xl overflow-hidden shadow-inner bg-gray-100 border border-gray-200">
                            <img id="live-tim-img" src="{{ asset($currentFotoTim) }}"
                                alt="Foto Tim PKK"
                                class="w-full h-full object-cover transition-all duration-300">
                            <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-emerald-950/85 to-transparent p-3 pointer-events-none">
                                <p class="text-xs font-semibold text-white leading-snug">Pengurus Tim Penggerak PKK Desa Karangtanjung</p>
                                <p class="text-[11px] text-emerald-200">Kec. Candi, Kab. Sidoarjo</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tips Panduan Foto yang Bagus --}}
                <div class="bg-[#ECFEF3] rounded-2xl border border-emerald-200 p-5 shadow-xs">
                    <h3 class="text-xs font-bold text-[#075B3C] uppercase tracking-wider mb-2 flex items-center gap-1.5">
                        <i class="fa-solid fa-lightbulb text-amber-500"></i>
                        <span>Panduan Pemilihan Foto Background</span>
                    </h3>
                    <ul class="text-xs text-emerald-900 space-y-1.5 leading-relaxed list-disc list-inside">
                        <li>Pilih foto dengan <strong>orientasi horizontal (landscape / mendatar)</strong> seperti rasio 16:9.</li>
                        <li>Rekomendasi resolusi minimal <strong>1920 &times; 1080 piksel</strong> agar tidak pecah/blur saat dibuka di layar komputer atau laptop.</li>
                    </ul>
                </div>
            </div>

            {{-- Kolom Kanan: Form Unggah Foto Baru Tim (Persis sama dengan Beranda) --}}
            <div class="lg:col-span-5">
                {{-- Kotak Tabel/Card Warna Hijau persis Struktur Organisasi & Hero Beranda --}}
                <div class="bg-[#2F9B45] rounded-2xl border border-gray-100 p-5 sm:p-6 shadow-xs space-y-4 sticky top-6">
                    <div class="flex items-center justify-between border-b border-white/20 pb-3">
                        <div>
                            <h3 class="text-sm font-bold text-white">Unggah Background Baru</h3>
                            <p class="text-[11px] text-white">Pilih file gambar untuk mengganti background</p>
                        </div>
                    </div>

                    <form id="form-foto-tim" action="{{ route('admin.hero.foto-tim.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @method('PUT')

                        {{-- Area Upload Drag & Drop di dalam inner box mint (#ECFEF3) --}}
                        <div class="bg-[#ECFEF3] p-4 rounded-xl border border-emerald-100 space-y-2">
                            <label for="foto_tim" class="block text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Pilih File Gambar <span class="text-red-500">*</span>
                            </label>

                            <div id="dropzone-tim"
                                onclick="document.getElementById('foto_tim').click()"
                                class="relative border-2 border-dashed border-emerald-300 hover:border-emerald-600 rounded-xl p-5 text-center cursor-pointer transition-colors bg-white hover:bg-emerald-50/50 group">

                                <input type="file" id="foto_tim" name="foto_tim" accept="image/jpeg,image/png,image/jpg,image/webp" class="hidden" required>

                                {{-- Tampilan Kosong (Belum Memilih File) --}}
                                <div id="tim-upload-placeholder" class="space-y-2">
                                    <div class="w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 mx-auto flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                                        <i class="fa-solid fa-camera"></i>
                                    </div>
                                    <div class="text-xs text-gray-700 font-medium">
                                        <span class="text-[#075B3C] font-bold group-hover:underline">Klik di sini untuk memilih foto</span>
                                    </div>
                                    <p class="text-[11px] text-gray-500">
                                        Format: JPG, JPEG, PNG, atau WEBP (Maks. 5 MB)
                                    </p>
                                </div>

                                {{-- Pratinjau File yang Baru Dipilih (Awalnya Sembunyi) --}}
                                <div id="tim-preview-container" class="hidden space-y-2">
                                    <div class="w-full h-40 rounded-lg overflow-hidden bg-black/5 relative border border-gray-200">
                                        <img id="tim-preview-img" src="" alt="Pratinjau File Baru" class="w-full h-full object-cover object-top">
                                    </div>
                                    <div class="flex items-center justify-between text-xs pt-1">
                                        <span id="tim-file-name" class="font-semibold text-gray-800 truncate max-w-[200px]">file.jpg</span>
                                        <span id="tim-file-size" class="text-gray-500 text-[11px]">0 KB</span>
                                    </div>
                                    <p class="text-[11px] text-[#075B3C] font-medium">
                                        <i class="fa-solid fa-arrows-rotate mr-1"></i> Klik untuk mengganti file lain
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Informasi Spesifikasi --}}
                        <div class="bg-[#ECFEF3] rounded-xl p-3.5 border border-emerald-100 text-[11px] text-gray-700 space-y-1.5 font-medium">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Maksimal Ukuran:</span>
                                <span class="font-bold text-gray-900">5 MB</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Format yang didukung:</span>
                                <span class="font-bold text-gray-900">JPG, PNG, WEBP</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Orientasi:</span>
                                <span class="font-bold text-gray-900">Landscape (Mendatar)</span>
                            </div>
                        </div>

                        {{-- Tombol Aksi Simpan & Batalkan --}}
                        <div class="pt-2 flex flex-col sm:flex-row items-center gap-2">
                            <button type="button" id="btn-cancel-tim" onclick="resetTimForm()"
                                class="hidden w-full sm:w-auto flex-1 py-2.5 px-4 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white text-xs sm:text-sm font-semibold rounded-xl shadow-sm hover:shadow transition-all flex items-center justify-center gap-1.5 cursor-pointer">
                                <i class="fa-solid fa-rotate-left"></i>
                                <span>Batalkan Perubahan</span>
                            </button>

                            <button type="submit" id="btn-submit-tim" disabled
                                class="w-full sm:w-auto flex-1 py-2.5 px-5 bg-white/70 text-gray-400 font-semibold rounded-xl text-sm transition-all duration-200 flex items-center justify-center gap-2 cursor-not-allowed">
                                <i class="fa-solid fa-floppy-disk"></i>
                                <span>Simpan Foto Background</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const fileInput = document.getElementById('hero_background');
        const placeholder = document.getElementById('upload-placeholder');
        const previewContainer = document.getElementById('new-preview-container');
        const previewImg = document.getElementById('new-preview-img');
        const fileNameEl = document.getElementById('new-file-name');
        const fileSizeEl = document.getElementById('new-file-size');
        const btnSubmit = document.getElementById('btn-submit');
        const btnCancel = document.getElementById('btn-cancel-hero');
        const liveHeroImg = document.getElementById('live-hero-img');
        const originalHeroSrc = liveHeroImg ? liveHeroImg.src : '';

        window.resetHeroForm = function() {
            if (fileInput) fileInput.value = '';
            if (placeholder) placeholder.classList.remove('hidden');
            if (previewContainer) previewContainer.classList.add('hidden');
            if (previewImg) previewImg.src = '';
            if (liveHeroImg) liveHeroImg.src = originalHeroSrc;
            if (btnSubmit) {
                btnSubmit.disabled = true;
                btnSubmit.className = 'w-full sm:w-auto flex-1 py-2.5 px-5 bg-white/70 text-gray-400 font-semibold rounded-xl text-sm transition-all duration-200 flex items-center justify-center gap-2 cursor-not-allowed';
            }
            if (btnCancel) btnCancel.classList.add('hidden');
        };

        if (!fileInput) return;

        fileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (!file) {
                resetHeroForm();
                return;
            }

            // Validasi ukuran maks 5MB di sisi klien
            const maxSize = 5 * 1024 * 1024;
            if (file.size > maxSize) {
                alert('Ukuran file melebihi batas maksimal 5 MB. Silakan pilih file lain yang lebih kecil.');
                resetHeroForm();
                return;
            }

            // Tampilkan info file
            fileNameEl.textContent = file.name;
            fileSizeEl.textContent = (file.size / (1024 * 1024)).toFixed(2) + ' MB';

            // Preview menggunakan FileReader
            const reader = new FileReader();
            reader.onload = (event) => {
                const result = event.target.result;
                previewImg.src = result;
                placeholder.classList.add('hidden');
                previewContainer.classList.remove('hidden');
                btnSubmit.disabled = false;
                btnSubmit.className = 'w-full sm:w-auto flex-1 py-2.5 px-5 bg-white hover:bg-emerald-50 active:bg-emerald-100 text-[#075B3C] font-bold rounded-xl text-sm transition-all duration-200 shadow-sm flex items-center justify-center gap-2 active:scale-95 cursor-pointer';
                if (btnCancel) btnCancel.classList.remove('hidden');

                // Update juga preview di mockup kiri agar admin bisa langsung melihat preview
                if (liveHeroImg) {
                    liveHeroImg.src = result;
                }
            };
            reader.readAsDataURL(file);
        });
    });

    // ── Foto Tim Profil ──────────────────────────────────────
    document.addEventListener('DOMContentLoaded', () => {
        const timFileInput  = document.getElementById('foto_tim');
        const timPlaceholder = document.getElementById('tim-upload-placeholder');
        const timPreviewContainer = document.getElementById('tim-preview-container');
        const timPreviewImg = document.getElementById('tim-preview-img');
        const timFileNameEl = document.getElementById('tim-file-name');
        const timFileSizeEl = document.getElementById('tim-file-size');
        const btnSubmitTim  = document.getElementById('btn-submit-tim');
        const btnCancelTim  = document.getElementById('btn-cancel-tim');
        const livTimImg     = document.getElementById('live-tim-img');
        const originalTimSrc = livTimImg ? livTimImg.src : '';

        window.resetTimForm = function() {
            if (timFileInput)        timFileInput.value = '';
            if (timPlaceholder)      timPlaceholder.classList.remove('hidden');
            if (timPreviewContainer) timPreviewContainer.classList.add('hidden');
            if (timPreviewImg)       timPreviewImg.src = '';
            if (livTimImg)           livTimImg.src = originalTimSrc;
            if (btnSubmitTim) {
                btnSubmitTim.disabled = true;
                btnSubmitTim.className = 'w-full sm:w-auto flex-1 py-2.5 px-5 bg-white/70 text-gray-400 font-semibold rounded-xl text-sm transition-all duration-200 flex items-center justify-center gap-2 cursor-not-allowed';
            }
            if (btnCancelTim) btnCancelTim.classList.add('hidden');
        };

        if (!timFileInput) return;

        timFileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (!file) {
                resetTimForm();
                return;
            }

            const maxSize = 5 * 1024 * 1024;
            if (file.size > maxSize) {
                alert('Ukuran file melebihi batas maksimal 5 MB. Silakan pilih file lain yang lebih kecil.');
                resetTimForm();
                return;
            }

            timFileNameEl.textContent = file.name;
            timFileSizeEl.textContent = (file.size / (1024 * 1024)).toFixed(2) + ' MB';

            const reader2 = new FileReader();
            reader2.onload = (ev) => {
                const result = ev.target.result;
                timPreviewImg.src = result;
                timPlaceholder.classList.add('hidden');
                timPreviewContainer.classList.remove('hidden');
                btnSubmitTim.disabled = false;
                btnSubmitTim.className = 'w-full sm:w-auto flex-1 py-2.5 px-5 bg-white hover:bg-emerald-50 active:bg-emerald-100 text-[#075B3C] font-bold rounded-xl text-sm transition-all duration-200 shadow-sm flex items-center justify-center gap-2 active:scale-95 cursor-pointer';
                if (btnCancelTim) btnCancelTim.classList.remove('hidden');

                if (livTimImg) {
                    livTimImg.src = result;
                }
            };
            reader2.readAsDataURL(file);
        });
    });
</script>
@endpush

@endsection

