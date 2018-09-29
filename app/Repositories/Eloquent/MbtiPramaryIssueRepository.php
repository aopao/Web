<?php
/**
 * MbtiPrimaryIssue 模型数据处理层
 * User: jason
 * Date: 2018/9/28
 * Time: 上午10:36
 */

namespace App\Repositories\Eloquent;

use App\Models\MbtiPrimaryIssue;

class MbtiPramaryIssueRepository extends Repository
{
    /**
     * 实例化 MbtiPrimaryIssue 模型对象
     *
     * @return string
     */
    public function model()
    {
        return MbtiPrimaryIssue::class;
    }

    /**
     * 根据 ID 查询问题
     *
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * 获取所有问题总数
     *
     * @return mixed
     */
    public function getAllCount()
    {
        return $this->model->count();
    }

    /**
     * 获取所有问题
     *
     * @return mixed
     */
    public function getAllMbtiPrimaryIssues()
    {
        return $this->model->get();
        //return $this->model->limit(5)->get();
    }

    /**
     * 问题分页
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
     * 根据 ID 更新问题数据
     *
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return $this->model->addAll($data);
    }
}