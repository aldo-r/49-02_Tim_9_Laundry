<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeterjenController;
use App\Http\Controllers\MesinController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\TarifController;

/*
|--------------------------------------------------------------------------
| Web Routes - Sistem Manajemen Laundry Farm
|--------------------------------------------------------------------------
*/

// Redirect Halaman Utama
Route::get('/', fn () => redirect()->route('deterjens.index'))->name('home');

// Alias untuk route tunggal /deterjen
Route::get('/deterjen', fn () => redirect()->route('deterjens.index'));

// --------------------------------------------------------------------------
// Guest Routes (Autentikasi: Login & Register)
// --------------------------------------------------------------------------
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// --------------------------------------------------------------------------
// Authenticated Routes (Akses Baca / View - User & Admin)
// --------------------------------------------------------------------------
Route::middleware('auth')->group(function () {
    // Menu Deterjen (Read Only)
    Route::resource('deterjens', DeterjenController::class)->only(['index', 'show']);

    // Menu Mesin (Read Only)
    Route::resource('mesin', MesinController::class)->only(['index']);

    // Menu Pelanggan (Read Only)
    Route::resource('pelanggan', PelangganController::class)->only(['index']);

    // Menu Layanan & Tarif (Read Only)
    Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
    Route::get('/layanan/{layanan}/tarif', [TarifController::class, 'index'])->name('tarif.index');
});

// --------------------------------------------------------------------------
// Admin Only Routes (Operasi CRUD & Kelola Data)
// --------------------------------------------------------------------------
Route::middleware(['auth', 'role:admin'])->group(function () {
    // CRUD Deterjen
    Route::resource('deterjens', DeterjenController::class)->except(['index', 'show']);

    // CRUD Mesin
    Route::resource('mesin', MesinController::class)->except(['index', 'show']);

    // CRUD Pelanggan
    Route::resource('pelanggan', PelangganController::class)->except(['index', 'show']);

    // Manajemen Layanan
    Route::get('/layanan/kelola', [LayananController::class, 'kelola'])->name('layanan.kelola');
    Route::post('/layanan', [LayananController::class, 'store'])->name('layanan.store');
    Route::get('/layanan/{layanan}/edit', [LayananController::class, 'edit'])->name('layanan.edit');
    Route::put('/layanan/{layanan}', [LayananController::class, 'update'])->name('layanan.update');
    Route::delete('/layanan/{layanan}', [LayananController::class, 'destroy'])->name('layanan.destroy');

    // Manajemen Tarif
    Route::post('/layanan/{layanan}/tarif', [TarifController::class, 'store'])->name('tarif.store');
    Route::get('/tarif/{tarif}/edit', [TarifController::class, 'edit'])->name('tarif.edit');
    Route::put('/tarif/{tarif}', [TarifController::class, 'update'])->name('tarif.update');
    Route::delete('/tarif/{tarif}', [TarifController::class, 'destroy'])->name('tarif.destroy');
});
