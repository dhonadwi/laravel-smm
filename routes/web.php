<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransactionRequestController;
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

Route::get('/', function () {
    return view('pages.dashboard');
});

Route::get('/barang', [ItemController::class, 'index'])->name('data-barang');
Route::get('/permintaan', [ItemController::class, 'create'])->name('request-barang');
Route::post('/permintaan', [TransactionRequestController::class, 'store'])->name('simpan-request-barang');
Route::get('/histori', [TransactionRequestController::class, 'index'])->name('histori-request');
Route::get('/histori/{id}', [TransactionRequestController::class, 'show'])->name('histori-request-detail');
