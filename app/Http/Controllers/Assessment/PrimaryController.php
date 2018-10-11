<?php

namespace App\Http\Controllers\Assessment;

use Cache;
use Illuminate\Http\Request;
use App\Services\MbtiPrimaryLogicService;
use App\Http\Requests\SerialNumberPrimaryRequest;
use App\Repositories\Eloquent\SerialNumberRepository;
use App\Repositories\Eloquent\MbtiCategoryRepository;
use App\Repositories\Eloquent\MbtiPramaryIssueRepository;
use App\Repositories\Eloquent\MbtiPrimaryReportRepository;
use App\Repositories\Eloquent\SerialNumberRecordRepository;

class PrimaryController extends BaseController
{
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
     * 根据序列号查看报告
     *
     * @param                                                        $serial_number
     * @param \App\Repositories\Eloquent\SerialNumberRepository      $serialNumberRepository
     * @param \App\Repositories\Eloquent\MbtiPrimaryReportRepository $mbtiPrimaryReportRepository
     * @param \App\Services\MbtiPrimaryLogicService                  $mbtiPrimaryLogicService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($serial_number, SerialNumberRepository $serialNumberRepository, MbtiPrimaryReportRepository $mbtiPrimaryReportRepository, MbtiPrimaryLogicService $mbtiPrimaryLogicService)
    {
        /* 判断序列号是否存在 */
        $serial_number_info = $serialNumberRepository->findBySerialNumber($serial_number);
        if (! $serial_number_info) {
            abort(404);
        }
        /* 加入缓存中,减轻数据库压力 */
        if (Cache::has($serial_number)) {
            $report = Cache::get($serial_number);
        } else {
            /* 组织展现的数据 */
            $report = $mbtiPrimaryReportRepository->getAllInfoBySerialNumber($serial_number)->ToArray();
            /* 对数据进行二次处理 */
            $mbtiPrimaryLogicService->handleReportData($report);
            Cache::forever($serial_number, $report);
        }

        return view('assessment.primary.show', compact('report'));
    }

    /**
     * 进入测试后填写用户信息界面
     *
     * @param \App\Http\Requests\SerialNumberPrimaryRequest          $serialNumberPrimaryRequest
     * @param \App\Repositories\Eloquent\MbtiPrimaryReportRepository $mbtiPrimaryReportRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function collect(SerialNumberPrimaryRequest $serialNumberPrimaryRequest, MbtiPrimaryReportRepository $mbtiPrimaryReportRepository)
    {
        $number = $serialNumberPrimaryRequest->get('number');
        $data = $this->serialNumberRepository->findBySerialNumber($number)->ToArray();
        if (isset($data) && $data['is_invalid'] == 0) {
            return view('assessment.primary.collect', compact('data'));
        } else {
            return redirect(route('assessment.primary.show', ['serial_number' => $data['number']]));
        }
    }

    /**
     * 测评答题界面
     *
     * @param \App\Http\Requests\SerialNumberPrimaryRequest         $serialNumberPrimaryRequest
     * @param \App\Repositories\Eloquent\MbtiPramaryIssueRepository $mbtiPrimaryIssueRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function issue(SerialNumberPrimaryRequest $serialNumberPrimaryRequest, MbtiPramaryIssueRepository $mbtiPrimaryIssueRepository)
    {
        $data = $serialNumberPrimaryRequest->all();
        $issues = $mbtiPrimaryIssueRepository->getAllMbtiPrimaryIssues();

        return view('assessment.primary.issue', compact('data', 'issues'));
    }

    /**
     * 用户提交数据处理生成测评报告
     *
     * @param \Illuminate\Http\Request                                $request
     * @param \App\Repositories\Eloquent\MbtiCategoryRepository       $mbtiCategoryRepository
     * @param \App\Repositories\Eloquent\MbtiPrimaryReportRepository  $mbtiPrimaryReportRepository
     * @param \App\Repositories\Eloquent\SerialNumberRepository       $serialNumberRepository
     * @param \App\Repositories\Eloquent\SerialNumberRecordRepository $serialNumberRecordRepository
     * @param \App\Services\MbtiPrimaryLogicService                   $mbtiPrimaryLogicService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function report(
        Request $request,
        MbtiCategoryRepository $mbtiCategoryRepository,
        SerialNumberRepository $serialNumberRepository,
        MbtiPrimaryLogicService $mbtiPrimaryLogicService,
        MbtiPrimaryReportRepository $mbtiPrimaryReportRepository,
        SerialNumberRecordRepository $serialNumberRecordRepository
    ) {
        $data = $request->all();

        /*判断是否是刷新*/
        $db_report = $mbtiPrimaryReportRepository->findBySerialNumber($data['serial_number']);
        if ($db_report) {
            $msg = trans('comment/form.not_allow_flush');

            return view('assessment.primary.report', compact('db_report', 'msg'));
        }

        /* 初级测评数据逻辑处理 */
        $response = $mbtiPrimaryLogicService->handleData($data, $mbtiCategoryRepository);

        /* 入库操作 */
        if ($serialNumberRecordRepository->store($response['serial_number_record_data'])) {
            /* 更新序列号为已使用 */
            $serialNumberRepository->updateInvalid($response['serial_number_record_data']['serial_number_id']);

            /* 生成报告 */
            $db_report = $mbtiPrimaryReportRepository->create($response['report']);

            return view('assessment.primary.report', compact('db_report'));
        } else {
            abort(500);
        }
    }
}
