<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\itemsController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategoryController;
use App\Models\transaction;

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

// Route::get('Home/{id}/destroy', [HomeController::class, 'destroy'])->name('admin.destroy');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('history',[TransactionController::class , 'history']);
Route::get('Category/{id}/hapus', [CategoryController::class, 'hapus'])->name('Category.hapus');
Route::get('Transaction/{id}/hapus', [TransactionController::class, 'hapus'])->name('Transaction.hapus');
Route::get('items/{id}/hapus', [itemsController::class, 'hapus'])->name('items.hapus');
Route::get('transactiondetails',[TransactionController::class , 'transactiondetails']);
Route::resource('home', homeController::class);
Route::resource('Transaction', TransactionController::class);
Route::post('transaction/checkout', [TransactionController::class, 'checkout'])->name('transaksi.checkout');
Route::resource('items', itemsController::class);
Route::resource('Category', CategoryController::class);
