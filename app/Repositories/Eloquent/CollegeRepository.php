<?php
/**
 * College 模型数据处理层
 * User: jason
 * Date: 2018/9/14
 * Time: 下午10:31
 */

namespace App\Repositories\Eloquent;

use App\Models\College;

class CollegeRepository extends Repository
{
    /**
     * 实例化 College 模型对象
     *
     * @return string
     */
    public function model()
    {
        return College::class;
    }

    /**
     * 根据 ID 查询大学信息
     *
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * 获取所有大学
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->get();
    }

    /**
     * 根据省份 ID 获取省内大学总数
     *
     * @param $province_id
     * @return mixed
     */
    public function getAllCountByProvinceId($province_id)
    {
        return $this->model->where('province_id', $province_id)->count();
    }

    /**
     * 获取所有大学总数
     *
     * @param $request
     * @return mixed
     */
    public function getAllCount($request)
    {
        $province_id = $request->get('province_id');
        $name = $request->get('name');
        $sql = $this->model;
        if ($province_id || $name) {
            if ($province_id) {
                $sql = $sql->where('province_id', $province_id);
            }
            if ($name) {
                $sql = $sql->where('name', 'like', '%'.$name.'%');
            }

            return $sql->count();
        } else {
            return $this->model->count();
        }
    }

    /**
     * 大学分页
     *
     * @param $request
     * @return mixed
     */
    public function getAllByPage($request)
    {
        $page = $request->get('page') - 1;
        $limit = $request->get('limit');
        $offset = $page * $limit;

        $province_id = $request->get('province_id');
        $name = $request->get('name');

        $sql = $this->model->skip($offset)->limit($limit)
            ->with('province:id,province_name')
            ->with('collegeDetail:college_id,id')
            ->with('collegeCategory:id,name')
            ->with('collegeDiplomas:id,name')
            ->orderBy('province_id', 'asc');
        if ($province_id || $name) {
            if ($province_id) {
                $sql = $sql->where('province_id', $province_id);
            }
            if ($name) {
                $sql = $sql->where('name', 'like', '%'.$name.'%');
            }

            return $sql->get();
        } else {
            return $sql->get();
        }
    }

    /**
     * 存储大学信息
     *
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return $this->model->create($data);
    }

    /**
     * 根据 ID 更新大学数据
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
     * 删除大学信息
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * 批量删除大学信息
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