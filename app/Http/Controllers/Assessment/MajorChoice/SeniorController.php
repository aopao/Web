<?php

namespace App\Http\Controllers\Assessment\MajorChoice;

use Cache;
use Illuminate\Http\Request;
use App\Http\Requests\SerialNumberSeniorRequest;
use App\Http\Controllers\Assessment\BaseController;
use App\Services\Assessment\MajorChoice\SeniorLogicService;
use App\Repositories\Eloquent\SerialNumberRepository;
use App\Repositories\Eloquent\MbtiCategoryRepository;
use App\Repositories\Eloquent\SerialNumberRecordRepository;
use App\Repositories\Eloquent\Assessment\MajorChoice\SeniorReportRepository;
use App\Repositories\Eloquent\Assessment\MajorChoice\SeniorIssueRepository;

class SeniorController extends BaseController
{
    /**
     * @var \App\Http\Requests\SerialNumberSeniorRequest
     */
    private $serialNumberRepository;

    /**
     * @var \App\Http\Requests\SerialNumberSeniorRequest
     */
    private $serialNumberSeniorRequest;

    /**
     * @var \App\Repositories\Eloquent\SerialNumberRecordRepository
     */
    private $serialNumberRecordRepository;

    /**
     * @var \App\Repositories\Eloquent\MbtiCategoryRepository
     */
    private $mbtiCategoryRepository;

    /**
     * @var \App\Repositories\Eloquent\Assessment\MajorChoice\SeniorIssueRepository
     */
    private $seniorIssueRepository;

    /**
     * @var \App\Repositories\Eloquent\Assessment\MajorChoice\SeniorReportRepository
     */
    private $seniorReportRepository;

    /**
     * @var \App\Services\Assessment\MajorChoice\SeniorLogicService
     */
    private $seniorLogicService;

    /**
     * SeniorController constructor.
     *
     * @param \App\Services\Assessment\MajorChoice\SeniorLogicService                  $seniorLogicService
     * @param \App\Repositories\Eloquent\Assessment\MajorChoice\SeniorIssueRepository  $seniorIssueRepository
     * @param \App\Repositories\Eloquent\Assessment\MajorChoice\SeniorReportRepository $seniorReportRepository
     * @param \App\Repositories\Eloquent\MbtiCategoryRepository                        $mbtiCategoryRepository
     * @param \App\Repositories\Eloquent\SerialNumberRepository                        $serialNumberRepository
     * @param \App\Http\Requests\SerialNumberSeniorRequest                             $serialNumberSeniorRequest
     * @param \App\Repositories\Eloquent\SerialNumberRecordRepository                  $serialNumberRecordRepository
     */
    public function __construct(
        SeniorLogicService $seniorLogicService,
        SeniorIssueRepository $seniorIssueRepository,
        SeniorReportRepository $seniorReportRepository,
        MbtiCategoryRepository $mbtiCategoryRepository,
        SerialNumberRepository $serialNumberRepository,
        SerialNumberSeniorRequest $serialNumberSeniorRequest,
        SerialNumberRecordRepository $serialNumberRecordRepository
    ) {
        $this->seniorLogicService = $seniorLogicService;
        $this->seniorIssueRepository = $seniorIssueRepository;
        $this->seniorReportRepository = $seniorReportRepository;
        $this->mbtiCategoryRepository = $mbtiCategoryRepository;
        $this->serialNumberRepository = $serialNumberRepository;
        $this->serialNumberRecordRepository = $serialNumberRecordRepository;
        $this->serialNumberSeniorRequest = $serialNumberSeniorRequest;
    }

    /**
     * 专业选择高级测试序列号填写部分
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('assessment.major_choice.senior.index');
    }

    /**
     * 根据序列号查看报告
     *
     * @param                                                          $serial_number
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
        //if (Cache::has(config('assessment.cookie_senior_report_prefix').$serial_number)) {
        //    $report = Cache::get(config('assessment.cookie_senior_report_prefix').$serial_number);
        //} else {
        /* 组织展现的数据 */
        $report = $this->seniorReportRepository->getAllInfoBySerialNumber($serial_number);
        if ($report) {
            /* 对数据进行二次处理 */
            $this->seniorLogicService->handleReportData($report);
            //Cache::forever(config('assessment.cookie_senior_report_prefix').$serial_number, $report);
        } else {
            abort(404);
        }

        //}
        //print_r($report);
        dd($report);
        return view('assessment.major_choice.senior.show', compact('report'));
    }

    /**
     * 进入测试后收集用户信息界面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function collect()
    {
        $data = $this->serialNumberRepository->findBySerialNumber($this->serialNumberSeniorRequest->get('number'));
        if (isset($data) && $data['is_invalid'] == 0) {
            return view('assessment.major_choice.senior.collect', compact('data'));
        } else {
            return redirect(route('assessment.major_choice.senior.show', ['serial_number' => $data['number']]));
        }
    }

    /**
     * 测评答题界面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function issue()
    {
        /* 保存收集的用户信息 */
        $data = $this->serialNumberSeniorRequest->all();
        /* 加入缓存,减轻数据库压力 */
        if (Cache::has('senior_issues')) {
            $issues = Cache::get('senior_issues');
        } else {
            $issues = $this->seniorIssueRepository->getAllMbtiSeniorIssues();
            Cache::forever('senior_issues', $issues);
        }

        return view('assessment.major_choice.senior.issue', compact('data', 'issues'));
    }

    /**
     * 用户查看报告界面
     *
     * @param \Illuminate\Http\Request                                $request
     * @param \App\Services\Assessment\MajorChoice\SeniorLogicService $seniorLogicService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function report(Request $request)
    {
        $data = $request->all();
        /*判断是否是刷新*/
        $db_report = $this->seniorReportRepository->findBySerialNumber($data['serial_number']);
        if ($db_report) {
            $msg = trans('comment/form.not_allow_flush');

            return view('assessment.major_choice.senior.report', compact('db_report', 'msg'));
        }

        /* 高级测评数据逻辑处理 */
        $response = $this->seniorLogicService->handleData($data);

        if ($this->serialNumberRecordRepository->store($response['serial_number'])) {
            /* 更新序列号为已使用 */
            $this->serialNumberRepository->updateInvalid($response['serial_number']['serial_number_id']);

            /* 生成报告 */
            $db_report = $this->seniorReportRepository->create($response);

            return view('assessment.major_choice.senior.report', compact('db_report'));
        } else {
            abort(500);
        }
    }
}
