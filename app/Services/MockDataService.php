<?php

namespace App\Services;

/**
 * 生成模拟数据
 * Class RandEmailService
 *
 * @package App\Services
 */
Class  MockDataService
{
    /**
     * 将需要的数据剥离出来
     *
     * @param $data
     * @return array
     */
    public static function parseData($data)
    {
        $serial_data['serial_number_id'] = array_pull($data, 'serial_number_id');
        $serial_data['serial_number'] = array_pull($data, 'serial_number');
        $serial_data['mobile'] = array_pull($data, 'mobile');
        $serial_data['username'] = array_pull($data, 'username');
        $serial_data['_token'] = array_pull($data, '_token');

        return $serial_data;
    }
}