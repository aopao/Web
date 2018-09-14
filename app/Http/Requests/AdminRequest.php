<?php

namespace App\Http\Requests;

use App\Rules\CheckMobile;
use Illuminate\Foundation\Http\FormRequest;
use Request;

class AdminRequest extends FormRequest
{
    private $rules = [
        'mobile' => [
            'unique:admins,mobile', //验证手机号是否唯一
        ],
        'password' => '',
    ];

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
        $rules = $this->rules;
        // 根据不同的情况, 添加不同的验证规则
        if (Request::method() == 'POST')//如果是save方法
        {
            $rules['mobile'] = [
                new CheckMobile(),
                'unique:admins,mobile', //验证手机号是否唯一
            ];
            $rules['password'] = 'required';
        }
        if (Request::method() == 'UPDATE')//如果是edit方法
        {
            $rules['mobile'] = [
                new CheckMobile(),
                'unique:admins,mobile', //验证手机号是否唯一
            ];
            $rules['password'] = 'required';
        }

        return $rules;
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
