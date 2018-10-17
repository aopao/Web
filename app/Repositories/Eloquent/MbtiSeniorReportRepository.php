<?php
/**
 * MbtiSeniorReportRepository 模型数据处理层
 * User: jason
 * Date: 2018/10/8
 * Time: 上午10:36
 */

namespace App\Repositories\Eloquent;

use App\Models\HollandProfessional;
use App\Models\MbtiSeniorReport;
use App\Models\Professional;

class MbtiSeniorReportRepository extends Repository
{
    /**
     * 实例化 MbtiSeniorReportRepository 模型对象
     *
     * @return string
     */
    public function model()
    {
        return MbtiSeniorReport::class;
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
            'mobile' => $data['serial_number_record_data']['mobile'],
            'username' => $data['serial_number_record_data']['username'],
            'serial_number' => $data['serial_number_record_data']['serial_number'],
            'mbti_name' => $data['parse_data']['mbti']['name'],
            'mbti_category_id' => $data['parse_data']['mbti']['mbti_category_id'],
            'mbti_e' => $data['parse_data']['mbti']['result']['E'],
            'mbti_i' => $data['parse_data']['mbti']['result']['I'],
            'mbti_s' => $data['parse_data']['mbti']['result']['S'],
            'mbti_n' => $data['parse_data']['mbti']['result']['N'],
            'mbti_t' => $data['parse_data']['mbti']['result']['T'],
            'mbti_f' => $data['parse_data']['mbti']['result']['F'],
            'mbti_j' => $data['parse_data']['mbti']['result']['J'],
            'mbti_p' => $data['parse_data']['mbti']['result']['P'],
            'holland_name' => $data['parse_data']['holland']['professional_code'],
            'holland_r' => $data['parse_data']['holland']['scale']['R'],
            'holland_i' => $data['parse_data']['holland']['scale']['I'],
            'holland_a' => $data['parse_data']['holland']['scale']['A'],
            'holland_s' => $data['parse_data']['holland']['scale']['S'],
            'holland_e' => $data['parse_data']['holland']['scale']['E'],
            'holland_c' => $data['parse_data']['holland']['scale']['C'],
            'subject_scale' => $data['parse_data']['holland']['subject_scale'],
            'answer' => $data['answers'],
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