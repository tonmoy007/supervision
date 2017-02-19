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

Route::get('/homepage', "home\\HomeController@index");
Route::resource('post/category', 'posts\\PostCategoryController');
Route::resource('post', 'posts\\SinglePostController');
Route::resource('employee/category', 'employee\\EmployeeCategoryController');
Route::resource('employee', 'employee\\EmployeeController');
Route::resource('link/category', 'link\\LinkCategoryController');
Route::resource('link', 'link\\LinkController');
Route::resource('school', 'school\\SchoolController');
Route::put('school/edit', 'school\\SchoolController@update');
Route::resource('slider', 'home\\SliderController');
Route::resource('gallery', 'home\\GallaryController');