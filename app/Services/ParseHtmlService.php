<?php
/**
 * 解析 html 代码页面
 * User: jason
 * Date: 2018/9/17
 * Time: 上午10:33
 */

namespace App\Services;

class  ParseHtmlService
{
    /**
     * 获取报告 ID
     *
     * @param $html
     * @return bool|mixed|string
     */
    static public function getReportId($html)
    {
        $pattern = "/src=\"(.*?)\"/";
        if (preg_match($pattern, $html, $arr)) {
            if (is_array($arr) && isset($arr[1])) {
                $url = parse_url($arr[1]);
                parse_str($url['query'], $arr);

                return isset($arr['theid']) ? $arr['theid'] : '-1';
            }
        }

        return false;
    }
}