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



Route::middleware(['auth'])->group(function () {
  
 
  Route::get('/admin/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout']);

  Route::get('/admin/changepassword', [App\Http\Controllers\Admin\DashboardController::class, 'changepassword']);
  
  Route::post('/admin/changepassword_submit', [App\Http\Controllers\Admin\DashboardController::class, 'changepassword_submit']);



     Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'dashboard']);

     Route::post('/admin/status', [App\Http\Controllers\Admin\DashboardController::class, 'status']);
  
      
      
      
    

      //Users
      Route::get('/admin/users/index', [App\Http\Controllers\Admin\UserController::class, 'index']);
      Route::get('/admin/users/create', [App\Http\Controllers\Admin\UserController::class, 'create']);
      Route::post('/admin/users/store', [App\Http\Controllers\Admin\UserController::class, 'store']);
      Route::get('/admin/users/edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit']);
      Route::post('/admin/users/update/{id}', [App\Http\Controllers\Admin\UserController::class, 'update']);
      Route::get('/admin/users/delete/{id}', [App\Http\Controllers\Admin\UserController::class, 'delete']);
      Route::get('admin/profile', [App\Http\Controllers\Admin\UserController::class, 'profile']);
      Route::post('admin/profile-update', [App\Http\Controllers\Admin\UserController::class, 'profile_update']);
  

      //Roles
      Route::get('/admin/roles/index', [App\Http\Controllers\Admin\RoleController::class, 'index']);
      Route::get('/admin/roles/create', [App\Http\Controllers\Admin\RoleController::class, 'create']);
      Route::post('/admin/roles/store', [App\Http\Controllers\Admin\RoleController::class, 'store']);
      Route::get('/admin/roles/edit/{id}', [App\Http\Controllers\Admin\RoleController::class, 'edit']);
      Route::post('/admin/roles/update/{id}', [App\Http\Controllers\Admin\RoleController::class, 'update']);
      Route::get('/admin/roles/delete/{id}', [App\Http\Controllers\Admin\RoleController::class, 'delete']);
      
      //customers
      Route::resource('/admin/customers', App\Http\Controllers\Admin\CustomerController::class);
      Route::resource('/admin/vendors', App\Http\Controllers\Admin\VendorController::class);

      
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