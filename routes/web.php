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
     
      Route::post('/admin/status', [DashboardController::class, 'status']);

      //select
      Route::get('/admin/dashboard/jobnumber', [DashboardController::class, 'jobnumber']);
      Route::get('/admin/dashboard/customer', [DashboardController::class, 'customer']);
      Route::get('/admin/dashboard/lc', [DashboardController::class, 'lc']);
      Route::get('/admin/dashboard/create_deliverychallan', [DashboardController::class, 'create_deliverychallan']);
      Route::get('/admin/dashboard/create_deliveryintimation', [DashboardController::class, 'create_deliveryintimation']);

      
      

      
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
    //   Route::resource('/admin/vendors',VendorController::class);
     
      //Consignment 
      Route::get('/admin/consignments/print/{id}',[ConsignmentController::class,'print']);
      Route::resource('/admin/consignments',ConsignmentController::class);

      //Pyorders
      Route::get('/admin/payorders/print/{id}',[PayorderController::class,'print']);
      Route::resource('/admin/payorders',PayorderController::class);

      //Delivery Challans
      Route::resource('/admin/delivery-challans',DeliveryChallanController::class);
      
      //Delivry Intimations
      Route::resource('/admin/delivery-intimations',DeliveryIntimationController::class);
      
      

      Route::get('/admin/customerstatement',[ReportController::class,'customerstatement']);
      Route::get('/admin/jobtracking',[ReportController::class,'jobtracking']);
      Route::get('/admin/jobstatus',[ReportController::class,'jobstatus']);
    
      
    // Master
    Route::match(['get', 'post'],'admin/masters/locations',[MasterController::class, 'locations']);
    Route::match(['get', 'post'],'admin/masters/pod',[MasterController::class, 'pod']);
    Route::match(['get', 'post'],'admin/masters/pol',[MasterController::class, 'pol']);
    Route::match(['get', 'post'],'admin/masters/vessels',[MasterController::class, 'vessels']);
    Route::match(['get', 'post'],'admin/masters/documents',[MasterController::class, 'documents']);

   //Settings
    Route::get('admin/settings/edit',[SettingController::class, 'edit']);
    Route::post('admin/settings/update',[SettingController::class, 'update']);

});

// Auth::routes();

Route::fallback(function () {
    return redirect('/'); 
});