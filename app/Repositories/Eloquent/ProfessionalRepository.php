<?php
/**
 * Professional 模型数据处理层
 * User: jason
 * Date: 2018/9/14
 * Time: 下午10:31
 */

namespace App\Repositories\Eloquent;

use App\Models\Professional;

class ProfessionalRepository extends Repository
{
    /**
     * 实例化 Professional 模型对象
     *
     * @return string
     */
    public function model()
    {
        return Professional::class;
    }

    /**
     * 根据 ID 查询专业信息
     *
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * 获取所有专业
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->get();
    }

    /**
     * 获取所有专业总数
     *
     * @param null $request
     * @return mixed
     */
    public function getAllCount($request = null)
    {
        if ($request->get('top_parent_id')) {
            return $this->model->where('top_parent_id', $request->get('top_parent_id'))->count();
        } else {
            return $this->model->count();
        }
    }

    /**
     * 专业分页
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
            ->with('professionalDetail:id,professional_id,awarded_degree');
        if ($request->get('top_parent_id')) {
            return $sql->where('top_parent_id', $request->get('top_parent_id'))->get();
        } else {
            return $sql->get();
        }
    }

    /**
     * 存储专业信息
     *
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return $this->model->create($data);
    }

    /**
     * 根据 ID 更新专业数据
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
     * 删除专业信息
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * 批量删除专业信息
     *
     * @param $ids
     * @return mixed
     */
    public function ProfessionalDelete($ids)
    {
        $id_array = array_filter(explode('|', $ids));

        return $this->destroy($id_array);
    }
}