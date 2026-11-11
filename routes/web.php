<?php

use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('buku.index'));

// Route untuk Admin & Petugas (Bisa lihat, tambah, edit)
Route::middleware(['auth', 'role:admin,petugas'])->group(function () {
    Route::resource('buku', BukuController::class)->except(['show', 'destroy']);
});

// Route KHUSUS Admin (Termasuk hapus data)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::delete('buku/{buku}', [BukuController::class, 'destroy'])->name('buku.destroy');
});
// Tambahkan ini supaya middleware auth tidak error "Route [login] not defined"
Route::get('/login', function () {
    return "Halaman Login Sederhana (Silakan buat form login atau arahkan ke halaman login kamu)";
})->name('login');
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Route Login Form
Route::get('/login', function () {
    return '
    <form method="POST" action="/login" style="max-width: 400px; margin: 50px auto; font-family: sans-serif;">
        ' . csrf_field() . '
        <h2>Login Aplikasi</h2>
        <div style="margin-bottom: 15px;">
            <label>Email:</label><br>
            <input type="email" name="email" required style="width: 100%; padding: 8px;">
        </div>
        <div style="margin-bottom: 15px;">
            <label>Password:</label><br>
            <input type="password" name="password" required style="width: 100%; padding: 8px;">
        </div>
        <button type="submit" style="padding: 10px 15px; background: #007bff; color: white; border: none; cursor: pointer;">Login</button>
    </form>
    ';
})->name('login');

// Route Proses Login
// Route Proses Login
Route::post('/login', function (\Illuminate\Http\Request $request) {
    $user = \App\Models\User::where('email', $request->email)->first();

    if ($user) {
        \Illuminate\Support\Facades\Auth::login($user);
        $request->session()->regenerate();
        return redirect('/buku');
    }

    return back()->withErrors([
        'email' => 'Email salah atau user tidak ditemukan.',
    ]);
});
Route::get('/buat-user', function () {
    \App\Models\User::updateOrCreate(
        ['email' => 'admin@gmail.com'],
        [
            'name' => 'Admin Ganteng',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]
    );

    \App\Models\User::updateOrCreate(
        ['email' => 'petugas@gmail.com'],
        [
            'name' => 'Petugas Setia',
            'password' => bcrypt('password'),
            'role' => 'petugas'
        ]
    );

    return "Akun Berhasil Dibuat! Email: admin@gmail.com / petugas@gmail.com, Password: password";
});

// Route Logout
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
});