<?php
/**
 * 学生会员中心管理路由
 * User: jason
 * Date: 2018/9/13
 * Time: 下午6:54
 */

/* 获取配置文件中学生会员中心的前缀地址 */
define('STUDENT_PREFIX', config('student.student_prefix'));

/* 学生后台登录处理 */
Route::namespace('Student')->prefix(STUDENT_PREFIX)->group(function () {
    /* 登录 */
    Route::get('login', 'LoginController@showLoginForm')->name('student.login');
    Route::post('login', 'LoginController@login');
    /* 注册 */
    Route::get('register', 'RegisterController@showRegistrationForm')->name('student.register');
    Route::post('register', 'RegisterController@register');
});

Route::namespace('Student')->prefix(STUDENT_PREFIX)->middleware('StudentAuth:student')->group(function () {
    /* 学生后台首页 */
    Route::get('', 'DashboardController@index');
    Route::get('dashboard', 'DashboardController@index')->name('student.dashboard');
    Route::post('logout', 'LoginController@logout')->name('student.logout');
});