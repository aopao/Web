<?php

use App\Services\JsonToArray;
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
        $professional_category = JsonToArray::getJson('professional_category.json');
        $professionalCategory->addAll($professional_category);
    }
}
