<?php

use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/orders', [OrderController::class, 'orders']);
Route::get('/getIdicatorsDashboard', [HomeController::class, 'getIdicatorsDashboard']);
Route::get('/allSalesByCategories', [HomeController::class, 'allSalesByCategories']);
Route::get('/getDataGraphSalesStatus', [HomeController::class, 'getDataGraphSalesStatus']);
Route::get('/getDataShowingTop10SellingProducts', [HomeController::class, 'getDataShowingTop10SellingProducts']);
Route::get('/getDataTableSalesDay', [HomeController::class, 'getDataTableSalesDay']);
Route::get('/getOrders', [OrderController::class, 'getOrders']);
Route::get('/renderOrderView', [OrderController::class, 'renderOrderView']);
Route::get('/updateStatusOrder', [OrderController::class, 'updateStatusOrder']);
Route::get('/delivered', [OrderController::class, 'delivered']);
Route::get('/beingPrepared', [OrderController::class, 'beingPrepared']);
Route::get('/canceled', [OrderController::class, 'canceled']);
Route::get('/exportOrder/{id}', [OrderController::class, 'exportOrder']);
Route::get('/showModalAddressOrderUser/{id}', [OrderController::class, 'showModalAddressOrderUser']);
Route::get('/showModalGerAdditionalOrders', [OrderController::class, 'showModalGerAdditionalOrders']);
Route::get('/getDataGraphSales', [HomeController::class, 'getDataGraphSales']);