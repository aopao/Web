<?php
/**
 * MbtiPrimaryReportRepository 模型数据处理层
 * User: jason
 * Date: 2018/10/8
 * Time: 上午10:36
 */

namespace App\Repositories\Eloquent;

use App\Models\MbtiPrimaryReport;

class MbtiPrimaryReportRepository extends Repository
{
    /**
     * 实例化 MbtiPrimaryReportRepository 模型对象
     *
     * @return string
     */
    public function model()
    {
        return MbtiPrimaryReport::class;
    }

    /**
     * 根据 ID 查询报告
     *
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * 获取所有报告总数
     *
     * @return mixed
     */
    public function getAllCount()
    {
        return $this->model->count();
    }

    /**
     * 根据序列号来获取此序列号所有关联信息
     *
     * @param $serial_number
     * @return mixed
     */
    public function getAllInfoBySerialNumber($serial_number)
    {
        return $this->model->with('serialNumberRecord', 'MbtiCategory')->first();
    }

    /**
     * 报告分页
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
     * 根据 ID 更新报告数据
     *
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return $this->model->addAll($data);
    }
}