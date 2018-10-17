<?php

use App\Services\JsonToArrayService;
use Illuminate\Database\Seeder;

use App\Models\MbtiCategory;

class MbtiCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mbti_category = new MbtiCategory();
        $category = JsonToArrayService::getJson('mbti_categories.json');
        $mbti_category->addAll($category);
    }
}
