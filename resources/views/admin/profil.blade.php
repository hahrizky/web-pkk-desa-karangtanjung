@extends('layouts.admin')

@section('title', 'Profil Desa')
@section('page-title', 'Profil Desa')

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-5">
        <div>
            <h2 class="text-lg font-bold text-gray-800">Profil Desa</h2>
            <p class="text-xs text-gray-500 mt-0.5">Kelola identitas desa, visi, dan misi TP. PKK Desa Karangtanjung</p>
        </div>
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

    <form id="profil-form" action="{{ route('admin.profil.update') }}" method="POST" class="space-y-5">
        @csrf @method('PUT')

        {{-- Identitas & Kontak Sekretariat (Sesuai Footer Website) --}}
        <div class="bg-[#2F9B45] rounded-xl border border-gray-200 p-5 sm:p-6 shadow-xs space-y-5">
            <div class="border-b border-gray-100 pb-3 flex items-center justify-between">
                <h3 class="text-sm font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-address-book text-white"></i>
                    <span>Informasi Kontak &amp; Identitas Sekretariat</span>
                </h3>
                <span class="text-[11px] text-white">Ditampilkan pada Footer Kontak Website</span>
            </div>

            {{-- 4 Item Kontak Sesuai Footer --}}
            <div class="space-y-4">
                {{-- 1. Alamat Kantor --}}
                <div>
                    <label class="block text-xs font-semibold text-white uppercase tracking-wider mb-1.5 flex items-center gap-2">
                        <i class="fa-solid fa-location-dot text-white w-4 text-center"></i>
                        <span>Alamat Lengkap Kantor / Sekretariat</span>
                    </label>
                    <input type="text" name="alamat" value="{{ old('alamat', $profil['alamat'] ?? 'Jl. Sunan Giri No.1 Desa Karangtanjung, Kec. Candi, Kab. Sidoarjo, Jawa Timur') }}"
                        placeholder="Contoh: Jl. Sunan Giri No.1 Desa Karangtanjung, Kec. Candi, Kab. Sidoarjo, Jawa Timur (kosongkan untuk menyembunyikan)"
                        class="bg-white w-full border border-gray-800 rounded-lg px-3.5 py-2.5 text-sm font-medium text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]">
                    <p class="text-[11px] text-[#E8F5E9] mt-1">Kosongkan jika ingin menyembunyikan baris alamat di footer</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- 2. Telepon / WhatsApp --}}
                    <div>
                        <label class="block text-xs font-semibold text-white uppercase tracking-wider mb-1.5 flex items-center gap-2">
                            <i class="fa-solid fa-phone text-white w-4 text-center"></i>
                            <span>Telepon / WhatsApp Sekretariat</span>
                        </label>
                        <input type="text" name="telepon" value="{{ old('telepon', $profil['telepon'] ?? '') }}"
                            placeholder="Contoh: +62 812-3456-7890"
                            class="bg-white w-full border border-gray-800 rounded-lg px-3.5 py-2.5 text-sm font-medium text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]">
                        <p class="text-[11px] text-[#E8F5E9] mt-1">Kosongkan jika ingin menyembunyikan telepon di footer</p>
                    </div>

                    {{-- 3. Email Resmi --}}
                    <div>
                        <label class="block text-xs font-semibold text-white uppercase tracking-wider mb-1.5 flex items-center gap-2">
                            <i class="fa-solid fa-envelope text-white w-4 text-center"></i>
                            <span>Email Resmi PKK</span>
                        </label>
                        <input type="email" name="email" value="{{ old('email', $profil['email'] ?? '') }}"
                            placeholder="Contoh: pkk.desakarangtanjung@gmail.com"
                            class="bg-white w-full border border-gray-800 rounded-lg px-3.5 py-2.5 text-sm font-medium text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]">
                        <p class="text-[11px] text-[#E8F5E9] mt-1">Kosongkan jika ingin menyembunyikan email di footer</p>
                    </div>
                </div>

                {{-- 4. Jam Layanan --}}
                <div>
                    <label class="block text-xs font-semibold text-white uppercase tracking-wider mb-1.5 flex items-center gap-2">
                        <i class="fa-solid fa-clock text-white w-4 text-center"></i>
                        <span>Jam Layanan Sekretariat</span>
                    </label>
                    <input type="text" name="jam_layanan" value="{{ old('jam_layanan', $profil['jam_layanan'] ?? 'Senin - Jumat (08.00 - 15.00 WIB)') }}"
                        placeholder="Contoh: Senin - Jumat (08.00 - 15.00 WIB)"
                        class="bg-white w-full border border-gray-800 rounded-lg px-3.5 py-2.5 text-sm font-medium text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]">
                </div>
            </div>

            {{-- Wilayah Administratif Desa --}}
            <div class="pt-3 border-t border-gray-100">
                <p class="text-xs font-bold text-white uppercase tracking-wider mb-3">Wilayah Administratif</p>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    <div>
                        <label class="block text-[11px] font-semibold text-white mb-1">Nama Desa</label>
                        <input type="text" name="nama_desa" value="{{ old('nama_desa', $profil['nama_desa'] ?? 'Karangtanjung') }}"
                            class="bg-white w-full border border-gray-800 rounded-lg px-3 py-2 text-xs font-medium text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-white mb-1">Kecamatan</label>
                        <input type="text" name="kecamatan" value="{{ old('kecamatan', $profil['kecamatan'] ?? 'Candi') }}"
                            class="bg-white w-full border border-gray-800 rounded-lg px-3 py-2 text-xs font-medium text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-white mb-1">Kabupaten</label>
                        <input type="text" name="kabupaten" value="{{ old('kabupaten', $profil['kabupaten'] ?? 'Sidoarjo') }}"
                            class="bg-white w-full border border-gray-800 rounded-lg px-3 py-2 text-xs font-medium text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-white mb-1">Provinsi</label>
                        <input type="text" name="provinsi" value="{{ old('provinsi', $profil['provinsi'] ?? 'Jawa Timur') }}"
                            class="bg-white w-full border border-gray-800 rounded-lg px-3 py-2 text-xs font-medium text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>
                    </div>
                </div>
            </div>
        </div>

        {{-- Visi & misi --}}
        <div class="bg-[#2F9B45] rounded-xl border border-gray-200 p-5 sm:p-6 shadow-xs space-y-4">
            <div class="border-b border-gray-100 pb-3">
                <h3 class="text-sm font-bold text-white flex items-center gap-2">
                    <span>VISI &amp; MISI</span>
                </h3>
            </div>

            <div class="visi-item bg-[#ECFEF3] border border-gray-200 rounded-xl p-3.5 sm:p-4 space-y-2.5 relative">
                <span class="visi inline-block text-xs font-bold text-amber-900 px-1 py-0.5 uppercase tracking-wider">
                    Visi
                </span>
                <textarea name="visi" rows="4"
                    class="bg-white w-full border border-gray-800 rounded-lg px-3.5 py-2.5 text-sm font-medium text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]"
                    placeholder="Tuliskan uraian visi PKK Desa Karangtanjung..." required>{{ old('visi', $profil['visi'] ?? '') }}</textarea>
            </div>

            {{-- Poin-Poin Misi Terstruktur --}}
            <div>
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <label class="block text-xs font-semibold text-white uppercase tracking-wider">Poin-Poin Misi</label>
                        <p class="font-semibold text-[11px] text-[#E8F5E9] mt-0.5">Ubah judul dan uraian deskripsi setiap misi yang tampil di website publik</p>
                    </div>
                    <button type="button" id="btn-tambah-misi"
                        class="px-3 py-1.5 bg-white hover:bg-gray-100 active:bg-gray-300 text-[#075B3C] border border-emerald-200 text-xs font-semibold rounded-lg transition-all duration-200 flex items-center gap-1.5 shadow-2xs">
                        <i class="fa-solid fa-plus text-[10px]"></i>
                        <span>Tambah Misi</span>
                    </button>
                </div>

                <div id="misi-container" class="space-y-3.5">
                    @foreach ($profil['misi'] as $idx => $m)
                    <div class="misi-item bg-[#ECFEF3] border border-gray-200 rounded-xl p-3.5 sm:p-4 space-y-2.5 relative">
                        <div class="flex items-center justify-between">
                            <span class="misi-badge text-[11px] font-bold text-[#075B3C] bg-emerald-200 px-2.5 py-0.5 rounded-full uppercase tracking-wider">
                                Misi {{ sprintf('%02d', $loop->iteration) }}
                            </span>
                            <button type="button" onclick="hapusMisi(this)"
                                class="btn-hapus-misi text-red-500 hover:text-red-700 hover:bg-red-50 active:bg-red-100 font-medium text-xs transition-colors flex items-center gap-1 rounded-md px-2 py-1">
                                <i class="fa-regular fa-trash-can"></i>
                                <span>Hapus</span>
                            </button>
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-600 mb-1">Judul Misi</label>
                            <input type="text" name="misi[{{ $idx }}][judul]" value="{{ old('misi.'.$idx.'.judul', $m['judul'] ?? '') }}"
                                placeholder="Contoh: Ketahanan Mental & Gotong Royong"
                                class="bg-white w-full border border-gray-800 rounded-lg px-3 py-2 text-xs sm:text-sm font-semibold text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-600 mb-1">Deskripsi Misi</label>
                            <textarea name="misi[{{ $idx }}][deskripsi]" rows="2"
                                placeholder="Tuliskan uraian detail misi ini..."
                                class="bg-white w-full border border-gray-800 rounded-lg px-3 py-2 text-xs sm:text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>{{ old('misi.'.$idx.'.deskripsi', $m['deskripsi'] ?? '') }}</textarea>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Tombol Simpan & Batal Perubahan (Floating) --}}
        <x-admin.form-actions
            :floating="true"
            submit-id="btn-submit-profil"
            submit-text="Simpan Perubahan Profil"
            cancel-id="btn-cancel-profil"
            cancel-action="resetProfilForm()"
            info-text="Pastikan seluruh informasi profil dan visi misi sudah benar sebelum disimpan." />
    </form>
