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

Route::get('news', 'App\Http\Controllers\NewsController@index');
Route::get('products', 'App\Http\Controllers\ProductsController@index');
Route::get('contacts', 'App\Http\Controllers\ContactsController@index');
Route::get('gallery', 'App\Http\Controllers\GalleryController@index');
Route::get('news/{id}', 'App\Http\Controllers\NewsController@show');

Route::middleware('auth.check:api')->group(function (){
    Route::prefix('news')->group(function (){
        Route::post('/add', 'App\Http\Controllers\NewsController@store');
        Route::post('/update', 'App\Http\Controllers\NewsController@update');
        Route::post('/delete', 'App\Http\Controllers\NewsController@destroy');
    });

    Route::post('contacts/update', 'App\Http\Controllers\ContactsController@update');

    Route::prefix('products')->group(function (){
        Route::post('/add', 'App\Http\Controllers\ProductsController@store');
        Route::post('/update', 'App\Http\Controllers\ProductsController@update');
        Route::post('/delete', 'App\Http\Controllers\ProductsController@destroy');
    });

    Route::prefix('gallery')->group(function () {
        Route::post('/add', 'App\Http\Controllers\GalleryController@store');
        Route::post('/delete', 'App\Http\Controllers\GalleryController@destroy');
    });
});



Route::post('/register', 'App\Http\Controllers\AuthController@Register');
Route::post('/auth/login', 'App\Http\Controllers\AuthController@Login');

