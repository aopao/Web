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
     * 获取所有省份总数
     *
     * @return mixed
     */
    public function getAllCount()
    {
        return $this->model->count();
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
     * 省份分页
     *
     * @param $data
     * @return mixed
     */
    public function getAllByPage($data)
    {
        $page = $data['page'] - 1;
        $limit = $data['limit'];
        $offset = $page * $limit;

        return $this->model->skip($offset)->limit($limit)->get();
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

    /**
     * 根据 ID 更新省份数据
     *
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        return $this->model->where('id', $id)->update($data);
    }

    /**
     * 删除单个省份信息
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * 批量删除省份信息
     *
     * @param $ids
     * @return mixed
     */
    public function batchDelete($ids)
    {
        $id_array = array_filter(explode('|', $ids));

        return $this->destroy($id_array);
    }
}