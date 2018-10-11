<?php

use App\Services\JsonToArrayService;
use Illuminate\Database\Seeder;

use App\Models\Professional;
use App\Models\ProfessionalCategory;

class ProfessionalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $professional_model = new Professional();
        $professional = JsonToArrayService::getJson('professionals.json');
        $professional_model->addAll($professional);
    }
}
