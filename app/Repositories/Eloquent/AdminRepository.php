<?php
/**
 * Admin 模型数据处理层
 * User: jason
 * Date: 2018/9/13
 * Time: 下午10:31
 */

namespace App\Repositories\Eloquent;

use App\Models\Admin;

class AdminRepository extends Repository
{
    /**
     * 实例化 Admin 模型对象
     *
     * @return string
     */
    public function model()
    {
        return Admin::class;
    }

    /**
     * 根据 ID 查询用户信息
     *
     * @param $id
     * @return mixed
     */
    public function findBy($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * 创建新的管理员用户
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->model->create($data);
    }
}