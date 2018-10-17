<?php

use App\Services\JsonToArrayService;
use Illuminate\Database\Seeder;
use App\Models\CollegeCategory;

class CollegeCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collegeCategory = new CollegeCategory();
        $college_category = JsonToArrayService::getJson('college_categories.json');
        $collegeCategory->addAll($college_category);
    }
}
