<?php

namespace App\Http\Controllers\Agent;

/**
 * Class DashboardController
 *
 * @package App\Http\Controllers\Admin
 */
class DashboardController extends BaseController
{
    /**
     * 管理后台首页构造函数
     * DashboardController constructor.
     */
    public function __construct()
    {

    }

    /**
     * 管理后台首页视图
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('agent.dashboard.index');
    }
}
