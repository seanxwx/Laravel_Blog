<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function () {
        return view('welcome');
    });


Route::any('admin/login', 'Admin\LoginController@login');

Route::get('admin/code','Admin\LoginController@code');

//Route::get('admin/crypt', 'admin\LoginController@crypt');
//Route::get('/test', 'IndexController@index');

//Route::get('admin/login', 'Admin\LoginController@login');

//Route::get('admin/getcode','Admin\LoginController@getcode');







Route::group(['middleware'=>['admin.login'],'prefix'=>'admin','namespace'=>'Admin'],function(){

    Route::get('index', 'IndexController@index');

    Route::get('info', 'IndexController@info');

    Route::get('quit', 'LoginController@quit');



    Route::any('pass', 'IndexController@pass');

    Route::resource('category','CategoryController');

    Route::post('cate/changeOrder', 'CategoryController@changeOrder');

    Route::resource('article','ArticleController');
});