<?php

use App\Models\MajorSubject;
use Illuminate\Database\Seeder;
use App\Services\JsonToArrayService;

class MajorSubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $major_model = new MajorSubject();
        $data = JsonToArrayService::getJson('major_subjects.json');
        $major_model->addAll($data);
    }
}
