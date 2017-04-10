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
Route::get('/questions/teachers', "Questions\\QuestionController@teachers");
Route::post('/questions/teachers', "Questions\\QuestionController@teachersAnswer");
Route::get('/questions/lectures', "Questions\\QuestionController@lectures");
Route::post('/questions/lectures', "Questions\\QuestionController@lecturesAnswer");
Route::get('/questions/multimedia', "Questions\\QuestionController@multimedia");
Route::post('/questions/multimedia', "Questions\\QuestionController@multimediaAnswer");
Route::get('/questions/yearlyplan', "Questions\\QuestionController@yearlyplan");
Route::post('/questions/yearlyplan', "Questions\\QuestionController@yearlyplanAnswer");
Route::get('/questions/diary', "Questions\\QuestionController@diary");
Route::post('/questions/diary', "Questions\\QuestionController@diaryAnswer");
Route::get('/questions/study', "Questions\\QuestionController@study");
Route::post('/questions/study', "Questions\\QuestionController@overallAnswer");
Route::get('/questions/meetings', "Questions\\QuestionController@meetings");
Route::post('/questions/meetings', "Questions\\QuestionController@overallAnswer");
Route::get('/questions/extracuriculumn', "Questions\\QuestionController@extracuriculumn");
Route::post('/questions/extracuriculumn', "Questions\\QuestionController@overallAnswer");
Route::get('/questions/lastbenchers', "Questions\\QuestionController@lastbenchers");
Route::post('/questions/lastbenchers', "Questions\\QuestionController@overallAnswer");
Route::get('/questions/creative', "Questions\\QuestionController@creative");
Route::post('/questions/creative', "Questions\\QuestionController@overallAnswer");
Route::get('/questions/assessment', "Questions\\QuestionController@assessment");
Route::post('/questions/assessment', "Questions\\QuestionController@overallAnswer");
Route::get('/questions/result', "Questions\\QuestionController@result");
Route::post('/questions/result', "Questions\\QuestionController@overallAnswer");
Route::get('/questions/academic', "Questions\\QuestionController@academic");
Route::post('/questions/academic', "Questions\\QuestionController@overallAnswer");
//Route::get('/questions/comment', "Questions\\QuestionController@comment");
//Route::post('/questions/comment', "Questions\\QuestionController@overallAnswer");
Route::get('/questions/teacherpresent', "Questions\\QuestionController@teacherpresent");
Route::post('/questions/teacherpresent', "Questions\\QuestionController@overallAnswer");
Route::get('/questions/general', "Questions\\ReportController@general");
Route::post('/questions/general', "Questions\\ReportController@allAnswer");
Route::get('/questions/responsibility', "Questions\\ReportController@responsibility");
Route::post('/questions/responsibility', "Questions\\ReportController@responsibilityAnswer");
Route::get('/questions/transfer', "Questions\\ReportController@transfer");
Route::post('/questions/transfer', "Questions\\ReportController@allAnswer");
Route::get('/questions/infrastructure', "Questions\\ReportController@infrastructure");


Route::get('/questions/all/{schoolID}', 'Questions\\QuestionController@getAllQuestions');
Route::get('/visits/{schoolID}', "Questions\\QuestionController@comment");
Route::post('/visits/{schoolID}', "Questions\\ReportController@visitAnswer");
//Route::resource('questions', "Questions\\QuestionController");
