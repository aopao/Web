<?php
/**
 * 霍兰德+MBTI 高级测评逻辑算法
 * User: jason
 * Date: 2018/10/10
 * Time: 上午10:33
 */

namespace App\Services;

use App\Models\Major;
use App\Models\HollandMajor;
use App\Repositories\Eloquent\HollandProfessionalRepository;
use App\Repositories\Eloquent\MajorRepository;

class MbtiSeniorLogicService
{
    private $e, $i, $s, $n, $t, $f, $j, $p;

    private $hollandProfessionCode;

    private $hollandProfession;

    /**
     * 初始化各维度的初始值
     * MbtiPrimaryLogicService constructor.
     */
    public function __construct()
    {
        $this->e = $this->i = $this->s = $this->n = $this->t = $this->f = $this->j = $this->p = 0;
    }

    /**
     * 提交数据生成报告控制器中总调用方法
     *
     * @param $data
     * @param $mbtiCategoryRepository
     * @return mixed
     */
    public function handleData($data, $mbtiCategoryRepository)
    {
        /* 序列号使用记录所需数据 */
        $response['serial_number_record_data'] = MockDataService::PrimarySplitData($data);

        /* 对接收的数据进行清洗 */
        $response['parse_data'] = $this->splitResult($data);

        /* 数据二次进行分析计算出各个维度的总值 */
        $this->parseSplitResult($response['parse_data']);

        /* 计算维度数值 */
        $this->parseDimensionDegreeResult($response['parse_data']);

        /* MBTI报告所需数据 */
        $mbti_info = $mbtiCategoryRepository->findByMbtiShortCode($response['parse_data']['mbti']['name']);
        $response['parse_data']['mbti']['mbti_category_id'] = isset($mbti_info['id']) ? $mbti_info['id'] : 0;

        /* 生成霍兰德职业代码 */
        $this->getHuollandProfessionalCode($response['parse_data']['holland']);

        /* 分析学科爱好 */
        $this->parseSubjectScale($data, $response['parse_data']['holland']);

        /* 作答选择以及分析结果 */
        $response['answers'] = json_encode($response, JSON_UNESCAPED_UNICODE);

        return $response;
    }

    /**
     * 报告查看页面总调用方法
     *
     * @param $data
     * @param $HollandProfessionalRepository
     */
    public function handleReportData(&$data, $HollandProfessionalRepository)
    {
        $data['answer'] = json_decode($data['answer']);
        $data['professions'] = $HollandProfessionalRepository->findByName($data['holland_name']);
        $data['professional_category'] = $this->sortProfessional($data['subject_scale'], $data['professions']);
        $data['professional_subject'] = $this->hollandProfession;
    }

