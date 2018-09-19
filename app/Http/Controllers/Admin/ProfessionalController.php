<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\ProfessionalCategoryRequest;
use App\Repositories\Eloquent\ProfessionalRepository;

class ProfessionalController extends ApiController
{
    /**
     * @var \App\Repositories\Eloquent\ProfessionalRepository
     */
    private $professionalRepository;

    /**
     * CollegeCategoryController constructor.
     *
     * @param \App\Repositories\Eloquent\ProfessionalRepository $professionalRepository
     */
    public function __construct(ProfessionalRepository $professionalRepository)
    {
        parent::__construct();
        $this->professionalRepository = $professionalRepository;
    }

    /**
     * 专业列表首页视图方法
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.professional.list.index');
    }

    /**
     * 获取专业列表分页列表,返回给前端
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListByPageId(Request $request)
    {
        $count = $this->professionalRepository->getAllCount($request);

        $professional_list = $this->professionalRepository->getAllByPage($request);

        return $this->responsePage($count, $professional_list);
    }

    /**
     * 添加专业列表方法
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.professional.list.create');
    }

    /**
     * 处理添加专业列表方法
     *
     * @param \App\Http\Requests\ProfessionalCategoryRequest $professionalCategoryRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProfessionalCategoryRequest $professionalCategoryRequest)
    {
        if ($this->professionalRepository->store($professionalCategoryRequest->all())) {
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
        $info = $this->professionalRepository->findAllById($id)->ToArray();

        return view('admin.professional.list.show', compact('info'));
    }

    /**
     * 修改专业列表方法
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = $this->professionalRepository->findById($id);

        return view('admin.professional.list.edit', compact('info'));
    }

    /**
     * 处理修改专业列表方法
     *
     * @param                                                   $id
     * @param \App\Repositories\Eloquent\ProfessionalRepository $professionalRepository
     * @return \Illuminate\Http\Response
     */
    public function update($id, ProfessionalRepository $professionalRepository)
    {
        if ($this->professionalRepository->update($id, $professionalRepository->except(['_token', '_method']))) {
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
        $code = $this->professionalRepository->destroy($id);
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
        $code = $this->professionalRepository->batchDelete($ids);
        if ($code && $code != '201') {
            return $this->responseSuccess();
        } else {
            return $this->setStatusCode(201)->responseErrors();
        }
    }
}
