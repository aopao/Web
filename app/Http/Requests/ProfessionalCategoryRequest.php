<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfessionalCategoryRequest extends FormRequest
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
            'professional_category_name' => 'required',
            'professional_category_code' => 'required',
            'parent_id' => 'required',
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
            'Professional_category_name.required' => '专业名称必填',
            'Professional_category_code.required' => '专业ID必填',
            'parent_id.required' => '必须选择层级',
        ];
    }
}
