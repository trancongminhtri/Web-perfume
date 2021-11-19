<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThuongHieuRequest extends FormRequest
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
            'ten_thuong_hieu' => 'bail|required',
        ];
    }

    public function messages()
    {
        return [
            'ten_thuong_hieu.required' => 'Vui lòng nhập tên thương hiệu!',
        ];
    }
}
