<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MbtiPrimaryIssueRequest extends FormRequest
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
            'issue' => [
                'requied',
            ],
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
            'issue.requied' => '问题必须填写!',
        ];
    }
}
