<?php
/**
 * Area 模型数据处理层
 * User: jason
 * Date: 2018/9/14
 * Time: 下午10:31
 */

namespace App\Repositories\Eloquent;

use App\Models\Area;

class AreaRepository extends Repository
{
    /**
     * 实例化 Area 模型对象
     *
     * @return string
     */
    public function model()
    {
        return Area::class;
    }

    /**
     * 根据 ID 查询地区信息
     *
     * @param $id
     * @return mixed
     */
    public function findBy($id)
    {
        return $this->model->where('id', $id)->first();
    }
}