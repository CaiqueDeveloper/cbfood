<?php

use App\Http\Controllers\Admin\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/products', [ProductsController::class, 'index']);
Route::get('/getModalCreatProduct', [ProductsController::class, 'getModalCreatProduct']);
Route::post('/storageProdudct', [ProductsController::class, 'storageProdudct']);
Route::get('/getAllProducts', [ProductsController::class, 'getAllProducts']);
Route::get('/deleteProduct/{id}', [ProductsController::class, 'deleteProduct']);
Route::get('/getModalUpdateProduct/{id}', [ProductsController::class, 'getModalUpdateProduct']);
Route::get('/deleteAdditionalProduct', [ProductsController::class, 'deleteAdditionalProduct']);
Route::get('/deleteImageProduct', [ProductsController::class, 'deleteImageProduct']);
Route::get('/deleteVariationProduct', [ProductsController::class, 'deleteVariationProduct']);