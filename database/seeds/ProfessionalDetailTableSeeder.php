<?php

use App\Services\JsonToArrayService;
use Illuminate\Database\Seeder;

use App\Models\Professional;
use App\Models\ProfessionalDetail;

class ProfessionalDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $professional_detail_model = new ProfessionalDetail();
        $professional_detal = JsonToArrayService::getJson('professional_details.json');
        $professional_detail_model->addAll($professional_detal);
    }
}
