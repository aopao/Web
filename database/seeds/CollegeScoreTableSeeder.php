<?php

use App\Models\CollegeMajor;
use App\Services\JsonToArrayService;
use Illuminate\Database\Seeder;

class CollegeScoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $college_major_model = new CollegeMajor();
        $college_major = JsonToArrayService::getJson('college_majors.json');
        $college_major_model->addAll($college_major);
    }
}
