<?php

use App\Http\Controllers\Admin\AdditionalController;
use Illuminate\Support\Facades\Route;

Route::get('/additional', [AdditionalController::class, 'index']);
Route::get('/getAllAditionals', [AdditionalController::class, 'getAllAditionals']);
Route::get('/getModalCreateGroupAdditional', [AdditionalController::class, 'getModalCreateGroupAdditional']);
Route::get('/getModalCreateItemAdditional', [AdditionalItemsController::class, 'getModalCreateItemAdditional']);
Route::post('/storageGropAdditional', [AdditionalController::class, 'storageGropAdditional']);
Route::post('/storageItemAdditional', [AdditionalItemsController::class, 'storageItemAdditional']);
Route::get('/deleteAdditional/{additional_id}', [AdditionalController::class, 'deleteAdditional']);
Route::get('/deleteItemAdditional/{id}', [AdditionalItemsController::class, 'deleteItemAdditional']);
Route::get('/getModalUpdateAdditional/{id}', [AdditionalController::class, 'getModalUpdateAdditional']);
Route::get('/getModalUpdateIemAdditional/{id}', [AdditionalItemsController::class, 'getModalUpdateIemAdditional']);
Route::post('/storageUpdateAdditonal', [AdditionalController::class, 'storageUpdateAdditonal']);
Route::post('/storageUpdateItemAdditional', [AdditionalItemsController::class, 'storageUpdateItemAdditional']);
Route::get('/renderViewContentAdditional', [AdditionalController::class, 'renderViewContentAdditional']);