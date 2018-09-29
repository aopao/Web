<?php

namespace App\Services;

/**
 * 随机生成邮箱地址
 * Class RandEmailService
 *
 * @package App\Services
 */
Class  RandEmailService
{
    /**
     * 随机邮箱后缀
     *
     * @return array
     */
    public function email_suffix()
    {
        return [
            '@qq.com',
            '@vip.qq.com',
            '@vip.163.com',
            '@126.com',
            '@139.com',
            '@188.com',
            '@sohu.com',
            '@sina.com',
            '@outlook.com',
            '@msn.com',
            '@msn.com',
            '@gmail.com',
            '@yahoo.com',
            '@hotmail.com',
            '@live.com',
            '@sogou.com',
        ];
    }

    /**
     * 邮箱名
     *
     * @param int $length
     * @return string
     */
    public function email_prefix($length = 6)
    {
        $email = "";
        $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for ($i = $length; $i > 0; $i--) {
            $email .= $char[mt_rand(0, strlen($char) - 1)];
        }

        return $email;
    }

    /**
     * 获取随机邮箱
     *
     * @return string
     */
    public function get_email()
    {
        $length = ceil(rand(4, 8));
        $email_prefix = self::email_prefix($length);
        $email_suffix_key = array_rand(self::email_suffix());
        $email_suffix = self::email_suffix();
        $email_suffix_value = $email_suffix[$email_suffix_key];

        return $email_prefix.$email_suffix_value;
    }
}