<?php

use App\Services\JsonToArray;
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
        $issue = JsonToArray::getJson('mbti_primary_issue.json');
        $mbti_primary_issue->addAll($issue);
    }
}
