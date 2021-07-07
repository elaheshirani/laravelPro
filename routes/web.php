<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['verify' => true]);

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::get('/google','GoogleAuthController@redirect')->name('auth.google');
    Route::get('/google/callback','GoogleAuthController@callback');

    Route::post('/token','AuthTokenController@sendToken');
    Route::get('/token','AuthTokenController@getToken')->name('auth-factors.token');
});


Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function(){

    Route::get('/', 'ProfileController@index')->name('profile');
    Route::group(['prefix' => 'auth-factors'], function(){
        Route::get('/', 'ProfileController@authFactors')->name('profile.auth-factors');
        Route::post('/', 'ProfileController@updateAuthFactors');

        Route::get('/phone', 'ProfileController@getPhoneVerify')->name('profile.auth-factors.phone');
        Route::post('/phone', 'ProfileController@sendPhoneVerify');
    });
});

