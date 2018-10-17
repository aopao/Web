<?php

use App\Services\JsonToArrayService;
use Illuminate\Database\Seeder;

use App\Models\HollandProfessionalCode;

class HollandProfessionalCodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $holland_professional_code_model = new HollandProfessionalCode();
        $holland_professional_code = JsonToArrayService::getJson('holland_professional_codes.json');
        $holland_professional_code_model->addAll($holland_professional_code);
    }
}
