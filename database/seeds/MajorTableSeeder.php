<?php

use App\Services\JsonToArrayService;
use Illuminate\Database\Seeder;

use App\Models\Major;

class MajorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $major_model = new Major();
        $major = JsonToArrayService::getJson('majors.json');
        $major_model->addAll($major);
    }
}
