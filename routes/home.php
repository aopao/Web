<?php
/**
 * 前台管理后台路由
 * User: jason
 * Date: 2018/9/13
 * Time: 下午6:54
 */

/* 前端处理路由 */
Route::namespace('Home')->group(function () {
    Route::get('/', 'IndexController@index')->name('home.index');
    Route::prefix("project")->group(function () {
        Route::get('/', 'ProjectController@index')->name('project.index');
        Route::get('/college', 'ProjectController@college')->name('project.college');
        Route::get('/major', 'ProjectController@major')->name('project.major');
        Route::get('/province/score', 'ProjectController@ProvinceScore')->name('project.ProvinceScore');
    });
});