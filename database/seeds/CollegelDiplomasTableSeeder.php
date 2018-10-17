<?php

use App\Services\JsonToArrayService;
use Illuminate\Database\Seeder;
use App\Models\CollegeDiplomas;

class CollegeDiplomasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $college_diplomas_model = new CollegeDiplomas();
        $college_diplomas = JsonToArrayService::getJson('college_diplomases.json');
        $college_diplomas_model->addAll($college_diplomas);
    }
}
