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
Route::get('/auth/google',[\App\Http\Controllers\Auth\GoogleAuthController::class,'redirect'])->name('auth.google');
Route::get('/auth/google/callback',[\App\Http\Controllers\Auth\GoogleAuthController::class,'callback']);

Route::post('/auth/token',[\App\Http\Controllers\Auth\AuthTokenController::class,'sendToken']);
Route::get('/auth/token',[\App\Http\Controllers\Auth\AuthTokenController::class,'getToken'])->name('auth-factors.token');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function(){
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/auth-factors', [App\Http\Controllers\ProfileController::class, 'authFactors'])->name('profile.auth-factors');
    Route::post('/profile/auth-factors', [App\Http\Controllers\ProfileController::class, 'updateAuthFactors']);

    Route::get('/profile/auth-factors/phone', [App\Http\Controllers\ProfileController::class, 'getPhoneVerify'])->name('profile.auth-factors.phone');
    Route::post('/profile/auth-factors/phone', [App\Http\Controllers\ProfileController::class, 'sendPhoneVerify']);
});

