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

// One to one 

Route::get('/show/{id}/user',function($id){
    return response()->json(User::findOrfail($id)->phone);
});


// Inverse of one to one is belongTo



Auth::routes(["register" => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/manage-users','Admin\User\UserController@index')->name('manageuser');
Route::get('/add-users','Admin\User\UserController@create')->name('adduser');
Route::post('/store-users','Admin\User\UserController@store')->name('storeuser');
