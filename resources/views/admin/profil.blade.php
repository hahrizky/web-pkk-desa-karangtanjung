@extends('layouts.admin')

@section('title', 'Profil Desa & Struktur Organisasi')
@section('page-title', 'Profil Desa & Struktur Organisasi')

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-5">
        <div>
            <h2 class="text-lg font-bold text-gray-800">Profil Desa &amp; Susunan Pengurus</h2>
            <p class="text-xs text-gray-500 mt-0.5">Kelola identitas desa, visi-misi, serta nama-nama pengurus struktur organisasi PKK</p>
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

        {{-- CARD 1: Struktur Organisasi (Fitur Ganti Nama Pengurus) --}}
        <div class="bg-white rounded-xl border border-gray-200 p-5 sm:p-6 shadow-xs space-y-4">
            <div class="border-b border-gray-100 pb-3 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold text-gray-800 flex items-center gap-2">
                        <i class="fa-solid fa-sitemap text-[#075B3C]"></i>
                        <span>Susunan Struktur Organisasi TP. PKK</span>
                    </h3>
                    <p class="text-xs text-gray-400 mt-0.5">Ubah nama pejabat/pengurus untuk bagan struktur organisasi di halaman Profil website</p>
                </div>
                <span class="text-[11px] bg-emerald-50 text-[#075B3C] font-semibold px-2.5 py-1 rounded-md">Periode Aktif</span>
            </div>

            {{-- Pembina & Pimpinan Inti --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">
                        Nama Pembina <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="pembina_nama" value="{{ old('pembina_nama', $profil['struktur']['pembina']['nama'] ?? 'Atmo') }}"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>
                    <input type="hidden" name="pembina_sub" value="{{ $profil['struktur']['pembina']['sub'] ?? 'Kepala Desa Karang Tanjung' }}">
                    <span class="text-[11px] text-gray-400 mt-0.5 block">Jabatan: Kepala Desa</span>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">
                        Ketua TP. PKK <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="ketua_nama" value="{{ old('ketua_nama', $profil['struktur']['pengurus_inti'][0]['nama'] ?? 'Hj. Sunariyah') }}"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>
                    <span class="text-[11px] text-gray-400 mt-0.5 block">Jabatan Utama</span>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-1">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">
                        Wakil Ketua <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="wakil_nama" value="{{ old('wakil_nama', $profil['struktur']['pengurus_inti'][1]['nama'] ?? 'Dwi Setyowati') }}"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">
                        Periode Kepengurusan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="periode" value="{{ old('periode', $profil['periode'] ?? '2024 - 2029') }}"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]"
                           placeholder="Contoh: 2024 - 2029" required>
                </div>
            </div>

            {{-- Sekretariat & Bendahara --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 border-t border-gray-100">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">
                        Sekretaris I <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="sekretaris_1" value="{{ old('sekretaris_1', $profil['struktur']['pengurus_inti'][2]['nama'] ?? 'Alfianita Defi, S.Pd.') }}"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">
                        Sekretaris II <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="sekretaris_2" value="{{ old('sekretaris_2', $profil['struktur']['pengurus_inti'][3]['nama'] ?? 'Cicik Suyanti') }}"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">
                        Bendahara I <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="bendahara_1" value="{{ old('bendahara_1', $profil['struktur']['pengurus_inti'][4]['nama'] ?? 'Ita Susanti') }}"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">
                        Bendahara II <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="bendahara_2" value="{{ old('bendahara_2', $profil['struktur']['pengurus_inti'][5]['nama'] ?? 'Nuryanti') }}"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>
                </div>
            </div>

            {{-- Ketua Pokja I - IV --}}
            <div class="pt-2 border-t border-gray-100">
                <p class="text-xs font-bold text-gray-700 uppercase tracking-wider mb-3">Ketua Kelompok Kerja (Pokja I - IV)</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs text-gray-600 mb-1">Ketua Pokja I</label>
                        <input type="text" name="pokja_1_ketua" value="{{ old('pokja_1_ketua', $profil['struktur']['pokja'][0]['ketua'] ?? 'Mutma\'innah, M.Pd.') }}"
                               class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-600 mb-1">Ketua Pokja II</label>
                        <input type="text" name="pokja_2_ketua" value="{{ old('pokja_2_ketua', $profil['struktur']['pokja'][1]['ketua'] ?? 'Resti Duwi Rohmawati') }}"
                               class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-600 mb-1">Ketua Pokja III</label>
                        <input type="text" name="pokja_3_ketua" value="{{ old('pokja_3_ketua', $profil['struktur']['pokja'][2]['ketua'] ?? 'Jazil Laturohmah') }}"
                               class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-600 mb-1">Ketua Pokja IV</label>
                        <input type="text" name="pokja_4_ketua" value="{{ old('pokja_4_ketua', $profil['struktur']['pokja'][3]['ketua'] ?? 'Lilik Mutammimah') }}"
                               class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>
                    </div>
                </div>
            </div>
        </div>

        {{-- CARD 2: Identitas & Kontak Sekretariat --}}
        <div class="bg-white rounded-xl border border-gray-200 p-5 sm:p-6 shadow-xs space-y-4">
            <div class="border-b border-gray-100 pb-3">
                <h3 class="text-sm font-bold text-gray-800 flex items-center gap-2">
                    <i class="fa-solid fa-building-columns text-[#075B3C]"></i>
                    <span>Identitas Desa &amp; Kontak Sekretariat</span>
                </h3>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Nama Desa</label>
                    <input type="text" name="nama_desa" value="{{ old('nama_desa', $profil['nama_desa'] ?? 'Karangtanjung') }}"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Kecamatan</label>
                    <input type="text" name="kecamatan" value="{{ old('kecamatan', $profil['kecamatan'] ?? 'Candi') }}"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Kabupaten</label>
                    <input type="text" name="kabupaten" value="{{ old('kabupaten', $profil['kabupaten'] ?? 'Sidoarjo') }}"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Provinsi</label>
                    <input type="text" name="provinsi" value="{{ old('provinsi', $profil['provinsi'] ?? 'Jawa Timur') }}"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-1">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Alamat Lengkap Kantor / Sekretariat</label>
                    <input type="text" name="alamat" value="{{ old('alamat', $profil['alamat'] ?? 'Jl. Sunan Giri No.1 Desa Karangtanjung, Kec. Candi, Kab. Sidoarjo, Jawa Timur') }}"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Telepon / WhatsApp</label>
                    <input type="text" name="telepon" value="{{ old('telepon', $profil['telepon'] ?? '') }}"
                           placeholder="Kosongkan jika belum ada"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Email Resmi</label>
                <input type="email" name="email" value="{{ old('email', $profil['email'] ?? '') }}"
                       placeholder="Kosongkan jika belum ada"
                       class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]">
            </div>
        </div>

        {{-- CARD 3: Visi & Misi --}}
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

            <div>
                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">Misi (Pisahkan per baris)</label>
                <textarea name="misi" rows="4"
                          class="w-full border border-gray-300 rounded-lg px-3.5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C]" required>{{ old('misi', $profil['misi'] ?? '') }}</textarea>
            </div>
        </div>

        {{-- Tombol Simpan --}}
        <div class="flex items-center justify-end gap-3 pt-2">
            <button type="submit"
                    class="px-6 py-2.5 bg-[#075B3C] hover:bg-[#055030] text-white font-semibold rounded-lg transition-all text-sm shadow-xs flex items-center gap-2">
                <i class="fa-solid fa-floppy-disk"></i>
                <span>Simpan Perubahan Profil &amp; Struktur</span>
            </button>
        </div>
    </form>
</div>
@endsection
