<?php

use App\Services\JsonToArrayService;
use Illuminate\Database\Seeder;

use App\Models\MbtiPrimaryIssue;

class MbtiPrimaryIusseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mbti_primary_issue = new MbtiPrimaryIssue();
        $issue = JsonToArrayService::getJson('mbti_primary_issues.json');
        $mbti_primary_issue->addAll($issue);
    }
}
