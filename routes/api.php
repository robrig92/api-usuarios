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

Route::group([
    'prefix' => 'users',
], function() {
    Route::get('/', 'UsersController@all');
    Route::get('/roles/{role}', 'UsersController@byRol');
    Route::get('/active/{active}', 'UsersController@byActive');
    Route::get('/roles/{role}', 'UsersController@byRol');
    Route::get('/permissions/{permission}', 'UsersController@byPermission');
    Route::post('/', 'UsersController@store');
    Route::patch('/{user}', 'UsersController@update');
    Route::delete('/{user}', 'UsersController@destroy');
});