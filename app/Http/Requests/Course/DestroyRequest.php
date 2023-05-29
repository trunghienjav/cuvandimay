<?php

namespace App\Http\Requests\Course;

use App\Models\Course;
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
        dd($this->all());
        return [
            'course' => [
                'required',
                Rule::exists(Course::class, 'id')
            ],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['course' => $this->route('course')->id]);
        //buổi 10, 1:34:00
    }
}
