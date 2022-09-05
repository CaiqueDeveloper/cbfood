<?php

use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/orders', [OrderController::class, 'orders']);
Route::get('/getOrders', [OrderController::class, 'getOrders']);
Route::get('/renderOrderView', [OrderController::class, 'renderOrderView']);
Route::get('/updateStatusOrder', [OrderController::class, 'updateStatusOrder']);
Route::get('/delivered', [OrderController::class, 'delivered']);
Route::get('/beingPrepared', [OrderController::class, 'beingPrepared']);
Route::get('/canceled', [OrderController::class, 'canceled']);
Route::get('/exportOrder/{id}', [OrderController::class, 'exportOrder']);
Route::get('/showModalAddressOrderUser/{id}', [OrderController::class, 'showModalAddressOrderUser']);
Route::get('/showModalGerAdditionalOrders', [OrderController::class, 'showModalGerAdditionalOrders']);
