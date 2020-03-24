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

Route::get('/', function () {
    return view('welcome');
});



Auth::routes(["register" => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/manage-users','Admin\User\UserController@index')->name('manageuser');
Route::get('/add-users','Admin\User\UserController@create')->name('adduser');
Route::post('/store-users','Admin\User\UserController@store')->name('storeuser');
Route::get('/edit/{$id}/user','Admin\User\UserController@show');
Route::post('/delete-user','Admin\User\UserController@deleteUser');

Route::get('/manage-category','Admin\Category\CategoryController@index')->name('managecategory');
Route::get('/add-category','Admin\Category\CategoryController@create')->name('create.category');
Route::post('/store-category','Admin\Category\CategoryController@store')->name('store.category');
Route::post('/delete-category','Admin\Category\CategoryController@destroy');


Route::get('/manage-banner','Admin\Banner\BannerController@index')->name('managebanner');
