<?php

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

Route::get('/', 'HomeController@index');
Route::get('/product-type/{id}', 'HomeController@productType');
Route::get('/product/{hashedId}', 'HomeController@product');

Auth::routes();

//Internal APIs - ones which are not used by external applications
//They don't need to be in api.php
Route::resource('cart', 'CartController');
Route::post('cart/add', 'CartController@add');
