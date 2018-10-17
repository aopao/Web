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
    Route::get('college/diplomas/page', 'CollegeDiplomasController@getListByPageId')->name('admin.college.diplomas.page');
    Route::resource('college/diplomas', 'CollegeDiplomasController', ['as' => 'admin.college']);

    /* 大学管理路由 */
    Route::delete('college/delete', 'CollegeController@deleteByIds')->name('admin.college.delete');
    Route::get('college/page', 'CollegeController@getListByPageId')->name('admin.college.page');
    Route::resource('college', 'CollegeController', ['as' => 'admin']);

    /* 专业列表管理路由 */
    Route::delete('major/delete', 'MajorController@deleteByIds')->name('admin.major.delete');
    Route::get('major/page', 'MajorController@getListByPageId')->name('admin.major.page');
    Route::resource('major', 'MajorController', ['as' => 'admin']);

    /* 省控线管理路由 */
    Route::delete('province/score/delete', 'ProvinceControlScoreController@deleteByIds')->name('admin.province.score.delete');
    Route::get('province/score/page', 'ProvinceControlScoreController@getListByPageId')->name('admin.province.score.page');
    Route::resource('province/score', 'ProvinceControlScoreController', ['as' => 'admin.province']);

    /* 代理商列表管理路由 */
    Route::delete('agent/delete', 'AgentController@deleteByIds')->name('admin.agent.delete');
    Route::get('agent/page', 'AgentController@getListByPageId')->name('admin.agent.page');
    Route::match(['GET', 'PUT'], 'agent/{agent_id}/change', 'AgentController@changeMobile')->name('admin.agent.change');
    Route::match(['GET', 'PUT'], 'agent/{agent_id}/assign', 'AgentController@assignAgentProvince')->name('admin.agent.assign');
    Route::resource('agent', 'AgentController', ['as' => 'admin']);

    /* 学生列表管理路由 */
    Route::delete('student/delete', 'StudentController@deleteByIds')->name('admin.student.delete');
    Route::get('student/page', 'StudentController@getListByPageId')->name('admin.student.page');
    Route::match(['GET', 'PUT'], 'student/{student_id}/change', 'StudentController@changeMobile')->name('admin.student.change');
    Route::match(['GET', 'PUT'], 'student/{student_id}/more', 'StudentController@inputMore')->name('admin.student.assign');
    Route::resource('student', 'StudentController', ['as' => 'admin']);

    /* 地域管理路由 -> 省份管理界面 */
    Route::delete('province/delete', 'ProvinceController@deleteByIds')->name('admin.province.delete');
    Route::get('province/page', 'ProvinceController@getListByPageId')->name('admin.province.page');
    Route::resource('province', 'ProvinceController', ['as' => 'admin']);

    /* 序列号使用记录管理路由 */
    Route::get('serial/record/page', 'SerialNumberRecordController@getListByPageId')->name('admin.serial.record.page');
    Route::get('serial/record/export', 'SerialNumberRecordController@export')->name('admin.serial.record.export');
    Route::resource('serial/record', 'SerialNumberRecordController', ['as' => 'admin.serial']);

    /* 序列号管理路由 */
    Route::get('serial/page', 'SerialNumberController@getListByPageId')->name('admin.serial.page');
    Route::get('serial/export', 'SerialNumberController@export')->name('admin.serial.export');
    Route::resource('serial', 'SerialNumberController', ['as' => 'admin']);

    /* 测评管理路由 */
    Route::get('assessment/page', 'AssessmentController@getListByPageId')->name('admin.assessment.page');
    Route::resource('assessment', 'AssessmentController', ['as' => 'admin']);

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