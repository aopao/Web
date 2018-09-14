<?php
/**
 * Province 模型数据处理层
 * User: jason
 * Date: 2018/9/14
 * Time: 上午10:36
 */

namespace App\Repositories\Eloquent;

use App\Models\Area;
use App\Models\City;
use App\Models\Province;

class ProvinceRepository extends Repository
{
    /**
     * 实例化 Province 模型对象
     *
     * @return string
     */
    public function model()
    {
        return Province::class;
    }

    /**
     * 根据 ID 查询省份信息
     *
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * 获取所有省份
     *
     * @return mixed
     */
    public function getAllProvinces()
    {
        return $this->model->all();
    }

    /**
     * 根绝省份 ID 获取所有的城市列表
     *
     * @param $id
     * @return \Illuminate\Support\Collection
     */
    public function getAllCityByProvinceId($id)
    {
        return City::where("province_id", $id)->get();
    }

    /**
     * 根据城市 ID 获取所有地区
     *
     * @param $id
     * @return \Illuminate\Support\Collection
     */
    public function getAllAreaByCityId($id)
    {
        return Area::where("city_id", $id)->get();
    }
}