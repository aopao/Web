<?php
/**
 * MbtiCategoryRepository 模型数据处理层
 * User: jason
 * Date: 2018/10/9
 * Time: 上午10:36
 */

namespace App\Repositories\Eloquent;

use App\Models\MbtiCategory;

class MbtiCategoryRepository extends Repository
{
    /**
     * 实例化 MbtiCategoryRepository 模型对象
     *
     * @return string
     */
    public function model()
    {
        return MbtiCategory::class;
    }

    /**
     * 根据 ID 查询MBTI类型
     *
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * 获取所有MBTI类型总数
     *
     * @return mixed
     */
    public function getAllCount()
    {
        return $this->model->count();
    }

    /**
     * 根据MBTI短代码获取此类型的信息
     *
     * @param $mbti_short_code
     * @return mixed
     */
    public function findByMbtiShortCode($mbti_short_code)
    {
        return $this->model->where('mbti_short_code', $mbti_short_code)->select('id')->first();
    }

    /**
     * MBTI类型分页
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
     * 根据 ID 更新MBTI类型数据
     *
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return $this->model->addAll($data);
    }
}