<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckMobile implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * 判断手机号是否合法
     *
     * @param  string $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return preg_match("/^1[345678]{1}\d{9}$/", $value) ? true : false;
    }

    /**
     * 手机号不合法返回的错误信息
     *
     * @return string
     */
    public
    function message()
    {
        return '手机号码不合法,请重新输入!';
    }
}
