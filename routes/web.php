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

#加载后台管理模块路由
include_once __DIR__.'/admin.php';

#加载代理商管理模块路由
include_once __DIR__.'/agent.php';

#加载学生会员中心理模块路由
include_once __DIR__.'/student.php';

//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
