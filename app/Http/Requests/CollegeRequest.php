<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CollegeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'college_name' => 'required',
            'province_id' => 'required',
            'college_level_id' => 'required',
            'college_category_id' => 'required',
        ];
    }

    /**
     * 错误返回信息
     *
     * @return array
     */
    public function messages()
    {
        return [
            'college_name.required' => '大学名称必填',
            'province_id.required' => '大学名称所在省份必须选择',
            'college_level_id.required' => '大学层次名称必须选择',
            'college_category_id.required' => '大学类型必须选择',
        ];
    }
}