</div>

<script>
    function updateMisiBadges() {
        const items = document.querySelectorAll('#misi-container .misi-item');
        items.forEach((item, index) => {
            const num = String(index + 1).padStart(2, '0');
            const badge = item.querySelector('.misi-badge');
            if (badge) badge.textContent = 'Misi ' + num;

            const judulInput = item.querySelector('input[type="text"]');
            if (judulInput) judulInput.name = `misi[${index}][judul]`;

            const deskripsiTextarea = item.querySelector('textarea');
            if (deskripsiTextarea) deskripsiTextarea.name = `misi[${index}][deskripsi]`;

            const btnHapus = item.querySelector('.btn-hapus-misi');
            if (btnHapus) {
                btnHapus.style.display = items.length <= 1 ? 'none' : 'flex';
            }
        });
    }

    function hapusMisi(button) {
        const container = document.getElementById('misi-container');
        if (container.children.length > 1) {
            button.closest('.misi-item').remove();
            updateMisiBadges();
            checkProfilDirty();
        }
    }

    document.getElementById('btn-tambah-misi')?.addEventListener('click', function() {
        const container = document.getElementById('misi-container');
        const count = container.children.length;
        const num = String(count + 1).padStart(2, '0');

        const div = document.createElement('div');
        div.className = 'misi-item bg-[#ECFEF3] border border-gray-200 rounded-xl p-3.5 sm:p-4 space-y-2.5 relative';
        div.innerHTML = `
            <div class="flex items-center justify-between">
                <span class="misi-badge text-[11px] font-bold text-[#075B3C] bg-emerald-200 px-2.5 py-0.5 rounded-full uppercase tracking-wider">
                    Misi ${num}
                </span>
                <button type="button" onclick="hapusMisi(this)"
                    class="btn-hapus-misi text-red-500 hover:text-red-700 hover:bg-red-50 active:bg-red-100 font-medium text-xs transition-colors flex items-center gap-1 rounded-md px-2 py-1">
                    <i class="fa-regular fa-trash-can"></i>
                    <span>Hapus</span>
                </button>
            </div>
            <div>
                <label class="block text-[11px] font-semibold text-gray-600 mb-1">Judul Misi</label>
                <input type="text" name="misi[${count}][judul]" value=""
                       placeholder="Contoh: Program Misi ${num}"
                       class="bg-white w-full border border-gray-800 rounded-lg px-3 py-2 text-xs sm:text-sm font-semibold text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>
            </div>
            <div>
                <label class="block text-[11px] font-semibold text-gray-600 mb-1">Deskripsi Misi</label>
                <textarea name="misi[${count}][deskripsi]" rows="2"
                          placeholder="Tuliskan uraian detail misi ini..."
                          class="bg-white w-full border border-gray-800 rounded-lg px-3 py-2 text-xs sm:text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required></textarea>
            </div>
        `;
        container.appendChild(div);
        updateMisiBadges();

        // Tambahkan listener dirty check pada input misi baru
        div.querySelectorAll('input, textarea').forEach(el => {
            el.addEventListener('input', checkProfilDirty);
            el.addEventListener('change', checkProfilDirty);
        });
        checkProfilDirty();

        // Otomatis scroll dan fokus ke field Judul Misi yang baru dibuat
        const newJudulInput = div.querySelector('input[type="text"]');
        if (newJudulInput) {
            div.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
            setTimeout(() => {
                newJudulInput.focus();
            }, 300);
        }
    });

    let initialMisiHtml = '';
    let initialProfilValues = {};

    function saveInitialProfilState() {
        const form = document.getElementById('profil-form');
        if (!form) return;

        const inputs = form.querySelectorAll('input:not([name="_token"]):not([name="_method"]), textarea');
        initialProfilValues = {};
        inputs.forEach(el => {
            initialProfilValues[el.name || el.id] = el.value;
            el.addEventListener('input', checkProfilDirty);
            el.addEventListener('change', checkProfilDirty);
        });

        const misiContainer = document.getElementById('misi-container');
        if (misiContainer) {
            initialMisiHtml = misiContainer.innerHTML;
        }
    }

    function checkProfilDirty() {
        const submitBtn = document.getElementById('btn-submit-profil');
        const cancelBtn = document.getElementById('btn-cancel-profil');
        if (!submitBtn) return;

        const form = document.getElementById('profil-form');
        let isDirty = false;

        const inputs = form.querySelectorAll('input:not([name="_token"]):not([name="_method"]), textarea');
        for (const el of inputs) {
            const key = el.name || el.id;
            if (initialProfilValues[key] === undefined || el.value !== initialProfilValues[key]) {
                isDirty = true;
                break;
            }
        }

        const misiContainer = document.getElementById('misi-container');
        if (!isDirty && misiContainer) {
            const currentItemCount = misiContainer.querySelectorAll('.misi-item').length;
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = initialMisiHtml;
            const initialItemCount = tempDiv.querySelectorAll('.misi-item').length;
            if (currentItemCount !== initialItemCount) {
                isDirty = true;
            }
        }

        submitBtn.disabled = !isDirty;
        if (isDirty) {
            submitBtn.className = 'w-full sm:w-auto px-6 py-2.5 bg-[#2F9B45] hover:bg-[#26863A] active:bg-[#075B3C] text-white font-semibold rounded-xl text-sm transition-all duration-200 shadow-sm flex items-center justify-center gap-2 active:scale-95 cursor-pointer';
        } else {
            submitBtn.className = 'w-full sm:w-auto px-6 py-2.5 bg-gray-300 text-gray-500 font-semibold rounded-xl text-sm transition-all duration-200 flex items-center justify-center gap-2 cursor-not-allowed';
        }

        if (cancelBtn) {
            if (isDirty) {
                cancelBtn.classList.remove('hidden');
            } else {
                cancelBtn.classList.add('hidden');
            }
        }
    }

    function resetProfilForm() {
        const misiContainer = document.getElementById('misi-container');
        if (misiContainer && initialMisiHtml) {
            misiContainer.innerHTML = initialMisiHtml;
            updateMisiBadges();
        }

        const form = document.getElementById('profil-form');
        if (form) {
            const inputs = form.querySelectorAll('input:not([name="_token"]):not([name="_method"]), textarea');
            inputs.forEach(el => {
                const key = el.name || el.id;
                if (initialProfilValues[key] !== undefined) {
                    el.value = initialProfilValues[key];
                }
            });
        }

        saveInitialProfilState();
        checkProfilDirty();
    }

    document.addEventListener('DOMContentLoaded', () => {
        updateMisiBadges();
        saveInitialProfilState();
    });
</script>
@endsection