<?php
/**
 * HTTP 请求服务类
 * User: jason
 * Date: 2018/9/17
 * Time: 上午10:33
 */

namespace App\Services;

use GuzzleHttp\Client;

class  SeniorHttpService
{
    private $client;

    /**
     * GuzzleHttpService constructor.
     */
    public function __construct()
    {
        $this->client = new Client([
            'headers' => [
                'User-Agent' => RandUserAgentService::getRandUserAgent(),
                'Content-Type' => 'application/x-www-form-urlencoded; charset=gn2312',
            ],
            'cookies' => true,
        ]);
    }

    /**
     * 初级报告 post 发送方法
     *
     * @param $data
     * @return \Psr\Http\Message\StreamInterface
     */
    public function post($data)
    {
        $response = $this->client->post(config('assessment.apesk_senior_api'),
            [
                'form_params' => $data,
                'headers' => [
                    'Referer' => config('assessment.referer_api'),
                ],
            ]
        );

        if ($response->getStatusCode() == 200) {
            return $response->getBody();
        }
    }
}