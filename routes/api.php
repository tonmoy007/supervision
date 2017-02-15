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

Route::get('/posts', 'posts\\SinglePostController@all');
Route::post('/post', 'posts\\SinglePostController@add');
Route::put('/post/{id}', 'posts\\SinglePostController@update');
Route::delete('/post/{id}', 'posts\\SinglePostController@add');


Route::get('/employees', 'employee\\EmployeeController@all');
Route::post('/employee', 'employee\\EmployeeController@add');
Route::put('/employee/{id}', 'employee\\EmployeeController@update');
Route::delete('/employee/{id}', 'employee\\EmployeeController@add');

Route::get('/links', 'link\\LinkController@all');
Route::post('/link', 'link\\LinkController@add');
Route::put('/link/{id}', 'link\\LinkController@update');
Route::delete('/link/{id}', 'link\\LinkController@add');

Route::get('/schools', 'school\\SchoolController@all');
Route::post('/school', 'school\\SchoolController@add');
Route::put('/school/{id}', 'school\\SchoolController@update');
Route::delete('/school/{id}', 'school\\SchoolController@add');