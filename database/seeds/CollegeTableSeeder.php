<?php

use App\Models\College;
use App\Services\JsonToArray;
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
        $college = JsonToArray::getJson('colleges.json');
        foreach ($college["RECORDS"] as $value) {
            $college_model->insert($value);
        }
    }
}
