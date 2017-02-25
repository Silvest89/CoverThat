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

Route::group(['middleware' => ['login.auth'], 'prefix' => 'dashboard', 'namespace' => 'Dashboard'], function () {

    Route::get('/login', 'LoginController@index')->name('dashboard.login');
    Route::post('/login', 'LoginController@login')->name('dashboard.login');
    Route::post('/login/google', 'LoginController@googleSingleSignOn')->name('google.form.login');
    Route::post('/login/facebook', 'LoginController@facebookSingleSignOn')->name('facebook.form.login');

});

Route::get('/oauth/google/sso', 'Auth\OAuthController@googleSingleSignOn');
Route::get('/oauth/facebook/sso', 'Auth\OAuthController@facebookSingleSignOn');

Route::post('/register', 'Auth\RegistrationController@register');

Route::group(['prefix' => 'dashboard', 'namespace' => 'Dashboard', 'middleware' => 'user.auth'], function() {

    Route::get('/logout', 'PagesController@logout');
    Route::get('/home', 'PagesController@index')->name('dashboard.home');

});
