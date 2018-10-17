<?php

use App\Services\JsonToArrayService;
use Illuminate\Database\Seeder;

use App\Models\HollandMajor;

class HollandMajorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $holland_major_model = new HollandMajor();
        $holland_professional = JsonToArrayService::getJson('holland_majors.json');
        foreach ($holland_professional as $value) {
            $holland_major_model->insert($value);
        }
    }
}
