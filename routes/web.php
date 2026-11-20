<?php

<<<<<<< HEAD
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;


Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:pegawai,admin'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/detail', [DetailController::class, 'index'])->name('detail');

        Route::get('/form/{id?}', [FormController::class, 'index'])->name('form');
        Route::post('/form/tambah', [FormController::class, 'tambah'])->name('tambahSupplier');
        Route::put('/form/update/{id?}', [FormController::class, 'update'])->name('updateSupplier');
    });

    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::delete('/form/delete/{id?}', [FormController::class, 'hapus'])->name('hapusSupplier');
    });
});

require __DIR__.'/auth.php';
=======
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
>>>>>>> 3d9d2383620fd00ae350ba7ec89b855d07d0701b
