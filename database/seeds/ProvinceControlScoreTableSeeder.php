<?php

use App\Services\JsonToArrayService;
use Illuminate\Database\Seeder;

use App\Models\ProvinceControlScore;

class ProvinceControlScoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinceControlScore = new ProvinceControlScore();
        $province_control_score = JsonToArrayService::getJson('province_control_scores.json');
        $provinceControlScore->addAll($province_control_score);
    }
}
