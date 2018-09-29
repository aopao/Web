<?php

namespace App\Http\Controllers\Admin;

use App\Services\SerialNumberService;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\SerialNumberRepository;

class SerialNumberController extends ApiController
{
    /**
     * @var \App\Repositories\Eloquent\SerialNumberRepository
     */
    private $serialNumberRepository;

    /**
     * CollegeCategoryController constructor.
     *
     * @param \App\Repositories\Eloquent\SerialNumberRepository $serialNumberRepository
     */
    public function __construct(SerialNumberRepository $serialNumberRepository)
    {
        parent::__construct();
        $this->serialNumberRepository = $serialNumberRepository;
    }

    /**
     * 序列号首页视图方法
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.serial.index');
    }

    /**
     * 获取序列号分页列表,返回给前端
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListByPageId(Request $request)
    {
        $count = $this->serialNumberRepository->getAllCount($request);

        $province_list = $this->serialNumberRepository->getAllByPage($request);

        return $this->responsePage($count, $province_list);
    }

    /**
     * 添加序列号方法
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.serial.create');
    }

    /**
     * 处理序列号方法
     *
     * @param \Illuminate\Http\Request          $request
     * @param \App\Services\SerialNumberService $serialNumberService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, SerialNumberService $serialNumberService)
    {
        ini_set('memory_limit', '500M');
        set_time_limit(0);//设置超时限制为0分钟
        $data = $serialNumberService->getSerialnunmbers($request->get('sum', 0), $request->get('is_senior', 0));
        if ($this->serialNumberRepository->addAll($data)) {
            return redirect()->back()->with("message", "添加成功");
        } else {
            return redirect()->back()->with("message", "添加失败");
        }
    }
}
