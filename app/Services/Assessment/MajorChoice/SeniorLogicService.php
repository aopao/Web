<?php
/**
 * 霍兰德+MBTI 高级测评逻辑算法
 * User: jason
 * Date: 2018/10/10
 * Time: 上午10:33
 */

namespace App\Services\Assessment\MajorChoice;

use App\Models\Major;
use App\Repositories\Eloquent\Assessment\Comment\HollandMajorRepository;
use App\Repositories\Eloquent\MbtiCategoryRepository;
use App\Services\MockDataService;

class SeniorLogicService
{
    private $hollandMajors;

    /**
     * @var \App\Repositories\Eloquent\MbtiCategoryRepository
     */
    private $mbtiCategoryRepository;

    /**
     * @var \App\Repositories\Eloquent\Assessment\Comment\HollandMajorRepository
     */
    private $hollandMajorRepository;

    /**
     * 初始化各维度的初始值
     * MbtiPrimaryLogicService constructor.
     *
     * @param \App\Repositories\Eloquent\MbtiCategoryRepository                    $mbtiCategoryRepository
     * @param \App\Repositories\Eloquent\Assessment\Comment\HollandMajorRepository $hollandMajorRepository
     */
    public function __construct(MbtiCategoryRepository $mbtiCategoryRepository, HollandMajorRepository $hollandMajorRepository)
    {
        $this->hollandMajorRepository = $hollandMajorRepository;
        $this->mbtiCategoryRepository = $mbtiCategoryRepository;
    }

    /**
     * 提交数据生成报告控制器中总调用方法
     *
     * @param $data
     * @return mixed
     */
    public function handleData($data)
    {
        /* 序列号使用记录所需数据 */
        $serial_number = MockDataService::parseData($data);
        $serial_number['assessment_type'] = 'major_choice_senior';

        /* 对接收的数据进行清洗 */
        $response = $this->splitResult($data);

        /* 分析计算出各个维度的总数 */
        $this->getDimensionSum($response);

        /* 计算维度数值 */
        $this->getDimensionRatio($response);
        /* MBTI报告所需数据 */
        $mbti_info = $this->mbtiCategoryRepository->findByMbtiShortCode($response['mbti']['name']);
        $response['mbti']['mbti_category_id'] = isset($mbti_info['id']) ? $mbti_info['id'] : 0;

        /* 生成霍兰德职业代码 */
        $response['holland']['professional_code'] = $this->getHuollandProfessionalCode($response['holland']['ratio']);

        /* 分析学科爱好 */
        $this->parseSubjectRatio($data, $response['holland']);

        /* 对结果进行汇总合并成数组 */

        return compact('serial_number', 'response');
    }

    /**
     * 对结果进行拆分,方便逻辑运算
     *
     * @param $data
     * @return array
     */
    private function splitResult($data)
    {
        $response = [];
        foreach ($data as $key => $value) {
            if (stristr($key, 'mbti')) {
                $response['mbti']['choice'][] = $value;
            } elseif (stristr($key, 'hobby')) {
                $response['holland']['hobby']['choice'][] = $value;
            } elseif (stristr($key, 'good')) {
                $response['holland']['good']['choice'][] = $value;
            } elseif (stristr($key, 'like')) {
                $response['holland']['like']['choice'][] = $value;
            } elseif (stristr($key, 'ability')) {
                $response['holland']['ability']['choice'][substr($key, 8, 1)] = $value;
            } elseif (stristr($key, 'skill')) {
                $response['holland']['skill']['choice'][substr($key, 6, 1)] = $value;
            }
        }

        return $response;
    }

