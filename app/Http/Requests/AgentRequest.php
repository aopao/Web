<?php

namespace App\Http\Requests;

use Request;
use App\Rules\CheckMobile;
use Illuminate\Foundation\Http\FormRequest;

class AgentRequest extends FormRequest
{
    private $rules = [
        'mobile' => [
            'unique:agents,mobile', //验证手机号是否唯一
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
        // 根据不同的情况, 添加不同的验证规则
        if (Request::method() == 'POST')//如果是save方法
        {
            $this->rules['mobile'] = [
                new CheckMobile(),
                'unique:agents,mobile', //验证手机号是否唯一
            ];
            $this->rules['password'] = 'required';
        }

        return $this->rules;
    }

    /**
     * 错误返回信息
     *
     * @return array
     */
    public function messages()
    {
        return [
            'mobile.required' => '手机号必须填写!',
            'mobile.unique' => '手机号已经注册了!',
            'password.required' => '密码必须填写!',
        ];
    }
}
