<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;

Route::get('/dashboard', [HomeController::class, 'index']);
Route::get('/getDataGraphSales', [HomeController::class, 'getDataGraphSales']);Route::get('/getIdicatorsDashboard', [HomeController::class, 'getIdicatorsDashboard']);
Route::get('/allSalesByCategories', [HomeController::class, 'allSalesByCategories']);
Route::get('/getDataGraphSalesStatus', [HomeController::class, 'getDataGraphSalesStatus']);
Route::get('/getDataShowingTop10SellingProducts', [HomeController::class, 'getDataShowingTop10SellingProducts']);
Route::get('/getDataTableSalesDay', [HomeController::class, 'getDataTableSalesDay']);