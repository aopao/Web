<?php

use App\Services\JsonToArray;
use Illuminate\Database\Seeder;

use App\Models\Professional;
use App\Models\ProfessionalDetail;

class ProfessionalDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $professional_model = new Professional();
        $professional = JsonToArray::getJson('professional.json');

        $professional_detail = new ProfessionalDetail();

        foreach ($professional as $value) {
            $professional_info = $professional_model->where('professional_code', $value['professional_code'])->first();
            $data = [];
            $data['professional_id'] = $professional_info['id'];
            $data['clicks'] = $value['clicks'];
            $data['awarded_degree'] = $value['awarded_degree'];
            $data['job_direction'] = $value['job_direction'];
            $data['graduation_student_num'] = $value['graduation_student_num'];
            $data['work_rate'] = $value['work_rate'];
            $data['subject_rate'] = $value['subject_rate'];
            $data['gender_rate'] = $value['gender_rate'];
            $data['description'] = $value['description'];
            $data['created_at'] = date('Y-m-d H:i:s');
            $professional_detail->insert($data);
        }
    }
}
