<?php
/**
 * 后台管理模块所有路由
 * User: jason
 * Date: 2018/9/13
 * Time: 下午3:42
 */

#获取配置文件中后台的前缀地址
define('ADMIN_PREFIX', config('admin.admin_prefix'));

##后台登录处理##
Route::namespace('Admin')->prefix(ADMIN_PREFIX)->group(function () {
    Route::get('/login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'LoginController@login');
});

Route::namespace('Admin')->prefix(ADMIN_PREFIX)->middleware('AdminAuth:admin')->group(function () {
    Route::get('/', 'DashboardController@index')->name('admin.index');
    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');
    Route::post('/logout', 'LoginController@logout')->name('admin.logout');
    Route::resource('/admin', 'AdminController');
});