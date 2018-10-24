<?php
/**
 * MBTI 测评逻辑算法 93 题
 * User: jason
 * Date: 2018/9/17
 * Time: 上午10:33
 */

namespace App\Services\Assessment\Mbti;

use App\Repositories\Eloquent\MbtiCategoryRepository;
use App\Services\MockDataService;

class SeniorLogicService
{
    /**
     * @var \App\Repositories\Eloquent\MbtiCategoryRepository
     */
    private $mbtiCategoryRepository;

    /**
     * 初始化各维度的初始值
     * MbtiPrimaryLogicService constructor.
     *
     * @param \App\Repositories\Eloquent\MbtiCategoryRepository $mbtiCategoryRepository
     */
    public function __construct(MbtiCategoryRepository $mbtiCategoryRepository)
    {
        $this->mbtiCategoryRepository = $mbtiCategoryRepository;
    }

    public function handleData($data)
    {
        /* 序列号数据 */
        $serial_number = MockDataService::parseData($data);
        $serial_number['assessment_type'] = 'mbti_senior';

        ///* 报告数据 */
        $response = $this->getResultNumber($data);
        $response['mobile'] = $serial_number['mobile'];
        $response['serial_number'] = $serial_number['serial_number'];
        $response['mbti_name'] = $this->getResultName($response);
        $response['answers'] = json_encode($data, JSON_UNESCAPED_UNICODE);

        $mbti_info = $this->mbtiCategoryRepository->findByMbtiShortCode($response['mbti_name']);
        $response['mbti_category_id'] = isset($mbti_info['id']) ? $mbti_info['id'] : 0;

        return compact('response', 'serial_number');
    }

    /**
     * 根据传入的数组数据分析结果数值
     *
     * @param $data
     * @return array
     */
    public function getResultNumber($data)
    {
        $index = 1;
        $e = $i = $s = $n = $t = $f = $j = $p = 0;
        $logic = config('logic.mbti_issue_93');
        foreach ($data as $key => $value) {
            if (isset($logic[$index][$value])) {
                $temp = $logic[$index][$value];
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
                        break;
                }
            }
            $index++;
        }
        $i = config('logic.mbti_issue_93_role.I') - $e;
        $n = config('logic.mbti_issue_93_role.N') - $s;
        $f = config('logic.mbti_issue_93_role.F') - $t;
        $p = config('logic.mbti_issue_93_role.P') - $j;

        return compact('e', 'i', 's', 'n', 't', 'f', 'j', 'p');
    }

    /**
     * 根据数值分析出 MBTI类型
     *
     * @param $data
     * @return string
     */
    public function getResultName($data)
    {
        $str = $data['e'] >= $data['i'] ? 'E' : 'I';
        $str .= $data['s'] >= $data['n'] ? 'S' : 'N';
        $str .= $data['t'] >= $data['f'] ? 'T' : 'F';
        $str .= $data['j'] >= $data['p'] ? 'J' : 'P';

        return $str;
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
}