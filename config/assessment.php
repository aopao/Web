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
    'cookie_primary_report_prefix' => env('COOKIE_PRIMARY_REPORT_PREFIX', "primary_report"),
    'cookie_senior_report_prefix' => env('COOKIE_SENIOR_REPORT_PREFIX', "senior_report"),
    'reprot_parse_time' => env('REPORT_PARSE_TIME', 9),
    //'subject' => ['chinese' => 1, 'math' => 2, 'english' => 3, 'physics' => 4, 'chemistry' => 5, 'biology' => 6, 'history' => 7, 'politics' => 8, 'geography' => 9],
    'subject' => [
        '1' => 'chinese',
        '2' => 'math',
        '3' => 'english',
        '4' => 'physics',
        '5' => 'chemistry',
        '6' => 'biology',
        '7' => 'history',
        '8' => 'politics',
        '9' => 'geography',
    ],
    'subject_id' => [
        'chinese' => [148, 149, 171, 205, 231, 233, 267],
        'math' => [291, 293, 294, 295, 296, 297, 299],
        'english' => [178, 200, 211, 213, 223, 232, 235],
        'physics' => [130, 137, 182, 190, 248, 251, 301],
        'chemistry' => [135, 138, 193, 256, 258, 247, 302],
        'biology' => [133, 140, 192, 195, 242, 252, 255, 271],
        'history' => [122, 184, 189, 249, 250, 272, 298],
        'politics' => [129, 161, 163, 169, 229, 252, 308],
        'geography' => [125, 131, 139, 183, 188, 196, 260],
    ],
];