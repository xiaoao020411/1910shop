<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// //闭包路由
// Route::get('/aa',function(){
//     return '闭包路由';
// });

//Route::get('/index','IndexController@index');
//Route::view('/index','index',['name'=>'张庆']);
Route::get('/add','IndexController@index');
Route::post('/doadd','IndexController@doadd');
Route::get('/goods/{id}/{name}','IndexController@goods')->where(['name'=>'[a-zA-Z\x{4e00}-\x{9fa5}]{3,6}']);
Route::get('/goods/{id}','IndexController@good');

Route::get('/show/{id?}','IndexController@show');
//混合方法
Route::get('/detail/{id}/{name?}','IndexController@detail');



Route::domain('admin.laravel.com')->group(function () {
    //品牌管理
    Route::prefix('/brand')->middleware('auth')->group(function(){
        Route::get('/','Admin\BrandController@index');//列表展示
        Route::get('/create','Admin\BrandController@create');//添加展示
        Route::post('/store','Admin\BrandController@store');//执行添加
        Route::get('/edit/{id}','Admin\BrandController@edit');//编辑展示
        Route::post('/update/{id}','Admin\BrandController@update');//执行编辑
        Route::get('/destroy/{id}','Admin\BrandController@destroy');//删除

    });

    //分类管理
    Route::prefix('/cate')->middleware('auth')->group(function(){
        Route::get('/create','Admin\CateController@create');//添加展示
        Route::post('/store','Admin\CateController@store');//执行添加
        Route::get('/','Admin\CateController@index');//列表展示
        Route::get('/destroy/{id}','Admin\BrandController@destroy');//删除
    });
    // 商品管理
    Route::prefix('/goods')->middleware('auth')->group(function(){
        Route::get('/create','Admin\GoodsController@create'); 
        Route::post('/store','Admin\GoodsController@store'); 
        Route::get('/','Admin\GoodsController@index'); 
        Route::get('/edit/{id}','Admin\GoodsController@edit'); 
        Route::post('/update/{id}','Admin\GoodsController@update'); 
        Route::get('/destroy/{id}','Admin\GoodsController@destroy'); 
    });
    // 管理员
    Route::prefix('/admin')->middleware('auth')->group(function(){
        Route::get('/create','Admin\AdminController@create'); 
        Route::post('/store','Admin\AdminController@store'); 
        Route::get('/','Admin\AdminController@index'); 
        Route::get('/edit/{id}','Admin\AdminController@edit'); 
        Route::post('/update/{id}','Admin\AdminController@update'); 
        Route::get('/destroy/{id}','Admin\AdminController@destroy'); 
    });
    // Route::view('/login','admin.login'); 
    // Route::post('/logindo','Admin\LoginController@logindo'); 

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');
});


Route::domain('www.laravel.com')->group(function () {
    //前台
    Route::get('/','Index\IndexController@index');
    Route::get('/login','Index\LoginController@login');
    Route::get('/reg','Index\LoginController@reg');

    //手机号的发送验证
    Route::post('/sendSms','Index\LoginController@sendSms');
});