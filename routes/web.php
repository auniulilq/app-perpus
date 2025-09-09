<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
});

// Login
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login', [LoginController::class, 'actionLogin'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [HomeController::class, 'index']);
    Route::post('logout', [LoginController::class, 'logout']);

    // Anggota
    Route::get('anggota/index', [AnggotaController::class, 'index']);
    Route::get('anggota/create', [AnggotaController::class, 'create']);
    Route::post('anggota/store', [AnggotaController::class, 'store'])->name('anggota.store');
    Route::get('anggota/edit/{id}', [AnggotaController::class, 'edit'])->name('anggota.edit');
    Route::put('anggota/update/{id}', [AnggotaController::class, 'update'])->name('anggota.update');
    Route::delete('anggota/destroy/{id}', [AnggotaController::class, 'softDelete'])->name('anggota.softdelete');
    Route::get('anggota/restore', [AnggotaController::class, 'indexRestore']);
    Route::get('anggota/restore/{id}', [AnggotaController::class, 'restore'])->name('anggota.restore');
    Route::delete('anggota/restore/destroy/{id}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');

    // Lokasi
    Route::get('lokasi/index', [LocationController::class, 'index']);
    Route::get('lokasi/create', [LocationController::class, 'create']);
    Route::post('lokasi/store', [LocationController::class, 'store'])->name('lokasi.store');
    Route::get('lokasi/edit/{id}', [LocationController::class, 'edit'])->name('lokasi.edit');
    Route::put('lokasi/update/{id}', [LocationController::class, 'update'])->name('lokasi.update');
    Route::delete('lokasi/destroy/{id}', [LocationController::class, 'destroy'])->name('lokasi.destroy');

    // Kategori
    Route::get('kategori/index', [CategoryController::class, 'index']);
    Route::get('kategori/create', [CategoryController::class, 'create']);
    Route::post('kategori/store', [CategoryController::class, 'store'])->name('kategori.store');
    Route::get('kategori/edit/{id}', [CategoryController::class, 'edit'])->name('kategori.edit');
    Route::put('kategori/update/{id}', [CategoryController::class, 'update'])->name('kategori.update');
    Route::delete('kategori/destroy/{id}', [CategoryController::class, 'destroy'])->name('kategori.destroy');

    // Buku
    Route::get('buku/index', [BookController::class, 'index']);
    Route::get('buku/create', [BookController::class, 'create']);
    Route::post('buku/store', [BookController::class, 'store'])->name('buku.store');
    Route::get('buku/edit/{id}', [BookController::class, 'edit'])->name('buku.edit');
    Route::put('buku/update/{id}', [BookController::class, 'update'])->name('buku.update');
    Route::delete('buku/destroy/{id}', [BookController::class, 'destroy'])->name('buku.destroy');

    // Transaksi
    Route::resource('transaction', TransactionController::class)->middleware('role:User');
    Route::get('get-buku/{id_category}', [TransactionController::class, 'getBukuByIdCategory']);
    Route::get('print-peminjam/{id}', action: [TransactionController::class, 'print'])->name('print-peminjam');
    Route::post('transaction/{id}/return',[App\Http\Controllers\TransactionController::class,'returnBook'])->name('transaction.return');

    // Role
    Route::resource('role', RoleController::class);
    // User
    Route::resource('user', App\Http\Controllers\UserController::class);
    Route::get('user/{id}/roles', [App\Http\Controllers\UserController::class, 'editRole'])->name('user.editRole');
    Route::post('user/{id}/roles', [App\Http\Controllers\UserController::class, 'updateRole'])->name('user.updateRole');

    
});

