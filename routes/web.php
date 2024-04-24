<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// wlecome page
Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// Kelas Controller
Route::prefix('/kelas')->group(function () {
    Route::get('/daftar-kelas', [KelasController::class, 'kelas_view'])->name('kelas.view');
    Route::post('/create-kelas', [KelasController::class, 'create_kelas'])->name('kelas.create');
    Route::put('/update-kelas/{id}', [KelasController::class, 'update_kelas'])->name('kelas.update');
    Route::delete('/delete-kelas/{id}', [KelasController::class, 'delete_kelas'])->name('kelas.delete');
});
// User Controller
Route::prefix('/pengguna')->group(function () {
    Route::get('/semua-pengguna', [UsersController::class, 'users_view'])->name('pengguna.view');
    Route::get('/cari-pengguna', [UsersController::class, 'search'])->name('pengguna.search');
    Route::post('/create-pengguna', [UsersController::class, 'create_user'])->name('pengguna.create');
    Route::put('/create-pengguna/{id}', [UsersController::class, 'update_user'])->name('pengguna.update');
    Route::delete('/delete-pengguna/{id}', [UsersController::class, 'delete_user'])->name('pengguna.delete');
});
// Lab Controller 
Route::prefix('/lab')->group(function () {
    Route::get('list-lab', [LabController::class, 'lab_view'])->name('lab.view');
    Route::post('/create-lab', [LabController::class, 'create_lab'])->name('lab.create');
    Route::put('/update-lab/{id}', [LabController::class, 'update_lab'])->name('lab.update');
    Route::delete('/delete-lab/{id}', [LabController::class, 'delete_lab'])->name('lab.delete');
    Route::get('/cari-lab', [LabController::class, 'search'])->name('lab.search');
});
// Peminjaman LAB Controller
Route::prefix('/peminjaman')->group(function () {
    Route::get('daftar-peminjaman', [PeminjamanController::class, 'pinjaman'])->name('peminjaman.view');
    Route::get('form-peminjaman', [PeminjamanController::class, 'form_peminjaman'])->name('forms.view');
    Route::post('ajukan-peminjaman', [PeminjamanController::class, 'create_peminjaman'])->name('peminjaman.create');
    Route::get('edit-peminjaman/{id}', [PeminjamanController::class, 'edit_peminjaman'])->name('edit.view');
    Route::put('update-peminjaman/{id}', [PeminjamanController::class, 'update_peminjaman'])->name('peminjaman.update');
    Route::delete('hapus-peminjaman/{id}', [PeminjamanController::class, 'delete'])->name('peminjaman.delete');
});
// Profile Controller
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authenticate Controller
require __DIR__ . '/auth.php';
