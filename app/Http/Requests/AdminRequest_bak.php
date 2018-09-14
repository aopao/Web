<?php

namespace App\Http\Requests;

use App\Rules\CheckMobile;
use Illuminate\Foundation\Http\FormRequest;

class AdminRequestBak extends FormRequest
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
            'mobile' => [
                new CheckMobile(), //验证手机号是否合法
                'unique:admins,mobile', //验证手机号是否唯一
            ],
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'mobile.required' => '手机号必须填写!',
            'mobile.unique' => '手机号已经注册了!',
            'password.required' => '密码必须填写!',
        ];
    }
}
