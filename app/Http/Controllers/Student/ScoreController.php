<?php

namespace App\Http\Controllers\Student;

use Auth;
use Illuminate\Http\Request;
use App\Models\MajorChoiceSeniorReport;
use App\Models\Student_score_record;
use App\Models\College;
use App\Models\CollegeMajor;
use App\Models\CollegeMajorScore;
use App\Http\Controllers\Controller;
use App\Services\Assessment\MajorChoice\SeniorLogicService;

class ScoreController extends Controller
{
    public function collection(Request $request)
    {
        if ($request->method() == "GET") {
            $student_score = new Student_score_record();
            $data = $student_score->where("student_id", Auth::guard("student")->user()->id)->first();
            $data = json_decode($data['note'], true);

            return view("student.score.collection", compact('data'));
        } else {
            $data = $request->all();
            $this->insert_score($data);

            return redirect(route('student.score'));
        }
    }

    public function insert_score($data)
    {
        $data['student_id'] = Auth::guard("student")->user()->id;
        $data['mobile'] = Auth::guard("student")->user()->mobile;
        $student_score = new Student_score_record();
        $exists = $student_score->where("student_id", $data['student_id'])->first();
        $avg_score = $this->get_avg_score($data);
        if (! $exists) {
            $student_score->student_id = $data['student_id'];
            $student_score->note = json_encode($data);
            $student_score->score = $avg_score;
            $student_score->save();
        } else {
            $student = $student_score->where("student_id", $data['student_id'])->first();
            $student->student_id = $data['student_id'];
            $student->note = json_encode($data);
            $student->score = $avg_score;
            $student->save();
        }
    }

    public function get_ratio($chengji, $manfen)
    {
        if ($manfen > 0) {
            return round(($chengji / $manfen), 2);
        }
    }

    public function get_avg_score($data)
    {
        //取总分的平均值
        $all_score = 0;
        $all_score_num = 0;
        foreach ($data as $key => $value) {
            if (substr_count($key, "zongfen")) {
                if (substr_count($key, "manfen")) {
                    if ($value > 0) {
                        $all_score_num++;
                    }
                }
                if (substr_count($key, "chengji")) {
                    if ($value > 0) {
                        $all_score += $value;
                    }
                }
            }
        }
        if ($all_score_num > 0) {
            $avg_score = round(($all_score / $all_score_num), 2);
        } else {
            $avg_score = 0;
        }

        return $avg_score;
    }

