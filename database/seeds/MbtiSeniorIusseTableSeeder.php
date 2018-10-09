<?php

use App\Services\JsonToArrayService;
use Illuminate\Database\Seeder;

use App\Models\MbtiSeniorIssue;

class MbtiSeniorIusseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mbti_senior_issue = new MbtiSeniorIssue();
        $issue = JsonToArrayService::getJson('mbti_senior_issue.json');
        $mbti_senior_issue->addAll($issue);
    }
}
