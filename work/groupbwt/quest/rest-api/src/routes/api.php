<?php

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

Route::group(['middleware' => '\BwtTeam\LaravelAPI\Middleware\Api', 'namespace' => 'Api'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::group(['middleware' => ['role:admin']], function () {
            Route::get('users/restore/{id}', 'UserController@restore');
            Route::apiResource('users', 'UserController');
        });
        Route::get('start-parser', 'ParserController@startParser');
        Route::get('logout', 'AuthController@logout');
        Route::apiResource('hotels', 'HotelController');
        Route::apiResource('rooms', 'RoomController')->only(['index', 'show']);
        Route::apiResource('hotels.rooms', 'HotelRoomController')->only(['index', 'show']);
    });
});
