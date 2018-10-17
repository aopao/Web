<?php

namespace App\Http\Controllers\Assessment;

use App\Http\Requests\SerialNumberSeniorRequest;
use App\Repositories\Eloquent\HollandProfessionalRepository;
use App\Repositories\Eloquent\MbtiCategoryRepository;
use App\Repositories\Eloquent\MbtiSeniorIssueRepository;
use App\Repositories\Eloquent\MbtiSeniorReportRepository;
use App\Repositories\Eloquent\SerialNumberRecordRepository;
use App\Repositories\Eloquent\SerialNumberRepository;
use App\Services\ArrayTranformsService;
use App\Services\MbtiSeniorLogicService;
use App\Services\MockDataService;
use App\Services\SeniorHttpService;
use Cache;
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
     * 根据序列号查看报告
     *
     * @param                                                          $serial_number
     * @param \App\Repositories\Eloquent\SerialNumberRepository        $serialNumberRepository
     * @param \App\Repositories\Eloquent\HollandProfessionalRepository $hollandProfessionalRepository
     * @param \App\Repositories\Eloquent\MbtiSeniorReportRepository    $mbtiSeniorReportRepository
     * @param \App\Services\MbtiSeniorLogicService                     $mbtiSeniorLogicService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(
        $serial_number,
        SerialNumberRepository $serialNumberRepository,
        HollandProfessionalRepository $hollandProfessionalRepository,
        MbtiSeniorReportRepository $mbtiSeniorReportRepository,
        MbtiSeniorLogicService $mbtiSeniorLogicService
    ) {
        /* 判断序列号是否存在 */
        $serial_number_info = $serialNumberRepository->findBySerialNumber($serial_number);
        if (! $serial_number_info) {
            abort(404);
        }
        /* 加入缓存中,减轻数据库压力 */
        //if (Cache::has(config('assessment.cookie_senior_report_prefix').$serial_number)) {
        //    $report = Cache::get(config('assessment.cookie_senior_report_prefix').$serial_number);
        //} else {
        /* 组织展现的数据 */
        $report = $mbtiSeniorReportRepository->getAllInfoBySerialNumber($serial_number);
        if ($report) {
            /* 对数据进行二次处理 */
            $mbtiSeniorLogicService->handleReportData($report, $hollandProfessionalRepository);
            //Cache::forever(config('assessment.cookie_senior_report_prefix').$serial_number, $report);
        } else {
            abort(404);
        }

        //}
        //dd($report->toArray());
        return view('assessment.senior.show', compact('report'));
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
        $data = $this->serialNumberRepository->findBySerialNumber($number)->ToArray();
        if (isset($data) && $data['is_invalid'] == 0) {
            return view('assessment.senior.collect', compact('data'));
        } else {
            return view('assessment.senior.show', compact('data'));
        }
    }

    /**
     * 测评答题界面
     *
     * @param \App\Http\Requests\SerialNumberSeniorRequest         $serialNumberSeniorRequest
     * @param \App\Repositories\Eloquent\MbtiSeniorIssueRepository $mbtiSeniorIssueRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function issue(SerialNumberSeniorRequest $serialNumberSeniorRequest, MbtiSeniorIssueRepository $mbtiSeniorIssueRepository)
    {
        $data = $serialNumberSeniorRequest->all();
        /* 加入缓存,减轻数据库压力 */
        if (Cache::has('senior_issues')) {
            $issues = Cache::get('senior_issues');
        } else {
            $issues = $mbtiSeniorIssueRepository->getAllMbtiSeniorIssues()->ToArray();
            Cache::forever('senior_issues', $issues);
        }

        return view('assessment.senior.issue', compact('data', 'issues'));
    }

    /**
     * 用户查看报告界面
     *
     * @param \Illuminate\Http\Request                                $request
     * @param \App\Repositories\Eloquent\MbtiCategoryRepository       $mbtiCategoryRepository
     * @param \App\Services\MbtiSeniorLogicService                    $mbtiSeniorLogicService
     * @param \App\Repositories\Eloquent\MbtiSeniorReportRepository   $mbtiSeniorReportRepository
     * @param \App\Repositories\Eloquent\SerialNumberRepository       $serialNumberRepository
     * @param \App\Repositories\Eloquent\SerialNumberRecordRepository $serialNumberRecordRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public
    function report(
        Request $request,
        MbtiCategoryRepository $mbtiCategoryRepository,
        MbtiSeniorLogicService $mbtiSeniorLogicService,
        SerialNumberRepository $serialNumberRepository,
        MbtiSeniorReportRepository $mbtiSeniorReportRepository,
        SerialNumberRecordRepository $serialNumberRecordRepository
    ) {
        $data = $request->all();

        /*判断是否是刷新*/
        $db_report = $mbtiSeniorReportRepository->findBySerialNumber($data['serial_number']);
        if ($db_report) {
            $msg = trans('comment/form.not_allow_flush');

            return view('assessment.senior.report', compact('db_report', 'msg'));
        }
        /* 高级测评数据逻辑处理 */
        $response = $mbtiSeniorLogicService->handleData($data, $mbtiCategoryRepository);

        if ($serialNumberRecordRepository->store($response['serial_number_record_data'])) {
            /* 更新序列号为已使用 */
            $serialNumberRepository->updateInvalid($response['serial_number_record_data']['serial_number_id']);
            /* 生成报告 */
            $db_report = $mbtiSeniorReportRepository->create($response);

            return view('assessment.senior.report', compact('db_report'));
        } else {
            abort(500);
        }
    }
}
