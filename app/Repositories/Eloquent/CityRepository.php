<?php
/**
 * City 模型数据处理层
 * User: jason
 * Date: 2018/9/14
 * Time: 下午10:31
 */

namespace App\Repositories\Eloquent;

use App\Models\City;

class CityRepository extends Repository
{
    /**
     * 实例化 City 模型对象
     *
     * @return string
     */
    public function model()
    {
        return City::class;
    }

    /**
     * 根据 ID 查询城市信息
     *
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model->where('id', $id)->first();
    }
}