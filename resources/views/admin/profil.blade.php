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

    <form action="{{ route('admin.profil.update') }}" method="POST" class="space-y-5">
        @csrf @method('PUT')

        {{-- Identitas & Kontak Sekretariat (Sesuai Footer Website) --}}
        <div class="bg-white rounded-xl border border-gray-200 p-5 sm:p-6 shadow-xs space-y-5">
            <div class="border-b border-gray-100 pb-3 flex items-center justify-between">
                <h3 class="text-sm font-bold text-gray-800 flex items-center gap-2">
                    <i class="fa-solid fa-address-book text-[#075B3C]"></i>
                    <span>Informasi Kontak &amp; Identitas Sekretariat</span>
                </h3>
                <span class="text-[11px] text-gray-400">Ditampilkan pada Footer Kontak Website</span>
            </div>

            {{-- 4 Item Kontak Sesuai Footer --}}
            <div class="space-y-4">
                {{-- 1. Alamat Kantor --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5 flex items-center gap-2">
                        <i class="fa-solid fa-location-dot text-amber-500 w-4 text-center"></i>
                        <span>Alamat Lengkap Kantor / Sekretariat</span>
                    </label>
                    <input type="text" name="alamat" value="{{ old('alamat', $profil['alamat'] ?? 'Jl. Sunan Giri No.1 Desa Karangtanjung, Kec. Candi, Kab. Sidoarjo, Jawa Timur') }}"
                           placeholder="Contoh: Jl. Sunan Giri No.1 Desa Karangtanjung, Kec. Candi, Kab. Sidoarjo, Jawa Timur (kosongkan untuk menyembunyikan)"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]">
                    <p class="text-[11px] text-gray-400 mt-1">Kosongkan jika ingin menyembunyikan baris alamat di footer</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- 2. Telepon / WhatsApp --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5 flex items-center gap-2">
                            <i class="fa-solid fa-phone text-amber-500 w-4 text-center"></i>
                            <span>Telepon / WhatsApp Sekretariat</span>
                        </label>
                        <input type="text" name="telepon" value="{{ old('telepon', $profil['telepon'] ?? '') }}"
                               placeholder="Contoh: +62 812-3456-7890 (kosongkan jika belum ada)"
                               class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]">
                        <p class="text-[11px] text-gray-400 mt-1">Kosongkan jika ingin menyembunyikan telepon di footer</p>
                    </div>

                    {{-- 3. Email Resmi --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5 flex items-center gap-2">
                            <i class="fa-solid fa-envelope text-amber-500 w-4 text-center"></i>
                            <span>Email Resmi PKK</span>
                        </label>
                        <input type="email" name="email" value="{{ old('email', $profil['email'] ?? '') }}"
                               placeholder="Contoh: pkk.desakarangtanjung@gmail.com (kosongkan jika belum ada)"
                               class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]">
                        <p class="text-[11px] text-gray-400 mt-1">Kosongkan jika ingin menyembunyikan email di footer</p>
                    </div>
                </div>

                {{-- 4. Jam Layanan --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5 flex items-center gap-2">
                        <i class="fa-solid fa-clock text-amber-500 w-4 text-center"></i>
                        <span>Jam Layanan Sekretariat</span>
                    </label>
                    <input type="text" name="jam_layanan" value="{{ old('jam_layanan', $profil['jam_layanan'] ?? 'Senin - Jumat (08.00 - 15.00 WIB)') }}"
                           placeholder="Contoh: Senin - Jumat (08.00 - 15.00 WIB) (kosongkan untuk menyembunyikan)"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]">
                </div>
            </div>

            {{-- Wilayah Administratif Desa --}}
            <div class="pt-3 border-t border-gray-100">
                <p class="text-xs font-bold text-gray-600 uppercase tracking-wider mb-3">Wilayah Administratif</p>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    <div>
                        <label class="block text-[11px] font-medium text-gray-500 mb-1">Nama Desa</label>
                        <input type="text" name="nama_desa" value="{{ old('nama_desa', $profil['nama_desa'] ?? 'Karangtanjung') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>
                    </div>
                    <div>
                        <label class="block text-[11px] font-medium text-gray-500 mb-1">Kecamatan</label>
                        <input type="text" name="kecamatan" value="{{ old('kecamatan', $profil['kecamatan'] ?? 'Candi') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>
                    </div>
                    <div>
                        <label class="block text-[11px] font-medium text-gray-500 mb-1">Kabupaten</label>
                        <input type="text" name="kabupaten" value="{{ old('kabupaten', $profil['kabupaten'] ?? 'Sidoarjo') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>
                    </div>
                    <div>
                        <label class="block text-[11px] font-medium text-gray-500 mb-1">Provinsi</label>
                        <input type="text" name="provinsi" value="{{ old('provinsi', $profil['provinsi'] ?? 'Jawa Timur') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>
                    </div>
                </div>
            </div>
        </div>

        {{-- Visi & misi --}}
        <div class="bg-white rounded-xl border border-gray-200 p-5 sm:p-6 shadow-xs space-y-4">
            <div class="border-b border-gray-100 pb-3">
                <h3 class="text-sm font-bold text-gray-800 flex items-center gap-2">
                    <i class="fa-solid fa-bullseye text-[#075B3C]"></i>
                    <span>Visi &amp; Misi TP. PKK Desa Karangtanjung</span>
                </h3>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">Visi</label>
                <textarea name="visi" rows="2"
                          class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>{{ old('visi', $profil['visi'] ?? '') }}</textarea>
            </div>

            {{-- Poin-Poin Misi Terstruktur --}}
            <div>
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">Poin-Poin Misi</label>
                        <p class="text-[11px] text-gray-400 mt-0.5">Ubah judul dan uraian deskripsi setiap misi yang tampil di website publik</p>
                    </div>
                    <button type="button" id="btn-tambah-misi"
                            class="px-3 py-1.5 bg-emerald-50 hover:bg-emerald-100 text-[#075B3C] border border-emerald-200 text-xs font-semibold rounded-lg transition-colors flex items-center gap-1.5 shadow-2xs">
                        <i class="fa-solid fa-plus text-[10px]"></i>
                        <span>Tambah Misi</span>
                    </button>
                </div>

                <div id="misi-container" class="space-y-3.5">
                    @foreach ($profil['misi'] as $idx => $m)
                    <div class="misi-item bg-gray-50/80 border border-gray-200 rounded-xl p-3.5 sm:p-4 space-y-2.5 relative">
                        <div class="flex items-center justify-between">
                            <span class="misi-badge text-[11px] font-bold text-emerald-800 bg-emerald-100 px-2.5 py-0.5 rounded-full uppercase tracking-wider">
                                Misi {{ sprintf('%02d', $loop->iteration) }}
                            </span>
                            <button type="button" onclick="hapusMisi(this)"
                                    class="btn-hapus-misi text-gray-400 hover:text-red-500 text-xs transition-colors flex items-center gap-1">
                                <i class="fa-regular fa-trash-can"></i>
                                <span>Hapus</span>
                            </button>
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-600 mb-1">Judul Misi</label>
                            <input type="text" name="misi[{{ $idx }}][judul]" value="{{ old('misi.'.$idx.'.judul', $m['judul'] ?? '') }}"
                                   placeholder="Contoh: Ketahanan Mental & Gotong Royong"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm font-semibold text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-600 mb-1">Deskripsi Misi</label>
                            <textarea name="misi[{{ $idx }}][deskripsi]" rows="2"
                                      placeholder="Tuliskan uraian detail misi ini..."
                                      class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>{{ old('misi.'.$idx.'.deskripsi', $m['deskripsi'] ?? '') }}</textarea>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Tombol Simpan --}}
        <div class="flex items-center justify-end gap-3 pt-2">
            <button type="submit"
                    class="px-6 py-2.5 bg-[#075B3C] hover:bg-[#055030] text-white font-semibold rounded-lg transition-all text-sm shadow-xs flex items-center gap-2">
                <i class="fa-solid fa-floppy-disk"></i>
                <span>Simpan Perubahan Profil</span>
            </button>
        </div>
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
        }
    }

    document.getElementById('btn-tambah-misi')?.addEventListener('click', function () {
        const container = document.getElementById('misi-container');
        const count = container.children.length;
        const num = String(count + 1).padStart(2, '0');

        const div = document.createElement('div');
        div.className = 'misi-item bg-gray-50/80 border border-gray-200 rounded-xl p-3.5 sm:p-4 space-y-2.5 relative';
        div.innerHTML = `
            <div class="flex items-center justify-between">
                <span class="misi-badge text-[11px] font-bold text-emerald-800 bg-emerald-100 px-2.5 py-0.5 rounded-full uppercase tracking-wider">
                    Misi ${num}
                </span>
                <button type="button" onclick="hapusMisi(this)"
                        class="btn-hapus-misi text-gray-400 hover:text-red-500 text-xs transition-colors flex items-center gap-1">
                    <i class="fa-regular fa-trash-can"></i>
                    <span>Hapus</span>
                </button>
            </div>
            <div>
                <label class="block text-[11px] font-semibold text-gray-600 mb-1">Judul Misi</label>
                <input type="text" name="misi[${count}][judul]" value=""
                       placeholder="Contoh: Program Misi ${num}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm font-semibold text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>
            </div>
            <div>
                <label class="block text-[11px] font-semibold text-gray-600 mb-1">Deskripsi Misi</label>
                <textarea name="misi[${count}][deskripsi]" rows="2"
                          placeholder="Tuliskan uraian detail misi ini..."
                          class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required></textarea>
            </div>
        `;
        container.appendChild(div);
        updateMisiBadges();
    });

    document.addEventListener('DOMContentLoaded', updateMisiBadges);
</script>
@endsection
