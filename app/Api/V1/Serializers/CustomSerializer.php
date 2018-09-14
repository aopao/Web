<?php
/**
 * TODO.
 * User: jason
 * Date: 2018/9/14
 * Time: 上午10:25
 */

namespace App\Api\V1\Serializers;

use League\Fractal\Serializer\ArraySerializer;

class CustomSerializer extends ArraySerializer
{
    /**
     * 自定义返回的 Json类型
     *
     * @param string $resourceKey
     * @param array  $data
     * @return array
     */
    public function collection($resourceKey, array $data)
    {
        return [
            'message' => 'success',
            'status_code' => 200,
            'data' => $data,
        ];
    }
}