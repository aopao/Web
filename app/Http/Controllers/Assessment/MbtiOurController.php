<?php

namespace App\Http\Controllers\Assessment;

use App\Models\Batch;
use App\Models\City;
use App\Models\College;
use App\Models\HollandDimension;
use App\Models\HollandProfessionalCode;
use App\Models\Major;
use App\Models\MajorSubject;
use App\Models\Province;
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

                    //NewProfessionalDetail::create($data);

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

    public function holland()
    {
        $all_data = [];
        $h = new HollandProfessional();
        $hollande_professional_codes = HollandProfessionalCode::all();
        foreach ($hollande_professional_codes as $key => $value) {
            $professional_array = explode('、', $value['professional']);
            foreach ($professional_array as $k => $v) {
                $data = [
                    'name' => $value['name'],
                    'professional_id' => 0,
                    'top_professional_id' => 0,
                ];
                $info = Professional::where('name', $v)->first();
                if ($info) {
                    $data = [
                        'name' => $value['name'],
                        'professional_id' => $info['id'],
                        'top_professional_id' => $info['top_parent_id'],
                    ];
                    //$h->addAll($data);
                }
                echo $key."关联完毕!<br/>";
            }
            //break;
        }
    }

    public function holland_single()
    {
        $info = HollandDimension::all();
        $h = new HollandProfessional();
        foreach ($info as $key => $value) {
            $professional_array = explode('、', $value['professional']);
            foreach ($professional_array as $k => $v) {
                $info = Professional::where('name', $v)->first();
                if ($info) {
                    $data = [
                        'name' => $value['code'],
                        'professional_id' => 0,
                        'top_professional_id' => 0,
                    ];
                    print_r($info);
                    $exists = HollandProfessional::where('name', $value['code'])->where('professional_id', $info['id'])->first();
                    if (! $exists) {
                        $data['professional_id'] = $info['id'];
                        $data['top_professional_id'] = $info['top_parent_id'];
                        //$h->addAll($data);
                    }
                }
                echo $key."关联完毕!<br/>";
            }
            //break;
        }
    }

    public function btz()
    {
        $data = [];
        $info = ProfessionalOld::all()->toArray();
        foreach ($info as $key => $value) {
            $data[$key]['bachelor_professional_id'] = $value['benke_profession_id'];
            $data[$key]['junior_professional_id'] = $value['zhuanke_profession_id'];
        }
        $p = new ProfessionalBachelorRealtionJunior();
        //$p->addAll($data);
    }

    public function sp()
    {
        $subject1 = [
            '1' => ['中国语言文学类', '人文科学试验班类', '新闻传播学类', '文科试验班类', '艺术学理论类', '音乐与舞蹈学类', '戏剧与影视学类', '美术学类', '设计学类'],
            '2' => ['经济学类', '财政学类', '金融学类', '经济与贸易类', '教育学类', '职业技术教育类', '数学类', '心理学类', '统计学类', '理科试验班类', '计算机类', '测绘类', '林学类'],
            '3' => ['经济学类', '财政学类', '金融学类', '经济与贸易类', '外国语言文学类', '艺术学理论类', '音乐与舞蹈学类', '戏剧与影视学类', '美术学类', '设计学类'],
            '4' => [
                '物理学类',
                '天文学',
                '大气科学类',
                '地球物理学类',
                '理科试验班类',
                '力学类',
                '机械类',
                '仪器类',
                '能源动力类',
                '电气类',
                '电子信息类',
                '自动化类',
                '计算机类',
                '土木类',
                '水利类',
                '测绘类',
                '地质类',
                '矿业类',
                '交通运输类',
                '海洋工程类',
                '航空航天类',
                '兵器类',
                '核工程类',
                '农业工程类',
                '林业工程类',
                '环境科学与工程类',
                '建筑类',
                '水产类',
            ],
            '5' => ['化学类', '材料类', '化工与制药类', '纺织类', '轻工类', '食品科学与工程类', '安全科学与工程类', '植物生产类', '自然保护与环境生态类', '动物生产类', '动物医学类', '草学类', '基础医学类', '临床医学类', '口腔医学类', '公共卫生与预防医学类', '中医学类', '中西医结合类', '药学类', '中药学类', '法医学类', '医学技术类', '医学试验班类'],
            '6' => ['教育学类', '职业技术教育类', '生物科学类', '心理学类', '生物医学工程类', '食品科学与工程类', '安全科学与工程类', '生物工程类', '植物生产类', '自然保护与环境生态类', '动物生产类', '动物医学类', '草学类', '基础医学类', '临床医学类', '口腔医学类', '公共卫生与预防医学类', '中医学类', '中西医结合类', '中药学类', '法医学类', '医学技术类', '医学试验班类'],
            '7' => ['历史学类'],
            '8' => ['哲学类', '法学类', '政治学类', '社会学类', '民族学类', '马克思主义理论类', '公安学类', '法学试验班类'],
            '9' => ['地理科学类', '海洋科学类', '地质学类'],
        ];

        $subject2 = [
            '1' => ['文学', '艺术学', '文化艺术', '新闻传播'],
            '2' => ['经济学', '教育学', '理学', '工学', '农林牧渔', '能源动力与材料', '土木建筑', '水利', '装备制造', '电子信息', '财经商贸', '教育与体育', '公共管理与服务'],
            '3' => ['文学', '艺术学', '经济学', '农林牧渔', '财经商贸', '文化艺术', '新闻传播', '公共管理与服务'],
            '4' => ['理学', '工学', '能源动力与材料', '土木建筑', '水利', '装备制造', '交通运输'],
            '5' => ['理学', '农学', '医学', '资源环境与安全', '生物与化工', '轻工纺织', '食品药品与粮食', '医药卫生'],
            '6' => ['教育学', '农学', '医学', '资源环境与安全', '生物与化工', '轻工纺织', '食品药品与粮食', '医药卫生', '教育与体育'],
            '7' => ['历史学'],
            '8' => ['哲学', '法学', '公安与司法'],
            '9' => ['旅游'],
        ];

        $arr = [];
        foreach ($subject1 as $key => $value) {
            foreach ($value as $k => $v) {
                $data = [];
                $info = Major::where('name', $v)->first()->toArray();
                $data['subject'] = $key;
                $data['major_id'] = $info['id'];
                $data['diplomas'] = $info['diplomas'];
                $arr[] = $data;
            }
        }
        $p = new MajorSubject();
        $p->addAll($arr);
    }

    public function pp()
    {
        $subject = [
            '2' => ['农业类', '林业类', '畜牧业类', '渔业类', '汽车制造类', '房地产类', '城乡规划与管理类', '公共管理类'],
            '3' => ['农业类', '林业类', '畜牧业类', '渔业类', '房地产类'],
            '4' => ['资源勘查类', '地质类', '气象类', '石油与天然气类', '煤炭类', '金属与非金属矿类', '安全类', '安全类', '电力技术类', '热能与发电工程类', '新能源发电工程类', '汽车制造类', '航空装备类', '船舶与海洋工程装备类', '铁道装备类', '自动化类', '机电设备类', '机械设计制造类', '水土保持与水环境类', '水利水电设备类', '水利工程与管理类', '水文水资源类', '城乡规划与管理类'],
            '5' => ['黑色金属材料类', '有色金属材料类', '有色金属材料类', '建筑材料类', '食品药品管理类', '药品制造类', '食品工业类', '纺织服装类', '印刷类', '包装类', '轻化工类', '化工技术类'],
            '6' => ['食品药品管理类', '药品制造类', '食品工业类', '纺织服装类', '印刷类', '包装类', '轻化工类', '生物技术类', '水土保持与水环境类'],
            '9' => ['测绘地理信息类', '环境保护类', '水土保持与水环境类', '城乡规划与管理类'],
        ];
        $arr = [];
        foreach ($subject as $key => $value) {
            foreach ($value as $k => $v) {
                $data = [];
                $info = Major::where('name', $v)->first()->toArray();
                $data['subject'] = $key;
                $data['major_id'] = $info['id'];
                $data['diplomas'] = 0;
                $arr[] = $data;
            }
        }
        $p = new MajorSubject();
        $p->addAll($arr);
    }

    public function cpp()
    {
        $college = new College();
        $colleges = $college->select('id', 'name', 'city_id')->skip(2000)->limit(1000)->get();
        foreach ($colleges as $key => $value) {
            echo $value['id']."<br>";
            if (isset($value['city_id']) && $value['city_id'] != '') {
                $city = City::where('city_name', $value['city_id'])->first();
                $college->where('id', $value['id'])->update(['city_id' => $city['id']]);
            }
        }
    }

    public function orm()
    {
        //Batch::create([
        //    "batch_name" => "哈哈",
        //]);
        $info = Batch::whereBatchName("哈哈")->first();
        print ($info->getBatchDescription());
        print ($info->batch_description);
        dd($info);
    }
}
