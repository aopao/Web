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
     * 将本站需要的数据剥离出来
     *
     * @param $data
     * @return array
     */
    public static function PrimarySplitData(&$data)
    {
        $private_data['serial_number_id'] = array_pull($data, 'serial_number_id');
        $private_data['serial_number'] = array_pull($data, 'serial_number');
        $private_data['mobile'] = array_pull($data, 'mobile');
        $private_data['username'] = array_pull($data, 'username');
        $private_data['_token'] = array_pull($data, '_token');

        return $private_data;
    }

    /**
     * 生成 APi接口中所需的模拟数据
     *
     * @return array
     */
    public static function mockPrimaryApiData()
    {
        $randChineseNameService = new RandChineseNameService();
        $randEmailService = new RandEmailService();

        return [
            'test_name' => $randChineseNameService->getName(2),
            'test_email' => $randEmailService->get_email(),
            'feishi' => ceil(rand(10, 25)),
            'hr_email' => $randEmailService->get_email(),
            'host' => '',
            'zyfou' => 'yes',
            'code' => '',
            'tishu' => 93,
            'sex' => 'female',
        ];
    }
}