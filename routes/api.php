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


Route::get('user/', 'UserController@index');
Route::get('user/{user_id}', 'UserController@view');
Route::post('user/', 'UserController@store');
Route::put('user/{user_id}', 'UserController@update');
Route::delete('user/{user_id}', 'UserController@destroy');

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
