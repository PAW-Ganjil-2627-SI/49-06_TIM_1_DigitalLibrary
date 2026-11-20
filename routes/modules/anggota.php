<?php

use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

// Modul Anggota & Kartu (Neysa)
Route::middleware('auth')->group(function () {
    // Admin dan Staff: lihat, tambah, ubah, detail/cetak kartu
    Route::middleware('role:admin,staff')->group(function () {
        Route::resource('anggota', MemberController::class)
            ->parameters(['anggota' => 'member'])
            ->names('members')
            ->except(['destroy']);
    });

    // Hanya Admin: hapus
    Route::delete('anggota/{member}', [MemberController::class, 'destroy'])
        ->name('members.destroy')
        ->middleware('role:admin');
});
