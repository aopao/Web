<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
//use App\Http\Requests\ProfessionalCategoryRequest;
use App\Repositories\Eloquent\MajorRepository;

class MajorController extends ApiController
{
    /**
     * @var \App\Repositories\Eloquent\MajorRepository
     */
    private $majorRepository;

    /**
     * CollegeCategoryController constructor.
     *
     * @param \App\Repositories\Eloquent\MajorRepository $majorRepository
     */
    public function __construct(MajorRepository $majorRepository)
    {
        parent::__construct();
        $this->majorRepository = $majorRepository;
    }

    /**
     * 专业列表首页视图方法
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.major.index');
    }

    /**
     * 获取专业列表分页列表,返回给前端
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListByPageId(Request $request)
    {
        $count = $this->majorRepository->getAllCount($request);

        $major_list = $this->majorRepository->getAllByPage($request);

        return $this->responsePage($count, $major_list);
    }

    /**
     * 添加专业列表方法
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.major.create');
    }

    /**
     * 处理添加专业列表方法
     *
     * @param \App\Http\Requests\ProfessionalCategoryRequest $professionalCategoryRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProfessionalCategoryRequest $professionalCategoryRequest)
    {
        if ($this->majorRepository->store($professionalCategoryRequest->all())) {
            return redirect()->back()->with("message", "添加成功");
        } else {
            return redirect()->back()->with("message", "添加失败");
        }
    }

    /**
     * 专业详细信息展示方法
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $info = $this->majorRepository->findAllById($id)->ToArray();

        return view('admin.major.show', compact('info'));
    }

    /**
     * 修改专业列表方法
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = $this->majorRepository->findById($id);

        return view('admin.major.edit', compact('info'));
    }

    /**
     * 处理修改专业列表方法
     *
     * @param                                                   $id
     * @param \App\Repositories\Eloquent\MajorRepository        $majorRepository
     * @return \Illuminate\Http\Response
     */
    public function update($id, MajorRepository $majorRepository)
    {
        if ($this->majorRepository->update($id, $majorRepository->except(['_token', '_method']))) {
            return redirect()->back()->with("message", "修改成功");
        } else {
            return redirect()->back()->with("message", "修改失败");
        }
    }

    /**
     * 删除专业列表方法
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $code = $this->majorRepository->destroy($id);
        if ($code && $code != '201') {
            return $this->responseSuccess();
        } else {
            return $this->setStatusCode(201)->responseErrors();
        }
    }

    /**
     * 批量删除专业列表方法
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteByIds(Request $request)
    {
        $ids = $request->get('ids', '|');
        $code = $this->majorRepository->batchDelete($ids);
        if ($code && $code != '201') {
            return $this->responseSuccess();
        } else {
            return $this->setStatusCode(201)->responseErrors();
        }
    }
}
