<?php

namespace App\Http\Controllers\Assessment;

use App\Repositories\Eloquent\SerialNumberRecordRepository;
use App\Services\ArrayTranformsService;
use App\Services\MockDataService;
use App\Services\ParseHtmlService;
use App\Services\PrimaryHttpService;
use App\Services\RandUserAgentService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use App\Http\Requests\SerialNumberRequest;
use App\Repositories\Eloquent\SerialNumberRepository;
use App\Repositories\Eloquent\MbtiPramaryIssueRepository;

class PrimaryController extends BaseController
{
    /**
     * @var \App\Repositories\Eloquent\SerialNumberRepository
     */
    private $serialNumberRepository;

    /**
     * PrimaryController constructor.
     *
     * @param \App\Repositories\Eloquent\SerialNumberRepository $serialNumberRepository
     */
    public function __construct(SerialNumberRepository $serialNumberRepository)
    {

        $this->serialNumberRepository = $serialNumberRepository;
    }

    /**
     * 初级测试序列号填写部分
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('assessment.primary.index');
    }

    /**
     * 进入测试后填写用户信息界面
     *
     * @param \App\Http\Requests\SerialNumberRequest                $serialNumberRequest
     * @param \App\Repositories\Eloquent\MbtiPramaryIssueRepository $mbtiPrimaryIssueRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function collect(SerialNumberRequest $serialNumberRequest, MbtiPramaryIssueRepository $mbtiPrimaryIssueRepository)
    {
        $number = $serialNumberRequest->get('number');
        $data = $this->serialNumberRepository->findByNumber($number)->ToArray();
        if (isset($data) && $data['is_invalid'] == 0) {
            $issues = $mbtiPrimaryIssueRepository->getAllMbtiPrimaryIssues()->ToArray();

            return view('assessment.primary.collect', compact('data', 'issues'));
        } else {
            return view('assessment.primary.show', compact('data'));
        }
    }

    /**
     * 用户测试答题界面
     *
     * @param \App\Http\Requests\SerialNumberRequest                $serialNumberRequest
     * @param \App\Repositories\Eloquent\MbtiPramaryIssueRepository $mbtiPrimaryIssueRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function issue(SerialNumberRequest $serialNumberRequest, MbtiPramaryIssueRepository $mbtiPrimaryIssueRepository)
    {
        $data = $serialNumberRequest->all();
        $issues = $mbtiPrimaryIssueRepository->getAllMbtiPrimaryIssues()->ToArray();

        return view('assessment.primary.issue', compact('data', 'issues'));
    }

    /**
     * 用户查看报告界面
     *
     * @param \Illuminate\Http\Request                                $request
     * @param \App\Services\ArrayTranformsService                     $arrayTranformsService
     * @param \App\Services\PrimaryHttpService                        $primaryHttpService
     * @param \App\Repositories\Eloquent\SerialNumberRepository       $serialNumberRepository
     * @param \App\Repositories\Eloquent\SerialNumberRecordRepository $serialNumberRecordRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function report(Request $request, ArrayTranformsService $arrayTranformsService, PrimaryHttpService $primaryHttpService, SerialNumberRepository $serialNumberRepository, SerialNumberRecordRepository $serialNumberRecordRepository)
    {
        $data = $request->all();
        /* 本站所需数据  $private_data */
        $private_data = MockDataService::PrimarySplitData($data);

        /* 以下数据为系统模拟生成,为接口准备 */
        $mock_data = MockDataService::mockPrimaryApiData();
        $data = array_merge($mock_data, $data);

        /* 本站所需数据补充 */
        $private_data['assessment_type'] = 'mbti_primary';
        $private_data['answers'] = json_encode($data, JSON_UNESCAPED_UNICODE);

        /* 发送数据到远程接口并返回 html 代码 */
        $data = $arrayTranformsService->arrayCharsetIconv($data);
        $response = $primaryHttpService->post($data);

        /* 解析返回的代码并做处理获取 ID */
        $private_data['apesk_id'] = ParseHtmlService::getReportId($response);

        if ($serialNumberRecordRepository->store($private_data)) {
            /* 更新序列号为已使用 */
            $serialNumberRepository->updateInvalid($private_data['serial_number_id']);

            return view('assessment.primary.report', compact('private_data'));
        } else {
            abort(500);
        }
    }
}
