<?php

use App\Http\Controllers\Auth\UserAuthenticationController;
use App\Http\Controllers\Client\HomeController;
use Illuminate\Support\Facades\Route;

//* ADMIN CONTROLLERS
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AdminAuthenticationController;
use App\Http\Controllers\Admin\UserController;

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

    //? Email Verification
    Route::post('email/verify/{uuid}',[UserAuthenticationController::class,'verify_email'])->name('email.verify');
    Route::get('email/verification',[UserAuthenticationController::class,'email_verification'])->name('email.verification');
    Route::get('email/verification/resend',[UserAuthenticationController::class,'resend_verification_code'])->name('email.verification_resend');

    Route::middleware(["user.verified"])->group(function(){
        // checkout
    });
});

//? => ADMIN ROUTES
Route::group(['prefix'=>'admin'], function(){

    Route::middleware(['auth.admin'])->group(function(){
        Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('admin.dashboard');

        Route::group(['prefix'=>'users', 'middleware'=>['auth.super_admin']], function(){
            Route::get('/',[UserController::class,'users'])->name('admin.users');
            Route::get('/new',[UserController::class,'new_user'])->name('admin.user.add');
            Route::post('/store',[UserController::class,'store_user'])->name('admin.user.store');
            Route::get('/edit/{uuid}', [UserController::class,'edit_user'])->name('admin.user.edit');
            Route::post('/update/{uuid}', [UserController::class,'update_user'])->name('admin.user.update');
            Route::get('/remove/{uuid}',[UserController::class,'remove_user'])->name('admin.user.remove');
        });
    });

    Route::get('/login',[AdminAuthenticationController::class,'login'])->name('admin.login');
    Route::post('/logout',[AdminAuthenticationController::class,'logout'])->name('admin.logout');
    Route::post('/authenticate',[AdminAuthenticationController::class,'authenticate'])->name('admin.authenticate');
});

