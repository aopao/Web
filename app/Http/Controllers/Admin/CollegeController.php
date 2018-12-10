<?php

namespace App\Http\Controllers\Admin;

use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Requests\CollegeRequest;
use App\Repositories\Eloquent\CollegeRepository;
use Maatwebsite\Excel\Facades\Excel;

class CollegeController extends ApiController
{
    /**
     * @var \App\Repositories\Eloquent\CollegeRepository
     */
    private $collegeRepository;

    /**
     * CollegeController constructor.
     *
     * @param \App\Repositories\Eloquent\CollegeRepository $collegeRepository
     */
    public function __construct(CollegeRepository $collegeRepository)
    {
        parent::__construct();
        $this->collegeRepository = $collegeRepository;
    }

    /**
     * 大学首页视图方法
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.college.list.index');
    }

    public function export()
    {
        ini_set('memory_limit', '500M');
        set_time_limit(0);//设置超时限制为0分钟
        $cellData = $this->collegeRepository->getAll();
        Excel::create("new.xlsx", function ($excel) use ($cellData) {
            //创建sheet
            $excel->sheet('sheet1', function ($sheet) use ($cellData) {
                //填充每个单元格的内容
                $sheet->cell('A1', function ($cell) use ($cellData) {
                    $cell->setValue("序号");
                });
                $sheet->cell('B1', function ($cell) use ($cellData) {
                    $cell->setValue("大学名称");
                });
                $sheet->cell('C1', function ($cell) use ($cellData) {
                    $cell->setValue("大学英文名称");
                });
                $sheet->cell('D1', function ($cell) use ($cellData) {
                    $cell->setValue("校徽");
                });
                $sheet->cell('E1', function ($cell) use ($cellData) {
                    $cell->setValue("院校代码");
                });
                $sheet->cell('F1', function ($cell) use ($cellData) {
                    $cell->setValue("省份");
                });
                $sheet->cell('G1', function ($cell) use ($cellData) {
                    $cell->setValue("城市");
                });
                $sheet->cell('H1', function ($cell) use ($cellData) {
                    $cell->setValue("院校层次");
                });
                $sheet->cell('I1', function ($cell) use ($cellData) {
                    $cell->setValue("院校类别");
                });
                $sheet->cell('J1', function ($cell) use ($cellData) {
                    $cell->setValue("是否直属教育部");
                });
                $sheet->cell('K1', function ($cell) use ($cellData) {
                    $cell->setValue("是否直属中央");
                });
                $sheet->cell('L1', function ($cell) use ($cellData) {
                    $cell->setValue("办学类型");
                });
                $sheet->cell('M1', function ($cell) use ($cellData) {
                    $cell->setValue("985");
                });
                $sheet->cell('N1', function ($cell) use ($cellData) {
                    $cell->setValue("211");
                });
                $sheet->cell('O1', function ($cell) use ($cellData) {
                    $cell->setValue("建校时间");
                });
                $sheet->cell('P1', function ($cell) use ($cellData) {
                    $cell->setValue("电话");
                });
                $sheet->cell('Q1', function ($cell) use ($cellData) {
                    $cell->setValue("地址");
                });
                $sheet->cell('R1', function ($cell) use ($cellData) {
                    $cell->setValue("直属部门");
                });
                $sheet->cell('S1', function ($cell) use ($cellData) {
                    $cell->setValue("男生比例");
                });
                $sheet->cell('T1', function ($cell) use ($cellData) {
                    $cell->setValue("女生比例");
                });
                $sheet->cell('U1', function ($cell) use ($cellData) {
                    $cell->setValue("学校网站");
                });
                $sheet->cell('V1', function ($cell) use ($cellData) {
                    $cell->setValue("全景校园");
                });
                $sheet->cell('W1', function ($cell) use ($cellData) {
                    $cell->setValue("是否是一流大学");
                });
                $sheet->cell('X1', function ($cell) use ($cellData) {
                    $cell->setValue("研究生点");
                });
                $sheet->cell('Y1', function ($cell) use ($cellData) {
                    $cell->setValue("博士生点");
                });
                $sheet->cell('Z1', function ($cell) use ($cellData) {
                    $cell->setValue("综合排名");
                });
                $sheet->cell('AA1', function ($cell) use ($cellData) {
                    $cell->setValue("毕业生排名");
                });
                $sheet->cell('AB1', function ($cell) use ($cellData) {
                    $cell->setValue("生源排名");
                });
                $sheet->cell('AC1', function ($cell) use ($cellData) {
                    $cell->setValue("教师排名");
                });
                $sheet->cell('AD1', function ($cell) use ($cellData) {
                    $cell->setValue("教师专业排名");
                });
                $sheet->cell('AE1', function ($cell) use ($cellData) {
                    $cell->setValue("武书连排名");
                });
                $sheet->cell('AF1', function ($cell) use ($cellData) {
                    $cell->setValue("中国校友会排名");
                });
                $sheet->cell('AG1', function ($cell) use ($cellData) {
                    $cell->setValue("生活指数排名");
                });
                $sheet->cell('AH1', function ($cell) use ($cellData) {
                    $cell->setValue("工作指数排名");
                });
                $sheet->cell('AI1', function ($cell) use ($cellData) {
                    $cell->setValue("简介");
                });
                $sheet->cell('AJ1', function ($cell) use ($cellData) {
                    $cell->setValue("收费标准");
                });
                $sheet->cell('AK1', function ($cell) use ($cellData) {
                    $cell->setValue("就业说明");
                });
                $sheet->cell('AL1', function ($cell) use ($cellData) {
                    $cell->setValue("邮箱");
                });
                $i = 2;
                foreach ($cellData as $key => $value) {
                    $sheet->cell('A'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($i);
                    });
                    $sheet->cell('B'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["name"]);
                    });

                    $sheet->cell('C'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["english_name"]);
                    });
                    $sheet->cell('D'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["logo"]);
                    });
                    $sheet->cell('E'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["code"]);
                    });
                    $sheet->cell('F'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["province"]["province_name"]);
                    });
                    $sheet->cell('G'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["city"]["city_name"]);
                    });
                    $sheet->cell('H'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["college_diplomas"]["name"]);
                    });
                    $sheet->cell('I'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["college_category"]["name"]);
                    });
                    $sheet->cell('J'.$i, function ($cell) use ($value, $i) {
                        $res = $value["is_belong_to_edu"] == 0 ? "否" : "是";
                        $cell->setValue($res);
                    });
                    $sheet->cell('K'.$i, function ($cell) use ($value, $i) {
                        $res = $value["is_belong_to_center"] == 0 ? "否" : "是";
                        $cell->setValue($res);
                    });
                    $sheet->cell('L'.$i, function ($cell) use ($value, $i) {
                        $res = $value["is_nation"] == 0 ? "民办" : "公办";
                        $cell->setValue($res);
                    });
                    $sheet->cell('M'.$i, function ($cell) use ($value, $i) {
                        $res = $value["is_985"] == 0 ? "否" : "是";
                        $cell->setValue($res);
                    });
                    $sheet->cell('N'.$i, function ($cell) use ($value, $i) {
                        $res = $value["is_211"] == 0 ? "否" : "是";
                        $cell->setValue($res);
                    });
                    $sheet->cell('O'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["since"]);
                    });
                    $sheet->cell('P'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["college_detail"]["telephone"]);
                    });
                    $sheet->cell('Q'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["college_detail"]["address"]);
                    });
                    $sheet->cell('R'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["college_detail"]["membership"]);
                    });
                    $sheet->cell('S'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["college_detail"]["male_rate"]);
                    });
                    $sheet->cell('T'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["college_detail"]["female_rate"]);
                    });
                    $sheet->cell('U'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["college_detail"]["web"]);
                    });
                    $sheet->cell('V'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["college_detail"]["full_view"]);
                    });
                    $sheet->cell('W'.$i, function ($cell) use ($value, $i) {
                        $res = $value["is_top_college"] == 0 ? "否" : "是";
                        $cell->setValue($res);
                    });
                    $sheet->cell('X'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["postgraduate_number"]);
                    });
                    $sheet->cell('Y'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["doctor_number"]);
                    });
                    $sheet->cell('Z'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["general_rank"]);
                    });
                    $sheet->cell('AA'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["graduate_rank"]);
                    });
                    $sheet->cell('AB'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["student_rank"]);
                    });
                    $sheet->cell('AC'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["teacher_rank"]);
                    });
                    $sheet->cell('AD'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["teacher_performance_rank"]);
                    });
                    $sheet->cell('AE'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["wushulian_province_rank"]);
                    });
                    $sheet->cell('AF'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["xyh_rank"]);
                    });
                    $sheet->cell('AG'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["life_rank"]);
                    });
                    $sheet->cell('AH'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["work_rank"]);
                    });
                    $sheet->cell('AI'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["college_detail"]["description"]);
                    });
                    $sheet->cell('AJ'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["college_detail"]["charge_standard"]);

                    });
                    $sheet->cell('AK'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["college_detail"]["job_prospect"]);

                    });
                    $sheet->cell('AL'.$i, function ($cell) use ($value, $i) {
                        $cell->setValue($value["general_rank"]);
                        $cell->setValue($value["college_detail"]["email"]);
                    });
                    $i++;
                }
            });
        })->export('xls');
    }

    public function show($id)
    {
        $info = $this->collegeRepository->findById($id);

        return view('admin.college.list.show');
    }

    /**
     * 获取大学分页列表,返回给前端
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListByPageId(Request $request)
    {
        $count = $this->collegeRepository->getAllCount($request);

        $college_list = $this->collegeRepository->getAllByPage($request);

        return $this->responsePage($count, $college_list);
    }

    /**
     * 添加大学页面方法
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.college.list.create');
    }

    /**
     * 处理大学页面方法
     *
     * @param \App\Http\Requests\CollegeRequest $CollegeRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CollegeRequest $CollegeRequest)
    {
        if ($this->collegeRepository->store($CollegeRequest->all())) {
            return redirect()->back()->with("message", "添加成功");
        } else {
            return redirect()->back()->with("message", "添加失败");
        }
    }

    /**
     * 修改大学页面方法
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = $this->collegeRepository->findById($id);

        return view('admin.college.list.edit', compact('info'));
    }

    /**
     * 处理修改大学页面方法
     *
     * @param                                           $id
     * @param \App\Http\Requests\CollegeRequest         $collegeRequest
     * @return \Illuminate\Http\Response
     */
    public function update($id, CollegeRequest $collegeRequest)
    {
        if ($this->collegeRepository->update($id, $collegeRequest->except(['_token', '_method']))) {
            return redirect()->back()->with("message", "修改成功");
        } else {
            return redirect()->back()->with("message", "修改失败");
        }
    }

    /**
     * 删除大学页面方法
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if ($this->collegeRepository->destroy($id)) {
            return $this->responseSuccess();
        }
    }

    /**
     * 批量删除大学方法
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteByIds(Request $request)
    {
        $ids = $request->get('ids', '|');
        if ($this->collegeRepository->batchDelete($ids)) {
            return $this->responseSuccess();
        }
    }
}
