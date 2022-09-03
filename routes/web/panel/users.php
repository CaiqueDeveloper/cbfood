<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/getInfoUserLogged', [UserController::class, 'getInfoUserLogged']);
Route::post('/updateUserFolks', [UserController::class, 'updateUserFolks']);
Route::post('/userChangePassword', [UserController::class, 'userChangePassword']);
Route::post('/updateOrInserAddressUser', [UserController::class, 'updateOrInserAddressUser']);
Route::get('/profileUser', [UserController::class, 'getProfile'])->name('profileUser');
Route::get('/users', [UserController::class, 'index']);
Route::get('/showModalRegisterUser',[UserController::class, 'showModalRegisterUser']);
Route::post('/storageUser', [UserController::class, 'storageUser']);
Route::get('/getUsers', [UserController::class, 'getUsers']);
Route::get('/showModalUpdateUser/{id}', [UserController::class, 'showModalUpdateUser']);
Route::get('/showModalUpdateOrInserAddresUser/{id}', [UserController::class, 'showModalUpdateOrInserAddresUser']);
Route::get('/showModalUpdatePassword/{id}', [UserController::class, 'showModalUpdatePassword']);
Route::get('/deleteUser/{id}', [UserController::class, 'deleteUser']);