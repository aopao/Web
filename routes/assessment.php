<?php
/**
 * 测评模块管理路由
 * User: jason
 * Date: 2018/9/28
 * Time: 下午6:54
 */

/* 获取配置文件中学生会员中心的前缀地址 */
define('ASSESSMENT_PREFIX', config('assessment.assessment_prefix'));
define('ASSESSMENT_MBTI_PREFIX', config('assessment.assessment_mbti_prefix'));
define('ASSESSMENT_HOLLAND_PREFIX', config('assessment.assessment_holland_prefix'));
define('ASSESSMENT_MAJOR_CHOICE_PREFIX', config('assessment.assessment_major_choice_prefix'));

/* 序列号测评处理路由 */
Route::namespace('Assessment')->prefix(ASSESSMENT_PREFIX)->group(function () {

    /* MBTI评测 */
    Route::namespace('MBTI')->prefix(ASSESSMENT_MBTI_PREFIX)->group(function () {

        /* MBTI 初级评测[28道题] TODO */
        //Route::get('/', 'PrimaryController@index');
        //Route::get('/primary/', 'PrimaryController@index')->name('assessment.primary');
        //Route::get('/primary/{serial_number}', 'PrimaryController@show')->name('assessment.primary.show');
        //Route::post('/primary/issue', 'PrimaryController@issue')->name('assessment.primary.issue');
        //Route::post('/primary/collect', 'PrimaryController@collect')->name('assessment.primary.collect');
        //Route::post('/primary/report', 'PrimaryController@report')->name('assessment.primary.report');

        /* MBTI 高级评测[93道题] */
        Route::get('/', 'SeniorController@index');
        Route::get('/senior/', 'SeniorController@index')->name('assessment.mbti.senior');
        Route::get('/senior/{serial_number}', 'SeniorController@show')->name('assessment.mbti.senior.show');
        Route::post('/senior/issue', 'SeniorController@issue')->name('assessment.mbti.senior.issue');
        Route::post('/senior/collect', 'SeniorController@collect')->name('assessment.mbti.senior.collect');
        Route::post('/senior/report', 'SeniorController@report')->name('assessment.mbti.senior.report');
    });

    Route::namespace('Holland')->prefix(ASSESSMENT_HOLLAND_PREFIX)->group(function () {

        /* 高级评测[霍兰德] */
        Route::get('/senior/', 'SeniorController@index')->name('assessment.senior');
        Route::get('/senior/{serial_number}', 'SeniorController@show')->name('assessment.senior.show');
        Route::post('/senior/issue', 'SeniorController@issue')->name('assessment.senior.issue');
        Route::post('/senior/collect', 'SeniorController@collect')->name('assessment.senior.collect');
        Route::post('/senior/report', 'SeniorController@report')->name('assessment.senior.report');
    });

    Route::namespace('MajorChoice')->prefix(ASSESSMENT_MAJOR_CHOICE_PREFIX)->group(function () {

        /* 高级评测[霍兰德+MBTI] */
        Route::get('/senior/', 'SeniorController@index')->name('assessment.senior');
        Route::get('/senior/{serial_number}', 'SeniorController@show')->name('assessment.senior.show');
        Route::post('/senior/issue', 'SeniorController@issue')->name('assessment.senior.issue');
        Route::post('/senior/collect', 'SeniorController@collect')->name('assessment.senior.collect');
        Route::post('/senior/report', 'SeniorController@report')->name('assessment.senior.report');
    });

    /* 初级评测 */
    Route::get('/mb/', 'MbtiOurController@index')->name('assessment.mb');
    Route::post('/mb', 'MbtiOurController@index');
    Route::get('/sb/', 'MbtiOurController@senior')->name('assessment.sb');
    Route::post('/sb', 'MbtiOurController@senior');
    Route::get('/zy/', 'MbtiOurController@zy')->name('assessment.zy');
    Route::get('/sho/', 'MbtiOurController@holland_single')->name('assessment.sho');
    Route::get('/ho/', 'MbtiOurController@holland')->name('assessment.ho');
    Route::get('/btz/', 'MbtiOurController@btz')->name('assessment.bzk');
    Route::get('/sp/', 'MbtiOurController@sp')->name('assessment.sp');
    Route::get('/pp/', 'MbtiOurController@pp')->name('assessment.pp');
    Route::get('/cpp/', 'MbtiOurController@cpp')->name('assessment.cpp');
    Route::get('/orm/', 'MbtiOurController@orm')->name('assessment.orm
    ');
});

Route::namespace('Assessment')->prefix(ASSESSMENT_PREFIX)->middleware('StudentAuth:student')->group(function () {
    /* 学生后台测评处理路由 */
});