<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ConsignmentController;
use App\Http\Controllers\Admin\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DeliveryChallanController;
use App\Http\Controllers\Admin\DeliveryIntimationController;
use App\Http\Controllers\Admin\FilemanagerController;
use App\Http\Controllers\Admin\MasterController;
use App\Http\Controllers\Admin\PayorderController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VendorController;

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
Route::get('/', [AuthController::class, 'login']);
Route::get('/admin/login', [AuthController::class, 'login'])->name('login');
Route::post('/admin/login_submit', [AuthController::class, 'login_submit']);



Route::middleware(['auth'])->group(function () {
  
 
  Route::get('/admin/logout', [AuthController::class, 'logout']);
  Route::get('/admin/changepassword', [DashboardController::class, 'changepassword']);
  Route::post('/admin/changepassword_submit', [DashboardController::class, 'changepassword_submit']);

  Route::get('/admin/dashboard', [DashboardController::class, 'dashboard']);
  Route::get('/admin/dashboard/products', [DashboardController::class, 'products']);
  Route::post('/admin/status', [DashboardController::class, 'status']);


      //Users
      Route::get('/admin/users/index',[UserController::class, 'index']);
      Route::get('/admin/users/create',[UserController::class, 'create']);
      Route::post('/admin/users/store',[UserController::class, 'store']);
      Route::get('/admin/users/edit/{id}',[UserController::class, 'edit']);
      Route::post('/admin/users/update/{id}',[UserController::class, 'update']);
      Route::get('/admin/users/delete/{id}',[UserController::class, 'delete']);
      Route::get('admin/profile',[UserController::class, 'profile']);
      Route::post('admin/profile-update',[UserController::class, 'profile_update']);

      //Roles
      Route::get('/admin/roles/index', [RoleController::class, 'index']);
      Route::get('/admin/roles/create', [RoleController::class, 'create']);
      Route::post('/admin/roles/store', [RoleController::class, 'store']);
      Route::get('/admin/roles/edit/{id}', [RoleController::class, 'edit']);
      Route::post('/admin/roles/update/{id}', [RoleController::class, 'update']);
      Route::get('/admin/roles/delete/{id}', [RoleController::class, 'delete']);

      //Modules
      Route::resource('/admin/customers',CustomerController::class);
      Route::resource('/admin/vendors',VendorController::class);
     
      //Consignment 
      Route::get('/admin/consignments/view/{id}',[ConsignmentController::class,'view']);
      Route::resource('/admin/consignments',ConsignmentController::class);

      //Delivery Challans
      Route::resource('/admin/delivery-challans',DeliveryChallanController::class);
      
      //Delivry Intimations
      Route::resource('/admin/delivery-intimations',DeliveryIntimationController::class);
      
      //Pyorders
      Route::resource('/admin/payorders',PayorderController::class);

      Route::get('/admin/customerstatement',[ReportController::class,'customerstatement']);
      Route::get('/admin/jobtracking',[ReportController::class,'jobtracking']);
      Route::get('/admin/jobstatus',[ReportController::class,'jobstatus']);
      Route::resource('masters',MasterController::class);
     


    //filemanager
      Route::get('/admin/filemanager/search', [FilemanagerController::class, 'search']);
      Route::get('/admin/filemanager', [FilemanagerController::class, 'index']);
      Route::get('admin/filemanager/create',[FilemanagerController::class,'create']);
      Route::post('admin/filemanager/store',[FilemanagerController::class,'store']);
      Route::get('admin/filemanager/edit/{id}',[FilemanagerController::class,'edit']);
      Route::post('admin/filemanager/update/{id}',[FilemanagerController::class,'update']);
      Route::get('admin/filemanager/delete/{id}',[FilemanagerController::class,'delete']);

   //Settings
    Route::get('admin/settings/edit',[SettingController::class, 'edit']);
    Route::post('admin/settings/update',[SettingController::class, 'update']);



});

// Auth::routes();

Route::fallback(function () {
    return redirect('/'); 
});