<?php

use App\Services\JsonToArray;
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
        $college_level = JsonToArray::getJson('college_level.json');
        $collegeLevel->addAll($college_level);
    }
}
