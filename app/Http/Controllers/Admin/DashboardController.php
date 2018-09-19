<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Eloquent\AdminRepository;

/**
 * Class DashboardController
 *
 * @package App\Http\Controllers\Admin
 */
class DashboardController extends BaseController
{
    private $model;

    /**
     * 管理后台首页构造函数
     * DashboardController constructor.
     *
     * @param \App\Repositories\Eloquent\AdminRepository $adminRepository
     */
    public function __construct(AdminRepository $adminRepository)
    {
        $this->model = $adminRepository;
    }

    /**
     * 管理后台首页视图
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        return view('admin.dashboard.index');
    }

    /**
     * 管理后台右侧首页视图
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        return view("admin.dashboard.show");
    }
}
