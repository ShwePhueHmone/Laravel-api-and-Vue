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
// Route::get('product', 'ProductController@index');
// Route::post('product', 'ProductController@store');
// Route::get('product/show/{id}', 'ProductController@show');
// Route::put('product/{id}', 'ProductController@update');
// Route::delete('product/delete/{id}', 'ProductController@destroy');
Route::apiResource('product', 'ProductController');