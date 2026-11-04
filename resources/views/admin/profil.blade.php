@extends('layouts.admin')

@section('title', 'Profil Desa')
@section('page-title', 'Profil Desa')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Profil Desa</h2>
            <p class="text-sm text-gray-500 mt-0.5">Kelola informasi profil desa yang tampil di website</p>
        </div>
    </div>

    <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="space-y-5">
            {{-- Informasi Umum --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <div class="w-1 h-5 bg-[#075B3C] rounded-full"></div>
                    Informasi Umum
                </h3>
                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Desa</label>
                        <input type="text" name="nama_desa" value="{{ old('nama_desa', $profil['nama_desa'] ?? 'Karangtanjung') }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Kecamatan</label>
                        <input type="text" name="kecamatan" value="{{ old('kecamatan', $profil['kecamatan'] ?? 'Cibadak') }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Kabupaten</label>
                        <input type="text" name="kabupaten" value="{{ old('kabupaten', $profil['kabupaten'] ?? 'Lebak') }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Provinsi</label>
                        <input type="text" name="provinsi" value="{{ old('provinsi', $profil['provinsi'] ?? 'Banten') }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all">
                    </div>
                </div>
            </div>

            {{-- Ketua PKK --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <div class="w-1 h-5 bg-[#075B3C] rounded-full"></div>
                    Ketua TP. PKK
                </h3>
                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Ketua PKK</label>
                        <input type="text" name="ketua_pkk" value="{{ old('ketua_pkk', $profil['ketua_pkk'] ?? '') }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all"
                               placeholder="Nama ketua PKK">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Periode</label>
                        <input type="text" name="periode" value="{{ old('periode', $profil['periode'] ?? '2024 - 2029') }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all"
                               placeholder="2024 - 2029">
                    </div>
                </div>
            </div>

            {{-- Kontak --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <div class="w-1 h-5 bg-[#075B3C] rounded-full"></div>
                    Kontak
                </h3>
                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Alamat</label>
                        <input type="text" name="alamat" value="{{ old('alamat', $profil['alamat'] ?? '') }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all"
                               placeholder="Alamat lengkap kantor desa">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Telepon / WhatsApp</label>
                        <input type="text" name="telepon" value="{{ old('telepon', $profil['telepon'] ?? '') }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all"
                               placeholder="0812-xxxx-xxxx">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                        <input type="email" name="email" value="{{ old('email', $profil['email'] ?? '') }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all"
                               placeholder="email@example.com">
                    </div>
                </div>
            </div>

            {{-- Visi Misi --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <div class="w-1 h-5 bg-[#075B3C] rounded-full"></div>
                    Visi & Misi
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Visi</label>
                        <textarea name="visi" rows="3"
                                  class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all resize-none"
                                  placeholder="Visi TP. PKK Desa...">{{ old('visi', $profil['visi'] ?? '') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Misi</label>
                        <textarea name="misi" rows="5"
                                  class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#075B3C]/20 focus:border-[#075B3C] transition-all resize-none"
                                  placeholder="Misi TP. PKK Desa (pisahkan per baris)...">{{ old('misi', $profil['misi'] ?? '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end mt-5">
            <button type="submit"
                    class="px-6 py-2.5 bg-[#075B3C] hover:bg-[#055030] text-white font-semibold rounded-xl transition-all active:scale-95 text-sm">
                <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Profil
            </button>
        </div>
    </form>
</div>
@endsection

