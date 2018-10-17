<?php

use App\Models\CollegeDetail;
use App\Services\JsonToArrayService;
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
        $collegeDetails = JsonToArrayService::getJson('college_details.json');
        foreach ($collegeDetails as $value) {
            $college_details->insert($value);
        }
    }
}
