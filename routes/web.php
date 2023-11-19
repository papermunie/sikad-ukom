<?php

use App\Http\Controllers\PengeluaranKasController;
use App\Http\Controllers\TblUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('', function() {
   
    return redirect('/');
});

Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/login', [TblUserController::class, 'index'])->name('login');
Route::post('/login', [TblUserController::class, 'login']);
Route::get('/logout', [TblUserController::class, 'logout'])->name('logout');

// Menampilkan semua data kas keluar
Route::get('/pengeluaran', [PengeluaranKasController::class, 'index'])->name('pengeluaran.index');

// Menampilkan formulir untuk membuat data kas keluar baru
Route::get('/pengeluaran/create', [PengeluaranKasController::class, 'create'])->name('pengeluaran.create');

// Menyimpan data kas keluar yang baru dibuat
Route::post('/pengeluaran', [PengeluaranKasController::class, 'store'])->name('pengeluaran.store');

// Menampilkan detail dari sebuah data kas keluar
Route::get('/pengeluaran/{id}', [PengeluaranKasController::class, 'show'])->name('pengeluaran.show');

// Menampilkan formulir untuk mengedit data kas keluar
Route::get('/pengeluaran/{id}/edit', [PengeluaranKasController::class, 'edit'])->name('pengeluaran.edit');

// Menyimpan perubahan pada data kas keluar yang sudah diedit
Route::put('/pengeluaran/{id}', [PengeluaranKasController::class, 'update'])->name('pengeluaran.update');

// Menghapus data kas keluar
Route::delete('/pengeluaran/{id}', [PengeluaranKasController::class, 'destroy'])->name('pengeluaran.destroy');
