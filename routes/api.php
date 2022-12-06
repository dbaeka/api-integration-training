<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/alive', 'App\Http\Controllers\AliveController@showAlive')->name('post.show-alive');
Route::get('/get-account-balance', 'App\Http\Controllers\ReloadlyController@getBalance')->name('post.get-account-balance'); // The name after the @ sign is the name of the function to call in the controller
Route::get('/get-transaction-status/{id}', 'App\Http\Controllers\ReloadlyController@getTransactionStatus')->name('post.get-transaction-status'); // The {id} means a variable that will be passed in the URL endpoint, so Laravel identifies that as a parameter passed to it
Route::get('/get-transaction-history', 'App\Http\Controllers\ReloadlyController@getTransactionHistory')->name('post.get-transaction-history');
Route::get('/get-access-token', 'App\Http\Controllers\ReloadlyController@getAccessToken')->name('post.get-access-token');
Route::post('/get-countries', 'App\Http\Controllers\ReloadlyController@getCountries')->name('post.get-countries');
Route::get('/get-products', 'App\Http\Controllers\ReloadlyController@getProducts')->name('post.get-products');
Route::post('/get-buy-giftcard', 'App\Http\Controllers\ReloadlyController@buyGiftCard')->name('post.get-buy-giftcard');
// .... Add the routes for the other features

