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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/weather', 'ParserController@index')->name('weather');

Route::get('comments/add', 'CommentController@add')->name('add');
Route::post('comments/add', 'CommentController@store')->name('store');

Route::get('comments', 'CommentController@index')->name('comments');
