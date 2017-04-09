<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Dashboard\HomeController@index');
Route::get("/isLogin", 'Dashboard\HomeController@isLogin');
Route::post("logout", "Auth\LoginController@logout");
Route::post("login", 'Auth\LoginController@login');
Route::post("register", 'Auth\RegisterController@register');

Route::group(['prefix' => 'api/v1', 'middleware' => 'auth'], function (){
    Route::group(['prefix' => 'user', 'namespace' => 'User'], function (){
        Route::get("order", "OrderController@getOrder");
    });
});
