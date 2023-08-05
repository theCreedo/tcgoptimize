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
    return view('about');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

// routes/web.php
Route::get('/discount', [DiscountController::class, 'showDiscountForm'])->name('discount');
Route::post('/discount', [DiscountController::class, 'submitForm'])->name('discount.submit');
