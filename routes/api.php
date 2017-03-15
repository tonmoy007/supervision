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
Route::post('/password/forget', "Auth\\PasswordController@askToken");
Route::post('/password/validate', "Auth\\PasswordController@validateToken");
Route::post('/password/reset', "Auth\\PasswordController@resetPassword");

Route::get('/users','UserController@index')->middleware('ability:token');
Route::get('/homepage', "home\\HomeController@index");
Route::get('/menu', "home\\HomeController@menu");
Route::get('/sidebar', "home\\HomeController@sidebar");
Route::get('/information', "home\\HomeController@information");
Route::get('post/category', 'posts\\PostCategoryController@index');
Route::get('post/category/{category}', 'posts\\SinglePostController@category');
Route::resource('post', 'posts\\SinglePostController');
Route::get('employee/category', 'employee\\EmployeeCategoryController@index');
Route::get('employee/category/{category}', 'employee\\EmployeeController@category');
Route::resource('employee', 'employee\\EmployeeController');
Route::get('link/category', 'link\\LinkCategoryController@index');
Route::get('link/category/{category}', 'link\\LinkController@category');
Route::resource('link', 'link\\LinkController');
Route::get('link/category/{category}', 'link\\LinkController@category');
Route::put('school/edit', 'school\\SchoolController@update');
Route::get('school/category/{category}', 'school\\SchoolController@category');
Route::resource('school', 'school\\SchoolController');
Route::resource('slider', 'home\\SliderController');
Route::resource('gallery', 'home\\GallaryController');

Route::resource('class', 'school\\ClassController');
Route::get('/attendance/{id}', 'school\\AttendanceController@schoolHistory');
Route::resource('attendance', 'school\\AttendanceController');
Route::resource('notice/new', 'notice\\NoticeController@newNotice');
Route::resource('notice', 'notice\\NoticeController');

Route::get('/questions/menu', "Questions\\QuestionController@index");
Route::get('/questions/environments', "Questions\\QuestionController@environment");
Route::post('/questions/environments', "Questions\\QuestionController@environmentAnswer");
Route::get('/questions/classrooms', "Questions\\QuestionController@classroom");
Route::post('/questions/classrooms', "Questions\\QuestionController@classroomAnswer");
Route::get('/questions/sciencelab', "Questions\\QuestionController@scienceLab");
Route::post('/questions/sciencelab', "Questions\\QuestionController@scienceLabAnswer");
Route::get('/questions/students', "Questions\\QuestionController@students");
Route::post('/questions/students', "Questions\\QuestionController@studentsAnswer");
//Route::resource('questions', "Questions\\QuestionController");
