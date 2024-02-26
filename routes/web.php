<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AdminAuthenticationController;

//* ADMIN CONTROLLERS
use App\Http\Controllers\Auth\UserAuthenticationController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ShopController;
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
Route::get('/',function(){
    return redirect()->route('home.index');
});

Route::middleware(["guest"])->group(function () {
    Route::get('login', [UserAuthenticationController::class, 'login'])->name("login");
    Route::get('register', [UserAuthenticationController::class, 'register'])->name('guest.register');
    Route::post('signup', [UserAuthenticationController::class, "signup"])->name('user.signup');
    Route::post('sign-in', [UserAuthenticationController::class, "authenticate"])->name('user.login');

    //?=>SHOP ROUTES
    Route::get('/home/shop',[ShopController::class,'index'])->name('home.shop.index');
    Route::get('/shop/product/{slug}',[ShopController::class,'show'])->name('shop.product.show');
});

Route::middleware(['auth.user'])->group(function () {
    Route::post('logout', [UserAuthenticationController::class, 'logout'])->name('user.logout');

    //? Email Verification
    Route::post('email/verify/{uuid}', [UserAuthenticationController::class, 'verify_email'])->name('email.verify');
    Route::get('email/verification', [UserAuthenticationController::class, 'email_verification'])->name('email.verification');
    Route::get('email/verification/resend', [UserAuthenticationController::class, 'resend_verification_code'])->name('email.verification_resend');

    Route::middleware(["user.verified"])->group(function () {

        // add_to_cart
        Route::post('add_to_cart',[CartController::class,'add_to_cart'])->name('user.add_to_cart');
        Route::get('get-cart-items',[CartController::class,'get_cart_items'])->name('user.get_cart_items');
        Route::get('remove-cart-item/{item_id}',[CartController::class,'removeFromCart'])->name('user.remove_cart_item');

    });
});

//? => ADMIN ROUTES
Route::group(['prefix' => 'admin'], function () {

    Route::middleware(['auth.admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

        Route::group(['prefix' => 'users', 'middleware' => ['auth.super_admin']], function () {
            Route::get('/', [UserController::class, 'users'])->name('admin.users');
            Route::get('/new', [UserController::class, 'new_user'])->name('admin.user.add');
            Route::post('/store', [UserController::class, 'store_user'])->name('admin.user.store');
            Route::get('/edit/{uuid}', [UserController::class, 'edit_user'])->name('admin.user.edit');
            Route::post('/update/{uuid}', [UserController::class, 'update_user'])->name('admin.user.update');
            Route::get('/remove/{uuid}', [UserController::class, 'remove_user'])->name('admin.user.remove');
        });

        //* category routes
        Route::group(['prefix'=>'categories'], function(){
            Route::get('/',[CategoryController::class,'categories'])->name('admin.categories');
            Route::get('/add',[CategoryController::class,'add_category'])->name('admin.category.add');
            Route::post('/store',[CategoryController::class,'store_category'])->name('admin.category.store');
            Route::get('/edit/{slug}',[CategoryController::class,'edit_category'])->name('admin.category.edit');
            Route::post('/update/{slug}',[CategoryController::class,'update_category'])->name('admin.category.update');
            Route::get('/remove/{slug}',[CategoryController::class,'remove_category'])->name('admin.category.remove');
        });

        Route::group(['prefix'=>'subcategories'], function(){
            Route::get('/',[SubcategoryController::class,'index'])->name('admin.subcategories');
            Route::get('/add',[SubcategoryController::class,'create'])->name('admin.subcategory.add');
            Route::post('/store',[SubcategoryController::class,'store'])->name('admin.subcategory.store');
            Route::get('/edit/{id}',[SubcategoryController::class,'edit'])->name('admin.subcategory.edit');
            Route::post('/update/{id}',[SubcategoryController::class,'update'])->name('admin.subcategory.update');
            Route::get('/remove/{id}',[SubcategoryController::class,'destroy'])->name('admin.subcategory.remove');
        });

        Route::group(['prefix'=>'products'], function(){
            Route::get('/',[ProductController::class,'index'])->name('admin.products');
            Route::get('/add',[ProductController::class,'create'])->name('admin.product.add');
            Route::post('/store',[ProductController::class,'store'])->name('admin.product.store');
            Route::get('/edit/{uuid}',[ProductController::class,'edit'])->name('admin.product.edit');
            Route::post('/update/{uuid}',[ProductController::class,'update'])->name('admin.product.update');
            Route::get('/remove/{slug}',[ProductController::class,'destroy'])->name('admin.product.remove');
            Route::get('/show/{slug}',[ProductController::class,'show'])->name('admin.product.show');
            Route::get('/promote/{uuid}/{promo_value}',[ProductController::class,'promote_product'])->name('admin.product.promote');
        });
        Route::group(['prefix'=>'brands'], function(){
            Route::get('/',[BrandController::class,'index'])->name('admin.brands');
            Route::get('/add',[BrandController::class,'create'])->name('admin.brand.add');
            Route::post('/store',[BrandController::class,'store'])->name('admin.brand.store');
            Route::get('/edit/{id}',[BrandController::class,'edit'])->name('admin.brand.edit');
            Route::post('/update/{id}',[BrandController::class,'update'])->name('admin.brand.update');
            Route::get('/remove/{id}',[BrandController::class,'destroy'])->name('admin.brand.remove');
        });
    });

    Route::get('/login', [AdminAuthenticationController::class, 'login'])->name('admin.login');
    Route::post('/logout', [AdminAuthenticationController::class, 'logout'])->name('admin.logout');
    Route::post('/authenticate', [AdminAuthenticationController::class, 'authenticate'])->name('admin.authenticate');
});

//* General apis
Route::get('/get-subcategories/{category}', [ProductController::class,'getSubcategories'])->name('get.subcategories');
Route::get('/get-category/{category_id}', [ProductController::class,'getCategory'])->name('get.category');
Route::get('/get-details/{id}',[ProductController::class,'getSizeAndColorsOfProduct'])->name('get.product.details');
