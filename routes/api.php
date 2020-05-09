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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'namespace' => 'Api\v1'], function () {    
    Route::resource('news', 'NewsController');
    Route::get('latest', 'NewsController@latest');
    Route::get('pg/{id}', 'NewsController@page');
    Route::get('date/{date}', 'NewsController@date');
});