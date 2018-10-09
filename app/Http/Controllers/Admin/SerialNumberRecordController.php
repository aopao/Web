<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\Eloquent\SerialNumberRecordRepository;

class SerialNumberRecordController extends ApiController
{
    /**
     * @var \App\Repositories\Eloquent\SerialNumberRecordRepository
     */
    private $serialNumberRecordRepository;

    /**
     * SerialNumberRecordController constructor.
     *
     * @param \App\Repositories\Eloquent\SerialNumberRecordRepository $serialNumberRecordRepository
     */
    public function __construct(SerialNumberRecordRepository $serialNumberRecordRepository)
    {
        parent::__construct();
        $this->serialNumberRecordRepository = $serialNumberRecordRepository;
    }

    /**
     * 序列号使用记录首页视图方法
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.serial.record.index');
    }

    /**
     * 获取序列号使用记录分页列表,返回给前端
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListByPageId(Request $request)
    {
        $count = $this->serialNumberRecordRepository->getAllCount($request);

        $province_list = $this->serialNumberRecordRepository->getAllByPage($request);

        return $this->responsePage($count, $province_list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $info = $this->serialNumberRecordRepository->getAllById($id);

        return view('admin.serial.record.show', compact('info'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
