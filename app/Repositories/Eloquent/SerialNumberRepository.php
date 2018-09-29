<?php
/**
 * SerialNumber 模型数据处理层
 * User: jason
 * Date: 2018/9/28
 * Time: 上午10:36
 */

namespace App\Repositories\Eloquent;

use App\Models\SerialNumber;

class SerialNumberRepository extends Repository
{
    /**
     * 实例化 SerialNumber 模型对象
     *
     * @return string
     */
    public function model()
    {
        return SerialNumber::class;
    }

    /**
     * 根据 ID 查询序列号
     *
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * 根据 number 查询序列号
     *
     * @param $number
     * @return mixed
     */
    public function findByNumber($number)
    {
        return $this->model->where('number', $number)->first();
    }

    /**
     * 获取所有序列号总数
     *
     * @return mixed
     */
    public function getAllCount()
    {
        return $this->model->count();
    }

    /**
     * 获取所有序列号
     *
     * @return mixed
     */
    public function getAllSerialNumbers()
    {
        return $this->model->all();
    }

    /**
     * 序列号分页
     *
     * @param $data
     * @return mixed
     */
    public function getAllByPage($data)
    {
        $page = $data['page'] - 1;
        $limit = $data['limit'];
        $offset = $page * $limit;

        return $this->model->orderBy('created_at', 'desc')
            ->skip($offset)->limit($limit)->get();
    }

    /**
     * 根据 ID 更新序列号数据
     *
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return $this->model->addAll($data);
    }
}