    public function parse_score(SeniorLogicService $seniorLogicService)
    {
        $student_score = new Student_score_record();
        $data = $student_score->where("student_id", Auth::guard("student")->user()->id)->first();
        $major_choice_report = new MajorChoiceSeniorReport();
        $report = $major_choice_report->where("mobile", Auth::guard("student")->user()->mobile)->first();

        if (isset($report)) {
            $seniorLogicService->handleReportData($report);
        } else {
            return "暂时未做测试,无法给你推荐大学";
        }

        /* 对数据进行二次处理 */

        if (isset($data)) {
            if (isset($report)) {
                $major_top_category = [];
                $student_avg_score = $data['score'];
                $major_category = $report['major_category'];
                foreach ($major_category as $key => $value) {
                    if (! in_array($value['top_parent_id'], $major_top_category) && $value['top_parent_id'] > 0) {
                        $major_top_category[] = $value['top_parent_id'];
                    }
                }
                $college_majro = CollegeMajor::whereIn('major_id', $major_top_category)->groupBy('college_id')->get()->toArray();
                $college_majro_id = [];
                foreach ($college_majro as $key => $value) {
                    if (! in_array($value['college_id'], $college_majro_id) && $value['college_id'] > 0) {
                        $college_majro_id[] = $value['college_id'];
                    }
                }

                $collges_score = CollegeMajorScore::orderBy('year', 'desc')->where('score', '<', $student_avg_score)->get();
                $college_score_id = [];
                foreach ($collges_score as $key => $value) {
                    if (! in_array($value['college_id'], $college_score_id) && $value['college_id'] > 0) {
                        $college_score_id[] = $value['college_id'];
                    }
                }
                $college_allow = array_intersect($college_majro_id, $college_score_id);
                $college_data = College::whereIn('id', $college_allow)->limit(3)->get()->toArray();
                //echo "你的分数为:".$student_avg_score."<br>";
                if (count($college_data) > 0) {
                    return view('student.score.score', compact("college_data"));
                } else {
                    $college_data = "数据太少或者分数不达标,暂时无法给你推荐院校!";

                    return view('student.score.score', compact("college_data"));
                }
                $data = json_decode($data['note'], true);

                $yuwen = [];
                $yuwen['yuwen_gaoyi_shang_ratio'] = $this->get_ratio($data['yuwen_gaoyi_shang_chengji'], $data['yuwen_gaoyi_shang_manfen']);
                $yuwen['yuwen_gaoyi_xia_ratio'] = $this->get_ratio($data['yuwen_gaoyi_xia_chengji'], $data['yuwen_gaoyi_xia_manfen']);
                $yuwen['yuwen_gaoer_shang_ratio'] = $this->get_ratio($data['yuwen_gaoer_shang_chengji'], $data['yuwen_gaoer_shang_manfen']);
                $yuwen['yuwen_gaoer_xia_ratio'] = $this->get_ratio($data['yuwen_gaoer_xia_chengji'], $data['yuwen_gaoer_xia_manfen']);
                $yuwen['yuwen_gaosan_shang_ratio'] = $this->get_ratio($data['yuwen_gaosan_shang_chengji'], $data['yuwen_gaosan_shang_manfen']);
                $yuwen['yuwen_huikao_ratio'] = $this->get_ratio($data['yuwen_huikao_chengji'], $data['yuwen_huikao_manfen']);
                $shuxue = [];
                $shuxue['shuxue_gaoyi_shang_ratio'] = $this->get_ratio($data['shuxue_gaoyi_shang_chengji'], $data['shuxue_gaoyi_shang_manfen']);
                $shuxue['shuxue_gaoyi_xia_ratio'] = $this->get_ratio($data['shuxue_gaoyi_xia_chengji'], $data['shuxue_gaoyi_xia_manfen']);
                $shuxue['shuxue_gaoer_shang_ratio'] = $this->get_ratio($data['shuxue_gaoer_shang_chengji'], $data['shuxue_gaoer_shang_manfen']);
                $shuxue['shuxue_gaoer_xia_ratio'] = $this->get_ratio($data['shuxue_gaoer_xia_chengji'], $data['shuxue_gaoer_xia_manfen']);
                $shuxue['shuxue_gaosan_shang_ratio'] = $this->get_ratio($data['shuxue_gaosan_shang_chengji'], $data['shuxue_gaosan_shang_manfen']);
                $shuxue['shuxue_huikao_ratio'] = $this->get_ratio($data['shuxue_huikao_chengji'], $data['shuxue_huikao_manfen']);
                $waiyu = [];
                $waiyu['waiyu_gaoyi_shang_ratio'] = $this->get_ratio($data['waiyu_gaoyi_shang_chengji'], $data['waiyu_gaoyi_shang_manfen']);
                $waiyu['waiyu_gaoyi_xia_ratio'] = $this->get_ratio($data['waiyu_gaoyi_xia_chengji'], $data['waiyu_gaoyi_xia_manfen']);
                $waiyu['waiyu_gaoer_shang_ratio'] = $this->get_ratio($data['waiyu_gaoer_shang_chengji'], $data['waiyu_gaoer_shang_manfen']);
                $waiyu['waiyu_gaoer_xia_ratio'] = $this->get_ratio($data['waiyu_gaoer_xia_chengji'], $data['waiyu_gaoer_xia_manfen']);
                $waiyu['waiyu_gaosan_shang_ratio'] = $this->get_ratio($data['waiyu_gaosan_shang_chengji'], $data['waiyu_gaosan_shang_manfen']);
                $waiyu['waiyu_huikao_ratio'] = $this->get_ratio($data['waiyu_huikao_chengji'], $data['waiyu_huikao_manfen']);
                $zhengzhi = [];
                $zhengzhi['zhengzhi_gaoyi_shang_ratio'] = $this->get_ratio($data['zhengzhi_gaoyi_shang_chengji'], $data['zhengzhi_gaoyi_shang_manfen']);
                $zhengzhi['zhengzhi_gaoyi_xia_ratio'] = $this->get_ratio($data['zhengzhi_gaoyi_xia_chengji'], $data['zhengzhi_gaoyi_xia_manfen']);
                $zhengzhi['zhengzhi_gaoer_shang_ratio'] = $this->get_ratio($data['zhengzhi_gaoer_shang_chengji'], $data['zhengzhi_gaoer_shang_manfen']);
                $zhengzhi['zhengzhi_gaoer_xia_ratio'] = $this->get_ratio($data['zhengzhi_gaoer_xia_chengji'], $data['zhengzhi_gaoer_xia_manfen']);
                $zhengzhi['zhengzhi_gaosan_shang_ratio'] = $this->get_ratio($data['zhengzhi_gaosan_shang_chengji'], $data['zhengzhi_gaosan_shang_manfen']);
                $zhengzhi['zhengzhi_huikao_ratio'] = $this->get_ratio($data['zhengzhi_huikao_chengji'], $data['zhengzhi_huikao_manfen']);
                $lishi = [];
                $lishi['lishi_gaoyi_shang_ratio'] = $this->get_ratio($data['lishi_gaoyi_shang_chengji'], $data['lishi_gaoyi_shang_manfen']);
                $lishi['lishi_gaoyi_xia_ratio'] = $this->get_ratio($data['lishi_gaoyi_xia_chengji'], $data['lishi_gaoyi_xia_manfen']);
                $lishi['lishi_gaoer_shang_ratio'] = $this->get_ratio($data['lishi_gaoer_shang_chengji'], $data['lishi_gaoer_shang_manfen']);
                $lishi['lishi_gaoer_xia_ratio'] = $this->get_ratio($data['lishi_gaoer_xia_chengji'], $data['lishi_gaoer_xia_manfen']);
                $lishi['lishi_gaosan_shang_ratio'] = $this->get_ratio($data['lishi_gaosan_shang_chengji'], $data['lishi_gaosan_shang_manfen']);
                $lishi['lishi_huikao_ratio'] = $this->get_ratio($data['lishi_huikao_chengji'], $data['lishi_huikao_manfen']);
                $dili = [];
                $dili['dili_gaoyi_shang_ratio'] = $this->get_ratio($data['dili_gaoyi_shang_chengji'], $data['dili_gaoyi_shang_manfen']);
                $dili['dili_gaoyi_xia_ratio'] = $this->get_ratio($data['dili_gaoyi_xia_chengji'], $data['dili_gaoyi_xia_manfen']);
                $dili['dili_gaoer_shang_ratio'] = $this->get_ratio($data['dili_gaoer_shang_chengji'], $data['dili_gaoer_shang_manfen']);
                $dili['dili_gaoer_xia_ratio'] = $this->get_ratio($data['dili_gaoer_xia_chengji'], $data['dili_gaoer_xia_manfen']);
                $dili['dili_gaosan_shang_ratio'] = $this->get_ratio($data['dili_gaosan_shang_chengji'], $data['dili_gaosan_shang_manfen']);
                $dili['dili_huikao_ratio'] = $this->get_ratio($data['dili_huikao_chengji'], $data['dili_huikao_manfen']);
                $wuli = [];
                $wuli['wuli_gaoyi_shang_ratio'] = $this->get_ratio($data['wuli_gaoyi_shang_chengji'], $data['wuli_gaoyi_shang_manfen']);
                $wuli['wuli_gaoyi_xia_ratio'] = $this->get_ratio($data['wuli_gaoyi_xia_chengji'], $data['wuli_gaoyi_xia_manfen']);
                $wuli['wuli_gaoer_shang_ratio'] = $this->get_ratio($data['wuli_gaoer_shang_chengji'], $data['wuli_gaoer_shang_manfen']);
                $wuli['wuli_gaoer_xia_ratio'] = $this->get_ratio($data['wuli_gaoer_xia_chengji'], $data['wuli_gaoer_xia_manfen']);
                $wuli['wuli_gaosan_shang_ratio'] = $this->get_ratio($data['wuli_gaosan_shang_chengji'], $data['wuli_gaosan_shang_manfen']);
                $wuli['wuli_huikao_ratio'] = $this->get_ratio($data['wuli_huikao_chengji'], $data['wuli_huikao_manfen']);
                $huaxue = [];
                $huaxue['huaxue_gaoyi_shang_ratio'] = $this->get_ratio($data['huaxue_gaoyi_shang_chengji'], $data['huaxue_gaoyi_shang_manfen']);
                $huaxue['huaxue_gaoyi_xia_ratio'] = $this->get_ratio($data['huaxue_gaoyi_xia_chengji'], $data['huaxue_gaoyi_xia_manfen']);
                $huaxue['huaxue_gaoer_shang_ratio'] = $this->get_ratio($data['huaxue_gaoer_shang_chengji'], $data['huaxue_gaoer_shang_manfen']);
                $huaxue['huaxue_gaoer_xia_ratio'] = $this->get_ratio($data['huaxue_gaoer_xia_chengji'], $data['huaxue_gaoer_xia_manfen']);
                $huaxue['huaxue_gaosan_shang_ratio'] = $this->get_ratio($data['huaxue_gaosan_shang_chengji'], $data['huaxue_gaosan_shang_manfen']);
                $huaxue['huaxue_huikao_ratio'] = $this->get_ratio($data['huaxue_huikao_chengji'], $data['huaxue_huikao_manfen']);
                $shengwu = [];
                $shengwu['shengwu_gaoyi_shang_ratio'] = $this->get_ratio($data['shengwu_gaoyi_shang_chengji'], $data['shengwu_gaoyi_shang_manfen']);
                $shengwu['shengwu_gaoyi_xia_ratio'] = $this->get_ratio($data['shengwu_gaoyi_xia_chengji'], $data['shengwu_gaoyi_xia_manfen']);
                $shengwu['shengwu_gaoer_shang_ratio'] = $this->get_ratio($data['shengwu_gaoer_shang_chengji'], $data['shengwu_gaoer_shang_manfen']);
                $shengwu['shengwu_gaoer_xia_ratio'] = $this->get_ratio($data['shengwu_gaoer_xia_chengji'], $data['shengwu_gaoer_xia_manfen']);
                $shengwu['shengwu_gaosan_shang_ratio'] = $this->get_ratio($data['shengwu_gaosan_shang_chengji'], $data['shengwu_gaosan_shang_manfen']);
                $shengwu['shengwu_huikao_ratio'] = $this->get_ratio($data['shengwu_huikao_chengji'], $data['shengwu_huikao_manfen']);
                $meishu = [];
                $meishu['meishu_gaoyi_shang_ratio'] = $this->get_ratio($data['meishu_gaoyi_shang_chengji'], $data['meishu_gaoyi_shang_manfen']);
                $meishu['meishu_gaoyi_xia_ratio'] = $this->get_ratio($data['meishu_gaoyi_xia_chengji'], $data['meishu_gaoyi_xia_manfen']);
                $meishu['meishu_gaoer_shang_ratio'] = $this->get_ratio($data['meishu_gaoer_shang_chengji'], $data['meishu_gaoer_shang_manfen']);
                $meishu['meishu_gaoer_xia_ratio'] = $this->get_ratio($data['meishu_gaoer_xia_chengji'], $data['meishu_gaoer_xia_manfen']);
                $meishu['meishu_gaosan_shang_ratio'] = $this->get_ratio($data['meishu_gaosan_shang_chengji'], $data['meishu_gaosan_shang_manfen']);
                $meishu['meishu_huikao_ratio'] = $this->get_ratio($data['meishu_huikao_chengji'], $data['meishu_huikao_manfen']);
                $tiyu = [];
                $tiyu['tiyu_gaoyi_shang_ratio'] = $this->get_ratio($data['tiyu_gaoyi_shang_chengji'], $data['tiyu_gaoyi_shang_manfen']);
                $tiyu['tiyu_gaoyi_xia_ratio'] = $this->get_ratio($data['tiyu_gaoyi_xia_chengji'], $data['tiyu_gaoyi_xia_manfen']);
                $tiyu['tiyu_gaoer_shang_ratio'] = $this->get_ratio($data['tiyu_gaoer_shang_chengji'], $data['tiyu_gaoer_shang_manfen']);
                $tiyu['tiyu_gaoer_xia_ratio'] = $this->get_ratio($data['tiyu_gaoer_xia_chengji'], $data['tiyu_gaoer_xia_manfen']);
                $tiyu['tiyu_gaosan_shang_ratio'] = $this->get_ratio($data['tiyu_gaosan_shang_chengji'], $data['tiyu_gaosan_shang_manfen']);
                $tiyu['tiyu_huikao_ratio'] = $this->get_ratio($data['tiyu_huikao_chengji'], $data['tiyu_huikao_manfen']);
                $yinyue = [];
                $yinyue['yinyue_gaoyi_shang_ratio'] = $this->get_ratio($data['yinyue_gaoyi_shang_chengji'], $data['yinyue_gaoyi_shang_manfen']);
                $yinyue['yinyue_gaoyi_xia_ratio'] = $this->get_ratio($data['yinyue_gaoyi_xia_chengji'], $data['yinyue_gaoyi_xia_manfen']);
                $yinyue['yinyue_gaoer_shang_ratio'] = $this->get_ratio($data['yinyue_gaoer_shang_chengji'], $data['yinyue_gaoer_shang_manfen']);
                $yinyue['yinyue_gaoer_xia_ratio'] = $this->get_ratio($data['yinyue_gaoer_xia_chengji'], $data['yinyue_gaoer_xia_manfen']);
                $yinyue['yinyue_gaosan_shang_ratio'] = $this->get_ratio($data['yinyue_gaosan_shang_chengji'], $data['yinyue_gaosan_shang_manfen']);
                $yinyue['yinyue_huikao_ratio'] = $this->get_ratio($data['yinyue_huikao_chengji'], $data['yinyue_huikao_manfen']);
                $xxjs = [];
                $xxjs['xxjs_gaoyi_shang_ratio'] = $this->get_ratio($data['xxjs_gaoyi_shang_chengji'], $data['xxjs_gaoyi_shang_manfen']);
                $xxjs['xxjs_gaoyi_xia_ratio'] = $this->get_ratio($data['xxjs_gaoyi_xia_chengji'], $data['xxjs_gaoyi_xia_manfen']);
                $xxjs['xxjs_gaoer_shang_ratio'] = $this->get_ratio($data['xxjs_gaoer_shang_chengji'], $data['xxjs_gaoer_shang_manfen']);
                $xxjs['xxjs_gaoer_xia_ratio'] = $this->get_ratio($data['xxjs_gaoer_xia_chengji'], $data['xxjs_gaoer_xia_manfen']);
                $xxjs['xxjs_gaosan_shang_ratio'] = $this->get_ratio($data['xxjs_gaosan_shang_chengji'], $data['xxjs_gaosan_shang_manfen']);
                $xxjs['xxjs_huikao_ratio'] = $this->get_ratio($data['xxjs_huikao_chengji'], $data['xxjs_huikao_manfen']);
                $wenzong = [];
                $wenzong['wenzong_gaoyi_shang_ratio'] = $this->get_ratio($data['wenzong_gaoyi_shang_chengji'], $data['wenzong_gaoyi_shang_manfen']);
                $wenzong['wenzong_gaoyi_xia_ratio'] = $this->get_ratio($data['wenzong_gaoyi_xia_chengji'], $data['wenzong_gaoyi_xia_manfen']);
                $wenzong['wenzong_gaoer_shang_ratio'] = $this->get_ratio($data['wenzong_gaoer_shang_chengji'], $data['wenzong_gaoer_shang_manfen']);
                $wenzong['wenzong_gaoer_xia_ratio'] = $this->get_ratio($data['wenzong_gaoer_xia_chengji'], $data['wenzong_gaoer_xia_manfen']);
                $wenzong['wenzong_gaosan_shang_ratio'] = $this->get_ratio($data['wenzong_gaosan_shang_chengji'], $data['wenzong_gaosan_shang_manfen']);
                $wenzong['wenzong_huikao_ratio'] = $this->get_ratio($data['wenzong_huikao_chengji'], $data['wenzong_huikao_manfen']);
                $lizong = [];
                $lizong['lizong_gaoyi_shang_ratio'] = $this->get_ratio($data['lizong_gaoyi_shang_chengji'], $data['lizong_gaoyi_shang_manfen']);
                $lizong['lizong_gaoyi_xia_ratio'] = $this->get_ratio($data['lizong_gaoyi_xia_chengji'], $data['lizong_gaoyi_xia_manfen']);
                $lizong['lizong_gaoer_shang_ratio'] = $this->get_ratio($data['lizong_gaoer_shang_chengji'], $data['lizong_gaoer_shang_manfen']);
                $lizong['lizong_gaoer_xia_ratio'] = $this->get_ratio($data['lizong_gaoer_xia_chengji'], $data['lizong_gaoer_xia_manfen']);
                $lizong['lizong_gaosan_shang_ratio'] = $this->get_ratio($data['lizong_gaosan_shang_chengji'], $data['lizong_gaosan_shang_manfen']);
                $lizong['lizong_huikao_ratio'] = $this->get_ratio($data['lizong_huikao_chengji'], $data['lizong_huikao_manfen']);
                $zongfen = [];
                $zongfen['zongfen_gaoyi_shang_ratio'] = $this->get_ratio($data['zongfen_gaoyi_shang_chengji'], $data['zongfen_gaoyi_shang_manfen']);
                $zongfen['zongfen_gaoyi_xia_ratio'] = $this->get_ratio($data['zongfen_gaoyi_xia_chengji'], $data['zongfen_gaoyi_xia_manfen']);
                $zongfen['zongfen_gaoer_shang_ratio'] = $this->get_ratio($data['zongfen_gaoer_shang_chengji'], $data['zongfen_gaoer_shang_manfen']);
                $zongfen['zongfen_gaoer_xia_ratio'] = $this->get_ratio($data['zongfen_gaoer_xia_chengji'], $data['zongfen_gaoer_xia_manfen']);
                $zongfen['zongfen_gaosan_shang_ratio'] = $this->get_ratio($data['zongfen_gaosan_shang_chengji'], $data['zongfen_gaosan_shang_manfen']);
                $zongfen['zongfen_huikao_ratio'] = $this->get_ratio($data['zongfen_huikao_chengji'], $data['zongfen_huikao_manfen']);
                print_r($yuwen);
            } else {
                print_r("暂时未做测试!");
            }
        } else {
            return redirect(route('student.score'));
        }
    }
}
