<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AnasayfaController;
use App\Http\Controllers\UrunController;

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


Route::get('/',[AnasayfaController::class,'index'])->name('anasayfa');
Route::get('/kategori/{slug_kategoriadi}',[KategoriController::class,'index'])->name('kategori');
Route::get('/urun/{slug_urunadi}',[UrunController::class,'index'])->name('urun');
