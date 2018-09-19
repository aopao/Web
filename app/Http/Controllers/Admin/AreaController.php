<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\CityRequest;
use App\Repositories\Eloquent\AreaRepository;
use App\Repositories\Eloquent\CityRepository;
use App\Repositories\Eloquent\provinceRepository;

class AreaController extends ApiController
{
    /**
     * @var \App\Repositories\Eloquent\provinceRepository
     */
    private $provinceRepository;

    /**
     * @var \App\Repositories\Eloquent\CityRepository
     */
    private $cityRepository;

    /**
     * @var \App\Repositories\Eloquent\AreaRepository
     */
    private $areaRepository;

    /**
     * CollegeCategoryController constructor.
     *
     * @param \App\Repositories\Eloquent\provinceRepository $provinceRepository
     * @param \App\Repositories\Eloquent\CityRepository     $cityRepository
     * @param \App\Repositories\Eloquent\AreaRepository     $areaRepository
     */
    public function __construct(ProvinceRepository $provinceRepository, CityRepository $cityRepository, AreaRepository $areaRepository)
    {
        parent::__construct();
        $this->cityRepository = $cityRepository;
        $this->areaRepository = $areaRepository;
        $this->provinceRepository = $provinceRepository;
    }

    /**
     * 省份管理首页视图方法
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $province = $this->provinceRepository->getAllProvinces();
        $citys = $this->cityRepository->getAllProvinces();

        return view('admin.region.city.index', compact('province', 'citys'));
    }

    /**
     * 获取省份管理分页列表,返回给前端
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListByPageId(Request $request)
    {
        $count = $this->cityRepository->getAllCount($request);

        $city_list = $this->cityRepository->getAllByPage($request);

        return $this->responsePage($count, $city_list);
    }

    /**
     * 添加省份方法
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.region.city.create');
    }

    /**
     * 处理省份方法
     *
     * @param \App\Http\Requests\CityRequest $cityRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CityRequest $cityRequest)
    {
        if ($this->cityRepository->store($cityRequest->all())) {
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
        $info = $this->cityRepository->findById($id);

        return view('admin.region.city.edit', compact('info'));
    }

    /**
     * 处理修改省份方法
     *
     * @param                                           $id
     * @param \App\Http\Requests\CityRequest            $cityRequest
     * @return \Illuminate\Http\Response
     */
    public function update($id, CityRequest $cityRequest)
    {
        if ($this->cityRepository->update($id, $cityRequest->except(['_token', '_method']))) {
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
        if ($this->cityRepository->destroy($id)) {
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
        if ($this->cityRepository->batchDelete($ids)) {
            return $this->responseSuccess();
        }
    }
}
