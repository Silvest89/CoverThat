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

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['login.auth'], 'prefix' => 'dashboard', 'namespace' => 'Auth'], function () {
    Route::get('/login', 'LoginController@index');
    Route::post('/login', 'LoginController@login')->name('dashboard.login');
});

Route::post('/register', 'Auth\RegistrationController@register');

Route::group(['prefix' => 'dashboard', 'namespace' => 'Dashboard', 'middleware' => 'user.auth'], function() {

    Route::get('/logout', 'DashboardController@logout');
    Route::get('/home', 'DashboardController@index')->name('dashboard_home');

});

