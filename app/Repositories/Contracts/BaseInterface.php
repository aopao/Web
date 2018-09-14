<?php
/**
 * 仓库（Repository）模式 所有接口基类
 * User: jason
 * Date: 2018/9/13
 * Time: 下午10:23
 */

namespace App\Repositories\Contracts;

interface BaseInterface
{
    //根绝 ID 查询所有信息
    public function findBy($id);
}