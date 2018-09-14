<?php
/**
 * City 模型转换层
 * User: jason
 * Date: 2018/9/14
 * Time: 上午9:12
 */

namespace App\Api\V1\Transformers;

use App\Models\City;
use League\Fractal\TransformerAbstract;

class CityTransformer extends TransformerAbstract
{
    public function transform(City $city)
    {
        return [
            'id' => $city['id'],
            'province_id' => $city['province_id'],
            'city_name' => $city['city_name'],
        ];
    }
}