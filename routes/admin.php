<?php
/**
 * 后台管理模块所有路由
 * User: jason
 * Date: 2018/9/13
 * Time: 下午3:42
 */

/* 获取配置文件中后台的前缀地址 */
define('ADMIN_PREFIX', config('admin.admin_prefix'));

/* 后台登录处理 */
Route::namespace('Admin')->prefix(ADMIN_PREFIX)->group(function () {
    Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'LoginController@login');
});

Route::namespace('Admin')->prefix(ADMIN_PREFIX)->middleware('AdminAuth:admin')->group(function () {
    /* 退出路由 */
    Route::post('logout', 'LoginController@logout')->name('admin.logout');

    /* 管理员首页路由 */
    Route::get('/', 'DashboardController@index');
    Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
    Route::get('dashboard/show', 'DashboardController@show')->name('admin.dashboard.show');

    /* 录取批次管理路由 */
    Route::delete('batch/delete', 'BatchController@deleteByIds')->name('admin.batch.delete');
    Route::get('batch/page', 'BatchController@getListByPageId')->name('admin.batch.page');
    Route::resource('batch', 'BatchController', ['as' => 'admin']);

    /* 大学类型管理路由 */
    Route::get('college/category/page', 'CollegeCategoryController@getListByPageId')->name('admin.college.category.page');
    Route::resource('college/category', 'CollegeCategoryController', ['as' => 'admin.college']);

    /* 大学层次管理路由 */
    Route::get('college/level/page', 'CollegeLevelController@getListByPageId')->name('admin.college.level.page');
    Route::resource('college/level', 'CollegeLevelController', ['as' => 'admin.college']);

    /* 大学管理路由 */
    Route::resource('college', 'CollegeController', ['as' => 'admin']);

    /* 专业大分类管理路由 */
    Route::delete('professional/category/delete', 'ProfessionalCategoryController@deleteByIds')->name('admin.professional.category.delete');
    Route::get('professional/category/page', 'ProfessionalCategoryController@getListByPageId')->name('admin.professional.category.page');
    Route::resource('professional/category', 'ProfessionalCategoryController', ['as' => 'admin.professional']);

    /* 专业列表管理路由 */
    Route::delete('professional/delete', 'ProfessionalController@deleteByIds')->name('admin.professional.delete');
    Route::get('professional/page', 'ProfessionalController@getListByPageId')->name('admin.professional.page');
    Route::resource('professional', 'ProfessionalController', ['as' => 'admin']);


    /* 省控线管理路由 */
    Route::delete('province/score/delete', 'ProvinceControlScoreController@deleteByIds')->name('admin.province.score.delete');
    Route::get('province/score/page', 'ProvinceControlScoreController@getListByPageId')->name('admin.province.score.page');
    Route::resource('province/score', 'ProvinceControlScoreController', ['as' => 'admin.province']);

    /* 地域管理路由 -> 省份管理界面 */
    Route::delete('province/delete', 'ProvinceController@deleteByIds')->name('admin.province.delete');
    Route::get('province/page', 'ProvinceController@getListByPageId')->name('admin.province.page');
    Route::resource('province', 'ProvinceController', ['as' => 'admin']);

    /* 地域管理路由 -> 城市管理界面 */
    Route::delete('city/delete', 'CityController@deleteByIds')->name('admin.city.delete');
    Route::get('city/page', 'CityController@getListByPageId')->name('admin.city.page');
    Route::resource('city', 'CityController', ['as' => 'admin']);

    /* 日志管理路由 -> 管理员登录日志管理界面 */
    Route::get('log/admin/login', 'AdminLoginLogController@index')->name('log.admin.login.index');
    Route::get('log/admin/login/page', 'AdminLoginLogController@getListByPageId')->name('log.admin.login.page');

    /* 日志管理路由 -> 代理商登录日志管理界面 */
    Route::get('log/agent/login', 'AgentLoginLogController@index')->name('log.agent.login.index');
    Route::get('log/agent/login/page', 'AgentLoginLogController@getListByPageId')->name('log.agent.login.page');

    /* 日志管理路由 -> 学生操作日志管理界面 */
    Route::get('log/student/login', 'StudentLoginLogController@index')->name('log.student.login.index');
    Route::get('log/student/login/page', 'StudentLoginLogController@getListByPageId')->name('log.student.login.page');
});