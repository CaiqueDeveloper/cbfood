<?php

use App\Http\Controllers\Admin\ProfilesUserController;
use Illuminate\Support\Facades\Route;

Route::get('/storageAssociateProfileWithUser', [ProfilesUserController::class, 'storageAssociateProfileWithUser']);
Route::get('/removeProfileAssociationWithUser', [ProfilesUserController::class, 'removeProfileAssociationWithUser']);