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

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');
Route::post('logout', 'AuthController@logout');

Route::get('posts/{post}/comments', 'CommentController@index');
Route::post('posts/{post}/comments', 'CommentController@store');
Route::patch('posts/{post}/comments/{comment}', 'CommentController@update');
Route::delete('posts/{post}/comments/{comment}', 'CommentController@destroy');
Route::resource('posts', 'PostController');

