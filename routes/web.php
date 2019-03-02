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
Route::get('/product-type/{id}', 'ProductTypeController@index');
Route::get('/product/{hashedId}', 'HomeController@product');
Route::get('/bundle/{hashedId}', 'HomeController@bundle');
Route::get('/viewcart', 'HomeController@viewcart');
Route::get('/checkout-option', 'HomeController@checkoutOption');
Route::get('/payment', 'HomeController@payment');

Route::post('/payment', 'PaymentController@store');

Route::get('/confirmation', 'HomeController@confirmation');

Route::get('/privacy', 'HomeController@privacy');

Auth::routes();

//Internal APIs - ones which are not used by external applications
//They don't need to be in api.php
Route::resource('cart', 'CartController');
Route::post('cart/add', 'CartController@add');
Route::put('cart/{type}/{hashedId}', 'CartController@update');
