<?php

use App\Services\JsonToArrayService;
use Illuminate\Database\Seeder;

use App\Models\ProfessionalCategory;

class ProfessionalCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $professionalCategory = new ProfessionalCategory();
        $professional_category = JsonToArrayService::getJson('professional_category.json');
        $professionalCategory->addAll($professional_category);
    }
}
