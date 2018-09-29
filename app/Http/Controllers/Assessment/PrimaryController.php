<?php

namespace App\Http\Controllers\Assessment;

use App\Repositories\Eloquent\SerialNumberRepository;
use App\Services\RandChineseNameService;
use App\Services\RandEmailService;
use Illuminate\Http\Request;
use App\Http\Requests\SerialNumberRequest;
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

    public function index()
    {
        return view('assessment.primary.index');
    }

    public function collect(SerialNumberRequest $serialNumberRequest, MbtiPramaryIssueRepository $mbtiPrimaryIssueRepository)
    {
        $number = $serialNumberRequest->get('number');
        $data = $this->serialNumberRepository->findByNumber($number)->ToArray();
        $issues = $mbtiPrimaryIssueRepository->getAllMbtiPrimaryIssues()->ToArray();

        return view('assessment.primary.collect', compact('data', 'issues'));
    }

    /**
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

    public function report(Request $request, RandChineseNameService $randChineseNameService, RandEmailService $randEmailService)
    {
        $data = $request->all();
        /* 本站所需数据 */
        $private_data['id'] = array_pull($data, 'id');
        $private_data['number'] = array_pull($data, 'number');
        $private_data['mobile'] = array_pull($data, 'mobile');
        $private_data['username'] = array_pull($data, 'username');
        $private_data['_token'] = array_pull($data, '_token');

        /* 以下数据为系统模拟生成,为接口准备 */
        $mock_data = [
            'test_name' => $randChineseNameService->getName(2),
            'test_email' => $randEmailService->get_email(),
            'feishi' => ceil(rand(10, 25)),
            'hr_email' => $randEmailService->get_email(),
            'host' => '',
            'zyfou' => 'yes',
            'code' => '',
            'tishu' => 93,
            'sex' => 'female',
        ];

        $data = array_merge($mock_data, $data);
        print_r($private_data);
        dd($data);

        return view('assessment.primary.report');
    }
}
