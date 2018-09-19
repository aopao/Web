<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\Eloquent\AdminLoginLogRepository;

class AdminLoginLogController extends ApiController
{
    /**
     * @var \App\Repositories\Eloquent\AdminLoginLogRepository
     */
    private $adminLoginLogRepository;

    /**
     * AdminLoginLogController constructor.
     *
     * @param \App\Repositories\Eloquent\AdminLoginLogRepository $adminLoginLogRepository
     */
    public function __construct(AdminLoginLogRepository $adminLoginLogRepository)
    {
        parent::__construct();
        $this->adminLoginLogRepository = $adminLoginLogRepository;
    }

    /**
     * 查看管理员登录日志首页视图方法
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.log.admin.login');
    }

    /**
     * 获取管理员登录日志分页列表,返回给前端
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListByPageId(Request $request)
    {
        $count = $this->adminLoginLogRepository->getAllCount($request);

        $admin_list = $this->adminLoginLogRepository->getAllByPage($request);

        return $this->responsePage($count, $admin_list);
    }
}
