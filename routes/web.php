<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProfileController;
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



Route::middleware('auth')->group(function () {
  Route::get('/', function () {
    return view('dashboard');
  })->name('dashboard');

  Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
  Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
  Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
  Route::get('/barang/{barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
  Route::patch('/barang/{barang}', [BarangController::class, 'update'])->name('barang.update');
  Route::delete('/barang/{barang}', [BarangController::class, 'destroy'])->name('barang.destroy');

  Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
  Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
  Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
  Route::get('/kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
  Route::patch('/kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
  Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
