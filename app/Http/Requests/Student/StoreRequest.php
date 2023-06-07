<?php

namespace App\Http\Requests\Student;

use App\Enums\StudentStatusEnum;
use App\Models\Course;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

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
            'name' => [
                'required',
                'string',
                'min:2',
                'max:50',
            ],
            'gender' => [
                'required',
                'boolean',
            ],
            'birthdate' => [
                'required',
                'before:today'
            ],
            'status' => [
                'required',
                Rule::in(StudentStatusEnum::asArray()),
            ],
            'course_id' => [
                'required',
                Rule::exists(Course::class, 'id'),
            ]
        ];
    }
}
