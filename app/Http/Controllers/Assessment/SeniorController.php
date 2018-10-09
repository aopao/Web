<?php

namespace App\Http\Controllers\Assessment;

use App\Http\Requests\SerialNumberSeniorRequest;
use App\Repositories\Eloquent\MbtiSeniorIssueRepository;
use App\Repositories\Eloquent\SerialNumberRecordRepository;
use App\Repositories\Eloquent\SerialNumberRepository;
use App\Services\ArrayTranformsService;
use App\Services\MockDataService;
use App\Services\SeniorHttpService;
use Illuminate\Http\Request;
use App\Services\ParseHtmlService;

class SeniorController extends BaseController
{
    /**
     * 高级测试序列号填写部分
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('assessment.senior.index');
    }

    /**
     * 进入测试后填写用户信息界面
     *
     * @param \App\Http\Requests\SerialNumberSeniorRequest         $serialNumberSeniorRequest
     * @param \App\Repositories\Eloquent\MbtiSeniorIssueRepository $mbtiSeniorIssueRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function collect(SerialNumberSeniorRequest $serialNumberSeniorRequest, MbtiSeniorIssueRepository $mbtiSeniorIssueRepository)
    {
        $number = $serialNumberSeniorRequest->get('number');
        $data = $this->serialNumberRepository->findByNumber($number)->ToArray();
        if (isset($data) && $data['is_invalid'] == 0) {
            return view('assessment.senior.collect', compact('data'));
        } else {
            return view('assessment.senior.show', compact('data'));
        }
    }

    /**
     * 用户测试答题界面
     *
     * @param \App\Http\Requests\SerialNumberSeniorRequest         $serialNumberSeniorRequest
     * @param \App\Repositories\Eloquent\MbtiSeniorIssueRepository $mbtiSeniorIssueRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function issue(SerialNumberSeniorRequest $serialNumberSeniorRequest, MbtiSeniorIssueRepository $mbtiSeniorIssueRepository)
    {
        $data = $serialNumberSeniorRequest->all();
        $issues = $mbtiSeniorIssueRepository->getAllMbtiSeniorIssues()->ToArray();

        return view('assessment.senior.issue', compact('data', 'issues'));
    }

    /**
     * 用户查看报告界面
     *
     * @param \Illuminate\Http\Request                                $request
     * @param \App\Services\ArrayTranformsService                     $arrayTranformsService
     * @param \App\Repositories\Eloquent\SerialNumberRecordRepository $serialNumberRecordRepository
     * @param \App\Services\SeniorHttpService                         $seniorHttpService
     * @param \App\Repositories\Eloquent\SerialNumberRepository       $serialNumberRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function report(Request $request, ArrayTranformsService $arrayTranformsService, SerialNumberRecordRepository $serialNumberRecordRepository, SeniorHttpService $seniorHttpService, SerialNumberRepository $serialNumberRepository)
    {
        $data = $request->all();

        /*判断是否是刷新*/
        $private_data = $serialNumberRecordRepository->findBySerialNumberId($data['serial_number_id']);
        if ($private_data) {
            $msg = trans('comment/form.not_allow_flush');

            return view('assessment.senior.report', compact('private_data', 'msg'));
        }

        /* 本站所需数据  $private_data */
        $private_data = MockDataService::PrimarySplitData($data);

        /* 以下数据为系统模拟生成,为接口准备 */
        $mock_data = MockDataService::mockSeniorApiData();
        $data = array_merge($mock_data, $data);
        /* 本站所需数据补充 */
        $private_data['assessment_type'] = 'mbti_senior';
        $private_data['answers'] = json_encode($data, JSON_UNESCAPED_UNICODE);

        /* 为防止才储发现,测试阶段为本地测试 */
        if (config('assessment.api_mock')) {
            /* 如果是本地模拟数据则填写默认值 */
            $private_data['report_id'] = config('assessment.api_mock_id');
        } else {
            /* 发送数据到远程接口并返回 html 代码 */
            $data = $arrayTranformsService->arrayCharsetIconv($data);
            $response = $seniorHttpService->post($data);

            /* 解析返回的代码并做处理获取 ID */
            $private_data['report_id'] = ParseHtmlService::getReportId($response);
        }

        if ($serialNumberRecordRepository->store($private_data)) {
            /* 更新序列号为已使用 */
            $serialNumberRepository->updateInvalid($private_data['serial_number_id']);

            return view('assessment.senior.report', compact('private_data'));
        } else {
            abort(500);
        }
    }
}
