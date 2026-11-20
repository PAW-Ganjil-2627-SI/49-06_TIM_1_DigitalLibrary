<?php

use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Route;

// Modul Katalog & Buku (Abid)
Route::middleware('auth')->group(function () {
    // Admin dan Staff: lihat, tambah, ubah
    Route::middleware('role:admin,staff')->group(function () {
        Route::resource('buku', BukuController::class)
            ->except(['show', 'destroy']);
    });

    // Hanya Admin: hapus
    Route::delete('buku/{buku}', [BukuController::class, 'destroy'])
        ->name('buku.destroy')
        ->middleware('role:admin');
});
