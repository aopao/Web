<?php

namespace App\Http\Controllers\Student;

/**
 * Class DashboardController
 *
 * @package App\Http\Controllers\Student
 */
class DashboardController extends BaseController
{
    /**
     * 学生会员中心首页构造函数
     * DashboardController constructor.
     */
    public function __construct()
    {

    }

    /**
     * 学生会员中心首页视图
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('student.dashboard.index');
    }
}
