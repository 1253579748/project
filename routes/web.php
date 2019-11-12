<?php

Route::prefix('admin/goods')->group(function () {

    Route::get('add', 'admin\Goods@add');

    Route::post('store', 'admin\Goods@store');

});


Route::prefix('api/type')->group(function () {

    Route::get('get/{id}', 'api\Type@getType');

    Route::get('getall', 'api\Type@getTypeAll');

});

// 后台首页路由
Route::get('admin/index/index','admin\Index@index');

//后台分类路由
Route::group(['prefix'=>'admin/cates'],function(){
    Route::get('index','admin\Cates@index');
    Route::post('create','admin\Cates@create');

});

