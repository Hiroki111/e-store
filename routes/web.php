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

Route::get('/product/{hashedId}', 'ProductController@index');

Route::get('/bundle/{hashedId}', 'BundleController@index');

Route::get('/viewcart', 'ViewCartController@index');

Route::get('/checkout-option', 'CheckoutOptionController@index');

Route::get('/payment', 'PaymentController@index');
Route::post('/payment', 'PaymentController@store');

Route::get('/confirmation/{hashedId}', 'OrderConfirmationController@show');
Route::get('/confirmation/{hashedId}/pdf', 'OrderConfirmationController@printPdf');

Route::get('/privacy', 'PrivacyController@index');

Route::get('/click-and-collect', 'ClickAndCollectController@index');

Route::get('/delivery', 'DeliveryController@index');

Auth::routes();

//Internal APIs - ones which are not used by external applications
//They don't need to be in api.php
Route::resource('cart', 'CartController');
Route::post('cart/add', 'CartController@add');
Route::put('cart/{type}/{hashedId}', 'CartController@update');
