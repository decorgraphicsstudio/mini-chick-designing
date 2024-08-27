<?php

use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

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

Route::post('/', [DataController::class, 'welcome'])->name('dataadd');
Route::post('/dataadd', [DataController::class, 'adddata'])->name('dataadd');
Route::get('/dataadd', [DataController::class, 'lastdata'])->name('dataadd');
Route::get('/showdata', [DataController::class, 'showdata'])->name('showdata');
Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
Route::get('/payment-form', [PaymentController::class, 'showForm'])->name('payment.form');
Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');
Route::get('/printer', [DataController::class, 'printer'])->name('printer');
Route::post('/addprinter', [DataController::class, 'addprinter'])->name('printer');
Route::get('/designname', [DataController::class, 'printer'])->name('printer');
Route::post('/designname', [DataController::class, 'designName'])->name('printer');
