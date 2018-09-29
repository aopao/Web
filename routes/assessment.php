<?php
/**
 * 测评模块管理路由
 * User: jason
 * Date: 2018/9/28
 * Time: 下午6:54
 */

/* 获取配置文件中学生会员中心的前缀地址 */
define('ASSESSMENT_PREFIX', config('assessment.assessment_prefix'));

/* 验证码测评处理路由 */
Route::namespace('Assessment')->prefix(ASSESSMENT_PREFIX)->group(function () {
    Route::get('/', 'PrimaryController@index');
    Route::get('/primary/', 'PrimaryController@index')->name('assessment.primary');
    Route::post('/primary/issue', 'PrimaryController@issue')->name('assessment.primary.issue');
    Route::post('/primary/collect', 'PrimaryController@collect')->name('assessment.primary.collect');
    Route::post('/primary/report', 'PrimaryController@report')->name('assessment.primary.report');
});

Route::namespace('Assessment')->prefix(ASSESSMENT_PREFIX)->middleware('StudentAuth:student')->group(function () {
    /* 学生后台测评处理路由 */
});