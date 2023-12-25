<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BoardController;
use App\Http\Controllers\Admin\MediumController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\SubjectController;


Route::any('/admin', [AuthController::class, 'login']);
Route::any('/admin/authenticate', [AuthController::class, 'authenticateUser']);
Route::any('/admin/registration', [AuthController::class, 'register']);
Route::any('/admin/storeuser', [AuthController::class, 'submitSignUpForm']);
Route::any('/admin/logout', [AuthController::class, 'signOut']);

Route::any('/admin/dashboard', [DashboardController::class, 'index']);

//Board Controller route//
Route::any('/admin/board', [BoardController::class, 'index']);
Route::post('/admin/addBoard', [BoardController::class,'addBoard']);
Route::get('/admin/getBoarddata',[BoardController::class,'getBoarddata']);
Route::get('/admin/fetchBoardData',[BoardController::class,'fetchBoardData']);
Route::delete('/admin/deleteBoarddata',[BoardController::class,'deleteBoarddata']);

//Medium Controller Route//
// Route::group(['namespace' => 'App\Http\Controllers\Admin'], function () {
// 	Route::get('/admin/medium',['as' => 'medium', 'uses' => 'MediumController@index']);
// 	Route::post('addMedium', ['as' => 'addMedium', 'uses' => 'MediumController@addMedium']);
// 	Route::get('getMediumAllData', ['as' => 'getMediumAllData', 'uses' => 'MediumController@getMediumAllData']);
// 	Route::delete('deleteMediumData',['as' => 'deleteMediumData', 'uses' => 'MediumController@deleteMediumData']);
// 	Route::get('updateGetMediumData',['as' => 'updateGetMediumData', 'uses' => 'MediumController@updateGetMediumData']);
// });

Route::any('/admin/medium', [MediumController::class, 'index']);
Route::post('/admin/addMedium', [MediumController::class,'addMedium']);
Route::get('/admin/getMediumAllData',[MediumController::class,'getMediumAllData']);
Route::get('/admin/updateGetMediumData',[MediumController::class,'updateGetMediumData']);
Route::delete('/admin/deleteMediumData',[MediumController::class,'deleteMediumData']);

//Class Controller Route//

// Route::group(['namespace' => 'App\Http\Controllers\Admin'], function () {
// 	Route::get('/admin/class',['as' => 'class', 'uses' => 'ClassController@index']);
// 	Route::get('/admin/getMediums',['as' => 'getMediums', 'uses' => 'ClassController@getMedium']);
// 	Route::post('/admin/addClass',['as' => 'addClass', 'uses' => 'ClassController@addClass']);
// 	Route::get('getClassAllData', ['as' => 'getClassAllData', 'uses' => 'ClassController@getClassAllData']);
// 	Route::get('updateGetClassData', ['as' => 'updateGetClassData', 'uses' => 'ClassController@updateGetClassData']);
// 	Route::delete('deleteClassData',['as' => 'deleteClassData', 'uses' => 'ClassController@deleteClassData']);
// 	// Route::get('updateGetMediumData',['as' => 'updateGetMediumData', 'uses' => 'MediumController@updateGetMediumData']);
// });
Route::any('/admin/class', [ClassController::class, 'index']);
Route::get('/admin/getMediums', [ClassController::class,'getMedium']);
Route::post('/admin/addClass', [ClassController::class,'addClass']);
Route::get('/admin/getClassAllData',[ClassController::class,'getClassAllData']);
Route::get('/admin/updateGetClassData',[ClassController::class,'updateGetClassData']);
Route::delete('/admin/deleteClassData',[ClassController::class,'deleteClassData']);

//Subject Route Here//
Route::any('/admin/subject', [SubjectController::class, 'index']);
Route::any('/admin/getClass',[SubjectController::class,'getClass']);
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


// Route::group(['namespace' => 'App\Http\Controllers\Admin'], function () {
// 	Route::any('/admin/board',['as' => 'board', 'uses' => 'BoardController@index']);
//     Route::post('addBoard', ['as' => 'addBoard', 'uses' => 'BoardController@addBoard']);
// 	Route::get('getBoarddata',['as' => 'getBoarddata', 'uses' => 'BoardController@getBoarddata']);
// 	Route::get('fetchBoardData',['as' => 'fetchBoardData', 'uses' => 'BoardController@fetchBoardData']);
// });


// Route::group(['namespace' => 'App\Http\Controllers\Admin'], function () {
// 	Route::get('/admin/medium',['as' => 'medium', 'uses' => 'MediumController@index']);
// 	Route::post('addMedium', ['as' => 'addMedium', 'uses' => 'MediumController@addMedium']);
// 	Route::get('getMediumAllData', ['as' => 'getMediumAllData', 'uses' => 'MediumController@getMediumAllData']);
// 	Route::delete('deleteMediumData',['as' => 'deleteMediumData', 'uses' => 'MediumController@deleteMediumData']);
// 	Route::get('updateGetMediumData',['as' => 'updateGetMediumData', 'uses' => 'MediumController@updateGetMediumData']);
// });


// Route::group(['namespace' => 'App\Http\Controllers\Admin'], function () {
// 	Route::get('/admin/class',['as' => 'class', 'uses' => 'ClassController@index']);
// 	Route::get('/admin/getMediums',['as' => 'getMediums', 'uses' => 'ClassController@getMedium']);
// 	Route::post('/admin/addClass',['as' => 'addClass', 'uses' => 'ClassController@addClass']);
// 	Route::get('getClassAllData', ['as' => 'getClassAllData', 'uses' => 'ClassController@getClassAllData']);
// 	Route::get('updateGetClassData', ['as' => 'updateGetClassData', 'uses' => 'ClassController@updateGetClassData']);
// 	Route::delete('deleteClassData',['as' => 'deleteClassData', 'uses' => 'ClassController@deleteClassData']);
// 	// Route::get('updateGetMediumData',['as' => 'updateGetMediumData', 'uses' => 'MediumController@updateGetMediumData']);
// });
