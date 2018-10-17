<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\CollegeDiplomasRequest;
use App\Repositories\Eloquent\CollegeDiplomasRepository;

class CollegeDiplomasController extends ApiController
{
    /**
     * @var \App\Repositories\Eloquent\CollegeCategoryRepository
     */
    private $collegeDiplomasRepository;

    /**
     * CollegeDiplomaController constructor.
     *
     * @param \App\Repositories\Eloquent\CollegeDiplomasRepository $collegeDiplomasRepository
     */
    public function __construct(CollegeDiplomasRepository $collegeDiplomasRepository)
    {
        parent::__construct();
        $this->collegeDiplomasRepository = $collegeDiplomasRepository;
    }

    /**
     * 大学文凭分类首页视图方法
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.college.diplomas.index');
    }

    /**
     * 获取大学文凭分类分页列表,返回给前端
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListByPageId(Request $request)
    {
        $count = $this->collegeDiplomasRepository->getAllCount();

        $college_level_list = $this->collegeDiplomasRepository->getAllByPage($request->all());

        return $this->responsePage($count, $college_level_list);
    }

    /**
     * 添加大学文凭分类页面方法
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.college.diplomas.create');
    }

    /**
     * 处理大学文凭分类页面方法
     *
     * @param \App\Http\Requests\CollegeDiplomasRequest $collegeDiplomasRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CollegeDiplomasRequest $collegeDiplomasRequest)
    {
        if ($this->collegeDiplomasRepository->store($collegeDiplomasRequest->all())) {
            return redirect()->back()->with("message", "添加成功");
        } else {
            return redirect()->back()->with("message", "添加失败");
        }
    }

    /**
     * 修改大学文凭分类页面方法
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = $this->collegeDiplomasRepository->findById($id);

        return view('admin.college.diplomas.edit', compact('info'));
    }

    /**
     * 处理修改大学文凭分类页面方法
     *
     * @param                                           $id
     * @param \App\Http\Requests\CollegeDiplomasRequest $collegeDiplomasRequest
     * @return \Illuminate\Http\Response
     */
    public function update($id, CollegeDiplomasRequest $collegeDiplomasRequest)
    {
        if ($this->collegeDiplomasRepository->update($id, $collegeDiplomasRequest->except(['_token', '_method']))) {
            return redirect()->back()->with("message", "修改成功");
        } else {
            return redirect()->back()->with("message", "修改失败");
        }
    }

    /**
     * 删除大学文凭分类页面方法
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if ($this->collegeDiplomasRepository->destroy($id)) {
            return $this->responseSuccess();
        }
    }
}
