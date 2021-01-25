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

Route::namespace('User')->group(function(){
    Route::get('user/list', 'UserController@index');
    Route::post('user/store', 'UserController@store');
    Route::post('user/update/{id}', 'UserController@update');
    Route::delete('user/delete/{id}', 'UserController@delete');
});
