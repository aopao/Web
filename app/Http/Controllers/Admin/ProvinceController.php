<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\ProvinceRequest;
use App\Repositories\Eloquent\provinceRepository;

class ProvinceController extends ApiController
{
    /**
     * @var \App\Repositories\Eloquent\CollegeCategoryRepository
     */
    private $provinceRepository;

    /**
     * CollegeCategoryController constructor.
     *
     * @param \App\Repositories\Eloquent\ProvinceRepository $provinceRepository
     */
    public function __construct(ProvinceRepository $provinceRepository)
    {
        parent::__construct();
        $this->provinceRepository = $provinceRepository;
    }

    /**
     * 省份管理首页视图方法
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.region.province.index');
    }

    /**
     * 获取省份管理分页列表,返回给前端
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListByPageId(Request $request)
    {
        $count = $this->provinceRepository->getAllCount();

        $province_list = $this->provinceRepository->getAllByPage($request->all());

        return $this->responsePage($count, $province_list);
    }

    /**
     * 添加省份方法
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.region.province.create');
    }

    /**
     * 处理省份方法
     *
     * @param \App\Http\Requests\ProvinceRequest $provinceRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProvinceRequest $provinceRequest)
    {
        if ($this->provinceRepository->store($provinceRequest->all())) {
            return redirect()->back()->with("message", "添加成功");
        } else {
            return redirect()->back()->with("message", "添加失败");
        }
    }

    /**
     * 修改省份方法
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = $this->provinceRepository->findById($id);

        return view('admin.region.province.edit', compact('info'));
    }

    /**
     * 处理修改省份方法
     *
     * @param                                           $id
     * @param \App\Http\Requests\ProvinceRequest        $provinceRequest
     * @return \Illuminate\Http\Response
     */
    public function update($id, ProvinceRequest $provinceRequest)
    {
        if ($this->provinceRepository->update($id, $provinceRequest->except(['_token', '_method']))) {
            return redirect()->back()->with("message", "修改成功");
        } else {
            return redirect()->back()->with("message", "修改失败");
        }
    }

    /**
     * 删除单个省份方法
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if ($this->provinceRepository->destroy($id)) {
            return $this->responseSuccess();
        }
    }

    /**
     * 批量删除省份方法
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteByIds(Request $request)
    {
        $ids = $request->get('ids', '|');
        if ($this->provinceRepository->batchDelete($ids)) {
            return $this->responseSuccess();
        }
    }
}