    /**
     * 对专业根据科目喜好进行排序
     *
     * @param $subject_scale
     * @param $profession
     * @return array
     */
    private function sortProfessional($subject_scale, $profession)
    {
        $professional_category = [];
        $professional_category_id = [];
        foreach ($subject_scale as $key => $value) {
            $this->hollandProfession[$key] = [];
        }
        //每个学科默认推荐4个.不够的后边补充
        //总共展示20个专业,每个专业显示4个.
        foreach ($profession as $key => $value) {

            if ($value['subject'] == 1 && count($this->hollandProfession['chinese']) < 4) {
                $this->hollandProfession['chinese'][] = $value;
            }
            if ($value['subject'] == 2 && count($this->hollandProfession['math']) < 4) {
                $this->hollandProfession['math'][] = $value;
            }
            if ($value['subject'] == 3 && count($this->hollandProfession['english']) < 4) {
                $this->hollandProfession['english'][] = $value;
            }
            if ($value['subject'] == 4 && count($this->hollandProfession['physics']) < 4) {
                $this->hollandProfession['physics'][] = $value;
            }
            if ($value['subject'] == 5 && count($this->hollandProfession['chemistry']) < 4) {
                $this->hollandProfession['chemistry'][] = $value;
            }
            if ($value['subject'] == 6 && count($this->hollandProfession['biology']) < 4) {
                $this->hollandProfession['biology'][] = $value;
            }
            if ($value['subject'] == 7 && count($this->hollandProfession['history']) < 4) {
                $this->hollandProfession['history'][] = $value;
            }
            if ($value['subject'] == 8 && count($this->hollandProfession['politics']) < 4) {
                $this->hollandProfession['politics'][] = $value;
            }
            if ($value['subject'] == 9 && count($this->hollandProfession['geography']) < 4) {
                $this->hollandProfession['geography'][] = $value;
            }
        }
        $profession = $this->hollandProfession;

        foreach ($profession as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $k => $v) {
                    if (! in_array($v['professionals']['parent_id'], $professional_category_id)) {
                        $professional_category_id[] = $v['professionals']['parent_id'];
                        $professional_category[] = Major::where('id', $v['professionals']['parent_id'])->first();
                    }
                }
            }
        }

        return $professional_category;
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
     * 分割内部数据,组装
     *
     * @param $data
     * @return mixed
     */
    private function parseSplitResult(&$data)
    {
        foreach ($data as $key => $value) {
            if ($key == 'mbti') {
                $data[$key]['result'] = array_count_values($value['choice']);
            } else {
                foreach ($value as $k => $v) {
                    $v['choice'] = array_replace($v['choice'], array_fill_keys(array_keys($v['choice'], null), ''));
                    switch ($k) {
                        case 'hobby':
                            $result = array_count_values($v['choice']);
                            $data[$key]['hobby']['result'] = $this->removeEmptyKeyAndSort($result);
                            break;
                        case 'good':
                            $result = array_count_values($v['choice']);
                            $data[$key]['good']['result'] = $this->removeEmptyKeyAndSort($result);
                            break;
                        case 'like':
                            $result = array_count_values($v['choice']);
                            $data[$key]['like']['result'] = $this->removeEmptyKeyAndSort($result);
                            break;
                            break;
                        case 'ability':
                            $data[$key]['ability']['result'] = $v['choice'];
                            break;
                        case 'skill':
                            $data[$key]['skill']['result'] = $v['choice'];
                            break;
                    }
                }
            }
        }

        return $data;
    }

    /**
     * 去除空键并且排序
     *
     * @param $array
     * @return array
     */
    private function removeEmptyKeyAndSort($array)
    {
        foreach ($array as $key => $value) {
            if ($key == '') {
                unset($array[$key]);
            }
        }

        return array_sort($array);
    }

    /**
     * 计算维度数值
     *
     * @param $data
     * @return array
     */
    private function parseDimensionDegreeResult(&$data)
    {
        /* MBTI 各维度总值 */
        $EI = $data['mbti']['result']['E'] + $data['mbti']['result']['I'];
        $SN = $data['mbti']['result']['S'] + $data['mbti']['result']['N'];
        $TF = $data['mbti']['result']['T'] + $data['mbti']['result']['F'];
        $JP = $data['mbti']['result']['J'] + $data['mbti']['result']['P'];
        /* MBTI 各维度值 */
        $mbti_scale = [];
        $mbti_scale['E'] = round(($data['mbti']['result']['E'] / $EI) * 100, 2);
        $mbti_scale['I'] = round(($data['mbti']['result']['I'] / $EI) * 100, 2);
        $mbti_scale['S'] = round(($data['mbti']['result']['S'] / $SN) * 100, 2);
        $mbti_scale['N'] = round(($data['mbti']['result']['N'] / $SN) * 100, 2);
        $mbti_scale['T'] = round(($data['mbti']['result']['T'] / $TF) * 100, 2);
        $mbti_scale['F'] = round(($data['mbti']['result']['F'] / $TF) * 100, 2);
        $mbti_scale['J'] = round(($data['mbti']['result']['J'] / $JP) * 100, 2);
        $mbti_scale['P'] = round(($data['mbti']['result']['P'] / $JP) * 100, 2);
        $data['mbti']['scale'] = $mbti_scale;

        /* MBTI 性格类型 */
        $data['mbti']['name'] = '';
        $data['mbti']['name'] .= $mbti_scale['E'] >= $mbti_scale['I'] ? 'E' : 'I';
        $data['mbti']['name'] .= $mbti_scale['S'] >= $mbti_scale['N'] ? 'S' : 'N';
        $data['mbti']['name'] .= $mbti_scale['T'] >= $mbti_scale['F'] ? 'T' : 'F';
        $data['mbti']['name'] .= $mbti_scale['J'] >= $mbti_scale['P'] ? 'J' : 'P';

        /* 霍兰德测评维度初始化*/
        $scale = [
            'R' => 0,
            'I' => 0,
            'A' => 0,
            'S' => 0,
            'E' => 0,
            'C' => 0,
        ];
        $holland = $data['holland'];

        foreach ($holland as $key => $value) {
            $scale['R'] += isset($value['result']['R']) ? $value['result']['R'] : 0;
            $scale['I'] += isset($value['result']['I']) ? $value['result']['I'] : 0;
            $scale['A'] += isset($value['result']['A']) ? $value['result']['A'] : 0;
            $scale['S'] += isset($value['result']['S']) ? $value['result']['S'] : 0;
            $scale['E'] += isset($value['result']['E']) ? $value['result']['E'] : 0;
            $scale['C'] += isset($value['result']['C']) ? $value['result']['C'] : 0;
        }
        $data['holland']['scale'] = $scale;

        return $data;
    }

    /**
     * 按照维度重新进行排序
     *
     * @param $data
     * @return array
     */
    private function rewriteScale($data)
    {
        return [
            'R' => $data['R'],
            'I' => $data['I'],
            'A' => $data['A'],
            'S' => $data['S'],
            'E' => $data['E'],
            'C' => $data['C'],
        ];
    }

    /**
     * 根绝数值的大小获取霍兰德的最终职业代码
     *
     * @param $arr
     * @return mixed
     */
    public function getHollandName($arr)
    {
        for ($i = 0; $i < 3; $i++) {
            $item = array_search(max($arr), $arr);
            unset($arr[$item]);
            $this->hollandProfessionCode .= $item;
        }

        return $this->hollandProfessionCode;
    }

    /**
     * 分析出霍兰德职业代码
     *
     * @param $data
     * @return mixed
     */
    private function getHuollandProfessionalCode(&$data)
    {
        //分析出维度最高的3个数值  数值相同的话权重比例为:R>I>A>S>E>C
        $scale = $this->rewriteScale($data['scale']);
        $data['professional_code'] = $this->getHollandName($scale);

        return $data;
    }

    /**
     * 分析出各科目的对比比例
     *
     * @param $origin_data
     * @param $data
     * @return mixed
     */
    private function parseSubjectScale($origin_data, &$data)
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
        $data['subject_scale']['chinese'] = ceil($chinese / 7 * 100) > 10 ? ceil($chinese / 7 * 100) : 10.0;
        $data['subject_scale']['math'] = ceil($math / 7 * 100) > 10 ? ceil($math / 7 * 100) : 10.0;
        $data['subject_scale']['english'] = ceil($english / 7 * 100) > 10 ? ceil($english / 7 * 100) : 10.0;
        $data['subject_scale']['physics'] = ceil($physics / 7 * 100) > 10 ? ceil($physics / 7 * 100) : 10.0;
        $data['subject_scale']['chemistry'] = ceil($chemistry / 7 * 100) > 10 ? ceil($chemistry / 7 * 100) : 10.0;
        $data['subject_scale']['biology'] = ceil($biology / 7 * 100) > 10 ? ceil($biology / 7 * 100) : 10.0;
        $data['subject_scale']['history'] = ceil($history / 7 * 100) > 10 ? ceil($history / 7 * 100) : 10.0;
        $data['subject_scale']['politics'] = ceil($politics / 7 * 100) > 10 ? ceil($politics / 7 * 100) : 10.0;
        $data['subject_scale']['geography'] = ceil($geography / 7 * 100) > 10 ? ceil($geography / 7 * 100) : 10.0;
        /* 保留键值进行排序 */
        arsort($data['subject_scale']);

        return $data;
    }
}