<?php

use App\Services\JsonToArray;
use Illuminate\Database\Seeder;
use App\Models\College;

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
        foreach ($college as $value) {
            $data = [];
            $data['college_id'] = $value['college_id'];
            $data['college_name'] = $value['college_name'];
            $data['college_english_name'] = $value['college_english_name'];
            $data['college_rank'] = $value['ranking'];
            $data['province_id'] = $value['province'];
            $data['city_id'] = $value['college_name'];
            $data['college_category_id'] = $value['college_property'];
            $data['college_level_id'] = $value['college_category'];
            $data['is_belong_to_edu'] = $value['edudirectly'];
            $data['is_belong_to_center'] = $value['center'];
            $is_nation = 0;
            if (isset($value['college_nature'])) {
                if ($value['college_nature'] == "公办") {
                    $is_nation = 1;
                } else {
                    $is_nation = 0;
                }
            }
            $data['is_nation'] = $is_nation;
            $data['is_985'] = $value['f985'];
            $data['is_211'] = $value['f211'];
            $data['is_top_college'] = $value['master_college'];
            $college_model->insert($data);
        }
    }
}
