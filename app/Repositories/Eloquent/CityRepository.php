<?php
/**
 * City 模型数据处理层
 * User: jason
 * Date: 2018/9/14
 * Time: 下午10:31
 */

namespace App\Repositories\Eloquent;

use App\Models\Area;
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

    /**
     * 获取所有城市总数
     *
     * @param $request
     * @return mixed
     */
    public function getAllCount($request)
    {
        if ($request->get('province_id')) {
            return $this->model->where('province_id', $request->get('province_id'))->count();
        } else {
            return $this->model->count();
        }
    }

    /**
     * 获取所有城市
     *
     * @return mixed
     */
    public function getAllProvinces()
    {
        return $this->model->all();
    }

    /**
     * 城市分页
     *
     * @param $request
     * @return mixed
     */
    public function getAllByPage($request)
    {
        $page = $request->get('page') - 1;
        $limit = $request->get('limit');
        $offset = $page * $limit;

        $sql = $this->model->skip($offset)->limit($limit)
            ->with('province')->orderBy('province_id', 'asc');
        if ($request->get('province_id')) {
            return $sql->where('province_id', $request->get('province_id'))->get();
        } else {
            return $sql->get();
        }
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
     * 存储城市信息
     *
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return $this->model->create($data);
    }

    /**
     * 根据 ID 更新城市数据
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
     * 删除单个城市信息
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * 批量删除城市信息
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