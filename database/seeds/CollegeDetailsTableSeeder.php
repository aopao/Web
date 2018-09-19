<?php

use App\Models\College;
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
        $colleges = JsonToArray::getJson('colleges.json');
        $collegeDetails = JsonToArray::getJson('college_details.json');
        foreach ($colleges as $key => $value) {
            $data = [];
            $data['college_id'] = $key + 1;
            $data['college_code'] = $value['college_code'];
            $data['since'] = $value['since'];
            $data['web'] = $value['web'];
            $data['full_view'] = isset($collegeDetails[$key]['view']) ? $collegeDetails[$key]['view'] : '';
            $data['doctor_number'] = $value['doctor'];
            $data['postgraduate_number'] = $value['master'];
            $data['membership'] = $value['membership'];
            $data['telephone'] = $value['telephone'];
            $data['email'] = $value['email'];
            $data['all_clicks'] = $value['clicks'];
            $data['month_clicks'] = $value['monthclicks'];
            $data['week_clicks'] = $value['weekclicks'];
            $data['student_rank'] = $value['student_rank'];
            $data['life_rank'] = $value['life_rank'];
            $data['work_rank'] = $value['work_rank'];
            $data['address'] = $value['address'];
            $data['old_college_name'] = $value['old_name'];
            $data['description'] = isset($collegeDetails[$key]['detail']) ? $collegeDetails[$key]['detail'] : '';
            $data['charge_standard'] = isset($collegeDetails[$key]['charge']) ? $collegeDetails[$key]['charge'] : '';
            $data['job_prospect'] = isset($collegeDetails[$key]['work']) ? $collegeDetails[$key]['work'] : '';
            $college_details->insert($data);
        }
    }
}
