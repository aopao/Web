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

    /**
     * 获取所有地区总数
     *
     * @param $request
     * @return mixed
     */
    public function getAllCount($request)
    {
        if ($request->get('city_id')) {
            return $this->model->where('city_id', $request->get('city_id'))->count();
        } else {
            return $this->model->count();
        }
    }

    /**
     * 地区分页
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
            ->with('city')->orderBy('city_id', 'asc');
        if ($request->get('city_id')) {
            return $sql->where('city_id', $request->get('city_id'))->get();
        } else {
            return $sql->get();
        }
    }

    /**
     * 根据地区 ID 获取所有地区
     *
     * @param $id
     * @return \Illuminate\Support\Collection
     */
    public function getAllAreaByCityId($id)
    {
        return Area::where("city_id", $id)->get();
    }

    /**
     * 存储地区信息
     *
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return $this->model->create($data);
    }

    /**
     * 根据 ID 更新地区数据
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
     * 删除单个地区信息
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * 批量删除地区信息
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