    /**
     * 对 MBTI数据和 Holland数据进行分割
     *
     * @param $data
     * @return mixed
     */
    private function getDimensionSum(&$data)
    {
        foreach ($data as $key => $value) {
            if ($key == 'mbti') {
                $data[$key]['result'] = $this->initMbtiDimension(array_count_values($value['choice']));
            } else {
                foreach ($value as $k => $v) {
                    $v['choice'] = array_replace($v['choice'], array_fill_keys(array_keys($v['choice'], null), ''));
                    switch ($k) {
                        case 'hobby':
                            $data[$key]['hobby']['result'] = $this->initHollandDImension(array_count_values($v['choice']));
                            break;
                        case 'good':
                            $data[$key]['good']['result'] = $this->initHollandDImension(array_count_values($v['choice']));
                            break;
                        case 'like':
                            $data[$key]['like']['result'] = $this->initHollandDImension(array_count_values($v['choice']));
                            break;
                        case 'ability':
                            $data[$key]['ability']['result'] = $this->initHollandDImension($v['choice']);
                            break;
                        case 'skill':
                            $data[$key]['skill']['result'] = $this->initHollandDImension($v['choice']);
                            break;
                    }
                }
            }
        }

        return $data;
    }

    /**
     * 对 MBTI 结果进行初始化
     *
     * @param $data
     * @return mixed
     */
    private function initMbtiDimension($data)
    {
        return [
            'E' => isset($data['E']) ? $data['E'] : 0,
            'I' => isset($data['I']) ? $data['I'] : 0,
            'S' => isset($data['S']) ? $data['S'] : 0,
            'N' => isset($data['N']) ? $data['N'] : 0,
            'T' => isset($data['T']) ? $data['T'] : 0,
            'F' => isset($data['F']) ? $data['F'] : 0,
            'J' => isset($data['J']) ? $data['J'] : 0,
            'P' => isset($data['P']) ? $data['P'] : 0,
        ];
    }

    /**
     * 对 Holland 结果进行初始化
     *
     * @param $data
     * @return array
     */
    private function initHollandDImension($data)
    {
        return [
            'R' => isset($data['R']) ? $data['R'] : 0,
            'I' => isset($data['I']) ? $data['I'] : 0,
            'A' => isset($data['A']) ? $data['A'] : 0,
            'S' => isset($data['S']) ? $data['S'] : 0,
            'E' => isset($data['E']) ? $data['E'] : 0,
            'C' => isset($data['C']) ? $data['C'] : 0,
        ];
    }

    /**
     * 计算维度数值
     *
     * @param $data
     * @return array
     */
    private function getDimensionRatio(&$data)
    {
        /* MBTI赋值 */
        $e = $data['mbti']['result']['E'];
        $i = $data['mbti']['result']['I'];
        $s = $data['mbti']['result']['S'];
        $n = $data['mbti']['result']['N'];
        $t = $data['mbti']['result']['T'];
        $f = $data['mbti']['result']['F'];
        $j = $data['mbti']['result']['J'];
        $p = $data['mbti']['result']['P'];

        /* MBTI 各维度总值 然后容错余数为零的情况 */
        $EI = ($e + $i) != 0 ? $e + $i : 1;
        $SN = ($s + $n) != 0 ? $s + $n : 1;
        $TF = ($t + $f) != 0 ? $t + $f : 1;
        $JP = ($j + $p) != 0 ? $j + $p : 1;

        /* MBTI 各维度值 */
        $mbti_ratio = [];
        $mbti_ratio['E'] = round(($e / $EI) * 100, 2);
        $mbti_ratio['I'] = round(($i / $EI) * 100, 2);
        $mbti_ratio['S'] = round(($s / $SN) * 100, 2);
        $mbti_ratio['N'] = round(($n / $SN) * 100, 2);
        $mbti_ratio['T'] = round(($t / $TF) * 100, 2);
        $mbti_ratio['F'] = round(($f / $TF) * 100, 2);
        $mbti_ratio['J'] = round(($j / $JP) * 100, 2);
        $mbti_ratio['P'] = round(($p / $JP) * 100, 2);
        $data['mbti']['ratio'] = $mbti_ratio;

        /* MBTI 性格类型 */
        $data['mbti']['name'] = '';
        $data['mbti']['name'] .= $mbti_ratio['E'] >= $mbti_ratio['I'] ? 'E' : 'I';
        $data['mbti']['name'] .= $mbti_ratio['S'] >= $mbti_ratio['N'] ? 'S' : 'N';
        $data['mbti']['name'] .= $mbti_ratio['T'] >= $mbti_ratio['F'] ? 'T' : 'F';
        $data['mbti']['name'] .= $mbti_ratio['J'] >= $mbti_ratio['P'] ? 'J' : 'P';

        /* 霍兰德测评维度初始化*/
        $ratio = [
            'R' => 0,
            'I' => 0,
            'A' => 0,
            'S' => 0,
            'E' => 0,
            'C' => 0,
        ];

        if (isset($data['holland'])) {
            $holland = $data['holland'];
            foreach ($holland as $key => $value) {
                $ratio['R'] += isset($value['result']['R']) ? $value['result']['R'] : 0;
                $ratio['I'] += isset($value['result']['I']) ? $value['result']['I'] : 0;
                $ratio['A'] += isset($value['result']['A']) ? $value['result']['A'] : 0;
                $ratio['S'] += isset($value['result']['S']) ? $value['result']['S'] : 0;
                $ratio['E'] += isset($value['result']['E']) ? $value['result']['E'] : 0;
                $ratio['C'] += isset($value['result']['C']) ? $value['result']['C'] : 0;
            }
            $data['holland']['ratio'] = $ratio;
        }

        return $data;
    }

