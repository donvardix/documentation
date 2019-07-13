<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::post('store', 'MemberController@store');
Route::post('store2', 'MemberController@store2');
Route::get('session', 'MemberController@session');
Route::get('show/{id}', 'MemberController@show');
Route::get('hide/{id}', 'MemberController@hide');
Route::get('check-admin', 'MemberController@checkAdmin');
Route::post('login-admin', 'MemberController@login');

Route::get('/{any}', 'MemberController@index')->where('any', '.*');