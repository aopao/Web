<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\CollegeLevelRequest;
use App\Repositories\Eloquent\CollegeLevelRepository;

class CollegeLevelController extends ApiController
{
    /**
     * @var \App\Repositories\Eloquent\CollegeCategoryRepository
     */
    private $collegeLevelRepository;

    /**
     * CollegeCategoryController constructor.
     *
     * @param \App\Repositories\Eloquent\CollegeLevelRepository $collegeLevelRepository
     */
    public function __construct(CollegeLevelRepository $collegeLevelRepository)
    {
        parent::__construct();
        $this->collegeLevelRepository = $collegeLevelRepository;
    }

    /**
     * 大学分类首页视图方法
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.college.level.index');
    }

    /**
     * 获取大学分类分页列表,返回给前端
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListByPageId(Request $request)
    {
        $count = $this->collegeLevelRepository->getAllCount();

        $college_level_list = $this->collegeLevelRepository->getAllByPage($request->all());

        return $this->responsePage($count, $college_level_list);
    }

    /**
     * 添加大学分类页面方法
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.college.level.create');
    }

    /**
     * 处理大学分类页面方法
     *
     * @param \App\Http\Requests\CollegeLevelRequest $collegeLevelRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CollegeLevelRequest $collegeLevelRequest)
    {
        if ($this->collegeLevelRepository->store($collegeLevelRequest->all())) {
            return redirect()->back()->with("message", "添加成功");
        } else {
            return redirect()->back()->with("message", "添加失败");
        }
    }

    /**
     * 修改大学分类页面方法
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = $this->collegeLevelRepository->findById($id);

        return view('admin.college.level.edit', compact('info'));
    }

    /**
     * 处理修改大学分类页面方法
     *
     * @param                                           $id
     * @param \App\Http\Requests\CollegeLevelRequest    $collegeLevelRequest
     * @return \Illuminate\Http\Response
     */
    public function update($id, CollegeLevelRequest $collegeLevelRequest)
    {
        if ($this->collegeLevelRepository->update($id, $collegeLevelRequest->except(['_token', '_method']))) {
            return redirect()->back()->with("message", "修改成功");
        } else {
            return redirect()->back()->with("message", "修改失败");
        }
    }

    /**
     * 删除大学分类页面方法
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if ($this->collegeLevelRepository->destroy($id)) {
            return $this->responseSuccess();
        }
    }
}
