<?php

namespace Tests\Feature\Admin;

use Illuminate\Support\Facades\File;
use Tests\TestCase;

class StrukturControllerTest extends TestCase
{
    private string $profilePath;
    private ?string $originalProfile = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->profilePath = storage_path('app/profil_data.json');
        if (File::exists($this->profilePath)) {
            $this->originalProfile = File::get($this->profilePath);
        }
    }

    protected function tearDown(): void
    {
        if ($this->originalProfile === null) {
            File::delete($this->profilePath);
        } else {
            File::put($this->profilePath, $this->originalProfile);
        }

        parent::tearDown();
    }

    public function test_admin_can_open_structure_form_with_existing_profile_data(): void
    {
        File::put($this->profilePath, json_encode([
            'visi' => 'Profil tetap utuh',
            'struktur' => [
                'pembina' => ['nama' => 'Nama Pembina'],
            ],
        ]));

        $this->withSession(['admin_logged_in' => true])
            ->get(route('admin.struktur.index'))
            ->assertOk()
            ->assertSee('Nama Pembina')
            ->assertSee('2024 - 2029');
    }

    public function test_structure_update_persists_all_members_and_preserves_other_profile_fields(): void
    {
        File::put($this->profilePath, json_encode([
            'nama_desa' => 'Karangtanjung',
            'visi' => 'Visi yang harus tetap ada',
            'misi' => [['judul' => 'Misi tetap ada', 'deskripsi' => 'Deskripsi']],
        ]));

        $this->withSession(['admin_logged_in' => true])
            ->put(route('admin.struktur.update'), [
                'periode' => '2025 - 2030',
                'pembina_nama' => 'Pembina Baru',
                'pembina_sub' => 'Kepala Desa',
                'ketua_nama' => 'Ketua Baru',
                'wakil_nama' => 'Wakil Baru',
                'sekretaris_1' => 'Sekretaris Satu',
                'sekretaris_2' => 'Sekretaris Dua',
                'bendahara_1' => 'Bendahara Satu',
                'bendahara_2' => 'Bendahara Dua',
                'pokja_1_ketua' => 'Pokja Satu',
                'pokja_2_ketua' => 'Pokja Dua',
                'pokja_3_ketua' => 'Pokja Tiga',
                'pokja_4_ketua' => 'Pokja Empat',
            ])
            ->assertRedirect(route('admin.struktur.index'));

        $saved = json_decode(File::get($this->profilePath), true);
        $this->assertSame('Visi yang harus tetap ada', $saved['visi']);
        $this->assertSame('Misi tetap ada', $saved['misi'][0]['judul']);
        $this->assertSame('2025 - 2030', $saved['periode']);
        $this->assertSame('Pembina Baru', $saved['struktur']['pembina']['nama']);
        $this->assertSame('Ketua Baru', $saved['struktur']['pengurus_inti'][0]['nama']);
        $this->assertSame('Sekretaris Dua', $saved['struktur']['pengurus_inti'][3]['nama']);
        $this->assertSame('Bendahara Dua', $saved['struktur']['pengurus_inti'][5]['nama']);
        $this->assertSame('Pokja Empat', $saved['struktur']['pokja'][3]['ketua']);
    }

    public function test_public_profile_does_not_restore_a_photo_explicitly_removed_by_admin(): void
    {
        File::put($this->profilePath, json_encode([
            'struktur' => [
                'pembina' => ['nama' => 'Pembina', 'foto' => null],
            ],
        ]));

        $this->get(route('profil'))
            ->assertOk()
            ->assertViewHas('struktur', fn (array $struktur) => $struktur['pembina']['foto'] === null);
    }
}
