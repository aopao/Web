<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\ProfessionalCategoryRequest;
use App\Repositories\Eloquent\ProfessionalCategoryRepository;

class ProfessionalCategoryController extends ApiController
{
    /**
     * @var \App\Repositories\Eloquent\CollegeCategoryRepository
     */
    private $professionalCategoryRepository;

    /**
     * CollegeCategoryController constructor.
     *
     * @param \App\Repositories\Eloquent\ProfessionalCategoryRepository $professionalCategoryRepository
     */
    public function __construct(ProfessionalCategoryRepository $professionalCategoryRepository)
    {
        parent::__construct();
        $this->professionalCategoryRepository = $professionalCategoryRepository;
    }

    /**
     * 专业大分类首页视图方法
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.professional.category.index');
    }

    /**
     * 获取专业大分类分页列表,返回给前端
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListByPageId(Request $request)
    {
        $count = $this->professionalCategoryRepository->getAllCount($request);

        $professional_category_list = $this->professionalCategoryRepository->getAllByPage($request);

        return $this->responsePage($count, $professional_category_list);
    }

    /**
     * 添加专业大分类方法
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.professional.category.create');
    }

    /**
     * 处理添加专业大分类方法
     *
     * @param \App\Http\Requests\ProfessionalCategoryRequest $professionalCategoryRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProfessionalCategoryRequest $professionalCategoryRequest)
    {
        if ($this->professionalCategoryRepository->store($professionalCategoryRequest->all())) {
            return redirect()->back()->with("message", "添加成功");
        } else {
            return redirect()->back()->with("message", "添加失败");
        }
    }

    /**
     * 修改专业大分类方法
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = $this->professionalCategoryRepository->findById($id);

        return view('admin.professional.category.edit', compact('info'));
    }

    /**
     * 处理修改专业大分类方法
     *
     * @param                                                $id
     * @param \App\Http\Requests\ProfessionalCategoryRequest $professionalCategoryRequest
     * @return \Illuminate\Http\Response
     */
    public function update($id, ProfessionalCategoryRequest $professionalCategoryRequest)
    {
        if ($this->professionalCategoryRepository->update($id, $professionalCategoryRequest->except(['_token', '_method']))) {
            return redirect()->back()->with("message", "修改成功");
        } else {
            return redirect()->back()->with("message", "修改失败");
        }
    }

    /**
     * 删除专业大分类方法
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $code = $this->professionalCategoryRepository->destroy($id);
        if ($code && $code != '201') {
            return $this->responseSuccess();
        } else {
            return $this->setStatusCode(201)->responseErrors();
        }
    }

    /**
     * 批量删除专业大分类方法
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteByIds(Request $request)
    {
        $ids = $request->get('ids', '|');
        $code = $this->professionalCategoryRepository->batchDelete($ids);
        if ($code && $code != '201') {
            return $this->responseSuccess();
        } else {
            return $this->setStatusCode(201)->responseErrors();
        }
    }
}
