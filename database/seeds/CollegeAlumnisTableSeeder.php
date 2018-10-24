<?php

use App\Models\CollegeAlumnis;
use App\Services\JsonToArrayService;
use Illuminate\Database\Seeder;

class CollegeAlumnisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $college_alumnis_model = new CollegeAlumnis();
        $college_alumnis = JsonToArrayService::getJson('college_alumnis.json');
        $college_alumnis_model->addAll($college_alumnis);
    }
}