    /**
     * 分析出霍兰德职业代码
     *
     * @param $data
     * @return mixed
     */
    private function getHuollandProfessionalCode($data)
    {
        //分析出维度最高的3个数值  数值相同的话权重比例为:R>I>A>S>E>C
        $sort_dimension = [
            'R' => $data['R'],
            'I' => $data['I'],
            'A' => $data['A'],
            'S' => $data['S'],
            'E' => $data['E'],
            'C' => $data['C'],
        ];

        $holland_professional_code = '';
        for ($i = 0; $i < 3; $i++) {
            $item = array_search(max($sort_dimension), $sort_dimension);
            unset($sort_dimension[$item]);
            $holland_professional_code .= $item;
        }

        return $holland_professional_code;
    }

    /**
     * 分析出各科目的对比比例
     *
     * @param $origin_data
     * @param $data
     * @return mixed
     */
    private function parseSubjectRatio($origin_data, &$data)
    {
        $chinese = $math = $english = $physics = $chemistry = $biology = $history = $politics = $geography = 0;
        foreach ($origin_data as $key => $value) {

            if (($key == 'like_C_291' && $value != '') || ($key == 'like_C_293' && $value != '') || ($key == 'like_C_294' && $value != '') || ($key == 'like_C_295' && $value != '') || ($key == 'like_C_296' && $value != '') || ($key == 'like_C_297' && $value != '') || ($key == 'like_C_299' && $value != '')) {
                $math++;
            }
            if (($key == 'hobby_A_148' && $value != '') || ($key == 'hobby_A_149' && $value != '') || ($key == 'hobby_C_171' && $value != '') || ($key == 'good_A_205' && $value != '') || ($key == 'good_C_231' && $value != '') || ($key == 'good_C_233' && $value != '') || ($key == 'like_A_267' && $value != '')) {
                $chinese++;
            }
            if (($key == 'hobby_C_178' && $value != '') || ($key == 'good_I_200' && $value != '') || ($key == 'good_S_211' && $value != '') || ($key == 'good_S_213' && $value != '') || ($key == 'good_E_223' && $value != '') || ($key == 'good_C_232' && $value != '') || ($key == 'good_C_235' && $value != '')) {
                $english++;
            }
            if (($key == 'hobby_R_130' && $value != '') || ($key == 'hobby_I_137' && $value != '') || ($key == 'good_R_182' && $value != '') || ($key == 'good_R_190' && $value != '') || ($key == 'like_R_248' && $value != '') || ($key == 'like_I_251' && $value != '') || ($key == 'ability_R_301' && $value != '')) {
                $physics++;
            }
            if (($key == 'hobby_I_135' && $value != '') || ($key == 'hobby_I_138' && $value != '') || ($key == 'good_I_193' && $value != '') || ($key == 'like_I_256' && $value != '') || ($key == 'like_I_258' && $value != '') || ($key == 'like_R_247' && $value != '') || ($key == 'ability_I_302' && $value != '')) {
                $chemistry++;
            }
            if (($key == 'hobby_I_133' && $value != '') || ($key == 'hobby_I_140' && $value != '') || ($key == 'good_I_192' && $value != '') || ($key == 'good_I_195' && $value != '') || ($key == 'like_R_242' && $value != '') || ($key == 'like_I_252' && $value != '') || ($key == 'like_I_255' && $value != '')) {
                $biology++;
            }
            if (($key == 'hobby_R_122' && $value != '') || ($key == 'good_R_184' && $value != '') || ($key == 'good_R_189' && $value != '') || ($key == 'like_R_249' && $value != '') || ($key == 'like_R_250' && $value != '') || ($key == 'like_S_272' && $value != '') || ($key == 'like_C_298' && $value != '')) {
                $history++;
            }
            if (($key == 'hobby_R_129' && $value != '') || ($key == 'hobby_E_161' && $value != '') || ($key == 'hobby_E_163' && $value != '') || ($key == 'hobby_E_169' && $value != '') || ($key == 'good_E_229' && $value != '') || ($key == 'like_I_252' && $value != '') || ($key == 'skill_I_308' && $value != '')) {
                $politics++;
            }
            if (($key == 'hobby_R_125' && $value != '') || ($key == 'hobby_I_131' && $value != '') || ($key == 'hobby_I_139' && $value != '') || ($key == 'good_R_183' && $value != '') || ($key == 'good_R_188' && $value != '') || ($key == 'good_I_196' && $value != '') || ($key == 'like_I_260' && $value != '')) {
                $geography++;
            }
        }
        /* 如果某个科目都没有选择,为了显示数据更加合理,默认最低值为10.0 */
        $data['subject_ratio']['chinese'] = ceil($chinese / 7 * 100) > 10 ? ceil($chinese / 7 * 100) : 10.0;
        $data['subject_ratio']['math'] = ceil($math / 7 * 100) > 10 ? ceil($math / 7 * 100) : 10.0;
        $data['subject_ratio']['english'] = ceil($english / 7 * 100) > 10 ? ceil($english / 7 * 100) : 10.0;
        $data['subject_ratio']['physics'] = ceil($physics / 7 * 100) > 10 ? ceil($physics / 7 * 100) : 10.0;
        $data['subject_ratio']['chemistry'] = ceil($chemistry / 7 * 100) > 10 ? ceil($chemistry / 7 * 100) : 10.0;
        $data['subject_ratio']['biology'] = ceil($biology / 7 * 100) > 10 ? ceil($biology / 7 * 100) : 10.0;
        $data['subject_ratio']['history'] = ceil($history / 7 * 100) > 10 ? ceil($history / 7 * 100) : 10.0;
        $data['subject_ratio']['politics'] = ceil($politics / 7 * 100) > 10 ? ceil($politics / 7 * 100) : 10.0;
        $data['subject_ratio']['geography'] = ceil($geography / 7 * 100) > 10 ? ceil($geography / 7 * 100) : 10.0;

        if ($data['subject_ratio']['chinese'] > 95) {
            $data['subject_ratio']['chinese'] = $data['subject_ratio']['chinese'] - 10;
        }
        if ($data['subject_ratio']['math'] > 95) {
            $data['subject_ratio']['math'] = $data['subject_ratio']['math'] - 10;
        }
        if ($data['subject_ratio']['english'] > 95) {
            $data['subject_ratio']['english'] = $data['subject_ratio']['english'] - 10;
        }
        if ($data['subject_ratio']['physics'] > 95) {
            $data['subject_ratio']['physics'] = $data['subject_ratio']['physics'] - 10;
        }
        if ($data['subject_ratio']['chemistry'] > 95) {
            $data['subject_ratio']['chemistry'] = $data['subject_ratio']['chemistry'] - 10;
        }
        if ($data['subject_ratio']['biology'] > 95) {
            $data['subject_ratio']['biology'] = $data['subject_ratio']['biology'] - 10;
        }
        if ($data['subject_ratio']['history'] > 95) {
            $data['subject_ratio']['history'] = $data['subject_ratio']['history'] - 10;
        }
        if ($data['subject_ratio']['politics'] > 95) {
            $data['subject_ratio']['politics'] = $data['subject_ratio']['politics'] - 10;
        }
        if ($data['subject_ratio']['geography'] > 95) {
            $data['subject_ratio']['geography'] = $data['subject_ratio']['geography'] - 10;
        }

        /* 保留键值进行排序 */
        arsort($data['subject_ratio']);

        return $data;
    }

