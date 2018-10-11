<?php
/**
 * 霍兰德+MBTI 高级测评逻辑算法
 * User: jason
 * Date: 2018/10/10
 * Time: 上午10:33
 */

namespace App\Services;

class MbtiSeniorLogicService
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
        $response = [];
        //$temp_data = $this->splitResult($data);
        //模拟数据
        $temp_data = [
            'mbti' => [
                'choice' => [
                    0 => 'N',
                    1 => 'N',
                    2 => 'N',
                    3 => 'N',
                    4 => 'N',
                    5 => 'S',
                    6 => 'N',
                    7 => 'S',
                    8 => 'S',
                    9 => 'S',
                    10 => 'N',
                    11 => 'S',
                    12 => 'N',
                    13 => 'S',
                    14 => 'S',
                    15 => 'E',
                    16 => 'E',
                    17 => 'I',
                    18 => 'E',
                    19 => 'E',
                    20 => 'I',
                    21 => 'I',
                    22 => 'I',
                    23 => 'I',
                    24 => 'E',
                    25 => 'I',
                    26 => 'E',
                    27 => 'I',
                    28 => 'I',
                    29 => 'I',
                    30 => 'T',
                    31 => 'F',
                    32 => 'F',
                    33 => 'F',
                    34 => 'T',
                    35 => 'T',
                    36 => 'T',
                    37 => 'T',
                    38 => 'T',
                    39 => 'T',
                    40 => 'T',
                    41 => 'T',
                    42 => 'T',
                    43 => 'T',
                    44 => 'F',
                    45 => 'J',
                    46 => 'J',
                    47 => 'P',
                    48 => 'J',
                    49 => 'J',
                    50 => 'J',
                    51 => 'J',
                    52 => 'P',
                    53 => 'P',
                    54 => 'P',
                    55 => 'J',
                    56 => 'J',
                    57 => 'J',
                    58 => 'J',
                    59 => 'J',
                    60 => 'N',
                    61 => 'N',
                    62 => 'N',
                    63 => 'N',
                    64 => 'N',
                    65 => 'S',
                    66 => 'N',
                    67 => 'S',
                    68 => 'S',
                    69 => 'S',
                    70 => 'N',
                    71 => 'S',
                    72 => 'N',
                    73 => 'S',
                    74 => 'S',
                    75 => 'E',
                    76 => 'E',
                    77 => 'I',
                    78 => 'E',
                    79 => 'E',
                    80 => 'I',
                    81 => 'I',
                    82 => 'I',
                    83 => 'I',
                    84 => 'E',
                    85 => 'I',
                    86 => 'E',
                    87 => 'I',
                    88 => 'I',
                    89 => 'I',
                    90 => 'T',
                    91 => 'F',
                    92 => 'F',
                    93 => 'F',
                    94 => 'T',
                    95 => 'T',
                    96 => 'T',
                    97 => 'T',
                    98 => 'T',
                    99 => 'T',
                    100 => 'T',
                    101 => 'T',
                    102 => 'T',
                    103 => 'T',
                    104 => 'F',
                    105 => 'J',
                    106 => 'J',
                    107 => 'P',
                    108 => 'J',
                    109 => 'J',
                    110 => 'J',
                    111 => 'J',
                    112 => 'P',
                    113 => 'P',
                    114 => 'P',
                    115 => 'J',
                    116 => 'J',
                    117 => 'J',
                    118 => 'J',
                    119 => 'J',
                ],
            ],
            'holland' => [
                'hobby' => [
                    'choice' => [
                        0 => 'R',
                        1 => '',
                        2 => '',
                        3 => '',
                        4 => 'R',
                        5 => 'R',
                        6 => '',
                        7 => '',
                        8 => 'R',
                        9 => 'R',
                        10 => 'I',
                        11 => 'I',
                        12 => '',
                        13 => '',
                        14 => 'I',
                        15 => 'I',
                        16 => '',
                        17 => 'I',
                        18 => 'I',
                        19 => 'I',
                        20 => 'A',
                        21 => '',
                        22 => '',
                        23 => 'A',
                        24 => 'A',
                        25 => 'A',
                        26 => '',
                        27 => 'A',
                        28 => 'A',
                        29 => 'A',
                        30 => 'S',
                        31 => 'S',
                        32 => 'S',
                        33 => 'S',
                        34 => 'S',
                        35 => '',
                        36 => 'S',
                        37 => 'S',
                        38 => 'S',
                        39 => 'S',
                        40 => 'E',
                        41 => 'E',
                        42 => 'E',
                        43 => '',
                        44 => '',
                        45 => 'E',
                        46 => '',
                        47 => 'E',
                        48 => 'E',
                        49 => '',
                        50 => 'C',
                        51 => '',
                        52 => 'C',
                        53 => '',
                        54 => '',
                        55 => 'C',
                        56 => 'C',
                        57 => 'C',
                        58 => 'C',
                        59 => 'C',
                    ],
                ],
                'good' => [
                    'choice' => [
                        0 => 'R',
                        1 => 'R',
                        2 => 'R',
                        3 => 'R',
                        4 => 'R',
                        5 => 'R',
                        6 => 'R',
                        7 => 'R',
                        8 => 'R',
                        9 => 'R',
                        10 => 'I',
                        11 => 'I',
                        12 => 'I',
                        13 => 'I',
                        14 => 'I',
                        15 => 'I',
                        16 => 'I',
                        17 => 'I',
                        18 => 'I',
                        19 => 'I',
                        20 => 'A',
                        21 => 'A',
                        22 => 'A',
                        23 => 'A',
                        24 => 'A',
                        25 => 'A',
                        26 => 'A',
                        27 => 'A',
                        28 => 'A',
                        29 => 'A',
                        30 => 'S',
                        31 => 'S',
                        32 => 'S',
                        33 => 'S',
                        34 => 'S',
                        35 => 'S',
                        36 => 'S',
                        37 => 'S',
                        38 => 'S',
                        39 => 'S',
                        40 => 'E',
                        41 => 'E',
                        42 => 'E',
                        43 => 'E',
                        44 => 'E',
                        45 => 'E',
                        46 => 'E',
                        47 => 'E',
                        48 => 'E',
                        49 => 'E',
                        50 => 'C',
                        51 => 'C',
                        52 => 'C',
                        53 => 'C',
                        54 => 'C',
                        55 => 'C',
                        56 => 'C',
                        57 => 'C',
                        58 => 'C',
                        59 => 'C',
                    ],
                ],
                'like' => [
                    'choice' => [
                        0 => '',
                        1 => '',
                        2 => 'R',
                        3 => '',
                        4 => 'R',
                        5 => '',
                        6 => 'R',
                        7 => '',
                        8 => 'R',
                        9 => 'R',
                        10 => 'I',
                        11 => 'I',
                        12 => 'I',
                        13 => 'I',
                        14 => 'I',
                        15 => 'I',
                        16 => 'I',
                        17 => 'I',
                        18 => 'I',
                        19 => 'I',
                        20 => 'A',
                        21 => 'A',
                        22 => 'A',
                        23 => 'A',
                        24 => 'A',
                        25 => 'A',
                        26 => 'A',
                        27 => 'A',
                        28 => 'A',
                        29 => 'A',
                        30 => 'S',
                        31 => 'S',
                        32 => 'S',
                        33 => 'S',
                        34 => 'S',
                        35 => 'S',
                        36 => 'S',
                        37 => 'S',
                        38 => 'S',
                        39 => 'S',
                        40 => 'E',
                        41 => 'E',
                        42 => 'E',
                        43 => 'E',
                        44 => 'E',
                        45 => 'E',
                        46 => 'E',
                        47 => 'E',
                        48 => 'E',
                        49 => 'E',
                        50 => 'C',
                        51 => 'C',
                        52 => 'C',
                        53 => 'C',
                        54 => 'C',
                        55 => 'C',
                        56 => 'C',
                        57 => 'C',
                        58 => 'C',
                        59 => 'C',
                    ],
                ],
                'ability' => ['choice' => ['R' => 1, 'I' => 3, 'A' => 0, 'S' => 4, 'E' => 1, 'C' => 1,],],
                'skill' => ['choice' => ['R' => 0, 'I' => 4, 'A' => 4, 'S' => 1, 'E' => 1, 'C' => 3,],],
            ],
        ];

        $response['parse_data'] = $this->parseSplitResult($temp_data);

        /* 计算维度数值 */
        $this->parseDimensionDegreeResult($response['parse_data']);

        return $response;
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
                $response['holland']['hobby']['choice'] = $value;
            } elseif (stristr($key, 'good')) {
                $response['holland']['good']['choice'] = $value;
            } elseif (stristr($key, 'like')) {
                $response['holland']['like']['choice'] = $value;
            } elseif (stristr($key, 'ability')) {
                $response['holland']['ability']['choice'] = $value;
            } elseif (stristr($key, 'skill')) {
                $response['holland']['skill']['choice'] = $value;
            }
        }

        return $this->parseSplitResult($response);
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
            $scale['R'] += $value['result']['R'];
            $scale['I'] += $value['result']['I'];
            $scale['A'] += $value['result']['A'];
            $scale['S'] += $value['result']['S'];
            $scale['E'] += $value['result']['E'];
            $scale['C'] += $value['result']['C'];
        }
        $data['holland']['scale'] = $scale;

        return $data;
    }
}