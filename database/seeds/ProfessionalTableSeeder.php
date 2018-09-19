<?php

use App\Services\JsonToArray;
use Illuminate\Database\Seeder;

use App\Models\Professional;
use App\Models\ProfessionalCategory;

class ProfessionalTableSeeder extends Seeder
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

        $professional_category = new ProfessionalCategory();

        foreach ($professional as $value) {
            $data = [];
            $data['professional_name'] = $value['professional_name'];
            $data['professional_code'] = $value['professional_code'];
            $data['parent_id'] = $value['parent_id'];
            $parent = $professional_category->where('id', $data['parent_id'])->first();
            $data['top_parent_id'] = $parent['parent_id'];
            $data['professional_level'] = $value['professional_level'];
            $data['ranking'] = $value['ranking'];
            $data['ranking_type'] = $value['ranking_type'];
            $data['created_at'] = date('Y-m-d H:i:s');
            $professional_model->insert($data);
        }
    }
}
