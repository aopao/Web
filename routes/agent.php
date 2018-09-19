<?php
/**
 * 代理商管理后台路由
 * User: jason
 * Date: 2018/9/13
 * Time: 下午6:54
 */
/* 获取配置文件中代理商管理后台的前缀地址 */
define('AGENT_PREFIX', config('agent.agent_prefix'));

/* 后台登录处理 */
Route::namespace('Agent')->prefix(AGENT_PREFIX)->group(function () {
    Route::get('login', 'LoginController@showLoginForm')->name('agent.login');
    Route::post('login', 'LoginController@login');
});

Route::namespace('Agent')->prefix(AGENT_PREFIX)->middleware('AgentAuth:agent')->group(function () {
    Route::get('', 'DashboardController@index')->name('agent.index');
    Route::get('dashboard', 'DashboardController@index')->name('agent.dashboard');
    Route::post('logout', 'LoginController@logout')->name('agent.logout');
});