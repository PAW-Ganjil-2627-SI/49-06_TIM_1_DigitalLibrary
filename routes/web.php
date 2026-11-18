<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('buku.index'));

// Login & logout
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// Admin & Staff: lihat, tambah, ubah
Route::middleware(['auth', 'role:admin,staff'])->group(function () {
    Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
    Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
    Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
    Route::get('/buku/{buku}/edit', [BukuController::class, 'edit'])->name('buku.edit');
    Route::put('/buku/{buku}', [BukuController::class, 'update'])->name('buku.update');
});

// Hanya Admin: hapus
Route::delete('/buku/{buku}', [BukuController::class, 'destroy'])
    ->name('buku.destroy')
    ->middleware(['auth', 'role:admin']);