<?php

namespace App\Http\Controllers\Assessment\Mbti;

use App\Http\Controllers\Assessment\BaseController;
use App\Http\Requests\SerialNumberSeniorRequest;
use App\Repositories\Eloquent\Assessment\Mbti\SeniorIssueRepository;
use App\Repositories\Eloquent\Assessment\Mbti\seniorReportRepository;
use App\Services\Assessment\Mbti\SeniorLogicService;
use Cache;
use Illuminate\Http\Request;
use App\Http\Requests\SerialNumberPrimaryRequest;
use App\Repositories\Eloquent\SerialNumberRepository;
use App\Repositories\Eloquent\MbtiCategoryRepository;
use App\Repositories\Eloquent\SerialNumberRecordRepository;

class SeniorController extends BaseController
{
    /**
     * @var \App\Services\Assessment\Mbti\SeniorLogicService
     */
    private $seniorLogicService;

    /**
     * @var \App\Repositories\Eloquent\Assessment\Mbti\SeniorIssueRepository
     */
    private $seniorIssueRepository;

    /**
     * @var \App\Repositories\Eloquent\Assessment\Mbti\seniorReportRepository
     */
    private $seniorReportRepository;

    /**
     * @var \App\Repositories\Eloquent\MbtiCategoryRepository
     */
    private $mbtiCategoryRepository;

    /**
     * @var \App\Repositories\Eloquent\SerialNumberRepository
     */
    private $serialNumberRepository;

    /**
     * @var \App\Http\Requests\SerialNumberPrimaryRequest
     */
    private $serialNumberPrimaryRequest;

    /**
     * @var \App\Repositories\Eloquent\SerialNumberRecordRepository
     */
    private $serialNumberRecordRepository;

    public function __construct(
        SeniorLogicService $seniorLogicService,
        SeniorIssueRepository $seniorIssueRepository,
        SeniorReportRepository $seniorReportRepository,
        MbtiCategoryRepository $mbtiCategoryRepository,
        SerialNumberRepository $serialNumberRepository,
        SerialNumberPrimaryRequest $serialNumberPrimaryRequest,
        SerialNumberRecordRepository $serialNumberRecordRepository
    ) {

        $this->seniorLogicService = $seniorLogicService;
        $this->seniorIssueRepository = $seniorIssueRepository;
        $this->seniorReportRepository = $seniorReportRepository;
        $this->mbtiCategoryRepository = $mbtiCategoryRepository;
        $this->serialNumberRepository = $serialNumberRepository;
        $this->serialNumberPrimaryRequest = $serialNumberPrimaryRequest;
        $this->serialNumberRecordRepository = $serialNumberRecordRepository;
    }

    /**
     * 初级测试序列号填写部分
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('assessment.mbti.senior.index');
    }

    /**
     * 根据序列号查看报告
     *
     * @param                                                        $serial_number
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($serial_number)
    {
        /* 判断序列号是否存在 */
        $serial_number_info = $this->serialNumberRepository->findBySerialNumber($serial_number);
        if (! $serial_number_info) {
            abort(404);
        }
        /* 加入缓存中,减轻数据库压力 */
        if (Cache::has(config('assessment.cookie_primary_report_prefix').$serial_number)) {
            $report = Cache::get(config('assessment.cookie_primary_report_prefix').$serial_number);
        } else {
            /* 组织展现的数据 */
            $report = $this->seniorReportRepository->getAllInfoBySerialNumber($serial_number);
            if ($report) {
                /* 对数据进行二次处理 */
                $this->seniorLogicService->handleReportData($report);
                Cache::forever(config('assessment.cookie_primary_report_prefix').$serial_number, $report);
            } else {
                abort(404);
            }
        }
        //dd($report);
        return view(
            'assessment.mbti.senior.show', compact('report'));
    }

    /**
     * 进入测试后填写用户信息界面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function collect()
    {
        $data = $this->serialNumberRepository->findBySerialNumber($this->serialNumberPrimaryRequest->get('number'))->ToArray();
        if (isset($data) && $data['is_invalid'] == 0) {
            return view('assessment.mbti.senior.collect', compact('data'));
        } else {
            return redirect(route('assessment.mbti.senior.show', ['serial_number' => $data['number']]));
        }
    }

    /**
     * 测评答题界面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function issue()
    {
        $data = $this->serialNumberPrimaryRequest->all();
        $issues = $this->seniorIssueRepository->getAllMbtiSeniorIssues();

        return view('assessment.mbti.senior.issue', compact('data', 'issues'));
    }

    /**
     * 用户提交数据处理生成测评报告
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function report(Request $request)
    {
        $data = $request->all();

        /*判断是否是刷新*/
        $db_report = $this->seniorReportRepository->findBySerialNumber($data['serial_number']);
        if ($db_report) {
            $msg = trans('comment/form.not_allow_flush');

            return view('assessment.mbti.senior.report', compact('db_report', 'msg'));
        }
        /* 初级测评数据逻辑处理 */
        $response = $this->seniorLogicService->handleData($data);
        //
        ///* 入库操作 */
        if ($this->serialNumberRecordRepository->store($response['serial_number'])) {
            /* 更新序列号为已使用 */
            $this->serialNumberRepository->updateInvalid($response['serial_number']['serial_number_id']);

            /* 生成报告 */
            $db_report = $this->seniorReportRepository->create($response['response']);

            return view('assessment.mbti.senior.report', compact('db_report'));
        } else {
            abort(500);
        }
    }
}
