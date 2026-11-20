<?php

use App\Http\Controllers\AreaController;
use Illuminate\Support\Facades\Route;

// Modul Fasilitas & Area (Marcel)
Route::middleware('auth')->group(function () {
    // Admin dan Staff: lihat, tambah, ubah
    Route::middleware('role:admin,staff')->group(function () {
        Route::resource('area', AreaController::class)->except(['show', 'destroy']);
    });

    // Hanya Admin: hapus
    Route::delete('area/{area}', [AreaController::class, 'destroy'])
        ->name('area.destroy')
        ->middleware('role:admin');
});
