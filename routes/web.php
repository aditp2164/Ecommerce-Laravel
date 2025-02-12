<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk admin melihat daftar pengguna
Route::get('/admin/users', [AuthController::class, 'listUsers'])->name('admin.users');
Route::get('/admin/users/edit/{id}', [AuthController::class, 'editUser'])->name('admin.editUser');
Route::put('/admin/users/update/{id}', [AuthController::class, 'updateUser'])->name('admin.updateUser');
Route::delete('/admin/users/delete/{id}', [AuthController::class, 'deleteUser'])->name('admin.deleteUser');

Route::get('/produk-perhitungan', [AuthController::class, 'showProdukPerhitungan'])->name('produk.perhitungan');
Route::post('/produk-perhitungan', [AuthController::class, 'storeProduk'])->name('produk.store');
Route::get('/produk/export', [AuthController::class, 'export'])->name('produk.export');
Route::post('/produk', [AuthController::class, 'storeProduk'])->name('produk.store');

Route::get('/performa', [AuthController::class, 'showPerforma'])->name('performa');

