<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_halaman_login_dan_register_tampil_untuk_tamu(): void
    {
        $this->get('/login')->assertOk()->assertSee('Login')->assertSee('Daftar');
        $this->get('/register')->assertOk()->assertSee('Konfirmasi Password');
    }

    public function test_tamu_diarahkan_ke_login(): void
    {
        $this->get('/')->assertRedirect(route('login'));
    }

    public function test_login_berhasil(): void
    {
        $user = User::factory()->create(['role' => 'staff']);

        $this->post('/login', ['email' => $user->email, 'password' => 'password'])
            ->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_login_gagal_menampilkan_pesan(): void
    {
        $user = User::factory()->create();

        $this->from('/login')->post('/login', ['email' => $user->email, 'password' => 'salah'])
            ->assertRedirect('/login')
            ->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_register_membuat_akun_staff_dan_langsung_login(): void
    {
        $this->post('/register', [
            'name' => 'Mahasiswa Baru',
            'email' => 'baru@example.com',
            'password' => 'rahasia123',
            'password_confirmation' => 'rahasia123',
        ])->assertRedirect(route('home'));

        $user = User::where('email', 'baru@example.com')->first();
        $this->assertNotNull($user);
        $this->assertSame('staff', $user->role);
        $this->assertAuthenticatedAs($user);
    }

    public function test_register_tidak_bisa_memilih_role_admin(): void
    {
        $this->post('/register', [
            'name' => 'Nakal',
            'email' => 'nakal@example.com',
            'password' => 'rahasia123',
            'password_confirmation' => 'rahasia123',
            'role' => 'admin',
        ]);

        $this->assertSame('staff', User::where('email', 'nakal@example.com')->value('role'));
    }

    public function test_register_validasi(): void
    {
        User::factory()->create(['email' => 'ada@example.com']);

        $this->post('/register', [
            'name' => '',
            'email' => 'ada@example.com',
            'password' => 'pendek',
            'password_confirmation' => 'beda',
        ])->assertSessionHasErrors(['name', 'email', 'password']);
    }

    public function test_logout(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('/logout')->assertRedirect(route('login'));
        $this->assertGuest();
    }

    public function test_user_login_tidak_bisa_membuka_login_lagi(): void
    {
        $this->actingAs(User::factory()->create())->get('/login')->assertRedirect();
    }

    public function test_logout_butuh_login(): void
    {
        $this->post('/logout')->assertRedirect(route('login'));
    }
}
