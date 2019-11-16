<?php

//商品
Route::prefix('admin/goods')->group(function () {

    Route::get('add', 'admin\Goods@add');

    Route::get('list', 'admin\Goods@list');

    Route::get('editImg/{id}', 'admin\Goods@editImg');

    Route::get('editGoods/{id}', 'admin\Goods@editGoods');

    Route::post('edit', 'admin\Goods@editCheck');

    Route::get('delGoods/{id}', 'admin\Goods@delGoods');

    Route::post('store', 'admin\Goods@store');

    Route::post('storeImg', 'admin\Goods@storeImg');

    Route::post('delImg', 'admin\Goods@delImg');


});

//商品模型规格
Route::group(['prefix'=>'admin/model'], function(){

    Route::get('list', 'admin\Model@list');

    Route::get('add', 'admin\Model@add');

    Route::post('del', 'admin\Model@del');

    Route::post('store', 'admin\Model@store');

});

Route::group(['prefix'=>'admin/order'], function(){

    Route::get('add', 'admin\Order@add');
});


//api接口
Route::prefix('api')->group(function () {

    Route::get('type/get/{id}', 'api\Type@getType');

    Route::get('type/getall', 'api\Type@getTypeAll');

    Route::get('spec/get/{id}', 'api\Spec@getSpec');

    Route::get('attr/get/{id}', 'api\Spec@getAttr');

    Route::get('user/getId/{name}', 'api\User@getId');


});

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

Route::get('/', function () {
    return view('前台首页');
});


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


    Route::get('index','admin\Cates@index');
    Route::post('create','admin\Cates@create');


Route::group(['prefix'=>'admin/comments'],function(){
	Route::get('index','admin\Comments@index');
	Route::get('update','admin\Comments@update');
	Route::post('store','admin\Comments@store');
	Route::get('delete','admin\Comments@delete');
	Route::post('create','admin\Cates@create');
});
//后台友情链接路由
Route::group(['prefix'=>'admin/ads'],function(){
    Route::get('show','admin\AdsController@show');
    Route::get('add','admin\AdsController@add');
    Route::post('add','admin\AdsController@addData');
    Route::get('del','admin\AdsController@del');
    Route::get('edit','admin\AdsController@edit');
    Route::post('edit','admin\AdsController@editData');
});



//后台友情链接路由
Route::group(['prefix'=>'admin/banner'],function(){
    Route::get('show','admin\BannerController@show');
    Route::get('add','admin\BannerController@add');
    Route::post('add','admin\BannerController@addData');
    Route::get('del','admin\BannerController@del');
    Route::get('edit','admin\BannerController@edit');
    Route::post('edit','admin\BannerController@editData');
});


