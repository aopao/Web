<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProvinceControlScoreRequest extends FormRequest
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
            'province_id' => 'required|integer',
            'year' => 'required|integer',
            'batch' => 'required',
            'subject' => 'required|integer',
            'score' => 'required|integer',
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
            'province_id.required' => '省份必须选择',
            'year.required' => '年份必须选择',
            'batch.required' => '批次必须填写',
            'subject.required' => '科类必须选择',
            'score.required' => '分数必须填写',
        ];
    }
}
