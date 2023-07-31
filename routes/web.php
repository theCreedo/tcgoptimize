<?php

use App\Http\Controllers\DiscountController;
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
    return view('index');
})->name('home');

// routes/web.php
Route::get('/discount', [DiscountController::class, 'showForm'])->name('discount.form');
Route::post('/discount', [DiscountController::class, 'submitForm'])->name('discount.submit');
