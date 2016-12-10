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
    $menus = TCG\Voyager\Models\MenuItem::where('menu_id', 2)->get();
    return view('/frontend/index', ['menus'=>$menus]);
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
