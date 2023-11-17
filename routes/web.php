<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PesananController;
use App\Models\Buku;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Login Customer
Route::middleware(['auth', 'auth'])->group(function () {
    Route::post('/cart/store', [customerController::class, 'cartstore']);

    Route::get('/cart', [customerController::class, 'cart']);

    Route::post('/cart/update', [customerController::class, 'cart_update']);

    Route::get('/cart/delete/{id}', [customerController::class, 'cart_delete']);

    Route::get('/cart/check-out', [customerController::class, 'check_out']);

    Route::get('/check-out/konfirmasi/{id}', [customerController::class, 'co_view']);

    Route::get('/check-out/bayar/{id}', [customerController::class, 'midtrans']);

    Route::post('/check-out/pembayaran', [CustomerController::class, 'pembayaran']);

    Route::get('/user/pesanan', [CustomerController::class, 'pesanan']);

    Route::get('/user/pesanan/detail/{id}', [CustomerController::class, 'detailpesanan']);

    Route::get('/user/profil', [CustomerController::class, 'profil']);

    Route::post('/user/profil/update', [CustomerController::class, 'profil_update']);

    Route::get('/user/pesanan/cetak/{id}', [CustomerController::class, 'exportPDF']);
});

// admin
Route::middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/admin', function(){
        $pesanan = Pesanan::all()->count();
        $user = User::where('role', 'customer')->count();
        $buku = Buku::all()->count();
        $total = Pesanan::all()->sum('total');

        return view('admin.index',[
            'pesanan' => $pesanan,
            'user' => $user,
            'buku' => $buku,
            'total' => $total
        ]);
    });

    // Buku
    Route::resource('buku', BukuController::class);

    // Kategori
    Route::resource('kategori', KategoriController::class);

    // Pesanan
    Route::get('pesanan', [PesananController::class, 'index']);

    Route::get('pesanan/detail/{id}', [PesananController::class, 'detailpesanan']);

    Route::get('pesanan/laporan/excel', [PesananController::class, 'exportexcel']);
});

// Tanpa Login
Route::get('/', [CustomerController::class, 'index']);

Route::get('wilayah', [CustomerController::class, 'wilayah']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
