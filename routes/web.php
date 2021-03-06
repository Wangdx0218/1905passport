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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/api/user/reg','User\UserController@reg');     //注册
Route::post('/api/user/login','User\UserController@login'); // 登录
Route::get('/api/show/time','User\UserController@showTime'); // 获取数据


// 签名
Route::get('/test/check','TestController@md5');     //注册
Route::post('/test/check1','TestController@check1'); 	// 验证签名

Route::get('/test/check2','TestController@Check2');    //密钥验签

Route::get('/decrypt','TestController@decrypt');    //对称加密

Route::get('/rsadescypt','TestController@rsadescypt'); //非对称解密
