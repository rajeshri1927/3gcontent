<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('admin');
});

include_once('admin/admin.php');

/* Route::get('admin/login', function () {
Route::get('admin', function () {
    return view('admin.login');
});

Route::get('admin/registration', function () {
    return view('admin.registration');
});

Route::get('admin/dashboard', function () {
	return view('admin.dashboard');
});

Route::get('admin/board', function () {
	return view('admin.board');
});

// Route::get('admin/medium', function () {
// 	return view('admin.medium');
// });

// Route::get('admin/class', function () {
// 	return view('admin.class');
// });

Route::get('admin/subject', function () {
	return view('admin.subject');
}); */
// Route::get('admin/board', function () {
// 	return view('admin.board');
// });

// Route::group(['namespace' => 'App\Http\Controllers'], function () {
// 	Route::get('admin/board',['as' => 'board', 'uses' => 'BoardController@index']);
//     Route::post('addBoard', ['as' => 'addBoard', 'uses' => 'BoardController@addBoard']);
// 	Route::get('getBoarddata',['as' => 'getBoarddata', 'uses' => 'BoardController@getBoarddata']);
// 	Route::delete('deleteBoarddata',['as' => 'deleteBoarddata', 'uses' => 'BoardController@deleteBoarddata']);
// 	Route::get('fetchBoardData',['as' => 'fetchBoardData', 'uses' => 'BoardController@fetchBoardData']);
// });


// Route::group(['namespace' => 'App\Http\Controllers'], function () {
// 	Route::get('admin/medium',['as' => 'medium', 'uses' => 'MediumController@index']);
// 	Route::post('addMedium', ['as' => 'addMedium', 'uses' => 'MediumController@addMedium']);
// 	Route::get('getMediumAllData', ['as' => 'getMediumAllData', 'uses' => 'MediumController@getMediumAllData']);
// 	Route::delete('deleteMediumData',['as' => 'deleteMediumData', 'uses' => 'MediumController@deleteMediumData']);
// 	Route::get('updateGetMediumData',['as' => 'updateGetMediumData', 'uses' => 'MediumController@updateGetMediumData']);
// });


// Route::group(['namespace' => 'App\Http\Controllers'], function () {
// 	Route::get('admin/class',['as' => 'class', 'uses' => 'ClassController@index']);
// 	Route::get('admin/getMediums',['as' => 'getMediums', 'uses' => 'ClassController@getMedium']);
// 	Route::post('admin/addClass',['as' => 'addClass', 'uses' => 'ClassController@addClass']);
// 	Route::get('getClassAllData', ['as' => 'getClassAllData', 'uses' => 'ClassController@getClassAllData']);
// 	Route::get('updateGetClassData', ['as' => 'updateGetClassData', 'uses' => 'ClassController@updateGetClassData']);
// 	Route::delete('deleteClassData',['as' => 'deleteClassData', 'uses' => 'ClassController@deleteClassData']);
// 	// Route::get('updateGetMediumData',['as' => 'updateGetMediumData', 'uses' => 'MediumController@updateGetMediumData']);
// });



