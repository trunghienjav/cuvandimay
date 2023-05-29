<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => [
                'bail', //giúp ktra từng cái chứ ko ktra hết
                'required',
                'string',
                'unique:App\Models\Course,name', //
            ],
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc phải điền',
            'string' => ':attribute phải điền bằng kí tự',
            'unique' => ':attribute has already been taken',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên',
        ];
    }
}
