<?php

use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ManufacturerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Client\Auth\AuthController as ClientAuthController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeController as ClientHomeController;
use App\Http\Controllers\Client\OrderController as ClientOrderController;
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

// Phía admin
// Route đăng nhập
Route::group(['middleware' => 'auth.admin.loginned', 'as' => 'admin.'], function () {
    Route::get('/admin-login', [AuthController::class, 'login'])->name('login');
    Route::post('/admin-login', [AuthController::class, 'processLogin'])->name('processLogin');
});

// Route đã đăng nhập
Route::group(['middleware' => 'auth.admin.login', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/logout', [HomeController::class, 'logout'])->name('logout');

    // Route xem profile admin
    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('/{admin}', [HomeController::class, 'profile'])->name('index');
        Route::put('/edit/{admin}', [HomeController::class, 'update'])->name('update');
        // api
        // Route::put('/edit/api/{admin}', [HomeController::class, 'updateProfileAPI'])->name('updateProfileAPI');
    });

    // Route quản lý nhà phân phối
    Route::group(['prefix' => 'manufacturers', 'as' => 'manufacturers.'], function () {
        Route::get('/', [ManufacturerController::class, 'index'])->name('index');
        Route::get('/create', [ManufacturerController::class, 'create'])->name('create');
        Route::post('/create', [ManufacturerController::class, 'store'])->name('store');
        Route::get('/edit/{manufacturer}', [ManufacturerController::class, 'edit'])->name('edit');
        Route::put('/edit/{manufacturer}', [ManufacturerController::class, 'update'])->name('update');
        Route::delete('delete/{manufacturer}', [ManufacturerController::class, 'destroy'])->name('destroy');
    });

    // Route quản lý người dùng
    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        // api
        Route::get('/api', [UserController::class, 'indexAPI'])->name('indexAPI');

        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/create', [UserController::class, 'store'])->name('store');
        Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
        Route::put('/edit/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/delete/{user}', [UserController::class, 'destroy'])->name('destroy');
    });

    // Route quản lý sản phẩm
    Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/create', [ProductController::class, 'store'])->name('store');
        Route::get('/edit/{productId}', [ProductController::class, 'edit'])->name('edit');
        Route::put('/edit/{productId}', [ProductController::class, 'update'])->name('update');
        Route::delete('/delete/{productId}', [ProductController::class, 'destroy'])->name('destroy');
    });

    // Route quản lý đơn hàng
    Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::patch('/{orderId}/approve', [OrderController::class, 'approve'])->name('approve');
        Route::patch('/{orderId}/cancel', [OrderController::class, 'cancel'])->name('cancel');

        Route::get('/show/{orderId}', [OrderController::class, 'show'])->name('show');
    });
});

// Phía client

// Route màn hình home
Route::get('/', [ClientHomeController::class, 'index'])->name('client.home');

// Route xem sản phẩm
// Route::get('/product/{id}', [ClientHomeController::class, 'showProductDetail'])->name('client.product.show');
Route::get('/product/{slug}', [ClientHomeController::class, 'showProductDetailBySlug'])->name('client.product.show');

// Route filter sản phẩm theo nhà sản xuất
Route::get('/products/{slug}', [ClientHomeController::class, 'filterProductsByManufacturer'])->name('client.filterProductsByManufacturer');

// Route chưa đăng nhập
Route::group(['middleware' => ['auth.client.loginned'], 'as' => 'client.'], function () {
    // Route::get('/login', [ClientAuthController::class, 'login'])->name('login');
    Route::post('/login', [ClientAuthController::class, 'processlogin'])->name('processLogin');

    Route::get('/register', [ClientAuthController::class, 'register'])->name('register');
    Route::post('/register', [ClientAuthController::class, 'processRegister'])->name('processRegister');
});

// Route đã đăng nhập
Route::group(['middleware' => ['auth.client.login'], 'as' => 'client.'], function () {
    Route::get('/logout', [ClientHomeController::class, 'logout'])->name('logout');

    // Route thêm vào giỏ hàng
    Route::post('/product/{id}', [CartController::class, 'addToCart'])->name('addToCart');

    // Route giỏ hàng
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::delete('/cart/delete/{productId}', [CartController::class, 'deleteOneProductInCart'])->name('cart.deleteOneProductInCart');
    Route::get('/cart/order-info', [CartController::class, 'orderInfo'])->name('cart.orderInfo');
    Route::post('/cart/order-info', [CartController::class, 'orderProcess'])->name('cart.orderProcess');

    // Route xem đơn đã đặt
    Route::get('/check-order', [ClientOrderController::class, 'index'])->name('order.index');
});
