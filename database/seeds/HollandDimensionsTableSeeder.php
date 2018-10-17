<?php

use App\Services\JsonToArrayService;
use Illuminate\Database\Seeder;

use App\Models\HollandDimension;

class HollandDimensionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $holland_deimension_model = new HollandDimension();
        $holland_deimension = JsonToArrayService::getJson('holland_dimensions.json');
        $holland_deimension_model->addAll($holland_deimension);
    }
}
