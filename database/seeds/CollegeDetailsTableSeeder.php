<?php

use App\Models\CollegeDetail;
use App\Services\JsonToArray;
use Illuminate\Database\Seeder;

class CollegeDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $college_details = new CollegeDetail();
        $collegeDetails = JsonToArray::getJson('college_details.json');
        foreach ($collegeDetails["RECORDS"] as $value) {
            $college_details->insert($value);
        }
    }
}
