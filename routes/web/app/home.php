<?php

use App\Http\Controllers\Page\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/menu/{slug}', [HomeController::class, 'index']);
Route::get('/renderViewGetProduct/{product_id}', [HomeController::class, 'renderViewGetProduct']);
Route::get('/rederViewAllProductsCompany/{slug}', [HomeController::class, 'rederViewAllProductsCompany']);
Route::post('/getProductName', [HomeController::class, 'getProductName']);
Route::post('/getProductCart', [HomeController::class, 'getProductCart']);
Route::get('/getModalCartItem', [HomeController::class, 'getModalCartItem']);
Route::get('/getModalCheckout', [HomeController::class, 'getModalCheckout']);
Route::post('/ckeckout', [HomeController::class, 'ckeckout']);
Route::get('/getModalInserNewAddressUser', [HomeController::class, 'getModalInserNewAddressUser']);
Route::post('/storageNewAddressUser', [HomeController::class, 'storageNewAddressUser']);
Route::post('/sendOrderUser', [HomeController::class, 'sendOrderUser']);
Route::get('/getModalLoginUser', [HomeController::class, 'getModalLoginUser']);
Route::post('/loginUser', [HomeController::class, 'loginUser']);
Route::post('/logoutUser', [HomeController::class, 'logoutUser']);
Route::get('/getModalMyBagUser', [HomeController::class, 'getModalMyBagUser']);
Route::get('/getModalUser', [HomeController::class, 'getModalUser']);
Route::get('product/{id}', [HomeController::class, 'product'])->name('product');