<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {

    // Dashboard
        Route::get('/dashboard',[AuthController::class, 'dashboard'] )->name('dashboard');

    // User
        Route::middleware('userAuth')->group(function () {
            // User Home
            Route::get('home',[UserController::class, 'home'])->name('user#home');
            Route::get('home/filter/{id}',[UserController::class, 'filter'])->name('user#filter');

            // Ajax
            Route::prefix('ajax')->group(function () {
                //  Products Ajax
                Route::get('list',[AjaxController::class, 'pizzaList'])->name('product#ajax');

                // Add Cart Ajax
                Route::get('addcart',[AjaxController::class, 'addCart'])->name('cart#ajax');

                // Update Cart Ajax
                Route::get('updatecart',[AjaxController::class, 'updateCart'])->name('cartUpdate#ajax');

                // OrderList Create Ajax
                Route::get('orderList/create',[AjaxController::class, 'orderListCreate'])->name('orderList#create');

                // Product View Count Increase
                Route::get('viewcount',[AjaxController::class , 'increaseViewCount'])->name('ajax#ViewCount');
            });

            // Products Details
            Route::get('pizza/details/{id}',[UserController::class, 'pizzaDetails'])->name('home#details');

            // Cart Page
            Route::prefix('cart')->group(function () {
                Route::get('list',[CartController::class, 'cartPage'])->name('user#cart');
                Route::get('add',[CartController::class, 'singleCart'])->name('cart#singleAdd');
                Route::get('delete/{id}',[CartController::class, 'deleteCart'])->name('cart#delete');
            });

            // Order History Page
            Route::prefix('order')->group(function () {
                Route::get('history',[OrderController::class, 'orderPage'])->name('user#orderHistory');
                Route::get('details/{code}',[OrderController::class, 'orderDetails'])->name('order#details');

            });

            // User Password
            Route::prefix('password')->group(function () {
                Route::get('change',[UserController::class,'password'])->name('user#password');
                Route::post('changePassword',[UserController::class,'passwordChange'])->name('user#passwordChange');
            });
            // User Account
            Route::get('profile',[UserController::class, 'profile'])->name('user#profile');

            // User Sent Message
            Route::get('ContactUs',[ContactController::class,'contactUsPage'])->name('user#ContactUs');
            Route::post('sendMessage',[ContactController::class, 'sendMessage'])->name('user#sendMessage');
        });
    // Admin
        Route::middleware('adminAuth')->prefix('admin')->group(function () {

            // Admin Password
            Route::prefix('password')->group(function () {
                Route::get('change',[AdminController::class,'password'])->name('admin#password');
                Route::post('changePassword',[AdminController::class,'passwordChange'])->name('admin#passwordChange');
            });

            // Admin Account
            Route::get('account',[AdminController::class, 'details'])->name('admin#account');
            Route::get('profile',[AdminController::class, 'profile'])->name('admin#profile');
            Route::get('list',[AdminController::class, 'list'])->name('admin#list');
            Route::get('create',[AdminController::class, 'create'])->name('admin#create');
            Route::get('list/detail/{id}',[AdminController::class, 'listDetail'])->name('admin#listDetail');
            Route::get('list/edit/{id}',[AdminController::class, 'listEdit'])->name('admin#edit');

            // Admin Category
            Route::prefix('category')->group(function () {
                Route::get('list',[CategoryController::class,'showList'])->name('admin#categoryList');
                Route::get('create',[CategoryController::class,'createPage'])->name('category#createPage');
                Route::post('categoryCreate',[CategoryController::class,'create'])->name('admin#categoryCreate');
                Route::get('delete/{id}',[CategoryController::class,'delete'])->name('admin#categoryDelete');
                Route::get('edit/{id}',[CategoryController::class,'editPage'])->name('category#editPage');
                Route::post('categoryEdit/{id}',[CategoryController::class,'edit'])->name('admin#categoryEdit');
            });

            // Admin Product
            Route::prefix('product')->group(function () {
                Route::get('list',[ProductController::class,'showList'])->name('admin#productList');
                Route::get('create',[ProductController::class,'createPage'])->name('product#createPage');
                Route::post('productCreate',[ProductController::class,'create'])->name('admin#productCreate');
                Route::get('delete/{id}',[ProductController::class,'delete'])->name('admin#productDelete');
                Route::get('edit/{id}',[ProductController::class,'editPage'])->name('product#editPage');
                Route::post('productEdit/{id}',[ProductController::class,'edit'])->name('admin#productEdit');
                Route::get('detail/{id}',[ProductController::class,'detail'])->name('admin#productDetail');
            });

            // Admin Order
            Route::prefix('order')->group(function () {
                Route::get('list',[OrderController::class, 'adminOrderPage'])->name('admin#orderList');
                Route::get('detail/{id}',[OrderController::class, 'adminOrderDetails'])->name('admin#orderDetails');
                Route::get('delivered/{id}',[OrderController::class, 'orderDelivered'])->name('order#delivered');
                Route::get('cancelled/{id}',[OrderController::class, 'orderCancelled'])->name('order#cancelled');
                Route::get('ajax',[AjaxController::class, 'orderAjax'])->name('order#ajax');
            });

            // Lists
            Route::prefix('list')->group(function () {
                Route::get('users', [UserController::class, 'usersList'])->name('admin#userList');
                Route::get('users/detail/{id}', [UserController::class, 'usersDetail'])->name('admin#userDetail');
                Route::get('messages',[ContactController::class, 'messageList'])->name('admin#messageList');
                Route::get('messages/detail/{id}',[ContactController::class, 'messageDetail'])->name('admin#messageDetails');
            });
        });
});

