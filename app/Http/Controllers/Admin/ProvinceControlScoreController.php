<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Eloquent\CollegeRepository;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\ProvinceRepository;
use App\Http\Requests\ProvinceControlScoreRequest;
use App\Repositories\Eloquent\ProvinceControlScoreRepository;

class ProvinceControlScoreController extends ApiController
{
    /**
     * @var \App\Repositories\Eloquent\ProvinceControlScoreRepository
     */
    private $provinceControlScoreRepository;

    /**
     * @var \App\Repositories\Eloquent\ProvinceRepository
     */
    private $provinceRepository;

    /**
     * ProvinceControlScoreController constructor.
     *
     * @param \App\Repositories\Eloquent\ProvinceControlScoreRepository $provinceControlScoreRepository
     * @param \App\Repositories\Eloquent\ProvinceRepository             $provinceRepository
     */
    public function __construct(ProvinceControlScoreRepository $provinceControlScoreRepository, ProvinceRepository $provinceRepository)
    {
        parent::__construct();
        $this->provinceControlScoreRepository = $provinceControlScoreRepository;
        $this->provinceRepository = $provinceRepository;
    }

    /**
     * 省控线首页视图方法
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = $this->provinceRepository->getAllProvinces();

        return view('admin.college.province_control_score.index', compact('provinces'));
    }

    /**
     * 获取省控线管理分页列表,返回给前端
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListByPageId(Request $request)
    {

        $count = $this->provinceControlScoreRepository->getAllCount($request);

        $province_control_score_list = $this->provinceControlScoreRepository->getAllByPage($request);

        return $this->responsePage($count, $province_control_score_list);
    }

    /**
     * 添加省控线方法
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.college.province_control_score.create');
    }

    /**
     * 处理添加省控线方法
     *
     * @param \App\Http\Requests\ProvinceControlScoreRequest $provinceControlScoreRequest
     * @return void
     */
    public function store(ProvinceControlScoreRequest $provinceControlScoreRequest)
    {
        if ($this->provinceControlScoreRepository->store($provinceControlScoreRequest->all())) {
            return redirect()->back()->with("message", "添加成功");
        } else {
            return redirect()->back()->with("message", "添加失败");
        }
    }

    /**
     * 编辑省控线方法
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = $this->provinceControlScoreRepository->findById($id);

        return view('admin.college.province_control_score.edit', compact('info'));
    }

    /**
     * 处理编辑省控线方法
     *
     * @param \App\Http\Requests\ProvinceControlScoreRequest $provinceControlScoreRequest
     * @param  int                                           $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProvinceControlScoreRequest $provinceControlScoreRequest, $id)
    {
        if ($this->provinceControlScoreRepository->update($id, $provinceControlScoreRequest->except(['_token', '_method']))) {
            return redirect()->back()->with("message", "修改成功");
        } else {
            return redirect()->back()->with("message", "修改失败");
        }
    }

    /**
     * 历年省控线图图表分析页面
     *
     * @param                                              $id
     * @param \App\Repositories\Eloquent\CollegeRepository $collegeRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id, CollegeRepository $collegeRepository)
    {
        /* 获取当前省份的具体信息 */
        $province_data = [];
        $province_data['info'] = $this->provinceRepository->findById($id);
        $province_data['province_college_sum'] = $collegeRepository->getAllCountByProvinceId($id);
        $province_data['year_interval'] = $this->provinceControlScoreRepository->getYearInterval($id);

        /* 历年理科柱状对比图 */
        $math = $this->provinceControlScoreRepository->parseSubjectCharsByProvinceId($id, 1)->Toarray();
        $math = $this->provinceControlScoreRepository->arrayToStringJson($math);

        /* 历年文科柱状对比图 */
        $art = $this->provinceControlScoreRepository->parseSubjectCharsByProvinceId($id, 0)->Toarray();
        $art = $this->provinceControlScoreRepository->arrayToStringJson($art);

        return view('admin.college.province_control_score.show', compact('province_data', 'math', 'art'));
    }

    /**
     * 删除单个省控线方法
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if ($this->provinceControlScoreRepository->destroy($id)) {
            return $this->responseSuccess();
        }
    }

    /**
     * 批量删除省控线方法
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteByIds(Request $request)
    {
        $ids = $request->get('ids', '|');
        if ($this->provinceControlScoreRepository->batchDelete($ids)) {
            return $this->responseSuccess();
        }
    }
}
