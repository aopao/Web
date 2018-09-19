<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

/**
 * 增加 api 接口限制次数  绑定 ip 5分钟内只能请求500次!
 */
$api->version('v1', ['middleware' => 'api.throttle', 'limit' => 500, 'expires' => 5], function ($api) {
    $api->get('/get/js/', ['as' => 'region.js', 'uses' => 'App\Api\V1\Controllers\RegionController@Js']);
    $api->get('/get/provinces/', ['as' => 'region.provinces', 'uses' => 'App\Api\V1\Controllers\RegionController@getAllProvinces']);
    $api->get('/get/province/{id}/', ['as' => 'region.province.cities', 'uses' => 'App\Api\V1\Controllers\RegionController@getAllCityByProvinceId']);
    $api->get('/get/city/{id}/', ['as' => 'region.cities', 'uses' => 'App\Api\V1\Controllers\RegionController@getAllAreaByCityId']);

    $api->get('/get/province/control/score/{province_id}/{subject}', ['as' => 'province.control.score.subject', 'uses' => 'App\Api\V1\Controllers\ProvinceControlScore@parseSubjectCharsByProvinceId']);
});
