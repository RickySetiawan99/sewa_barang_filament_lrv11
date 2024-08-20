<?php

use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/transactions', [FrontController::class, 'transactions'])->name('front.transactions');
Route::post('/transactions/details', [FrontController::class, 'transactions_details'])->name('front.transaction.details');
Route::get('/details/{product:slug}', [FrontController::class, 'details'])->name('front.details');
Route::get('/booking/{product:slug}', [FrontController::class, 'booking'])->name('front.booking');
Route::post('/booking/{product:slug}/save', [FrontController::class, 'booking_save'])->name('front.booking_save');
Route::get('/success-booking/{transaction}', [FrontController::class, 'success_booking'])->name('front.success.booking');
Route::post('/checkout/finish', [FrontController::class, 'checkout_store'])->name('front.checkout.store');
Route::get('/checkout/{product:slug}/payment', [FrontController::class, 'checkout'])->name('front.checkout');
Route::get('/category/{category:slug}', [FrontController::class, 'category'])->name('front.category');
Route::get('/brand/{brand:slug}/products', [FrontController::class, 'brand'])->name('front.brand');
