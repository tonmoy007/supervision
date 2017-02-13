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

Route::post('/login','UserController@authenticate');
Route::get('/logout','UserController@logout')->middleware('ability:token');
Route::get('/users','UserController@index')->middleware('ability:token');


Route::post('/add_post', 'posts\\SinglePostController@add');
Route::put('/update_post', 'posts\\SinglePostController@update');
Route::delete('/delete_post/{id}', 'posts\\SinglePostController@add');
