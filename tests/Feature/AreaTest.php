<?php

namespace Tests\Feature;

use App\Models\Area;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AreaTest extends TestCase
{
    use RefreshDatabase;

    private function data(array $o = []): array
    {
        return array_merge([
            'kode_area' => 'MB-01', 'jenis' => 'Meja Baca', 'nomor_lantai' => 2,
            'stopkontak' => '1', 'wifi' => '1', 'status' => 'Tersedia',
        ], $o);
    }

    public function test_tamu_ditolak(): void
    {
        $this->get('/area')->assertRedirect(route('login'));
    }

    public function test_staff_bisa_lihat_tambah_ubah(): void
    {
        $staff = User::factory()->create(['role' => 'staff']);

        $this->actingAs($staff)->get('/area')->assertOk()->assertSee('Data Fasilitas')->assertSee('Marcel Aziz');
        $this->actingAs($staff)->post('/area', $this->data())->assertRedirect(route('area.index'));
        $area = Area::first();
        $this->assertTrue($area->wifi);

        $this->actingAs($staff)->put("/area/{$area->id}", $this->data(['status' => 'Terpakai', 'wifi' => null]))
            ->assertRedirect(route('area.index'));
        $area->refresh();
        $this->assertSame('Terpakai', $area->status);
        $this->assertFalse($area->wifi);
    }

    public function test_validasi(): void
    {
        $staff = User::factory()->create(['role' => 'staff']);
        $this->actingAs($staff)->post('/area', $this->data(['jenis' => 'Lainnya', 'nomor_lantai' => 99]))
            ->assertSessionHasErrors(['jenis', 'nomor_lantai']);
    }

    public function test_hapus_hanya_admin(): void
    {
        $area = Area::create($this->data());

        $this->actingAs(User::factory()->create(['role' => 'staff']))->delete("/area/{$area->id}")->assertForbidden();
        $this->assertDatabaseCount('areas', 1);

        $this->actingAs(User::factory()->create(['role' => 'admin']))->delete("/area/{$area->id}")
            ->assertRedirect(route('area.index'));
        $this->assertDatabaseCount('areas', 0);
    }

    public function test_tombol_hapus_hanya_tampil_untuk_admin(): void
    {
        Area::create($this->data());
        $this->actingAs(User::factory()->create(['role' => 'staff']))->get('/area')->assertDontSee('Hapus');
        $this->actingAs(User::factory()->create(['role' => 'admin']))->get('/area')->assertSee('Hapus');
    }
}
