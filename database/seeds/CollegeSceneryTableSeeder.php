<?php

use App\Models\CollegeScenery;
use App\Services\JsonToArrayService;
use Illuminate\Database\Seeder;

class CollegeSceneryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $college_scenery_model = new CollegeScenery();
        $college_scenery = JsonToArrayService::getJson('college_sceneries.json');
        $college_scenery_model->addAll($college_scenery);
    }
}
