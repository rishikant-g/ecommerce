<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\Phone;
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

Route::get('/', 'Shop\HomeController@index');



Auth::routes(["register" => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/manage-users','Admin\User\UserController@index')->name('manageuser');
Route::get('/add-users','Admin\User\UserController@create')->name('adduser');
Route::post('/store-users','Admin\User\UserController@store')->name('storeuser');
Route::get('/edit/{id}/user','Admin\User\UserController@show');
Route::post('/delete-user','Admin\User\UserController@deleteUser');
Route::put('/user/{id}/update','Admin\User\UserController@update')->name('user.update');

Route::get('/manage-category','Admin\Category\CategoryController@index')->name('managecategory');
Route::get('/add-category','Admin\Category\CategoryController@create')->name('create.category')->middleware('admin');
Route::post('/store-category','Admin\Category\CategoryController@store')->name('store.category')->middleware('admin');
Route::get('/edit/{id}/category','Admin\Category\CategoryController@edit')->middleware('admin');
Route::put('/category/{id}/update','Admin\Category\CategoryController@update')->middleware('admin');
Route::delete('/delete-category/{id}','Admin\Category\CategoryController@destroy')->middleware('admin');


Route::get('/manage-banner','Admin\Banner\BannerController@index')->name('managebanner');
Route::get('/add-banner','Admin\Banner\BannerController@create')->name('create.banner');
Route::post('/store-banner','Admin\Banner\BannerController@store')->name('store.banner');
Route::get('/edit/{id}/banner','Admin\Banner\BannerController@edit');
Route::put('/banner/{id}/update','Admin\Banner\BannerController@update');
Route::post('/delete-banner','Admin\Banner\BannerController@destroy');


Route::get('/products','Admin\Product\ProductController@index')->name('manageproduct');
Route::get('/create-product','Admin\Product\ProductController@create')->name('create.product');
Route::post('/store-product','Admin\Product\ProductController@store')->name('store.product');
Route::get('/edit/{id}/product','Admin\Product\ProductController@edit');
Route::put('/update/{id}/product','Admin\Product\ProductController@update');
Route::delete('/delete-product/{id}','Admin\Product\ProductController@destroy');


Route::get('/shop/home', 'Shop\HomeController@index');

// user routes 

Route::get('/product/{id}/details','Shop\HomeController@productDetails');
Route::post('/add-to-cart','Customer\CartController@addToCart');
Route::get('/cart-details','Customer\CartController@index');
Route::delete('/cart/delete/{id}','Customer\CartController@deleteCart');
Route::post('/update-quantity','Customer\CartController@updateCart');
Route::get('/customer-billing','Customer\CheckoutController@index');
Route::post('/checkout-process','Customer\CheckoutController@processCheckout')->name('checkout.process');
Route::get('/pay','Customer\CheckoutController@showPaymentPage')->name('showpaymentpage');
Route::post('dopayment', 'RazorpayController@dopayment')->name('dopayment');



Route::get('/register-customer','Customer\CustomerController@index')->name('customer.register');
Route::post('/store-customer','Customer\CustomerController@store')->name('store.customer');








