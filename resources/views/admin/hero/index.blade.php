@extends('layouts.admin')

@section('title', 'Form Kelola Foto Background Beranda dan Profil Tim Pengurus')
@section('page-title', 'Form Kelola Foto Background Beranda dan Profil Tim Pengurus')

@section('content')
<div class="space-y-6">

    {{-- Header halaman --}}
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

    {{-- Notifikasi sukses/error ditampilkan oleh layout admin. --}}
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
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

        {{-- Kolom Kiri: Pratinjau Langsung (Live Mockup) --}}
        <div id="left-col-hero" class="lg:col-span-7 space-y-4">
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
        <div id="right-col-hero" class="lg:col-span-5">
            <div class="bg-[#2F9B45] rounded-2xl border border-gray-100 p-5 sm:p-6 shadow-xs space-y-4">
                <div class="flex items-center justify-between border-b border-white/20 pb-3">
                    <div>
                        <h3 class="text-sm font-bold text-white">Unggah Background Baru</h3>
                        <p class="text-[11px] text-white">Pilih file gambar untuk mengganti background</p>
                    </div>
                </div>

                <form id="hero-upload-form" action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                    @csrf
                    @method('PUT')

                    {{-- Area Upload Drag & Drop di dalam inner box mint (#ECFEF3) --}}
                    <div class="bg-[#ECFEF3] p-3 rounded-xl border border-emerald-100 space-y-1.5">
                        <label for="hero_background" class="block text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Pilih File Gambar <span class="text-red-500">*</span>
                        </label>

                        <div id="dropzone"
                            onclick="document.getElementById('hero_background').click()"
                            class="relative border-2 border-dashed border-emerald-300 hover:border-emerald-600 rounded-xl p-3.5 text-center cursor-pointer transition-colors bg-white hover:bg-emerald-50/50 group">

                            <input type="file" id="hero_background" name="hero_background" accept="image/jpeg,image/png,image/jpg,image/webp" class="hidden" required>

                            {{-- Tampilan Kosong (Belum Memilih File) --}}
                            <div id="upload-placeholder" class="space-y-1.5">
                                <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-700 mx-auto flex items-center justify-center text-lg group-hover:scale-110 transition-transform">
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
                            <div id="new-preview-container" class="hidden flex items-center gap-3 text-left">
                                <div class="w-14 h-14 rounded-lg overflow-hidden bg-gray-100 border border-gray-200 flex-shrink-0">
                                    <img id="new-preview-img" src="" alt="Pratinjau File Baru" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1 min-w-0 space-y-0.5">
                                    <div id="new-file-name" class="font-semibold text-gray-800 text-xs truncate">file.jpg</div>
                                    <div id="new-file-size" class="text-gray-500 text-[11px]">0 KB</div>
                                    <p class="text-[11px] text-[#075B3C] font-medium flex items-center gap-1">
                                        <i class="fa-solid fa-arrows-rotate text-[10px]"></i> Klik untuk ganti file
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Informasi Ketentuan Upload file --}}
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
                    <div class="pt-1 flex flex-col items-stretch gap-2">
                        <button type="submit" id="btn-submit" disabled
                            class="w-full py-2.5 px-5 bg-white/70 text-gray-400 font-semibold rounded-xl text-sm transition-all duration-200 flex items-center justify-center gap-2 cursor-not-allowed">
                            <i class="fa-solid fa-floppy-disk"></i>
                            <span>Simpan Foto Background</span>
                        </button>

                        <button type="button" id="btn-cancel-hero" onclick="resetHeroForm()"
                            class="hidden w-full py-2.5 px-5 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white text-sm font-semibold rounded-xl shadow-sm hover:shadow transition-all flex items-center justify-center gap-1.5 cursor-pointer">
                            <i class="fa-solid fa-rotate-left"></i>
                            <span>Batalkan Perubahan</span>
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
        {{-- Header bagian foto tim --}}
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

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            {{-- Kolom Kiri: Pratinjau Foto Tim --}}
            <div id="left-col-tim" class="lg:col-span-7 space-y-4">
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

            {{-- Form unggah foto tim --}}
            <div id="right-col-tim" class="lg:col-span-5">
                <div class="bg-[#2F9B45] rounded-2xl border border-gray-100 p-5 sm:p-6 shadow-xs space-y-3">
                    <div class="flex items-center justify-between border-b border-white/20 pb-3">
                        <div>
                            <h3 class="text-sm font-bold text-white">Unggah Background Baru</h3>
                            <p class="text-[11px] text-white">Pilih file gambar untuk mengganti background</p>
                        </div>
                    </div>

                    <form id="form-foto-tim" action="{{ route('admin.hero.foto-tim.update') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                        @csrf
                        @method('PUT')

                        {{-- Area Upload Drag & Drop di dalam inner box mint (#ECFEF3) --}}
                        <div class="bg-[#ECFEF3] p-3 rounded-xl border border-emerald-100 space-y-1.5">
                            <label for="foto_tim" class="block text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Pilih File Gambar <span class="text-red-500">*</span>
                            </label>

                            <div id="dropzone-tim"
                                onclick="document.getElementById('foto_tim').click()"
                                class="relative border-2 border-dashed border-emerald-300 hover:border-emerald-600 rounded-xl p-3.5 text-center cursor-pointer transition-colors bg-white hover:bg-emerald-50/50 group">

                                <input type="file" id="foto_tim" name="foto_tim" accept="image/jpeg,image/png,image/jpg,image/webp" class="hidden" required>

                                {{-- Tampilan Kosong (Belum Memilih File) --}}
                                <div id="tim-upload-placeholder" class="space-y-1.5">
                                    <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-700 mx-auto flex items-center justify-center text-lg group-hover:scale-110 transition-transform">
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
                                <div id="tim-preview-container" class="hidden flex items-center gap-3 text-left">
                                    <div class="w-14 h-14 rounded-lg overflow-hidden bg-gray-100 border border-gray-200 flex-shrink-0">
                                        <img id="tim-preview-img" src="" alt="Pratinjau File Baru" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-1 min-w-0 space-y-0.5">
                                        <div id="tim-file-name" class="font-semibold text-gray-800 text-xs truncate">file.jpg</div>
                                        <div id="tim-file-size" class="text-gray-500 text-[11px]">0 KB</div>
                                        <p class="text-[11px] text-[#075B3C] font-medium flex items-center gap-1">
                                            <i class="fa-solid fa-arrows-rotate text-[10px]"></i> Klik untuk ganti file
                                        </p>
                                    </div>
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
                        <div class="pt-1 flex flex-col items-stretch gap-2">
                            <button type="submit" id="btn-submit-tim" disabled
                                class="w-full py-2.5 px-5 bg-white/70 text-gray-400 font-semibold rounded-xl text-sm transition-all duration-200 flex items-center justify-center gap-2 cursor-not-allowed">
                                <i class="fa-solid fa-floppy-disk"></i>
                                <span>Simpan Foto Background</span>
                            </button>

                            <button type="button" id="btn-cancel-tim" onclick="resetTimForm()"
                                class="hidden w-full py-2.5 px-5 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white text-sm font-semibold rounded-xl shadow-sm hover:shadow transition-all flex items-center justify-center gap-1.5 cursor-pointer">
                                <i class="fa-solid fa-rotate-left"></i>
                                <span>Batalkan Perubahan</span>
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
        const disabledButtonClasses = 'w-full py-2.5 px-5 bg-white/70 text-gray-400 font-semibold rounded-xl text-sm transition-all duration-200 flex items-center justify-center gap-2 cursor-not-allowed';
        const enabledButtonClasses = 'w-full py-2.5 px-5 bg-white hover:bg-emerald-50 active:bg-emerald-100 text-[#075B3C] font-bold rounded-xl text-sm transition-all duration-200 shadow-sm flex items-center justify-center gap-2 active:scale-95 cursor-pointer';

        const setupImageUpload = (config) => {
            const input = document.getElementById(config.input);
            const placeholder = document.getElementById(config.placeholder);
            const previewContainer = document.getElementById(config.previewContainer);
            const previewImage = document.getElementById(config.previewImage);
            const fileName = document.getElementById(config.fileName);
            const fileSize = document.getElementById(config.fileSize);
            const submitButton = document.getElementById(config.submitButton);
            const cancelButton = document.getElementById(config.cancelButton);
            const liveImage = document.getElementById(config.liveImage);
            const originalImage = liveImage ? liveImage.src : '';

            const reset = () => {
                input.value = '';
                placeholder.classList.remove('hidden');
                previewContainer.classList.add('hidden');
                previewImage.src = '';
                if (liveImage) liveImage.src = originalImage;
                submitButton.disabled = true;
                submitButton.className = disabledButtonClasses;
                cancelButton.classList.add('hidden');
            };

            window[config.resetFunction] = reset;

            input.addEventListener('change', (event) => {
                const selectedFile = event.target.files[0];
                if (!selectedFile) {
                    reset();
                    return;
                }

                if (selectedFile.size > 5 * 1024 * 1024) {
                    const currentMB = (selectedFile.size / (1024 * 1024)).toFixed(2);
                    if (typeof showAdminAlert === 'function') {
                        showAdminAlert({
                            title: 'Ukuran Foto Terlalu Besar',
                            message: `Foto yang Anda pilih berukuran ${currentMB} MB, melebihi batas maksimal yang diizinkan (5 MB). Silakan pilih foto dengan ukuran lebih kecil.`
                        });
                    } else {
                        alert(`Ukuran file (${currentMB} MB) melebihi batas maksimal 5 MB. Silakan pilih file lain yang lebih kecil.`);
                    }
                    reset();
                    return;
                }

                fileName.textContent = selectedFile.name;
                fileSize.textContent = (selectedFile.size / (1024 * 1024)).toFixed(2) + ' MB';

                const reader = new FileReader();
                reader.onload = (loadEvent) => {
                    const result = loadEvent.target.result;
                    previewImage.src = result;
                    placeholder.classList.add('hidden');
                    previewContainer.classList.remove('hidden');
                    submitButton.disabled = false;
                    submitButton.className = enabledButtonClasses;
                    cancelButton.classList.remove('hidden');
                    if (liveImage) liveImage.src = result;
                };
                reader.readAsDataURL(selectedFile);
            });
        };

        setupImageUpload({
            input: 'hero_background',
            placeholder: 'upload-placeholder',
            previewContainer: 'new-preview-container',
            previewImage: 'new-preview-img',
            fileName: 'new-file-name',
            fileSize: 'new-file-size',
            submitButton: 'btn-submit',
            cancelButton: 'btn-cancel-hero',
            liveImage: 'live-hero-img',
            resetFunction: 'resetHeroForm',
        });

        setupImageUpload({
            input: 'foto_tim',
            placeholder: 'tim-upload-placeholder',
            previewContainer: 'tim-preview-container',
            previewImage: 'tim-preview-img',
            fileName: 'tim-file-name',
            fileSize: 'tim-file-size',
            submitButton: 'btn-submit-tim',
            cancelButton: 'btn-cancel-tim',
            liveImage: 'live-tim-img',
            resetFunction: 'resetTimForm',
        });
    });
</script>
@endpush

@endsection

