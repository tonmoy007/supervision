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

Route::get('/link', 'link\\LinkController@index')->middleware('ability:token');
Route::resource('post', 'posts\\SinglePostController');
Route::resource('employee', 'employee\\EmployeeController');
Route::resource('link', 'link\\LinkController');
Route::resource('school', 'school\\SchoolController');
Route::resource('slider', 'home\\SliderController');
Route::resource('gallary', 'home\\GallaryController');