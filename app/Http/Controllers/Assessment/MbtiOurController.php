<?php

namespace App\Http\Controllers\Assessment;

use App\Models\NewProfessional;
use App\Models\NewProfessionalDetail;
use App\Models\Professional;
use App\Models\ProfessionalCategory;
use App\Models\ProfessionalDetail;
use App\Services\JsonToArrayService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MbtiOurController extends Controller
{
    public function index(Request $request)
    {
        if ($request->method() == "POST") {
            $data = $request->all();
            print_r($data);
            $e = $i = $s = $n = $t = $f = $j = $p = 0;
            $p = 1;
            $logic = config('logic.mbti_issue_93');
            foreach ($data as $key => $value) {
                if (isset($logic[$p][$value])) {
                    $temp = $logic[$p][$value];
                    switch ($temp) {
                        case 'E':
                            $e++;
                            break;
                        case 'S':
                            $s++;
                            break;
                        case 'T':
                            $t++;
                            break;
                        case 'J':
                            $j++;
                    }
                }
                $p++;
            }
            echo "<hr>";
            echo "E: ".$e."<br>";
            echo "I: ".(21 - $e)."<br>";
            echo "S: ".$s."<br>";
            echo "N: ".(26 - $s)."<br>";
            echo "T: ".$t."<br>";
            echo "F: ".(24 - $t)."<br>";
            echo "J: ".$j."<br>";
            echo "P: ".(22 - $j)."<br>";
        } else {
            $a = ['A', 'B'];
            $data = [];
            for ($i = 1; $i < 94; $i++) {
                $data[$i]['id'] = $i;
                $data[$i]['answer'] = $a[array_rand($a)];
            }

            return view('assessment.mnti.index', compact('data'));
        }
    }

    public function senior(Request $request)
    {
        if ($request->method() == "POST") {
            $data = $request->all();
            dd($data);
        } else {
            //$a = ['A', 'B'];
            //$data = [];
            //for ($i = 1; $i < 94; $i++) {
            //    $data[$i]['id'] = $i;
            //    $data[$i]['answer'] = $a[array_rand($a)];
            //}
            //return view('assessment.mnti.index', compact('data'));

            $issues = JsonToArrayService::getJson('mbti_senior_issue.json');
            $new = [];
            foreach ($issues as $issue) {
                if ($issue['dimension_category'] == 'M') {
                    $new['mbti_arr']['choice'][] = $issue['answer1_value'];
                } else {
                    if ($issue['iusse_category'] == 'hobby') {
                        $new['holland']['hobby']['choice'][] = $issue['dimension_category'];
                    }
                    if ($issue['iusse_category'] == 'good') {
                        $new['holland']['good']['choice'][] = $issue['dimension_category'];
                    }
                    if ($issue['iusse_category'] == 'like') {
                        $new['holland']['like']['choice'][] = $issue['dimension_category'];
                    }
                    if ($issue['iusse_category'] == 'ability') {
                        $new['holland']['ability']['choice']['R'] = rand(0, 4);
                        $new['holland']['ability']['choice']['I'] = rand(0, 4);
                        $new['holland']['ability']['choice']['A'] = rand(0, 4);
                        $new['holland']['ability']['choice']['S'] = rand(0, 4);
                        $new['holland']['ability']['choice']['E'] = rand(0, 4);
                        $new['holland']['ability']['choice']['C'] = rand(0, 4);
                    }
                    if ($issue['iusse_category'] == 'skill') {
                        $new['holland']['skill']['choice']['R'] = rand(0, 4);
                        $new['holland']['skill']['choice']['I'] = rand(0, 4);
                        $new['holland']['skill']['choice']['A'] = rand(0, 4);
                        $new['holland']['skill']['choice']['S'] = rand(0, 4);
                        $new['holland']['skill']['choice']['E'] = rand(0, 4);
                        $new['holland']['skill']['choice']['C'] = rand(0, 4);
                    }
                }
            }
            var_export($new);
        }
    }

    public function zy()
    {
        $issue = JsonToArrayService::getJson('zhuanke.json');
        foreach ($issue as $key => $value) {
            //$code = $value['code'];
            //$name = $value['major_name'];
            //$ranking = $ranking_type = 0;
            //
            //$info = Professional::where('professional_name', $name.'类')->first();
            //if ($info) {
            //    $ranking = $info['ranking'];
            //    $ranking_type = $info['ranking_type'];
            //}
            //NewProfessional::create(['name' => $name, 'code' => $code, 'level' => 0, 'ranking' => $ranking, 'ranking_type' => $ranking_type]);
            foreach ($value['two'] as $ke => $va) {
                //$parent_name = $value['major_name'];
                //$code = $va['code'];
                //$name = $va['name'];
                //$ranking = $ranking_type = 0;
                //
                //$parent_info = NewProfessional::where('name', $parent_name)->where('level', '0')->first();
                //$info = Professional::where('professional_name', $name)->first();
                //if ($info) {
                //    $ranking = $info['ranking'];
                //    $ranking_type = $info['ranking_type'];
                //}
                //$data = [
                //    'name' => $name,
                //    'code' => $code,
                //    'level' => 0,
                //    'parent_id' => $parent_info['id'],
                //    'top_parent_id' => $parent_info['id'],
                //    'ranking' => $ranking,
                //    'ranking_type' => $ranking_type,
                //];
                //NewProfessional::create($data);

                foreach ($va['three'] as $k => $v) {
                    $name = $v['name'];
                    $info = Professional::where('professional_name', $name)->first();
                    $item = NewProfessional::where('name', $name)->first();
                    $data = [];
                    $data['professional_id'] = $item['id'];

                    if ($info) {
                        $detail = ProfessionalDetail::where('professional_id', $info['id'])->first();
                        $data['clicks'] = $detail['clicks'] ? $detail['clicks'] : 0;
                        $data['awarded_degree'] = $detail['awarded_degree'];
                    } else {
                        $data['clicks'] = 0;
                        $data['awarded_degree'] = null;
                    }
                    $data['job_direction'] = $v['desc']['fang_xiang_pei_yang'];
                    if (is_array($v['desc']['gao_kao_bi_ye_sheng']) && isset($v['desc']['gao_kao_bi_ye_sheng'][0])) {
                        $data['graduation_student_num'] = str_replace('人', '', $v['desc']['gao_kao_bi_ye_sheng'][0]);
                    } else {
                        $data['graduation_student_num'] = 0;
                    }
                    $year = $v['desc']['cong_ye_qing_kuang'];
                    $new_split = ['2015' => '0', '2016' => '0', '2017' => '0', '2018' => '0'];
                    if (is_array($year) && isset($year[0])) {
                        $spilt = explode('、', $year[0]);
                        foreach ($spilt as $key => $value) {
                            $new_split[substr($value, 0, 4)] = substr($value, 5, -1);
                        }
                    }

                    $data['work_rate'] = json_encode($new_split);
                    $data['subject_art_rate'] = $v['desc']['bili_wenke'];
                    $data['subject_math_rate'] = $v['desc']['bili_like'];
                    $data['gender_male_rate'] = $v['desc']['bili_nan'];
                    $data['gender_female_rate'] = $v['desc']['bili_nv'];
                    if ($info) {
                        $data['description'] = $detail['description'];
                    } else {
                        $data['description'] = $v['desc']['basic'];
                    }

                    NewProfessionalDetail::create($data);

                    //NewProfessional::create($data);
                }
            }
        }

        //$info = NewProfessional::all()->toArray();
        //foreach ($info as $item) {
        //    $name = $item['name'];
        //    $info = Professional::where('professional_name', $name)->first();
        //    if ($info) {
        //        $detail = ProfessionalDetail::where('professional_id', $info['id'])->first();
        //        $data = [];
        //        $data['professional_id'] = $item['id'];
        //        $data['clicks'] = $detail['clicks'] ? $detail['clicks'] : 0;
        //        $data['awarded_degree'] = $detail['awarded_degree'];
        //        $data['job_direction'] = $detail['job_direction'];
        //        $data['graduation_student_num'] = $detail['graduation_student_num'] ? $detail['graduation_student_num'] : 0;
        //        $data['work_rate'] = json_encode($detail['work_rate']);
        //        $data['subject_art_rate'] = $detail['subject_rate']['list'][0]['value'];
        //        $data['subject_math_rate'] = $detail['subject_rate']['list'][1]['value'];
        //        $data['gender_male_rate'] = $detail['gender_rate']['list'][0]['value'];
        //        $data['gender_female_rate'] = $detail['gender_rate']['list'][1]['value'];
        //        $data['description'] = $detail['description'];
        //        NewProfessionalDetail::create($data);
        //    }
        //}
    }
}
