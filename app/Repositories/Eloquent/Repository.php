<?php
/**
 * 所有模型的抽象数据处理类
 * User: jason
 * Date: 2018/9/13
 * Time: 下午10:28
 */

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\BaseInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;

abstract class Repository implements BaseInterface
{
    protected $app;     //App容器

    protected $model;   //操作model

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    abstract function model();

    public function findBy($id)
    {
        return $this->model->find($id);
    }

    public function makeModel()
    {
        $model = $this->app->make($this->model());
        /*是否是Model实例*/
        if (! $model instanceof Model) {
            Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }
        $this->model = $model;
    }
}

