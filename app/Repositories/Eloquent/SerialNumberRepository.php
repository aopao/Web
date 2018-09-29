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
     * @param $request
     * @return mixed
     */
    public function getAllCount($request)
    {
        $number = $request->get('number');
        $is_senior = $request->get('is_senior');
        $is_invalid = $request->get('is_invalid');

        $sql = $this->model;
        if ($number || $is_senior || $is_senior === '0' || $is_invalid || $is_invalid === '0') {
            if ($number) {
                $sql = $sql->where('number', $number);
            }
            if ($is_senior || $is_senior === '0') {
                $sql = $sql->where('is_senior', $is_senior);
            }
            if ($is_invalid || $is_invalid === '0') {
                $sql = $sql->where('is_invalid', $is_invalid);
            }

            return $sql->count();
        } else {
            return $this->model->count();
        }
    }

    /**
     * 获取所有序列号
     *
     * @return mixed
     */
    public function getAllSerialNumbers()
    {
        return $this->model->limit(10000)->get();

        //return $this->model->all();
    }

    /**
     * 序列号分页
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
        $is_senior = $request->get('is_senior');
        $is_invalid = $request->get('is_invalid');

        $sql = $this->model->skip($offset)->limit($limit)->orderBy('created_at', 'desc');

        if ($number || $is_senior || $is_senior === '0' || $is_invalid || $is_invalid === '0') {
            if ($number) {
                $sql = $sql->where('number', $number);
            }
            if ($is_senior || $is_senior === '0') {
                $sql = $sql->where('is_senior', $is_senior);
            }
            if ($is_invalid || $is_invalid === '0') {
                $sql = $sql->where('is_invalid', $is_invalid);
            }

            return $sql->get();
        } else {
            return $sql->get();
        }
    }

    /**
     * 根据 ID 更新序列号数据
     *
     * @param $data
     * @return mixed
     */
    public function addAll($data)
    {
        return $this->model->addAll($data);
    }

    /**
     * 更新数据
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
     * 更新序列号为已使用
     *
     * @param $id
     * @return mixed
     */
    public function updateInvalid($id)
    {
        return $this->model->where('id', $id)->update(['is_invalid' => 1]);
    }
}