<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;

Route::any('/admin', [AuthController::class, 'login']);
Route::any('/admin/authenticate', [AuthController::class, 'authenticateUser']);
Route::any('/admin/registration', [AuthController::class, 'register']);
Route::any('/admin/storeuser', [AuthController::class, 'submitSignUpForm']);
Route::any('/admin/logout', [AuthController::class, 'signOut']);

Route::any('/admin/dashboard', [DashboardController::class, 'index']);

/* Route::group(array('prefix' => 'admin'), function(){
    $module_controller = "App\Http\Controllers\Admin\AuthController@";
    Route::any('/',['as'=>'','uses'=>$module_controller.'login']);
    Route::any('/registration',['as'=>'','uses'=>$module_controller.'register']);
    Route::any('/storeuser',['as'=>'','uses'=>$module_controller.'submitSignUpForm']);
    Route::any('/authenticate',['as'=>'','uses'=>$module_controller.'authenticateUser']);
    Route::any('/logout',['as'=>'','uses'=>$module_controller.'signOut']);

    $module_controller = "App\Http\Controllers\Admin\DashboardController@";
    Route::any('/dashboard',['as'=>'','uses'=>$module_controller.'index']);
}); */