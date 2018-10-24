<?php

use App\Services\JsonToArrayService;
use Illuminate\Database\Seeder;

use App\Models\MajorChoiceSeniorIssue;

class MajorChoiceSeniorIusseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $major_choice_senior_issue = new MajorChoiceSeniorIssue();
        $issue = JsonToArrayService::getJson('major_choice_senior_issues.json');
        $major_choice_senior_issue->addAll($issue);
    }
}
