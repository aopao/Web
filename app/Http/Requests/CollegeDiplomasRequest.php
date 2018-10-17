<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CollegeDiplomasRequest extends FormRequest
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
            'diplomas_name' => 'required',
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
            'diplomas_name.required' => '大学文凭名称必填',
        ];
    }
}
