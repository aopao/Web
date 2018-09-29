<?php
/**
 * Student 模型数据处理层
 * User: jason
 * Date: 2018/9/15
 * Time: 上午10:31
 */

namespace App\Repositories\Eloquent;

use App\Models\Student;

class StudentRepository extends Repository
{
    /**
     * 实例化 Student 模型对象
     *
     * @return string
     */
    public function model()
    {
        return Student::class;
    }

    /**
     * 根据 ID 查询学生信息
     *
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model->find($id);
    }

    /**
     * 获取所有学生信息总数
     *
     * @param null $request
     * @return mixed
     */
    public function getAllCount($request = null)
    {
        $mobile = $request->get('mobile');
        if ($mobile) {
            return $this->model->where('mobile', 'like', '%'.$mobile.'%')->count();
        } else {
            return $this->model->count();
        }
    }

    /**
     * 学生信息分页
     *
     * @param $request
     * @return mixed
     */
    public function getAllByPage($request)
    {
        $page = $request->get('page') - 1;
        $limit = $request->get('limit');
        $offset = $page * $limit;
        $mobile = $request->get('mobile');

        $sql = $this->model->skip($offset)->limit($limit);
        if ($mobile) {
            return $sql->where('mobile', 'like', '%'.$mobile.'%')->get();
        } else {
            return $sql->get();
        }
    }

    /**
     * 存储学生信息信息
     *
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return $this->model->create($data);
    }

    /**
     * 根据 ID 更新学生信息数据
     *
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        if (! isset($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }
        if (isset($data['mobile'])) {
            if ($this->model->where('mobile', $data['mobile'])->exists()) {
                return 400;
            }
        }

        return $this->model->where('id', $id)->update($data);
    }

    /**
     * 删除学生信息信息
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * 批量删除学生信息
     *
     * @param $ids
     * @return mixed
     */
    public function batchDelete($ids)
    {
        $id_array = array_filter(explode('|', $ids));

        return $this->destroy($id_array);
    }
}