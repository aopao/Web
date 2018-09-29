<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\CollegeRequest;
use App\Repositories\Eloquent\CollegeRepository;

class CollegeController extends ApiController
{
    /**
     * @var \App\Repositories\Eloquent\CollegeRepository
     */
    private $collegeRepository;

    /**
     * CollegeController constructor.
     *
     * @param \App\Repositories\Eloquent\CollegeRepository $collegeRepository
     */
    public function __construct(CollegeRepository $collegeRepository)
    {
        parent::__construct();
        $this->collegeRepository = $collegeRepository;
    }

    /**
     * 大学首页视图方法
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.college.list.index');
    }

    public function show($id)
    {
        $info = $this->collegeRepository->findById($id);
        return view('admin.college.list.show');

    }

    /**
     * 获取大学分页列表,返回给前端
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListByPageId(Request $request)
    {
        $count = $this->collegeRepository->getAllCount($request);

        $college_list = $this->collegeRepository->getAllByPage($request);

        return $this->responsePage($count, $college_list);
    }

    /**
     * 添加大学页面方法
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.college.list.create');
    }

    /**
     * 处理大学页面方法
     *
     * @param \App\Http\Requests\CollegeRequest $CollegeRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CollegeRequest $CollegeRequest)
    {
        if ($this->collegeRepository->store($CollegeRequest->all())) {
            return redirect()->back()->with("message", "添加成功");
        } else {
            return redirect()->back()->with("message", "添加失败");
        }
    }

    /**
     * 修改大学页面方法
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = $this->collegeRepository->findById($id);

        return view('admin.college.list.edit', compact('info'));
    }

    /**
     * 处理修改大学页面方法
     *
     * @param                                           $id
     * @param \App\Http\Requests\CollegeRequest         $collegeRequest
     * @return \Illuminate\Http\Response
     */
    public function update($id, CollegeRequest $collegeRequest)
    {
        if ($this->collegeRepository->update($id, $collegeRequest->except(['_token', '_method']))) {
            return redirect()->back()->with("message", "修改成功");
        } else {
            return redirect()->back()->with("message", "修改失败");
        }
    }

    /**
     * 删除大学页面方法
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if ($this->collegeRepository->destroy($id)) {
            return $this->responseSuccess();
        }
    }

    /**
     * 批量删除大学方法
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteByIds(Request $request)
    {
        $ids = $request->get('ids', '|');
        if ($this->collegeRepository->batchDelete($ids)) {
            return $this->responseSuccess();
        }
    }
}
