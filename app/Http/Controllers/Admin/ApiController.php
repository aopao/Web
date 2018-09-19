<?php

namespace App\Http\Controllers\Admin;

/**
 * Class ApiController
 *
 * @package App\Http\Controllers\Admin
 */
class ApiController extends BaseController
{
    /**
     * 默认返回码
     *
     * @var int
     */
    private $statusCode = 200;

    /**
     * ApiController constructor.
     *
     * @param $statusCode
     */
    public function __construct($statusCode = 200)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * 获取返回的状态码
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * 设置返回的状态码
     *
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * 返回 Json 模式
     *
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function response($data)
    {
        return response()->json($data);
    }

    /**
     * 返回自定义的错误 Json 格式
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseErrors($message = 'Not Found')
    {
        return $this->response([
            'code' => 0,
            'status_code' => $this->statusCode,
            'msg' => $message,
        ]);
    }

    /**
     * 返回自定义的成功 Json 格式
     *
     * @param        $data
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseSuccess($data = [], $message = 'Success')
    {
        return $this->response([
            'code' => 0,
            'status_code' => 200,
            'msg' => $message,
            'data' => $data,
        ]);
    }

    /**
     * 返回自定义的分页 Json 格式
     *
     * @param        $data
     * @param int    $count
     * @return \Illuminate\Http\JsonResponse
     */
    public function responsePage($count = 0, $data = [])
    {
        return $this->response([
            'code' => 0,
            'status_code' => $this->statusCode,
            'msg' => '',
            'count' => $count,
            'data' => $data,
        ]);
    }
}