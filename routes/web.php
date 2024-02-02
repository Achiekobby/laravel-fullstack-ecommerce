<?php

use App\Http\Controllers\Auth\UserAuthenticationController;
use App\Http\Controllers\Client\HomeController;
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

Route::get('/home', [HomeController::class, 'home'])->name('home.index');

Route::middleware(["guest"])->group(function () {
    Route::get('login', [UserAuthenticationController::class, 'login'])->name("login");
    Route::get('register', [UserAuthenticationController::class, 'register'])->name('guest.register');
    Route::post('signup',[UserAuthenticationController::class,"signup"])->name('user.signup');
    Route::post('sign-in',[UserAuthenticationController::class,"authenticate"])->name('user.login');
});

Route::middleware(['auth.user'])->group(function(){
    Route::post('logout',[UserAuthenticationController::class,'logout'])->name('user.logout');
});
