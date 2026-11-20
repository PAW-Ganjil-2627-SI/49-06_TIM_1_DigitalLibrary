<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth (seragam untuk semua modul)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Halaman awal: arahkan ke halaman utama modul pertama yang tersedia.
Route::get('/', function () {
    foreach (['area.index', 'buku.index', 'members.index', 'suppliers.index'] as $name) {
        if (Route::has($name)) {
            return redirect()->route($name);
        }
    }
    abort(404);
})->middleware('auth')->name('home');

/*
|--------------------------------------------------------------------------
| Route per modul
|--------------------------------------------------------------------------
| Setiap anggota menaruh route-nya di routes/modules/<modul>.php, sehingga
| saat merge tidak ada yang saling menimpa file routes/web.php.
*/
foreach (glob(__DIR__ . '/modules/*.php') as $moduleRoutes) {
    require $moduleRoutes;
}
