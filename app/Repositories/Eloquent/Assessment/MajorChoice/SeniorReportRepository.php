<?php
/**
 * MajorChoiceSeniorReport 模型数据处理层
 * User: jason
 * Date: 2018/10/8
 * Time: 上午10:36
 */

namespace App\Repositories\Eloquent\Assessment\MajorChoice;

use App\Models\MajorChoiceSeniorReport;
use App\Repositories\Eloquent\Repository;

class SeniorReportRepository extends Repository
{
    /**
     * 实例化 MajorChoiceSeniorReport 模型对象
     *
     * @return string
     */
    public function model()
    {
        return MajorChoiceSeniorReport::class;
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
     * 根据 serial_number 查询报告
     *
     * @param $serial_number
     * @return mixed
     */
    public function findBySerialNumber($serial_number)
    {
        return $this->model->where('serial_number', $serial_number)->first();
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
        //$data = $this->model->with('serialNumberRecord', 'MbtiCategory')->where('serial_number', $serial_number)->first();
        $data = $this->model->with('MbtiCategory')->where('serial_number', $serial_number)->first();
        if ($data) {
            $data = $data->toArray();
        }

        return $data;
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
     * 插入数据
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        $insert_data = [
            'mobile' => $data['serial_number']['mobile'],
            'username' => $data['serial_number']['username'],
            'serial_number' => $data['serial_number']['serial_number'],
            'mbti_name' => $data['response']['mbti']['name'],
            'mbti_category_id' => $data['response']['mbti']['mbti_category_id'],
            'mbti_e' => $data['response']['mbti']['result']['E'],
            'mbti_i' => $data['response']['mbti']['result']['I'],
            'mbti_s' => $data['response']['mbti']['result']['S'],
            'mbti_n' => $data['response']['mbti']['result']['N'],
            'mbti_t' => $data['response']['mbti']['result']['T'],
            'mbti_f' => $data['response']['mbti']['result']['F'],
            'mbti_j' => $data['response']['mbti']['result']['J'],
            'mbti_p' => $data['response']['mbti']['result']['P'],
            'holland_name' => $data['response']['holland']['professional_code'],
            'holland_r' => $data['response']['holland']['ratio']['R'],
            'holland_i' => $data['response']['holland']['ratio']['I'],
            'holland_a' => $data['response']['holland']['ratio']['A'],
            'holland_s' => $data['response']['holland']['ratio']['S'],
            'holland_e' => $data['response']['holland']['ratio']['E'],
            'holland_c' => $data['response']['holland']['ratio']['C'],
            'subject_ratio' => json_encode($data['response']['holland']['subject_ratio'], JSON_UNESCAPED_UNICODE),
            'answer' => json_encode($data, JSON_UNESCAPED_UNICODE),
        ];

        return $this->model->create($insert_data);
    }

    /**
     * 批量插入数据
     *
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return $this->model->addAll($data);
    }
}