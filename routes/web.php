<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PenjualController;
use App\Http\Controllers\DetailPenjualanController;
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

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('/actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');

Route::middleware('IsLogin','CekRole:administrator,petugas')->group(function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
    Route::get('/produk', [ProdukController::class, 'index']);
    Route::get('/penjualan', [PenjualController::class, 'index']);
    Route::get('/cetakpenjualan/{id}', [PenjualController::class, 'cetakpenjualan'])->name('cetakpenjualan');
    Route::post('/penjualan/excel', [PenjualController::class, 'excel'])->name('penjualan.excel');
    Route::get('/actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');
});

Route::middleware('IsLogin','CekRole:administrator')->group(function() {
    Route::get('/create',[ProdukController::class, 'create'])->name('create');
    Route::post('/store',[ProdukController::class, 'store'])->name('store');
    Route::get('/edit/{id}',[ProdukController::class, 'edit'])->name('edit');
    Route::get('/editStok/{id}',[ProdukController::class, 'editStok'])->name('editStok');
    Route::put('/update/{id}',[ProdukController::class, 'update'])->name('update');
    Route::put('/updateStok/{id}',[ProdukController::class, 'updateStok'])->name('updateStok');
    Route::delete('/delete/{id}', [ProdukController::class, 'destroy'])->name('delete');

    Route::get('/user', [UserController::class, 'index']);
    Route::get('/createUser',[UserController::class, 'create'])->name('createUser');
    Route::post('/storeUser',[UserController::class, 'store'])->name('storeUser');
    Route::get('/editUser/{id}',[UserController::class, 'edit'])->name('editUser');
    Route::put('/updateUser/{id}',[UserController::class, 'update'])->name('updateUser');
    Route::delete('/deleteUser/{id}', [UserController::class, 'destroy'])->name('deleteUser');
});

Route::middleware('IsLogin','CekRole:petugas')->group(function() {
    Route::get('/createPenjualan', [PenjualController::class, 'create'])->name('createPenjualan');
    Route::post('/storepenjualan', [PenjualController::class, 'store'])->name('storepenjualan');
    Route::delete('/penjualanDestroy/{id}', [PenjualController::class, 'destroy'])->name('penjualan.destroy');
});

