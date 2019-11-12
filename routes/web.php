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


// 后台首页路由
Route::get('admin/index/index','admin\Index@index');

//后台分类路由
Route::group(['prefix'=>'admin/cates'],function(){
	Route::get('index','admin\Cates@index');
	Route::get('create','admin\Cates@create');

});

//hash加密测试
Route::get('/hash', function () {
    return password_hash('123456', PASSWORD_DEFAULT);
});

//后台操作
Route::group(['prefix' => '/Admin', 'middleware' => ['user.login']], function(){
    //后台首页
    Route::get('/', 'Admin\IndexController@index');
    //后台退出
    Route::get('/logout', 'Admin\IndexController@logout');
    //后台显示用户
    Route::get('/list', 'Admin\ListController@index');
});

//后台登录
Route::get('/Admin/login', 'Admin\LoginController@show')->middleware('user.load');
Route::post('/Admin/login', 'Admin\LoginController@login')->middleware('user.load');
