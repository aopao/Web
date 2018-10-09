<?php
/**
 * SerialNumberRecord 模型数据处理层
 * User: jason
 * Date: 2018/9/14
 * Time: 下午10:31
 */

namespace App\Repositories\Eloquent;

use App\Models\Agent;
use App\Models\SerialNumberRecord;

class SerialNumberRecordRepository extends Repository
{
    /**
     * 实例化 SerialNumberRecord 模型对象
     *
     * @return string
     */
    public function model()
    {
        return SerialNumberRecord::class;
    }

    /**
     * 根据 ID 查询序列号使用记录信息
     *
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * 根据 ID 查询序列号记录是否存在
     *
     * @param $serial_number_id
     * @return mixed
     */
    public function findBySerialNumberId($serial_number_id)
    {
        return $this->model->where('serial_number_id', $serial_number_id)->first();
    }

    /**
     * 获取所有序列号使用记录信息
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->get();
    }

    /**
     * 根据序列号 ID 查询关于此序列号的所有信息
     *
     * @param $id
     * @return mixed
     */
    public function getAllById($id)
    {
        $info = $this->model->where('id', $id)->with('student', 'serialNumberInfo')->first();
        if (isset($info['student']['agent_id']) && is_array($info['student'])) {
            $info['agent'] = Agent::where('id', $info['student']['agent_id'])->first();
        }

        return $info;
    }

    /**
     * 获取所有序列号使用记录信息总数
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function getAllCount($request)
    {
        $number = $request->get('number');
        $mobile = $request->get('mobile');
        $assessment_type = $request->get('assessment_type');

        $sql = $this->model;
        if ($number || $assessment_type || $mobile) {
            if ($number) {
                $sql = $sql->where('serial_number', $number);
            }
            if ($mobile) {
                $sql = $sql->where('mobile', 'like', '%'.$mobile.'%');
            }
            if ($assessment_type) {
                $sql = $sql->where('assessment_type', $assessment_type);
            }

            return $sql->count();
        } else {
            return $this->model->count();
        }
    }

    /**
     * 序列号使用记录信息分页
     *
     * @param $request
     * @return mixed
     */
    public function getAllByPage($request)
    {
        $page = $request->get('page') - 1;
        $limit = $request->get('limit');
        $offset = $page * $limit;

        $number = $request->get('number');
        $mobile = $request->get('mobile');
        $assessment_type = $request->get('assessment_type');

        $sql = $this->model->skip($offset)->limit($limit)
            ->orderBy('created_at', 'desc');

        if ($number || $assessment_type || $mobile) {
            if ($number) {
                $sql = $sql->where('serial_number', $number);
            }
            if ($mobile) {
                $sql = $sql->where('mobile', 'like', '%'.$mobile.'%');
            }
            if ($assessment_type) {
                $sql = $sql->where('assessment_type', $assessment_type);
            }

            return $sql->get();
        } else {
            return $sql->get();
        }
    }

    /**
     * 存储序列号记录信息
     *
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return $this->model->create($data);
    }
}