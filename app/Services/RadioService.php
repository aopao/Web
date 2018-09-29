<?php
/**
 * 选择表单服务类
 * User: jason
 * Date: 2018/9/17
 * Time: 上午10:33
 */

namespace App\Services;

class RadioService
{
    /**
     * 根据传入的 id 判断是否选中
     *
     * @param $value
     * @param $db_value
     * @return string
     */
    public function isChecked($value, $db_value)
    {
        $ckecked = null;
        if ($value === $db_value) {
            return "checked=\"checked\"";
        }
    }
}