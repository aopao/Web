<?php
/**
 * Config 模型数据处理层
 * User: jason
 * Date: 2018/9/13
 * Time: 下午10:31
 */

namespace App\Repositories\Eloquent;

use App\Models\Config;

class ConfigRepository extends Repository
{
    /**
     * 实例化 Config 模型对象
     *
     * @return string
     */
    public function model()
    {
        return Config::class;
    }

    /**
     * 获取所有的配置信息
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->get();
    }

    /**
     * 创建新的配置文件
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->model->create($data);
    }
}