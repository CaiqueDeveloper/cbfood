<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::redirect('/', '/admin/dashboard');
Broadcast::routes();
//PAINEL
Route::prefix('admin')->group(base_path('routes/web/panel/dashboard.php'));
Route::prefix('admin')->group(base_path('routes/web/panel/users.php'));
Route::prefix('admin')->group(base_path('routes/web/panel/company.php'));
Route::prefix('admin')->group(base_path('routes/web/panel/settingCompany.php'));
Route::prefix('admin')->group(base_path('routes/web/panel/category.php'));
Route::prefix('admin')->group(base_path('routes/web/panel/product.php'));
Route::prefix('admin')->group(base_path('routes/web/panel/additional.php'));
Route::prefix('admin')->group(base_path('routes/web/panel/order.php'));
Route::prefix('admin')->group(base_path('routes/web/panel/permission.php'));
Route::prefix('admin')->group(base_path('routes/web/panel/profile.php'));
Route::prefix('admin')->group(base_path('routes/web/panel/moduleProfile.php'));
Route::prefix('admin')->group(base_path('routes/web/panel/profileUser.php'));
Route::prefix('admin')->group(base_path('routes/web/panel/deliverymen.php'));
Route::prefix('admin')->group(base_path('routes/web/panel/systemUsability.php'));
Route::prefix('admin')->group(base_path('routes/web/panel/ultils.php'));
Route::prefix('admin')->group(base_path('routes/web/panel/notify.php'));
Route::prefix('admin')->group(base_path('routes/web/panel/report.php'));
Route::prefix('admin')->group(base_path('routes/web/panel/promotion.php'));
//MENU DIGITAL
Route::prefix('app')->group(base_path('routes/web/app/home.php'));
Route::prefix('app')->group(base_path('routes/web/app/cart.php'));
//AUTENTICAÇÃO
Route::prefix('auth')->group(base_path('routes/web/auth/auth.php'));


