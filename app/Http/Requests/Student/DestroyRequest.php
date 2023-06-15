<?php

namespace App\Http\Requests\Student;

use App\Models\student;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DestroyRequest extends FormRequest
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
            'student' => [
                'required',
                Rule::exists(student::class, 'id'),
            ]
        ];
    }

    protected function prepareForValidation()
    {
        // dd(1);
        $this->merge([
            'student' => $this->route('student')
        ]);
    }
}
