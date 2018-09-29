<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\StudentRequest;
use App\Repositories\Eloquent\StudentRepository;

class StudentController extends ApiController
{
    /**
     * @var \App\Repositories\Eloquent\StudentRepository
     */
    private $studentRepository;

    /**
     * CollegeCategoryController constructor.
     *
     * @param \App\Repositories\Eloquent\StudentRepository $studentRepository
     */
    public function __construct(StudentRepository $studentRepository)
    {
        parent::__construct();
        $this->studentRepository = $studentRepository;
    }

    /**
     * 学生首页视图方法
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.student.index');
    }

    /**
     * 获取学生分页列表,返回给前端
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListByPageId(Request $request)
    {
        $count = $this->studentRepository->getAllCount($request);

        $article_list = $this->studentRepository->getAllByPage($request);

        return $this->responsePage($count, $article_list);
    }

    /**
     * 添加学生方法
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.student.create');
    }

    /**
     * 处理添加学生方法
     *
     * @param \App\Http\Requests\StudentRequest $studentRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StudentRequest $studentRequest)
    {
        if ($this->studentRepository->store($studentRequest->all())) {
            return redirect()->back()->with("message", "添加成功");
        } else {
            return redirect()->back()->with("message", "添加失败");
        }
    }

    /**
     * 根据学生 ID 修改手机号
     *
     * @param                          $student_id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changeMobile($student_id, Request $request)
    {
        if ($request->method() == 'GET') {
            $info = $this->studentRepository->findById($student_id);

            return view('admin.student.change', compact('info'));
        } else {
            $res = $this->studentRepository->update($student_id, $request->except(['_token', '_method']));
            if ($res == 1) {
                $data['message'] = '修改成功';
                $data['status_code'] = 200;

                return redirect()->back()->with("data", $data);
            } else {
                $data['message'] = '修改失败,手机号必须唯一!';
                $data['status_code'] = 400;

                return redirect()->back()->with("data", $data);
            }
        }
    }

    /**
     * 修改学生方法
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = $this->studentRepository->findById($id);

        return view('admin.student.edit', compact('info'));
    }

    /**
     * 处理修改学生方法
     *
     * @param                                           $id
     * @param \App\Http\Requests\StudentRequest         $studentRequest
     * @return \Illuminate\Http\Response
     */
    public function update($id, StudentRequest $studentRequest)
    {
        if ($this->studentRepository->update($id, $studentRequest->except(['_token', '_method']))) {
            return redirect()->back()->with("message", "修改成功");
        } else {
            return redirect()->back()->with("message", "修改失败");
        }
    }

    public function inputMore($student_id)
    {
        return 111;
    }

    /**
     * 删除学生方法
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if ($this->studentRepository->destroy($id)) {
            return $this->responseSuccess();
        }
    }

    /**
     * 批量删除学生方法
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteByIds(Request $request)
    {
        $ids = $request->get('ids', '|');
        if ($this->studentRepository->batchDelete($ids)) {
            return $this->responseSuccess();
        }
    }
}
