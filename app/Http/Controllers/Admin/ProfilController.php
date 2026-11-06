<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    private function getProfilData()
    {
        return [
            'nama_desa' => 'Karangtanjung',
            'kecamatan' => 'Cibadak',
            'kabupaten' => 'Lebak',
            'provinsi' => 'Banten',
            'ketua_pkk' => 'Hj. Sunariyah',
            'periode' => '2024 - 2029',
            'alamat' => 'Jl. Raya Karangtanjung, Kec. Cibadak, Kab. Lebak, Banten',
            'telepon' => '0812-0000-0000',
            'email' => 'pkk.karangtanjung@gmail.com',
            'visi' => 'Mewujudkan keluarga sehat, sejahtera, dan mandiri berbasis gotong royong',
            'misi' => "1. Meningkatkan pembinaan mental spiritual dan karakter keluarga\n2. Mendorong kemandirian ekonomi keluarga melalui UP2K\n3. Mewujudkan ketahanan pangan melalui pemanfaatan pekarangan\n4. Meningkatkan derajat kesehatan masyarakat melalui posyandu",
        ];
    }

    public function index()
    {
        $profil = $this->getProfilData();
        return view('admin.profil', compact('profil'));
    }

    public function update(Request $request)
    {
        return redirect()->route('admin.profil')
            ->with('success', 'Profil desa berhasil diperbarui! (Demo — data belum disimpan ke database)');
    }
}

