<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/ok', function(){
    return ['satus' => true];
});

/*
Route::namespace('api')->name('api.')->group(function(){
    Route::get('/products', 'App\Http\Controllers\Api\ProductController@index')->name('products');
});
*/

//Route::get('/products', 'App\Http\Controllers\Api\ProductController@index');

Route::prefix('products')->group(function(){

    Route::get('/', 'App\Http\Controllers\Api\ProductController@index')->name('index_products');
    Route::get('/{id}', 'App\Http\Controllers\Api\ProductController@show')->name('show_products');

    //POST
    Route::post('/','App\Http\Controllers\Api\ProductController@store')->name('store_products');

});