    /**
     * 报告查看页面总调用方法
     *
     * @param $data
     */
    public function handleReportData(&$data)
    {
        $data['answer'] = json_decode($data['answer']);
        $data['majors'] = $this->hollandMajorRepository->findByName($data['holland_name']);
        $data['major_category'] = $this->sortMajors(json_decode($data['subject_ratio']), $data['majors']);
        $data['majors_subject'] = $this->hollandMajors;
    }

    /**
     * 对专业根据科目喜好进行排序
     *
     * @param $subject_ratio
     * @param $major
     * @return array
     */
    private function sortMajors($subject_ratio, $major)
    {
        $major_category = [];
        $major_category_id = [];
        foreach ($subject_ratio as $key => $value) {
            $this->hollandMajors[$key] = [];
        }

        //总共展示20个专业,每个专业显示4个.不够的后边补充
        foreach ($major as $key => $value) {

            if ($value['subject'] == 1 && count($this->hollandMajors['chinese']) < 4) {
                $this->hollandMajors['chinese'][] = $value;
            }
            if ($value['subject'] == 2 && count($this->hollandMajors['math']) < 4) {
                $this->hollandMajors['math'][] = $value;
            }
            if ($value['subject'] == 3 && count($this->hollandMajors['english']) < 4) {
                $this->hollandMajors['english'][] = $value;
            }
            if ($value['subject'] == 4 && count($this->hollandMajors['physics']) < 4) {
                $this->hollandMajors['physics'][] = $value;
            }
            if ($value['subject'] == 5 && count($this->hollandMajors['chemistry']) < 4) {
                $this->hollandMajors['chemistry'][] = $value;
            }
            if ($value['subject'] == 6 && count($this->hollandMajors['biology']) < 4) {
                $this->hollandMajors['biology'][] = $value;
            }
            if ($value['subject'] == 7 && count($this->hollandMajors['history']) < 4) {
                $this->hollandMajors['history'][] = $value;
            }
            if ($value['subject'] == 8 && count($this->hollandMajors['politics']) < 4) {
                $this->hollandMajors['politics'][] = $value;
            }
            if ($value['subject'] == 9 && count($this->hollandMajors['geography']) < 4) {
                $this->hollandMajors['geography'][] = $value;
            }
        }
        $majors = $this->hollandMajors;

        foreach ($majors as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $k => $v) {
                    if (! in_array($v['majors']['parent_id'], $major_category_id)) {
                        $major_category_id[] = $v['majors']['parent_id'];
                        $major_category[] = Major::where('id', $v['majors']['parent_id'])->first();
                    }
                }
            }
        }

        return $major_category;
    }
}