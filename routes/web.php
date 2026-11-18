<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', fn () => redirect()->route('area.index'));

    // Admin dan Staff: lihat, tambah, ubah
    Route::middleware('role:admin,staff')->group(function () {
        Route::resource('area', AreaController::class)->except(['show', 'destroy']);
    });

    // Hanya Admin: hapus
    Route::delete('area/{area}', [AreaController::class, 'destroy'])
        ->name('area.destroy')
        ->middleware('role:admin');
});