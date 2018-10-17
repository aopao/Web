<?php

use App\Models\MajorBachelorJunior;
use App\Services\JsonToArrayService;
use Illuminate\Database\Seeder;

class MajorBachelorJuniorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $major_bachelor_junior_model = new MajorBachelorJunior();
        $data = JsonToArrayService::getJson('major_bachelor_juniors.json');
        $major_bachelor_junior_model->addAll($data);
    }
}
