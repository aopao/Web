<?php

namespace App\Http\Controllers\Assessment;

use App\Http\Requests\SerialNumberSeniorRequest;
use App\Repositories\Eloquent\MbtiCategoryRepository;
use App\Repositories\Eloquent\MbtiSeniorIssueRepository;
use App\Repositories\Eloquent\SerialNumberRecordRepository;
use App\Repositories\Eloquent\SerialNumberRepository;
use App\Services\ArrayTranformsService;
use App\Services\MbtiSeniorLogicService;
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
        $issues = $mbtiSeniorIssueRepository->getAllMbtiSeniorIssues()->ToArray();

        return view('assessment.senior.issue', compact('data', 'issues'));
    }

    /**
     * 用户查看报告界面
     *
     * @param \Illuminate\Http\Request                                $request
     * @param \App\Repositories\Eloquent\MbtiCategoryRepository       $mbtiCategoryRepository
     * @param \App\Services\MbtiSeniorLogicService                    $mbtiSeniorLogicService
     * @param \App\Repositories\Eloquent\SerialNumberRecordRepository $serialNumberRecordRepository
     * @param \App\Repositories\Eloquent\SerialNumberRepository       $serialNumberRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function report(
        Request $request,
        MbtiCategoryRepository $mbtiCategoryRepository,
        MbtiSeniorLogicService $mbtiSeniorLogicService,
        SerialNumberRepository $serialNumberRepository,
        SerialNumberRecordRepository $serialNumberRecordRepository
    ) {
        $data = $request->all();

        /*判断是否是刷新*/
        //$private_data = $serialNumberRecordRepository->findBySerialNumberId($data['serial_number_id']);
        //if ($private_data) {
        //    $msg = trans('comment/form.not_allow_flush');
        //
        //    return view('assessment.senior.report', compact('private_data', 'msg'));
        //}

        /* 初级测评数据逻辑处理 */
        $response = $mbtiSeniorLogicService->handleData($data, $mbtiCategoryRepository);

        dd($response);
        //if ($serialNumberRecordRepository->store($response)) {
        //    /* 更新序列号为已使用 */
        //    $serialNumberRepository->updateInvalid($response['serial_number_id']);
        //
        //    return view('assessment.senior.report', compact('private_data'));
        //} else {
        //    abort(500);
        //}
    }
}
