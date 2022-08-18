<?php

use App\Http\Controllers\Admin\AdditionalController;
use App\Http\Controllers\Admin\AdditionalItemsController;
use App\Http\Controllers\Admin\UltilsController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DeliveryMenController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ModulesProfileController;
use App\Http\Controllers\Admin\NotifyController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\ProfilesController;
use App\Http\Controllers\Admin\ProfilesUserController;
use App\Http\Controllers\Admin\PromotionsController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\settingCompanyController;
use App\Http\Controllers\Admin\SystemUsabilityControlController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Page\HomeController as PageHomeController;
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
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function(){
    
    //User
    Route::get('/dashboard', [HomeController::class, 'index']);
    Route::get('/getInfoUserLogged', [UserController::class, 'getInfoUserLogged']);
    Route::post('/updateUserFolks', [UserController::class, 'updateUserFolks']);
    Route::post('/userChangePassword', [UserController::class, 'userChangePassword']);
    Route::post('/uploadedFile', [UltilsController::class, 'uploadedFile']);
    Route::post('/updateOrInserAddressUser', [UserController::class, 'updateOrInserAddressUser']);
    Route::get('/changeCompany', [settingCompanyController::class, 'changeCompany']);
    Route::get('/profileUser', [UserController::class, 'getProfile'])->name('profileUser');
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/showModalRegisterUser',[UserController::class, 'showModalRegisterUser']);
    Route::post('/storageUser', [UserController::class, 'storageUser']);
    Route::get('/getUsers', [UserController::class, 'getUsers']);
    Route::get('/showModalUpdateUser/{id}', [UserController::class, 'showModalUpdateUser']);
    Route::get('/showModalUpdateOrInserAddresUser/{id}', [UserController::class, 'showModalUpdateOrInserAddresUser']);
    Route::get('/showModalUpdatePassword/{id}', [UserController::class, 'showModalUpdatePassword']);
    Route::get('/deleteUser/{id}', [UserController::class, 'deleteUser']);
    //Company
    Route::get('/company', [CompanyController::class, 'getCompany']);
    Route::post('/updateOrInserAddreCompany', [CompanyController::class, 'updateOrInserAddreCompany']);
    Route::post('/storageOrCreateCompany', [CompanyController::class, 'storageOrCreateCompany']);
    


    //Setting Company
    Route::post('/updateSettingCompany', [settingCompanyController::class, 'updateSettingCompany']);
    Route::get('/OpenedOrClosedStore', [settingCompanyController::class, 'OpenedOrClosedStore']);

    //Category
    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/getModalCreateCategory', [CategoryController::class, 'getModalCreateCategory']);
    Route::post('/storageCategory', [CategoryController::class, 'storageCategory']);
    Route::get('/getAllCategoryCompany', [CategoryController::class, 'getAllCategoryCompany']);
    Route::get('/deleteCategory/{id}', [CategoryController::class, 'deleteCategory']);
    Route::get('/getModalUpdateCategory/{id}', [CategoryController::class, 'getModalUpdateCategory']);
    Route::post('/storageUpdateCategory', [CategoryController::class, 'storageUpdateCategory']);

    //Products
    Route::get('/products', [ProductsController::class, 'index']);
    Route::get('/getModalCreatProduct', [ProductsController::class, 'getModalCreatProduct']);
    Route::post('/storageProdudct', [ProductsController::class, 'storageProdudct']);
    Route::get('/getAllProducts', [ProductsController::class, 'getAllProducts']);
    Route::get('/deleteProduct/{id}', [ProductsController::class, 'deleteProduct']);
    Route::get('/getModalUpdateProduct/{id}', [ProductsController::class, 'getModalUpdateProduct']);
    Route::get('/deleteAdditionalProduct', [ProductsController::class, 'deleteAdditionalProduct']);
    Route::get('/deleteImageProduct', [ProductsController::class, 'deleteImageProduct']);
    Route::get('/deleteVariationProduct', [ProductsController::class, 'deleteVariationProduct']);
    
    Route::get('/import', [ReportController::class, 'import']);
    Route::post('/import/processingReport', [ReportController::class, 'processingReport']);

    //Additionals
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

    // Orders
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

    //Notify
    Route::get('/renderBoxNotifyCompany', [NotifyController::class, 'renderBoxNotifyCompany']);
    Route::get('/getNotifyCompany', [NotifyController::class, 'getNotifyCompany']);

    //Permissions
    Route::get('/permissions', [ProfilesController::class, 'index']);
    Route::get('/showModalCreateNewPorifle', [ProfilesController::class, 'showModalCreateNewPorifle']);
    Route::post('/storageProfile', [ProfilesController::class, 'storageProfile']);
    Route::get('/showModalCreateNewPermission', [PermissionController::class, 'showModalCreateNewPermission']);
    Route::post('/storagePermission', [PermissionController::class, 'storagePermission']);
    Route::get('/geAllProfiles', [ProfilesController::class, 'geAllProfiles']);
    Route::get('/geAllPermissions', [PermissionController::class, 'geAllPermissions']);
    Route::get('/showModalUpdateProfile/{id}', [ProfilesController::class, 'showModalUpdateProfile']);
    Route::post('/updateProfile', [ProfilesController::class, 'updateProfile']);
    Route::get('/delteProfile/{id}', [ProfilesController::class, 'delteProfile']);
    Route::get('/showModalAllUserAssociateWithProfile/{id}', [ProfilesController::class, 'showModalAllUserAssociateWithProfile']);
    Route::get('/storageAssociateProfileWithUser', [ProfilesUserController::class, 'storageAssociateProfileWithUser']);
    Route::get('/removeProfileAssociationWithUser', [ProfilesUserController::class, 'removeProfileAssociationWithUser']);
    Route::get('/showModalUpdatePermission/{id}', [PermissionController::class, 'showModalUpdatePermission']);
    Route::post('/updatePermission', [PermissionController::class, 'updatePermission']);
    Route::get('/deletePermission/{id}', [PermissionController::class, 'deletePermission']);
    Route::get('/showModalPermissionAssociationWithProfile/{id}',[ModulesProfileController::class, 'showModalPermissionAssociationWithProfile']);
    Route::get('/storageAssociationPermissionWithProfile', [ModulesProfileController::class, 'storageAssociationPermissionWithProfile']);
    Route::get('/removeAssociationPermissionWithProfile', [ModulesProfileController::class, 'removeAssociationPermissionWithProfile']);

    //Deliveries
    Route::get('/deliveries', [DeliveryMenController::class , 'index']);
    Route::get('/showModalGeteDelirevyMen/{id}', [DeliveryMenController::class, 'showModalGeteDelirevyMen']);
    Route::get('/sendOrderToDeliveryPerson', [DeliveryMenController::class, 'sendOrderToDeliveryPerson']);
    Route::get('/getOrdersDeliveryMen', [DeliveryMenController::class, 'getOrdersDeliveryMen']);
    Route::get('/getRederIdicatorsDeliveryMen', [DeliveryMenController::class, 'getRederIdicatorsDeliveryMen']);

    //Promotions
    Route::get('/promotions', [PromotionsController::class, 'index']);
    Route::get('/showModalCreateNewPromotion', [PromotionsController::class, 'showModalCreateNewPromotion']);

    //Save Histoy accessing user
    Route::post('/storageNameModuleUserAccessing', [UltilsController::class, 'storageNameModuleUserAccessing']);

    //System Usability Control
    Route::get('/systemUsabilityControl', [SystemUsabilityControlController::class, 'index']);
    Route::get('/systemUsabilityControl/summaryIdicator', [SystemUsabilityControlController::class, 'summaryIdicator']);
    Route::get('/systemUsabilityControl/listUserUsabilityHistory', [SystemUsabilityControlController::class, 'listUserUsabilityHistory']);
    Route::get('/systemUsabilityControl/getData', [SystemUsabilityControlController::class, 'getData']);
});

