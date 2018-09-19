<?php
/**
 * 所有数据模型的基类
 * User: jason
 * Date: 2018/9/14
 * Time: 下午2:03
 */

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    /**
     * 批量插入数据
     *
     * @param array $data
     * @return mixed
     */
    public function addAll(Array $data)
    {
        $rs = DB::table($this->getTable())->insert($data);

        return $rs;
    }
}