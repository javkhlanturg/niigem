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

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
Route::get('/polls','PollController@index');
Route::get('/video','PostController@video');
Route::post('/action/home','HomeController@action');
Route::get('/reporter/{userid}', 'PostController@reportList');
Route::post('/submit_poll','PollController@store')->name('addPoll');
Route::post('/comment','CommentController@addComment')->name('addComment');
Route::post('/replycomment','CommentController@replyComment')->name('replyComment');
Route::get('/','HomeController@index');
Route::post('/slider/action','PostController@sliders')->name('sliders');
Route::post('/slider/directories','PostController@get_all_dirs')->name('postList');
Route::get('/{slug}','PostController@postList')->name('postList');
Route::get('/{slug}/{postid}','PostController@post')->name('viewPost');
