<?php

namespace Tests\Feature;

use App\Models\Buku;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BukuTest extends TestCase
{
    use RefreshDatabase;

    private function data(array $o = []): array
    {
        return array_merge([
            'judul' => 'Laskar Pelangi', 'isbn' => '9789793062792', 'pengarang' => 'Andrea Hirata',
            'tahun_terbit' => 2005, 'kategori' => 'Sastra',
        ], $o);
    }

    public function test_tamu_ditolak(): void
    {
        $this->get('/buku')->assertRedirect(route('login'));
    }

    public function test_staff_bisa_lihat_tambah_ubah(): void
    {
        $staff = User::factory()->create(['role' => 'staff']);

        $this->actingAs($staff)->post('/buku', $this->data())->assertRedirect(route('buku.index'));
        $b = Buku::first();
        $this->actingAs($staff)->get('/buku')->assertOk()->assertSee('Laskar Pelangi')->assertSee('Abid');

        $this->actingAs($staff)->put("/buku/{$b->id}", $this->data(['kategori' => 'Sejarah']))
            ->assertRedirect(route('buku.index'));
        $this->assertSame('Sejarah', $b->fresh()->kategori);
    }

    public function test_validasi_kategori_dan_tahun(): void
    {
        $staff = User::factory()->create(['role' => 'staff']);

        $this->actingAs($staff)->post('/buku', $this->data(['kategori' => 'Komik', 'tahun_terbit' => 999]))
            ->assertSessionHasErrors(['kategori', 'tahun_terbit']);
        $this->actingAs($staff)->post('/buku', [])->assertSessionHasErrors(['judul', 'isbn', 'pengarang']);
    }

    public function test_hapus_hanya_admin(): void
    {
        $b = Buku::create($this->data());

        $this->actingAs(User::factory()->create(['role' => 'staff']))->delete("/buku/{$b->id}")->assertForbidden();
        $this->assertDatabaseCount('buku', 1);
        $this->actingAs(User::factory()->create(['role' => 'admin']))->delete("/buku/{$b->id}")
            ->assertRedirect(route('buku.index'));
        $this->assertDatabaseCount('buku', 0);
    }
}
