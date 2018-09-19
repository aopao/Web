<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\Eloquent\StudentLoginLogRepository;

class StudentLoginLogController extends ApiController
{
    /**
     * @var \App\Repositories\Eloquent\StudentLoginLogRepository
     */
    private $studentLoginLogRepository;

    /**
     * AdminLoginLogController constructor.
     *
     * @param \App\Repositories\Eloquent\StudentLoginLogRepository $studentLoginLogRepository
     */
    public function __construct(StudentLoginLogRepository $studentLoginLogRepository)
    {
        parent::__construct();
        $this->studentLoginLogRepository = $studentLoginLogRepository;
    }

    /**
     * 查看学生登录日志首页视图方法
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.log.student.login');
    }

    /**
     * 获取学生登录日志分页列表,返回给前端
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListByPageId(Request $request)
    {
        $count = $this->studentLoginLogRepository->getAllCount($request);

        $admin_list = $this->studentLoginLogRepository->getAllByPage($request);

        return $this->responsePage($count, $admin_list);
    }
}
