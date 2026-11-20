<?php

namespace Tests\Feature;

use App\Models\Member;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnggotaTest extends TestCase
{
    use RefreshDatabase;

    private function data(array $o = []): array
    {
        return array_merge([
            'name' => 'Budi Santoso', 'membership_type' => 'Mahasiswa', 'status' => 'Aktif',
            'joined_at' => '2026-01-01', 'expires_at' => '2027-01-01',
        ], $o);
    }

    public function test_tamu_ditolak(): void
    {
        $this->get('/anggota')->assertRedirect(route('login'));
    }

    public function test_tambah_membuat_nomor_anggota_dan_kartu_otomatis(): void
    {
        $this->actingAs(User::factory()->create(['role' => 'staff']))
            ->post('/anggota', $this->data())->assertRedirect(route('members.index'));

        $m = Member::first();
        $this->assertStringStartsWith('AGT-' . date('Y') . '-', $m->member_number);
        $this->assertSame('CARD-' . $m->member_number, $m->card_number);
    }

    public function test_pencarian_dan_halaman_kartu(): void
    {
        $staff = User::factory()->create(['role' => 'staff']);
        $a = Member::create($this->data(['name' => 'Ani Lestari', 'member_number' => 'A-1', 'card_number' => 'C-1']));
        Member::create($this->data(['name' => 'Candra', 'member_number' => 'A-2', 'card_number' => 'C-2']));

        $this->actingAs($staff)->get('/anggota?q=Ani')->assertOk()->assertSee('Ani Lestari')->assertDontSee('Candra');
        $this->actingAs($staff)->get("/anggota/{$a->id}")->assertOk()
            ->assertSee('KARTU ANGGOTA PERPUSTAKAAN')->assertSee('Cetak ID Card')->assertSee('C-1');
    }

    public function test_tambah_tanpa_mengirim_field_nomor_tetap_aman(): void
    {
        $data = $this->data();
        unset($data['member_number'], $data['card_number']);

        $this->actingAs(User::factory()->create(['role' => 'staff']))
            ->post('/anggota', $data)->assertRedirect(route('members.index'));
        $this->assertNotNull(Member::first()->card_number);
    }

    public function test_validasi_tanggal_dan_tipe(): void
    {
        $this->actingAs(User::factory()->create(['role' => 'staff']))
            ->post('/anggota', $this->data(['expires_at' => '2025-01-01', 'membership_type' => 'VIP']))
            ->assertSessionHasErrors(['expires_at', 'membership_type']);
    }

    public function test_edit_boleh_mempertahankan_nomor_sendiri(): void
    {
        $staff = User::factory()->create(['role' => 'staff']);
        $m = Member::create($this->data(['member_number' => 'A-1', 'card_number' => 'C-1']));

        $this->actingAs($staff)->put("/anggota/{$m->id}", $this->data(['member_number' => 'A-1', 'card_number' => 'C-1', 'name' => 'Baru']))
            ->assertRedirect(route('members.index'));
        $this->assertSame('Baru', $m->fresh()->name);
    }

    public function test_hapus_hanya_admin(): void
    {
        $m = Member::create($this->data(['member_number' => 'A-9', 'card_number' => 'C-9']));

        $this->actingAs(User::factory()->create(['role' => 'staff']))->delete("/anggota/{$m->id}")->assertForbidden();
        $this->assertDatabaseCount('members', 1);
        $this->actingAs(User::factory()->create(['role' => 'admin']))->delete("/anggota/{$m->id}")->assertRedirect(route('members.index'));
        $this->assertDatabaseCount('members', 0);
    }
}
