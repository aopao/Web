<?php

use App\Services\JsonToArrayService;
use Illuminate\Database\Seeder;
use App\Models\CollegeLevel;

class CollegelevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collegeLevel = new CollegeLevel();
        $college_level = JsonToArrayService::getJson('college_level.json');
        $collegeLevel->addAll($college_level);
    }
}
