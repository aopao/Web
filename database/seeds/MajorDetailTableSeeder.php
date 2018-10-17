<?php

use App\Services\JsonToArrayService;
use Illuminate\Database\Seeder;

use App\Models\MajorDetail;

class MajorDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $major_detail_model = new MajorDetail();
        $major_detal = JsonToArrayService::getJson('major_details.json');
        $major_detail_model->addAll($major_detal);
    }
}
