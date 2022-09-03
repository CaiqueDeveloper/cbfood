<?php

use App\Http\Controllers\Admin\ProfilesController;
use Illuminate\Support\Facades\Route;

Route::get('/geAllProfiles', [ProfilesController::class, 'geAllProfiles']);
Route::get('/showModalAllUserAssociateWithProfile/{id}', [ProfilesController::class, 'showModalAllUserAssociateWithProfile']);
Route::get('/showModalUpdateProfile/{id}', [ProfilesController::class, 'showModalUpdateProfile']);
Route::post('/updateProfile', [ProfilesController::class, 'updateProfile']);
Route::get('/delteProfile/{id}', [ProfilesController::class, 'delteProfile']);
Route::get('/permissions', [ProfilesController::class, 'index']);
Route::get('/showModalCreateNewPorifle', [ProfilesController::class, 'showModalCreateNewPorifle']);
Route::post('/storageProfile', [ProfilesController::class, 'storageProfile']);