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
	Route::post('store','admin\Cates@store');
	Route::post('update','admin\Cates@update');
	Route::get('delete','admin\Cates@delete');
});

Route::group(['prefix'=>'admin/comments'],function(){
	Route::get('index','admin\Comments@index');
	Route::get('update','admin\Comments@update');
	Route::post('store','admin\Comments@store');
	Route::get('delete','admin\Comments@delete');
});

