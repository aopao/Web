<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\CollegeCategoryRequest;
use App\Repositories\Eloquent\CollegeCategoryRepository;

class CollegeCategoryController extends ApiController
{
    /**
     * @var \App\Repositories\Eloquent\CollegeCategoryRepository
     */
    private $categoryRepository;

    /**
     * CollegeCategoryController constructor.
     *
     * @param \App\Repositories\Eloquent\CollegeCategoryRepository $categoryRepository
     */
    public function __construct(CollegeCategoryRepository $categoryRepository)
    {
        parent::__construct();
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * 大学分类首页视图方法
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.college.category.index');
    }

    /**
     * 获取大学分类分页列表,返回给前端
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListByPageId(Request $request)
    {
        $count = $this->categoryRepository->getAllCount();

        $college_category_list = $this->categoryRepository->getAllByPage($request->all());

        return $this->responsePage($count, $college_category_list);
    }

    /**
     * 添加大学分类页面方法
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.college.category.create');
    }

    /**
     * 处理大学分类页面方法
     *
     * @param \App\Http\Requests\CollegeCategoryRequest $collegeCategoryRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CollegeCategoryRequest $collegeCategoryRequest)
    {
        if ($this->categoryRepository->store($collegeCategoryRequest->all())) {
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
        $info = $this->categoryRepository->findById($id);

        return view('admin.college.category.edit', compact('info'));
    }

    /**
     * 处理修改大学分类页面方法
     *
     * @param                                           $id
     * @param \App\Http\Requests\CollegeCategoryRequest $categoryRequest
     * @return \Illuminate\Http\Response
     */
    public function update($id, CollegeCategoryRequest $categoryRequest)
    {
        if ($this->categoryRepository->update($id, $categoryRequest->except(['_token', '_method']))) {
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
        if ($this->categoryRepository->destroy($id)) {
            return $this->responseSuccess();
        }
    }
}
