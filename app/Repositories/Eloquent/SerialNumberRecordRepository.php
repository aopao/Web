<?php
/**
 * SerialNumberRecord 模型数据处理层
 * User: jason
 * Date: 2018/9/14
 * Time: 下午10:31
 */

namespace App\Repositories\Eloquent;

use App\Models\SerialNumberRecord;
use Illuminate\Http\Request;

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
     * 获取所有序列号使用记录信息
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->get();
    }

    /**
     * 获取所有序列号使用记录信息总数
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function getAllCount(Request $request)
    {
        $mobile = $request->get('admin');
        $range_date = $request->get('range_date');

        if ($mobile || $range_date) {
            $sql = $this->model->where('admin_mobile', 'like', '%'.$mobile.'%');
            if ($range_date) {
                $date_array = explode('~', $range_date);
                if (count($date_array) == 2) {
                    $start_date = trim($date_array[0]);
                    $end_date = trim($date_array[1]);
                    $sql->whereBetween('created_at', [$start_date, $end_date]);
                }
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
    public
    function getAllByPage(
        $request
    ) {

        $page = $request->get('page') - 1;
        $limit = $request->get('limit');
        $offset = $page * $limit;
        $mobile = $request->get('admin');
        $range_date = $request->get('range_date');

        $sql = $this->model->skip($offset)->limit($limit);
        if ($mobile || $range_date) {
            $sql = $sql->where('admin_mobile', 'like', '%'.$mobile.'%');
            if ($range_date) {
                $date_array = explode('~', $range_date);
                if (count($date_array) == 2) {
                    $start_date = trim($date_array[0]);
                    $end_date = trim($date_array[1]);
                    $sql->whereBetween('created_at', [$start_date, $end_date]);
                }
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