Route::prefix('app')->group(function(){

    Route::get('/menu/{slug}', [PageHomeController::class, 'index']);
    Route::get('/renderViewGetProduct/{product_id}', [PageHomeController::class, 'renderViewGetProduct']);
    Route::get('/rederViewAllProductsCompany/{slug}', [PageHomeController::class, 'rederViewAllProductsCompany']);
    Route::post('/getProductName', [PageHomeController::class, 'getProductName']);
    Route::post('/getProductCart', [PageHomeController::class, 'getProductCart']);
    Route::get('/getModalCartItem', [PageHomeController::class, 'getModalCartItem']);
    Route::get('/getModalCheckout', [PageHomeController::class, 'getModalCheckout']);
    Route::post('/ckeckout', [PageHomeController::class, 'ckeckout']);
    Route::get('/getModalInserNewAddressUser', [PageHomeController::class, 'getModalInserNewAddressUser']);
    Route::post('/storageNewAddressUser', [PageHomeController::class, 'storageNewAddressUser']);
    Route::post('/sendOrderUser', [PageHomeController::class, 'sendOrderUser']);
    Route::get('/getModalLoginUser', [PageHomeController::class, 'getModalLoginUser']);
    Route::post('/loginUser', [PageHomeController::class, 'loginUser']);
    Route::post('/logoutUser', [PageHomeController::class, 'logoutUser']);
    Route::get('/getModalMyBagUser', [PageHomeController::class, 'getModalMyBagUser']);
    Route::get('/getModalUser', [PageHomeController::class, 'getModalUser']);

    //Cart
    Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
    Route::get('cart/totalPriceCartItem', [CartController::class, 'priceCart']);
    Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
    Route::get('updateItemCart', [CartController::class, 'updateCart'])->name('cart.update');
    Route::get('remove/{id}', [CartController::class, 'removeCart'])->name('cart.remove');
    Route::get('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
});

// //auth
Route::prefix('auth')->group(function(){
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/actionLogin', [AuthController::class, 'actionLogin']);
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/storage', [AuthController::class, 'storage']);
});
