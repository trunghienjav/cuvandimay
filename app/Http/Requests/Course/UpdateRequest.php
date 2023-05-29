<?php

namespace App\Http\Requests\Course;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
                Rule::unique(Course::class)->ignore($this->course), //update nhưng muốn giữ nguyên tên cũ, chỉ thay đổi cái khác thì phải như này, nếu ko nó sẽ báo trùng, buổi 10, 1:23
                // Course::class là khai báo theo kiểu model
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
