<?php

use App\Http\Controllers\cartcontroller;
use App\Http\Controllers\categorycontroller;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CuponController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\frontendcontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\subcategorycontroller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\productcontroller;
use App\Models\product;
use App\Models\ProductThumbnails;

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

Auth::routes();

// customer login
Route::post('/customer/login',[CustomerLoginController::class, 'customer_login']);
// customer register
Route::post('/customer/register',[CustomerRegisterController::class, 'customer_register']);
// customer Logout
Route::get('/customer/logout',[CustomerLoginController::class, 'customer_logout'])->name('customer.logout');

// -----forntEnd All Route start--------
Route::get('/',[frontendcontroller::class, 'index'])->name('index');

Route::get('/product/details/{product_id}',[frontendcontroller::class, 'product_details'])->name('product_details');

// all product show routes

Route::get('/all_product',[frontendcontroller::class, 'all_product'])->name('all_product');

// customer account--
Route::get('/account',[frontendcontroller::class, 'account'])->name('account');
Route::post('/account/update',[frontendcontroller::class, 'account_update']);


// dashboard home page url
Route::get('/home', [HomeController::class, 'index'])->name('home');
// users
Route::get('/users', [HomeController::class, 'users'])->name('users');

Route::get('user/delete/{user_id}', [HomeController::class, 'user_delete'])->name('user.delete');

// category all route
Route::get('category/add_category',[categorycontroller::class, 'add_category'])->name('addcategory');

Route::post('/category/insert',[categorycontroller::class, 'category_insert']);

Route::get('/category/view_category',[categorycontroller::class, 'view_category'])->name('ViewCategory');

Route::get('/category/Softdelete_category/{category_id}',[categorycontroller::class, 'category_softDelete'])->name('category.SoftDelete');

Route::get('/category/trashed_category',[categorycontroller::class, 'trashed_category'])->name('trashed_category');

Route::get('/category/forcedelete_category/{category_id}',[categorycontroller::class, 'forcedelete_category'])->name('category.forcedelete');

Route::get('/category/retore/{category_id}',[categorycontroller::class, 'restore_category'])->name('category.restore');

Route::get('/category/edit_category/{category_id}',[categorycontroller::class, 'edit_category'])->name('category.edit');

Route::post('/category/update_category', [categorycontroller::class, 'update_category']);

// sub Category -----

Route::get('subcategory/add_subcategory',[subcategorycontroller::class, 'add_subcategory'])->name('add.subcategory');

Route::post('/subcategory/insert',[subcategorycontroller::class, 'insert_subcategory']);

Route::get('/subcategory/view_subcategory',[subcategorycontroller::class, 'view_subcategory'])->name('View.SubCategory');

Route::get('/subcategory/edit_subcategory/{subcategory_id}',[subcategorycontroller::class, 'edit_subcategory'])->name('subcategory.edit');

Route::post('/subcategory/update', [subcategorycontroller::class, 'update_subcategory']);


//product all route

Route::get('/product/add_product',[productcontroller::class, 'add_product'])->name('add.product');

// relation category to subcategory with ajax----
Route::post('/getcategory_ajax',[productcontroller::class, 'getcategory_ajax']);
// relation category to subcategory with ajax end----
Route::post('/product/insert',[productcontroller::class, 'insert_product']);

Route::get('/product/view_product',[productcontroller::class, 'view_product'])->name('view.product');

Route::get('/product/delete/{product_id}',[productcontroller::class, 'delete_product'])->name('product.delete');

// frontend cart all routes

Route::post('/cart/insert',[cartcontroller::class, 'cart_insert']);
Route::get('/cart',[cartcontroller::class, 'cart'])->name('cart');
Route::get('/cart/{cupon_code}',[cartcontroller::class, 'cart']);
Route::get('/cart/delete/{cart_id}',[cartcontroller::class, 'cart_delete'])->name('cart.delete');
Route::post('/cart/update',[cartcontroller::class, 'cart_update']);

// cupon all routes

Route::get('/cupon/add_cupon',[CuponController::class, 'add_cupon'])->name('add.cupon');
Route::post('/cupon/insert',[CuponController::class, 'cupon_insert']);

// frontend checkout all routes

Route::get('/checkout',[CheckoutController::class, 'checkout'])->name('checkout');
Route::post('/getCity',[CheckoutController::class, 'getCity']);
Route::post('/order/insert',[CheckoutController::class, 'order_insert']);
Route::get('/order/order_confirm',[CheckoutController::class, 'order_confirm'])->name('order_confirm');


// SSLCOMMERZ Start
Route::get('/ssl/payment', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END
