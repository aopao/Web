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
    'assessment_prefix' => env('ASSESSMENT_PREFIX', "assessment"),
    'primary_referer_api' => env('PRIMARY_REFERER_API', "http://www.apesk.com"),
    'apesk_api' => env('APESK_API', "http://cp.17985.cn/mensa/common_submit_hr/submit_mbti_conn_mm.asp"),
];