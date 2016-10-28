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
Route::group(['namespace' => 'Index', 'prefix' => 'index'], function () {
    Route::get('/', ['as' => 'home', function () {
        return view('index.index');
    }]);
    Route::controller('index', 'IndexController');
    Route::controller('doc', 'DocController');

    Route::group(['middleware' => 'demo'], function () {
        Route::controller('user', 'UserController');
        Route::controller('relation', 'RelationController');
//        Route::resource('user', 'UserController');//不好用
    });
    Route::controller('demo', 'DemoController');

});

Route::group(['namespace' => 'Api', 'prefix' => 'api'], function () {
    Route::get('jobs', 'IndexController@insJobTest');
    Route::get('params', 'IndexController@showParams');
});
