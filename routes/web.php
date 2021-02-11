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
})->middleware('verified');

Auth::routes(['verify' => true]);
Route::get('/auth/google',[\App\Http\Controllers\Auth\GoogleAuthController::class,'redirect'])->name('auth.google');
Route::get('/auth/google/callback',[\App\Http\Controllers\Auth\GoogleAuthController::class,'callback']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->prefix('/profile')->group(function (){
    Route::get('/', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::get('/twoFactor', [\App\Http\Controllers\ProfileController::class, 'twoFactorAuth'])->name('twoFactor');
    Route::post('/twoFactor', [\App\Http\Controllers\ProfileController::class, 'postTwoFactorAuth']);
});

