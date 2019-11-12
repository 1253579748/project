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

Route::prefix('admin/goods')->group(function () {

    Route::get('add', 'admin\Goods@add');

    Route::post('store', 'admin\Goods@store');

});


Route::prefix('api/type')->group(function () {

    Route::get('get/{id}', 'api\Type@getType');

    Route::get('getall', 'api\Type@getTypeAll');

        
});
