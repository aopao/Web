<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\Eloquent\AgentLoginLogRepository;

class AgentLoginLogController extends ApiController
{
    /**
     * @var \App\Repositories\Eloquent\AgentLoginLogRepository
     */
    private $agentLoginLogRepository;

    /**
     * AdminLoginLogController constructor.
     *
     * @param \App\Repositories\Eloquent\AgentLoginLogRepository $agentLoginLogRepository
     */
    public function __construct(AgentLoginLogRepository $agentLoginLogRepository)
    {
        parent::__construct();
        $this->agentLoginLogRepository = $agentLoginLogRepository;
    }

    /**
     * 查看代理商登录日志首页视图方法
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.log.agent.login');
    }

    /**
     * 获取代理商登录日志分页列表,返回给前端
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListByPageId(Request $request)
    {
        $count = $this->agentLoginLogRepository->getAllCount($request);

        $admin_list = $this->agentLoginLogRepository->getAllByPage($request);

        return $this->responsePage($count, $admin_list);
    }
}
