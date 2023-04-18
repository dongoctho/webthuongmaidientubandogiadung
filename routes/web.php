<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ManufactureController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

use Laravel\Socialite\Facades\Socialite;

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


// login, register, logout
Route::get('/login', [AuthController::class, 'index'])->name('login_page');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout',[AuthController::class, 'logout'])->name('logout');
Route::get('/register',[AuthController::class, 'register_page'])->name('register_page');
Route::post('/register',[AuthController::class, 'register'])->name('register');
Route::get('/change-pass',[AuthController::class, 'change_pass_page'])->name('change_pass_page');
Route::post('/change-pass',[AuthController::class, 'change_pass'])->name('change_pass');
Route::get('/google',[AuthController::class, 'redirecToGoogle'])->name('login_google');
Route::get('/google/callback',[AuthController::class, 'handleGoogleCallback'])->name('handle');


//client
Route::get('',[IndexController::class, 'indexClient'])->name('client_index');
Route::get('/checkout',[OrderController::class, 'index'])->name('checkout_index');
Route::post('/checkout/payment',[OrderController::class, 'addOrder'])->name('payment');
Route::get('/checkout/infor',[OrderController::class, 'inforOrder'])->name('infor_order');
Route::get('/checkout/infor/detail/{id_user}/order/{id}',[OrderController::class, 'inforOrderDetail'])->name('infor_order_detail');
Route::get('/contact',[IndexController::class, 'indexContact'])->name('client_contact');
Route::get('/productDetail/{id}',[ProductController::class, 'productDetail'])->name('product_detail');
Route::post('/productDetail/{id}',[CartController::class, 'addCart'])->name('cart_detail');
Route::get('/cartDetail',[CartController::class, 'showCart'])->name('show_cart');
Route::get('/cartDetail/change-price',[CartController::class, 'changePrice'])->name('channge_price');
Route::get('/cartDetail/deleted/{id}',[CartController::class, 'deleted'])->name('deleted_cart_detail');
Route::get('/product',[ProductController::class, 'indexProduct'])->name('show_product_index');
Route::get('/information',[IndexController::class, 'information'])->name('infor_index');
Route::get('/information/edit',[IndexController::class, 'editInformation'])->name('infor_index_edit');
Route::post('/information/edit',[IndexController::class, 'editInfor']);

//admin
Route::prefix('admin')->group(function(){
    Route::get('/dashboard',[DashboardController::class, 'dashboard'])->middleware('CheckLogin')->name('dashboard');

    //Cart
    Route::prefix('cart')->group(function(){
        Route::get('/list', [CartController::class, 'list'])->middleware('CheckLogin')->name('list_cart');
        Route::get('/list_detail/{id_user}', [CartController::class, 'listCartDetail'])->middleware('CheckLogin')->name('list_cart_detail');
    });

    //Order
    Route::prefix('order')->group(function(){
        Route::get('/list', [OrderController::class, 'list'])->middleware('CheckLogin')->name('list_order');
        Route::get('/list/{id}', [OrderController::class, 'show'])->middleware('CheckLogin')->name('show_order');
        Route::get('/list_detail/{id_user}/order/{id}', [OrderController::class, 'listOrderDetail'])->middleware('CheckLogin')->name('list_order_detail');
        Route::post('/update-status', [OrderController::class, 'update'])->middleware('CheckLogin')->name('updateStatus');
    });

    //Category
    Route::prefix('category')->group(function(){
        Route::get('/create', [CategoryController::class, 'index'])->middleware('CheckLogin')->name('add_category');
        Route::post('/create', [CategoryController::class, 'create'])->middleware('CheckLogin');
        Route::get('/list', [CategoryController::class, 'list'])->middleware('CheckLogin')->name('list_category');
        Route::get('/edit/{id}', [CategoryController::class, 'show'])->middleware('CheckLogin')->name('show_category');
        Route::post('/edit/{id}', [CategoryController::class, 'update'])->middleware('CheckLogin');
        Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->middleware('CheckLogin')->name('delete_category');
    });

    //manufacture
    Route::prefix('manufacture')->group(function(){
        Route::get('/create', [ManufactureController::class, 'index'])->middleware('CheckLogin')->name('add_manufacture');
        Route::post('/create', [ManufactureController::class, 'create'])->middleware('CheckLogin');
        Route::get('/list', [ManufactureController::class, 'list'])->middleware('CheckLogin')->name('list_manufacture');
        Route::get('/edit/{id}', [ManufactureController::class, 'show'])->middleware('CheckLogin')->name('show_manufacture');
        Route::post('/edit/{id}', [ManufactureController::class, 'update'])->middleware('CheckLogin');
        Route::get('/delete/{id}', [ManufactureController::class, 'destroy'])->middleware('CheckLogin')->name('delete_manufacture');
    });

    //product
    Route::prefix('product')->group(function(){
        Route::get('/create', [ProductController::class, 'index'])->middleware('CheckLogin')->name('add_product');
        Route::post('/create', [ProductController::class, 'create'])->middleware('CheckLogin');
        Route::get('/list', [ProductController::class, 'list'])->middleware('CheckLogin')->name('list_product');
        Route::get('/edit/{id}', [ProductController::class, 'show'])->middleware('CheckLogin')->name('show_product');
        Route::post('/edit/{id}', [ProductController::class, 'update'])->middleware('CheckLogin');
        Route::get('/delete/{id}', [ProductController::class, 'destroy'])->middleware('CheckLogin')->name('delete_product');
    });

    //storage
    Route::prefix('storage')->group(function(){
        Route::get('/create', [StorageController::class, 'index'])->middleware('CheckLogin')->name('add_storage');
        Route::post('/create', [StorageController::class, 'create'])->middleware('CheckLogin');
        Route::get('/list', [StorageController::class, 'list'])->middleware('CheckLogin')->name('list_storage');
        Route::get('/edit/{id}', [StorageController::class, 'show'])->middleware('CheckLogin')->name('show_storage');
        Route::post('/edit/{id}', [StorageController::class, 'update'])->middleware('CheckLogin');
        Route::get('/delete/{id}', [StorageController::class, 'destroy'])->middleware('CheckLogin')->name('delete_storage');
    });

    //voucher
    Route::prefix('voucher')->group(function(){
        Route::get('/create', [VoucherController::class, 'index'])->middleware('CheckLogin')->name('add_voucher');
        Route::post('/create', [VoucherController::class, 'create'])->middleware('CheckLogin');
        Route::get('/list', [VoucherController::class, 'list'])->middleware('CheckLogin')->name('list_voucher');
        Route::get('/edit/{id}', [VoucherController::class, 'show'])->middleware('CheckLogin')->name('show_voucher');
        Route::post('/edit/{id}', [VoucherController::class, 'update'])->middleware('CheckLogin');
        Route::get('/delete/{id}', [VoucherController::class, 'destroy'])->middleware('CheckLogin')->name('delete_voucher');
    });
});
