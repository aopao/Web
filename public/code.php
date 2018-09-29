<?php

class Code
{
    //获取唯一序列号
    public static function generateNum()
    {
        //strtoupper转换成全大写的
        $charid = strtoupper(md5(uniqid(mt_rand())));
        $uuid = substr($charid, 0, 8).substr($charid, 8, 4).substr($charid, 12, 4).substr($charid, 16, 4);

        return $uuid;
    }
}

$s = microtime(true);
$code = new Code();
$aa = [];
for ($i = 1; $i < 100; $i++) {
    $a = $code::generateNum();
    if (in_array($a, $aa)) {
        exit("错误");
    }
    echo $i.":".$a.'<br/>';
}
$e = microtime(true);
echo (($e - $s) * 1000).'ms';
