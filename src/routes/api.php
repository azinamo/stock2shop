<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => 'products', 'as' => 'products.', 'namespace' => 'Api'], function () {
    Route::get('/', 'ProductController@index')->name('list');
    Route::post('/create', 'ProductController@store')->name('create');
});
Route::fallback(function(){
   return response()->json([
       'message' => 'Page not found.'
   ]);
});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
