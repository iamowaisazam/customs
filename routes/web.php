<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
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

Route::get('/',function(){
    
    return redirect('/admin/login'); 
});



//Admin
Route::get('/', [App\Http\Controllers\Admin\AuthController::class, 'login']);
Route::get('/admin/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login');
Route::post('/admin/login_submit', [App\Http\Controllers\Admin\AuthController::class, 'login_submit']);


Route::middleware(['web', 'auth'])->group(function () {
  
  Route::get('/admin/update_file_url', [App\Http\Controllers\Admin\DashboardController::class, 'update_file_url']);
  
  Route::get('/admin/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout']);
  Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'dashboard']);
  Route::get('/admin/changepassword', [App\Http\Controllers\Admin\DashboardController::class, 'changepassword']);
  
  Route::post('/admin/changepassword_submit', [App\Http\Controllers\Admin\DashboardController::class, 'changepassword_submit']);

  Route::post('/admin/status', [App\Http\Controllers\Admin\DashboardController::class, 'status']);
  
  
  //Users
    Route::get('/admin/users/index', [App\Http\Controllers\Admin\UserController::class, 'index']);
    Route::get('/admin/users/create', [App\Http\Controllers\Admin\UserController::class, 'create']);
    Route::post('/admin/users/store', [App\Http\Controllers\Admin\UserController::class, 'store']);
    Route::get('/admin/users/edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit']);
    Route::post('/admin/users/update/{id}', [App\Http\Controllers\Admin\UserController::class, 'update']);
    Route::get('/admin/users/delete/{id}', [App\Http\Controllers\Admin\UserController::class, 'delete']);


    // profile edit
    Route::get('admin/editprofile', [App\Http\Controllers\Admin\profileController::class, 'index'])->name('profile');

    Route::post('admin/update', [App\Http\Controllers\Admin\profileController::class, 'update'])->name('update');
    
    
    //Roles
    Route::get('/admin/roles/index', [App\Http\Controllers\Admin\RoleController::class, 'index']);
    Route::get('/admin/roles/create', [App\Http\Controllers\Admin\RoleController::class, 'create']);
    Route::post('/admin/roles/store', [App\Http\Controllers\Admin\RoleController::class, 'store']);
    Route::get('/admin/roles/edit/{id}', [App\Http\Controllers\Admin\RoleController::class, 'edit']);
    Route::post('/admin/roles/update/{id}', [App\Http\Controllers\Admin\RoleController::class, 'update']);
    Route::get('/admin/roles/delete/{id}', [App\Http\Controllers\Admin\RoleController::class, 'delete']);
    

   
           
    //newsletters
    Route::get('/admin/newsletter/index', [App\Http\Controllers\Admin\NewsletterController::class, 'index'])->name('admin.newsletter.index');
    Route::get('admin/newsletter/delete/{id}', [App\Http\Controllers\Admin\NewsletterController::class, 'delete'])->name('admin.newsletter.delete');
    

    //products
  Route::get('/admin/products/index', [App\Http\Controllers\Admin\ProductController::class, 'index']);
  Route::get('/admin/products/create', [App\Http\Controllers\Admin\ProductController::class, 'create']);
  Route::post('/admin/products/store', [App\Http\Controllers\Admin\ProductController::class, 'store']);
  Route::get('/admin/products/edit/{id}', [App\Http\Controllers\Admin\ProductController::class, 'edit']);
  Route::post('/admin/products/update/{id}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('update-Products');
  Route::get('/admin/products/remove-image/{id}', [App\Http\Controllers\Admin\ProductController::class, 'remove_image']);
  Route::get('/admin/products/delete/{id}', [App\Http\Controllers\Admin\ProductController::class, 'delete']);
  Route::post('/admin/products/variations/{id}', [App\Http\Controllers\Admin\ProductController::class, 'variations']);
  Route::get('/admin/products/getvariations/{id}', [App\Http\Controllers\Admin\ProductController::class, 'getvariations'])->name('products.getvariations');
  Route::DELETE('/admin/products/removevariation/{id}', [App\Http\Controllers\Admin\ProductController::class, 'remove_variation'])->name('products.removevariation');
  Route::post('/admin/products/variationsupdate/{id}', [App\Http\Controllers\Admin\ProductController::class, 'variationsUpdate'])->name('products.variationsupdate');

  
  //orders
  Route::get('/admin/orders/index', [App\Http\Controllers\Admin\OrderController::class, 'index']);
  Route::get('/admin/orders/edit/{id}', [App\Http\Controllers\Admin\OrderController::class, 'edit']);
  Route::post('/admin/orders/update/{id}', [App\Http\Controllers\Admin\OrderController::class, 'update']);
  
  // client Report
  Route::get('/admin/reports/clients/index', [App\Http\Controllers\Admin\ReportsController::class, 'clientIndex']);
  // Route::get('/admin/reports/clients/edit/{id}', [App\Http\Controllers\Admin\ReportsController::class, 'clientEdit']);
  
  // Product Report
  Route::get('/admin/reports/product/index', [App\Http\Controllers\Admin\ReportsController::class, 'productIndex']);
  
  // inventory Report
  Route::get('/admin/reports/inventory/index', [App\Http\Controllers\Admin\ReportsController::class, 'inventoryIndex']);
  
  // payment
  Route::get('/admin/payment/index', [App\Http\Controllers\Admin\PaymentController::class, 'index']);
  Route::get('/admin/payment/create', [App\Http\Controllers\Admin\PaymentController::class, 'create']);
  Route::get('/admin/payment/edit/{id}', [App\Http\Controllers\Admin\PaymentController::class, 'edit']);
  Route::get('/admin/payment/delete/{id}', [App\Http\Controllers\Admin\PaymentController::class, 'delete']);
  Route::post('/admin/payment/store', [App\Http\Controllers\Admin\PaymentController::class, 'store']);
  Route::post('/admin/payment/update/{id}', [App\Http\Controllers\Admin\PaymentController::class, 'update']);
  
  //Sliders
  Route::get('/admin/sliders/index', [App\Http\Controllers\Admin\SliderController::class, 'index']);
  Route::get('/admin/sliders/create', [App\Http\Controllers\Admin\SliderController::class, 'create']);
  Route::post('/admin/sliders/store', [App\Http\Controllers\Admin\SliderController::class, 'store']);
  Route::get('/admin/sliders/edit/{id}', [App\Http\Controllers\Admin\SliderController::class, 'edit']);
  Route::post('/admin/sliders/update/{id}', [App\Http\Controllers\Admin\SliderController::class, 'update']);
  Route::get('/admin/sliders/delete/{id}', [App\Http\Controllers\Admin\SliderController::class, 'delete']);
  
  
  //Collections
  Route::get('/admin/collections/index', [App\Http\Controllers\Admin\CollectionController::class, 'index']);
  Route::get('/admin/collections/create', [App\Http\Controllers\Admin\CollectionController::class, 'create']);
  Route::post('/admin/collections/store', [App\Http\Controllers\Admin\CollectionController::class, 'store']);
  Route::get('/admin/collections/edit/{id}', [App\Http\Controllers\Admin\CollectionController::class, 'edit']);
  Route::post('/admin/collections/update/{id}', [App\Http\Controllers\Admin\CollectionController::class, 'update']);
  Route::get('/admin/collections/delete/{id}', [App\Http\Controllers\Admin\CollectionController::class, 'delete']);
    
 
    

    //products category
    Route::get('/admin/categories/index', [App\Http\Controllers\Admin\CategoryController::class, 'index']);
    Route::get('/admin/categories/create', [App\Http\Controllers\Admin\CategoryController::class, 'create']);
    Route::post('/admin/categories/store', [App\Http\Controllers\Admin\CategoryController::class, 'store']);
    Route::get('/admin/categories/sort', [App\Http\Controllers\Admin\CategoryController::class, 'sort']);
    Route::get('/admin/categories/edit/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit']);
    Route::post('/admin/categories/update/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'update']);
    Route::get('/admin/categories/delete/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'delete']);

  //filemanager
    Route::get('/admin/filemanager/search', [App\Http\Controllers\Admin\FilemanagerController::class, 'search']);
    Route::get('/admin/filemanager', [App\Http\Controllers\Admin\FilemanagerController::class, 'index']);
    Route::get('admin/filemanager/create',[App\Http\Controllers\Admin\FilemanagerController::class,'create']);
    Route::post('admin/filemanager/store',[App\Http\Controllers\Admin\FilemanagerController::class,'store']);
    Route::get('admin/filemanager/edit/{id}',[App\Http\Controllers\Admin\FilemanagerController::class,'edit']);
    Route::post('admin/filemanager/update/{id}',[App\Http\Controllers\Admin\FilemanagerController::class,'update']);
    Route::get('admin/filemanager/delete/{id}',[App\Http\Controllers\Admin\FilemanagerController::class,'delete']);

  //Settings
    Route::get('admin/settings/edit', [App\Http\Controllers\Admin\SettingController::class, 'edit']);
    Route::post('admin/settings/update', [App\Http\Controllers\Admin\SettingController::class, 'update']);



});

// Auth::routes();

Route::fallback(function () {
    return redirect('/'); 
});