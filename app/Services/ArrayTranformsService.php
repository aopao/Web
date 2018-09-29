<?php
/**
 * 将数组内非字符串类型转换成字符
 * User: jason
 * Date: 2018/9/17
 * Time: 下午1:38
 */

namespace App\Services;

class ArrayTranformsService
{
    /**
     * 将数组内非字符串类型转换成字符
     *
     * @param $array
     */
    public function arrayValuesToInt(&$array)
    {
        if (is_array($array)) {
            foreach ($array as &$arrayPiece) {
                $this->arrayValuesToInt($arrayPiece);
            }
        } else {
            $array = (string) $array;
        }
    }

    /**
     * 将含有utf-8的中文数组转为gb2312
     *
     * @param array  $arr         数组
     * @param string $in_charset  原字符串编码
     * @param string $out_charset 输出的字符串编码
     * @return array
     */
    public function arrayCharsetIconv($arr, $in_charset = "utf-8", $out_charset = "gb2312")
    {
        return eval('return '.iconv($in_charset, $out_charset, var_export($arr, true).';'));
    }
}