<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    $header=view('home.header');
    $footer=view('home.footer');
    $main=view('home.main_home');
    return $header.$main.$footer;
});
Route::get('getView/{name}',function($name){
    return view($name);
});

Route::get('/get_post', 'posts\\SinglePostController@getPost');

Route::get('/home', 'HomeController@index');

Route::get('menu', "Questions\\QuestionController@index");
Route::get('environments', "Questions\\QuestionController@environment");
Route::post('environments', "Questions\\QuestionController@environmentAnswer");
Route::get('classrooms', "Questions\\QuestionController@classroom");
Route::post('classrooms', "Questions\\QuestionController@classroomAnswer");