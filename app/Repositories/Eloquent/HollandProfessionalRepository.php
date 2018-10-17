<?php
/**
 * HollandProfessional 模型数据处理层
 * User: jason
 * Date: 2018/10/9
 * Time: 上午10:36
 */

namespace App\Repositories\Eloquent;

use App\Models\HollandProfessional;

class HollandProfessionalRepository extends Repository
{
    /**
     * 实例化 HollandProfessional 模型对象
     *
     * @return string
     */
    public function model()
    {
        return HollandProfessional::class;
    }

    /**
     * 根据 ID 查询霍兰德职业代码信息
     *
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * 获取所有霍兰德职业代码信息总数
     *
     * @return mixed
     */
    public function getAllCount()
    {
        return $this->model->count();
    }

    /**
     * 根据霍兰德职业短代码获取此类型的信息
     *
     * @param $name
     * @return mixed
     */
    public function findByName($name)
    {
        $res = $this->model->where('name', $name)->with('professionals')->orderBy('subject', 'ASC')->get();
        if (! empty($res)) {
            $res = $res->toArray();
        }

        return $res;
    }

    /**
     * 霍兰德职业代码信息分页
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
}