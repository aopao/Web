<?php

use App\Services\JsonToArray;
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
        $college_category = JsonToArray::getJson('college_category.json');
        $collegeCategory->addAll($college_category);
    }
}
