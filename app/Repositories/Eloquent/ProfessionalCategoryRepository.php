<?php
/**
 * ProfessionalCategory 模型数据处理层
 * User: jason
 * Date: 2018/9/14
 * Time: 下午10:31
 */

namespace App\Repositories\Eloquent;

use App\Models\ProfessionalCategory;

class ProfessionalCategoryRepository extends Repository
{
    /**
     * 实例化 ProfessionalCategory 模型对象
     *
     * @return string
     */
    public function model()
    {
        return ProfessionalCategory::class;
    }

    /**
     * 根据 ID 查询专业大分类信息
     *
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * 获取所有专业大分类
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->get();
    }

    /**
     * 获取所有专业大分类总数
     *
     * @param $request
     * @return mixed
     */
    public function getAllCount($request=null)
    {
        if ($request->get('parent_id')) {
            return $this->model->where('parent_id', $request->get('parent_id'))->count();
        } else {
            return $this->model->count();
        }
    }

    /**
     * 专业大分类分页
     *
     * @param $request
     * @return mixed
     */
    public function getAllByPage($request)
    {
        $page = $request->get('page') - 1;
        $limit = $request->get('limit');
        $offset = $page * $limit;

        $sql = $this->model->skip($offset)->limit($limit);
        if ($request->get('parent_id')) {
            return $sql->where('parent_id', $request->get('parent_id'))->get();
        } else {
            return $sql->get();
        }
    }

    /**
     * 存储专业大分类信息
     *
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return $this->model->create($data);
    }

    /**
     * 根据 ID 更新专业大分类数据
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
     * 判断是否有子分类
     *
     * @param $ids
     * @return bool
     */
    public function checkHasSon($ids)
    {
        $has_son = false;
        if (is_array($ids)) {
            foreach ($ids as $value) {
                $res = $this->model->where('parent_id', $value)->exists();
                if ($res) {
                    $has_son = true;
                }
            }

            return $has_son;
        } else {
            return $this->model->where('parent_id', $ids)->exists();
        }
    }

    /**
     * 删除专业大分类信息
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        if (! $this->checkHasSon($id)) {
            return $this->model->destroy($id);
        } else {
            return '201';
        }
    }

    /**
     * 批量删除专业大分类信息
     *
     * @param $ids
     * @return mixed
     */
    public function batchDelete($ids)
    {
        $id_array = array_filter(explode('|', $ids));
        if (! $this->checkHasSon($ids)) {
            return $this->destroy($id_array);
        } else {
            return '201';
        }
    }

    /**
     * 根据传入参数获取专业分类
     *
     * @param null $parent_id
     * @return mixed
     */
    public function getAllProfessionalCategories($parent_id = null)
    {
        if ($parent_id >= 0) {
            return $this->model->where('parent_id', $parent_id)->get();
        } else {
            return $this->model->get();
        }
    }
}