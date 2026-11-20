<?php

namespace Tests\Feature;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SupplierTest extends TestCase
{
    use RefreshDatabase;

    private function data(array $o = []): array
    {
        return array_merge([
            'nama_supplier' => 'Nusantara Media', 'no_telp' => '0812-0000-0001',
            'alamat' => 'Jl. Merdeka No. 1', 'wilayah_asal' => 'Jawa Barat',
        ], $o);
    }

    public function test_tamu_ditolak(): void
    {
        $this->get('/supplier')->assertRedirect(route('login'));
    }

    public function test_staff_bisa_lihat_tambah_ubah(): void
    {
        $staff = User::factory()->create(['role' => 'staff']);

        $this->actingAs($staff)->post('/supplier', $this->data())->assertRedirect(route('suppliers.index'));
        $s = Supplier::first();
        $this->actingAs($staff)->get('/supplier')->assertOk()->assertSee('Nusantara Media')->assertSee('Akila Hirza');

        $this->actingAs($staff)->put("/supplier/{$s->id}", $this->data(['wilayah_asal' => 'Jawa Timur']))
            ->assertRedirect(route('suppliers.index'));
        $this->assertSame('Jawa Timur', $s->fresh()->wilayah_asal);
    }

    public function test_semua_field_wajib_dan_ada_batas_panjang(): void
    {
        $staff = User::factory()->create(['role' => 'staff']);

        $this->actingAs($staff)->post('/supplier', [])
            ->assertSessionHasErrors(['nama_supplier', 'no_telp', 'alamat', 'wilayah_asal']);
        $this->actingAs($staff)->post('/supplier', $this->data(['no_telp' => str_repeat('1', 21)]))
            ->assertSessionHasErrors('no_telp');
    }

    public function test_hapus_hanya_admin(): void
    {
        $s = Supplier::create($this->data());

        $this->actingAs(User::factory()->create(['role' => 'staff']))->delete("/supplier/{$s->id}")->assertForbidden();
        $this->assertDatabaseCount('suppliers', 1);
        $this->actingAs(User::factory()->create(['role' => 'admin']))->delete("/supplier/{$s->id}")
            ->assertRedirect(route('suppliers.index'));
        $this->assertDatabaseCount('suppliers', 0);
    }
}
