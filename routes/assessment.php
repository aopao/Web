<?php
/**
 * 测评模块管理路由
 * User: jason
 * Date: 2018/9/28
 * Time: 下午6:54
 */

/* 获取配置文件中学生会员中心的前缀地址 */
define('ASSESSMENT_PREFIX', config('assessment.assessment_prefix'));

/* 序列号测评处理路由 */
Route::namespace('Assessment')->prefix(ASSESSMENT_PREFIX)->group(function () {
    /* 初级评测 */
    Route::get('/', 'PrimaryController@index');
    Route::get('/primary/', 'PrimaryController@index')->name('assessment.primary');
    Route::post('/primary/issue', 'PrimaryController@issue')->name('assessment.primary.issue');
    Route::post('/primary/collect', 'PrimaryController@collect')->name('assessment.primary.collect');
    Route::post('/primary/report', 'PrimaryController@report')->name('assessment.primary.report');

    /* 高级评测 */
    Route::get('/senior/', 'SeniorController@index')->name('assessment.senior');
    Route::post('/senior/issue', 'SeniorController@issue')->name('assessment.senior.issue');
    Route::post('/senior/collect', 'SeniorController@collect')->name('assessment.senior.collect');
    Route::post('/senior/report', 'SeniorController@report')->name('assessment.senior.report');

    /* 初级评测 */
    Route::get('/', 'MbtiOurController@index');
    Route::get('/mb/', 'MbtiOurController@index')->name('assessment.mb');
    Route::post('/mb', 'MbtiOurController@index');
});

Route::namespace('Assessment')->prefix(ASSESSMENT_PREFIX)->middleware('StudentAuth:student')->group(function () {
    /* 学生后台测评处理路由 */
});