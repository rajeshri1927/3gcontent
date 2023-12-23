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
    return view('welcome');
});

include_once('admin/admin.php');

/* Route::get('admin/login', function () {
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

Route::get('admin/medium', function () {
	return view('admin.medium');
});

Route::get('admin/class', function () {
	return view('admin.class');
});

Route::get('admin/subject', function () {
	return view('admin.subject');
}); */

