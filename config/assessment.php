<?php
/**
 * 测评模块配置文件
 * User: jason
 * Date: 2018/9/13
 * Time: 上午10:14
 */
return [

    /*
    |--------------------------------------------------------------------------
    | Assessment Module Config Config
    |--------------------------------------------------------------------------
    */
    'api_mock' => env('API_MOCK', "true"),
    'api_mock_id' => env('API_MOCK_ID', "95556"),
    'assessment_prefix' => env('ASSESSMENT_PREFIX', "assessment"),
    'referer_api' => env('PRIMARY_REFERER_API', "http://www.apesk.com"),
    'apesk_primary_api' => env('APESK_PRIMARY_API', "http://www.apesk.com.gqxxg.com/assessment/primary/report"),
    'apesk_senior_api' => env('APESK_SENIOR_API', "http://www.apesk.com.gqxxg.com/assessment/senior/report"),
    'reprot_parse_time' => env('REPORT_PARSE_TIME', 9),
];