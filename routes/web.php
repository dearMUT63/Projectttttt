<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\TransactionController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/product', ProductController::class);
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('/product', ProductController::class);
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
    Route::get('/transaction/approve/{order}', [TransactionController::class, 'approve'])->name('transaction.approve');
    Route::get('/transaction/reject/{order}', [TransactionController::class, 'reject'])->name('transaction.reject');


});
Route::middleware(['auth'])->group(function () {
    Route::resource('cart', CartController::class);
    Route::post('checkout', [CartController::class, 'checkOut'])->name('cart.checkout');
    Route::get('history', [HistoryController::class, 'index'])->name('history.index');
    Route::post('upload/slip', [HistoryController::class, 'uploadSlip'])->name('upload.slip');
    Route::get('/transaction/cancel/{order}', [TransactionController::class, 'cancel'])->name('transaction.cancel');
});
