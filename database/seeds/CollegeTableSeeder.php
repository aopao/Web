<?php

use App\Models\College;
use App\Services\JsonToArrayService;
use Illuminate\Database\Seeder;

class CollegeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $college_model = new College();
        $college = JsonToArrayService::getJson('colleges.json');
        foreach ($college as $value) {
            $college_model->insert($value);
        }
    }
}
