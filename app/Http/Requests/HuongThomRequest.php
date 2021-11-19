<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HuongThomRequest extends FormRequest
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
            'ten_huong_thom' => 'bail|required',
        ];
    }

    public function messages()
    {
        return [
            'ten_huong_thom.required' => 'Vui lòng nhập tên hương thơm!',
        ];
    }
}
