<?php
/**
 * 学生会员中心管理路由
 * User: jason
 * Date: 2018/9/13
 * Time: 下午6:54
 */
#获取配置文件中学生会员中心的前缀地址
define('STUDENT_PREFIX', config('student.student_prefix'));

##后台登录处理##
Route::namespace('Student')->prefix(STUDENT_PREFIX)->group(function () {
    Route::get('/login', 'LoginController@showLoginForm')->name('student.login');
    Route::post('/login', 'LoginController@login');
});

Route::namespace('Student')->prefix(STUDENT_PREFIX)->middleware('StudentAuth:student')->group(function () {
    Route::get('/', 'DashboardController@index')->name('student.index');
    Route::get('/dashboard', 'DashboardController@index')->name('student.dashboard');
    Route::post('/logout', 'LoginController@logout')->name('student.logout');
});