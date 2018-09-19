<?php
/**
 * ProvinceControlScore 模型数据处理层
 * User: jason
 * Date: 2018/9/14
 * Time: 上午10:36
 */

namespace App\Repositories\Eloquent;

use App\Models\ProvinceControlScore;
use App\Services\ArrayTranforms;

class ProvinceControlScoreRepository extends Repository
{
    /**
     * 实例化 ProvinceControlScore 模型对象
     *
     * @return string
     */
    public function model()
    {
        return ProvinceControlScore::class;
    }

    /**
     * 根据 ID 查询省控线信息
     *
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model->where('id', $id)->first();
    }


    /**
     * 获取所有省控线总数
     *
     * @param \Request $request
     * @return mixed
     */
    public function getAllCount($request)
    {
        if ($request->get('province_id')) {
            return $this->model->where('province_id', $request->get('province_id'))->count();
        } else {
            return $this->model->count();
        }
    }

    /**
     * 根据省份 ID 获取省控线
     *
     * @param $id
     * @return mixed
     */
    public function getAllProvinceControlScoreByProvinceId($id)
    {
        return $this->model->where('province_id', $id)->orderBy('province_id', 'asc')
            ->orderBy('year', 'desc')
            ->with('province')->get();
    }

    /**
     * 省控线分页
     *
     * @param $request
     * @return mixed
     */
    public function getAllByPage($request)
    {
        $page = $request->get('page') - 1;
        $limit = $request->get('limit');
        $offset = $page * $limit;

        $sql = $this->model->orderBy('province_id', 'asc')
            ->orderBy('year', 'desc')
            ->skip($offset)->limit($limit)
            ->with('province');
        if ($request->get('province_id')) {
            return $sql->where('province_id', $request->get('province_id'))->get();
        } else {
            return $sql->get();
        }
    }

    /**
     * 存储省控线信息
     *
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return $this->model->create($data);
    }

    /**
     * 根据 ID 更新省控线数据
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
     * 删除单个省控线信息
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * 批量删除省控线信息
     *
     * @param $ids
     * @return mixed
     */
    public function batchDelete($ids)
    {
        $id_array = array_filter(explode('|', $ids));

        return $this->destroy($id_array);
    }

    /**
     * 根据省份 ID 获取每年省份文理科柱状图 Json
     *
     * @param          $province_id
     * @param int|null $subject
     * @return mixed
     */
    public function parseSubjectCharsByProvinceId($province_id, int $subject = null)
    {
        $pre = $this->model->where('province_id', $province_id)
            ->select('year', 'batch', 'subject', 'score')
            ->orderBy('year', 'asc');
        if ($subject >= 0) {
            return $pre->where('subject', $subject)->get();
        } else {
            return $pre->get();
        }
    }

    /**
     * 返回G2图表所需的Json格式
     *
     * @param $subject
     * @return string
     */
    public function arrayToStringJson($subject)
    {
        $arrayToJson = new ArrayTranforms();
        $arrayToJson->arrayValuesToInt($subject);

        return json_encode($subject, true);
    }

    /**
     * 获取数据库中当前 ID 省份的年份跨度
     *
     * @param $province_id
     * @return int|mixed
     */
    public function getYearInterval($province_id)
    {
        $year_interval = 0;
        $data = $this->model->where('province_id', $province_id)->orderBy('year', 'asc')->get()->toArray();
        if (is_array($data) && count($data) > 1) {
            $start_year = array_shift($data);
            $end_year = array_pop($data);
            $year_interval = $end_year['year'] - $start_year['year'];
        }

        return $year_interval;
    }
}