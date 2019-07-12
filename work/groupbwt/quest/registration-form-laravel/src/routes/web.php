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

Route::get('/', 'MemberController@index')->name('home');
Route::post('store', 'MemberController@store');
Route::post('store2', 'MemberController@store2');
Route::get('all-members', 'MemberController@members')->name('all_members');
Route::get('show/{id}', 'MemberController@show');
Route::get('hide/{id}', 'MemberController@hide');