<?php
/**
 * MBTI 初级测评逻辑算法
 * User: jason
 * Date: 2018/9/17
 * Time: 上午10:33
 */

namespace App\Services;

class MbtiPrimaryLogicService
{
    private $e, $i, $s, $n, $t, $f, $j, $p;

    /**
     * 初始化各维度的初始值
     * MbtiPrimaryLogicService constructor.
     */
    public function __construct()
    {
        $this->e = $this->i = $this->s = $this->n = $this->t = $this->f = $this->j = $this->p = 0;
    }

    public function handleData($data, $mbtiCategoryRepository)
    {
        /* 序列号数据 */
        $serial_number_record_data = MockDataService::PrimarySplitData($data);
        $serial_number_record_data['assessment_type'] = 'mbti_primary';
        $serial_number_record_data['answers'] = json_encode($data, JSON_UNESCAPED_UNICODE);

        /* 报告数据 */
        $report = $this->getResultNumber($data);
        $report['mobile'] = $serial_number_record_data['mobile'];
        $report['serial_number'] = $serial_number_record_data['serial_number'];
        $report['mbti_name'] = $this->getResultName($data);
        $mbti_info = $mbtiCategoryRepository->findByMbtiShortCode($report['mbti_name']);
        $report['mbti_category_id'] = isset($mbti_info['id']) ? $mbti_info['id'] : 0;

        return compact('report', 'serial_number_record_data');
    }

    /**
     * 根据传入的数组数据分析结果数值
     *
     * @param $data
     * @return array
     */
    public function getResultNumber($data)
    {
        $p = 1;
        $logic = config('logic.mbti_issue_93');
        foreach ($data as $key => $value) {
            if (isset($logic[$p][$value])) {
                $temp = $logic[$p][$value];
                $this->addDimension($temp);
            }
            $p++;
        }

        return $this->finalResult();
    }

    /**
     * 根据数值分析出 MBTI类型
     *
     * @param $data
     * @return string
     */
    public function getResultName($data)
    {
        $result = $this->getResultNumber($data);
        $str = $result['e'] >= $result['i'] ? 'E' : 'I';
        $str .= $result['s'] >= $result['n'] ? 'S' : 'N';
        $str .= $result['t'] >= $result['f'] ? 'T' : 'F';
        $str .= $result['j'] >= $result['p'] ? 'J' : 'P';

        return $str;
    }

    /**
     * 根绝值对不同维度的参数加一
     *
     * @param $string
     */
    private function addDimension($string)
    {
        switch ($string) {
            case 'E':
                $this->e++;
                break;
            case 'S':
                $this->s++;
                break;
            case 'T':
                $this->t++;
                break;
            case 'J':
                $this->j++;
        }
    }

    /**
     * 得出最终类型的短代码
     *
     * @return array
     */
    private function finalResult()
    {
        $data = [
            'e' => $this->e,
            'i' => config('logic.mbti_issue_93_role.I') - $this->e,
            's' => $this->s,
            'n' => config('logic.mbti_issue_93_role.N') - $this->s,
            't' => $this->t,
            'f' => config('logic.mbti_issue_93_role.F') - $this->t,
            'j' => $this->j,
            'p' => config('logic.mbti_issue_93_role.P') - $this->j,
        ];

        return $data;
    }

    public function handleReportData(&$report_data)
    {
        $data = $report_data;
        $report_data['e'] = $this->getScale($report_data['e'], 'E');
        $report_data['i'] = $this->getScale($report_data['i'], 'I');
        $report_data['s'] = $this->getScale($report_data['s'], 'S');
        $report_data['n'] = $this->getScale($report_data['n'], 'N');
        $report_data['t'] = $this->getScale($report_data['t'], 'T');
        $report_data['f'] = $this->getScale($report_data['f'], 'F');
        $report_data['j'] = $this->getScale($report_data['j'], 'J');
        $report_data['p'] = $this->getScale($report_data['p'], 'P');

        $report_data['inclination_degree'] = $this->getInclinationDegree($data);
    }

    private function getInclinationDegree($data)
    {
        $mbti_degree = 0;
        $mbti_degree_sum = config('logic.mbti_issue_93_role.I') + config('logic.mbti_issue_93_role.N') + config('logic.mbti_issue_93_role.F') + config('logic.mbti_issue_93_role.P');
        for ($i = 0; $i < strlen($data['mbti_name']); $i++) {
            $mbti_degree += $data[strtolower(substr($data['mbti_name'], $i, 1))];
        }

        return round(($mbti_degree / $mbti_degree_sum) * 100, 2);
    }

    /**
     * 计算出各维度的比例
     *
     * @param        $data
     * @param string $dimension
     * @return float
     */
    private function getScale($data, $dimension = 'E')
    {
        switch ($dimension) {
            case 'E':
            case 'I':
                return ceil(($data / (config('logic.mbti_issue_93_role.I'))) * 100);
            case 'S':
            case 'N':
                return round(($data / config('logic.mbti_issue_93_role.N')) * 100, 2);
            case 'T':
            case 'F':
                return ceil(($data / config('logic.mbti_issue_93_role.F')) * 100);
            case 'J':
            case 'P':
                return ceil(($data / config('logic.mbti_issue_93_role.P')) * 100);
        }
    }
}