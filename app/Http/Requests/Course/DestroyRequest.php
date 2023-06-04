<?php

namespace App\Http\Requests\Course;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DestroyRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // dd($this->all(), request('course'));
        // CÁCH DD RA ĐỂ XEM NTN, xem cách anh Long dd rồi giải thích là hiểu

        return [
            'course' => [
                // thèn course trong rule này lấy fill từ trong form nên khi để nó là thanh địa chỉ thì nó ko lấy đc
                'required',
                Rule::exists(Course::class, 'id') //vẫn chưa hiểu lắm, buổi 10, 1:34:00->
                //hình như là khi muốn xoá thì nó bắt buộc là phải xoá theo id tồn tại thực (validate)
            ],
        ];
    }
    protected function prepareForValidation()
    {
        // dd(1);
        $this->merge([
            'course' => $this->route('course')
        ]);
    }
}
