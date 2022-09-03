<?php

use App\Http\Controllers\Admin\CartController;
use Illuminate\Support\Facades\Route;

Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::get('cart/totalPriceCartItem', [CartController::class, 'priceCart']);
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::get('updateItemCart', [CartController::class, 'updateCart'])->name('cart.update');
Route::get('remove/{id}', [CartController::class, 'removeCart'])->name('cart.remove');
Route::get('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');