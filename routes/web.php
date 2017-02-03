<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['login.auth']], function () {
    Route::get('/login', 'Auth\LoginController@login');
});

Route::get('/login/userdashboard', 'LoginController@userDashboard')->name('user_dashboard')->middleware('user.auth');
Route::get('/login/admindashboard', 'LoginController@adminDashboard')->name('admin_dashboard')->middleware('admin.auth');

