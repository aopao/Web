<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\BatchRequest;
use App\Repositories\Eloquent\BatchRepository;

class BatchController extends ApiController
{
    /**
     * @var \App\Repositories\Eloquent\CollegeCategoryRepository
     */
    private $batchRepository;

    /**
     * CollegeCategoryController constructor.
     *
     * @param \App\Repositories\Eloquent\BatchRepository $batchRepository
     */
    public function __construct(BatchRepository $batchRepository)
    {
        parent::__construct();
        $this->batchRepository = $batchRepository;
    }

    /**
     * 录取批次首页视图方法
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.batch.index');
    }

    /**
     * 获取录取批次分页列表,返回给前端
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListByPageId(Request $request)
    {
        $count = $this->batchRepository->getAllCount();

        $article_list = $this->batchRepository->getAllByPage($request->all());

        return $this->responsePage($count, $article_list);
    }

    /**
     * 添加录取批次方法
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.batch.create');
    }

    /**
     * 处理添加录取批次方法
     *
     * @param \App\Http\Requests\BatchRequest $batchRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BatchRequest $batchRequest)
    {
        if ($this->batchRepository->store($batchRequest->all())) {
            return redirect()->back()->with("message", "添加成功");
        } else {
            return redirect()->back()->with("message", "添加失败");
        }
    }

    /**
     * 修改录取批次方法
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = $this->batchRepository->findById($id);

        return view('admin.batch.edit', compact('info'));
    }

    /**
     * 处理修改录取批次方法
     *
     * @param                                           $id
     * @param \App\Http\Requests\BatchRequest           $batchRequest
     * @return \Illuminate\Http\Response
     */
    public function update($id, BatchRequest $batchRequest)
    {
        if ($this->batchRepository->update($id, $batchRequest->except(['_token', '_method']))) {
            return redirect()->back()->with("message", "修改成功");
        } else {
            return redirect()->back()->with("message", "修改失败");
        }
    }

    /**
     * 删除录取批次方法
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if ($this->batchRepository->destroy($id)) {
            return $this->responseSuccess();
        }
    }

    /**
     * 批量删除录取批次方法
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteByIds(Request $request)
    {
        $ids = $request->get('ids', '|');
        if ($this->batchRepository->batchDelete($ids)) {
            return $this->responseSuccess();
        }
    }
}
