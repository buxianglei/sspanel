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

# 首页
Route::get('/', 'Dashboard\HomeController@index');

# 是否登陆
Route::get("/isLogin", 'Dashboard\HomeController@isLogin');

# 退出登录
Route::post("logout", "Auth\LoginController@logout");

# 登陆
Route::post("login", 'Auth\LoginController@login');

# 注册
Route::post("register", 'Auth\RegisterController@register');

# 支付宝回调
Route::any("callback", "Recharge\RechargeController@callback");

# API模块
Route::group(['prefix' => 'api/v1', 'middleware' => 'auth'], function (){
    # 用户模块
    Route::group(['prefix' => 'user', 'namespace' => 'User'], function (){
        Route::get("order", "OrderController@getOrder");
        Route::post("buyPlan", 'OrderController@generateOrder');
    });

    # 帮助模块
    Route::group(['prefix' => 'help', 'namespace' => 'Help'], function () {
        Route::get("/", "ListController@index");
        Route::get("/{id}", "ListController@show");
    });

    # 充值模块
    Route::group(['prefix' => 'recharge', 'namespace' => 'Recharge'], function(){
        Route::post("/", "RechargeController@generate");
    });

    # 节点模块
    Route::group(['prefix' => 'node', 'namespace' => 'Node'], function(){
        Route::get('available', "ListController@available");
    });

    # 套餐模块
    Route::group(['prefix' => 'plan', 'namespace' => 'Plan'], function(){
        Route::get('getListByNodeId/{nodeId}', "ListController@getListByNodeId");
    });
});
