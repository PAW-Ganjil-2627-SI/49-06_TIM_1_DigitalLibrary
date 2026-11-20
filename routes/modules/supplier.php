<?php

use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

// Modul Penerbit & Supplier (Akila)
Route::middleware('auth')->group(function () {
    // Admin dan Staff: lihat, tambah, ubah
    Route::middleware('role:admin,staff')->group(function () {
        Route::resource('supplier', SupplierController::class)
            ->names('suppliers')
            ->except(['show', 'destroy']);
    });

    // Hanya Admin: hapus
    Route::delete('supplier/{supplier}', [SupplierController::class, 'destroy'])
        ->name('suppliers.destroy')
        ->middleware('role:admin');
});
