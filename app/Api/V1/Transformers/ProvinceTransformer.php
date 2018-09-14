<?php
/**
 * Province 模型转换层
 * User: jason
 * Date: 2018/9/14
 * Time: 上午9:12
 */

namespace App\Api\V1\Transformers;

use App\Models\Province;
use League\Fractal\TransformerAbstract;

class ProvinceTransformer extends TransformerAbstract
{
    public function transform(Province $province)
    {
        return [
            'id' => $province['id'],
            'province_name' => $province['province_name'],
        ];
    }
}