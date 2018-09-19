<?php
/**
 * 将数组内非字符串类型转换成字符
 * User: jason
 * Date: 2018/9/17
 * Time: 下午1:38
 */

namespace App\Services;

class ArrayTranforms
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
}