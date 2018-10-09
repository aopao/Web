<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SerialNumberPrimaryRequest extends FormRequest
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
            'number' => [
                Rule::exists('serial_numbers')->where(function ($query) {
                    $query->where('is_senior', 0);
                }),
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
            'number.exists' => '序列号不存在!',
        ];
    }
}
