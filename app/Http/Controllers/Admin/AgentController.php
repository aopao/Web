<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\AgentRequest;
use App\Repositories\Eloquent\AgentRepository;

class AgentController extends ApiController
{
    /**
     * @var \App\Repositories\Eloquent\CollegeCategoryRepository
     */
    private $agentRepository;

    /**
     * CollegeCategoryController constructor.
     *
     * @param \App\Repositories\Eloquent\AgentRepository $agentRepository
     */
    public function __construct(AgentRepository $agentRepository)
    {
        parent::__construct();
        $this->agentRepository = $agentRepository;
    }

    /**
     * 代理商首页视图方法
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.agent.index');
    }

    /**
     * 获取代理商分页列表,返回给前端
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListByPageId(Request $request)
    {
        $count = $this->agentRepository->getAllCount($request);

        $article_list = $this->agentRepository->getAllByPage($request);

        return $this->responsePage($count, $article_list);
    }

    /**
     * 添加代理商方法
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.agent.create');
    }

    /**
     * 处理添加代理商方法
     *
     * @param \App\Http\Requests\AgentRequest $agentRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AgentRequest $agentRequest)
    {
        if ($this->agentRepository->store($agentRequest->all())) {
            return redirect()->back()->with("message", "添加成功");
        } else {
            return redirect()->back()->with("message", "添加失败");
        }
    }

    /**
     * 根据代理商 ID 修改手机号
     *
     * @param                          $agent_id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changeMobile($agent_id, Request $request)
    {
        if ($request->method() == 'GET') {
            $info = $this->agentRepository->findById($agent_id);

            return view('admin.agent.change', compact('info'));
        } else {
            if ($this->agentRepository->update($agent_id, $request->except(['_token', '_method']))) {
                return redirect()->back()->with("message", "修改成功");
            } else {
                return redirect()->back()->with("message", "修改失败");
            }
        }
    }

    /**
     * 修改代理商方法
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = $this->agentRepository->findById($id);

        return view('admin.agent.edit', compact('info'));
    }

    /**
     * 处理修改代理商方法
     *
     * @param                                           $id
     * @param \App\Http\Requests\AgentRequest           $agentRequest
     * @return \Illuminate\Http\Response
     */
    public function update($id, AgentRequest $agentRequest)
    {
        if ($this->agentRepository->update($id, $agentRequest->except(['_token', '_method']))) {
            return redirect()->back()->with("message", "修改成功");
        } else {
            return redirect()->back()->with("message", "修改失败");
        }
    }

    /**
     * 删除代理商方法
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if ($this->agentRepository->destroy($id)) {
            return $this->responseSuccess();
        }
    }

    /**
     * 批量删除代理商方法
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteByIds(Request $request)
    {
        $ids = $request->get('ids', '|');
        if ($this->agentRepository->batchDelete($ids)) {
            return $this->responseSuccess();
        }
    }
}
