<?php
/**
 * Area 模型转换层
 * User: jason
 * Date: 2018/9/14
 * Time: 上午9:12
 */

namespace App\Api\V1\Transformers;

use App\Models\Area;
use League\Fractal\TransformerAbstract;

class AreaTransformer extends TransformerAbstract
{
    public function transform(Area $area)
    {
        return [
            'id' => $area['id'],
            'city_id' => $area['city_id'],
            'area_name' => $area['area_name'],
        ];
    }
}