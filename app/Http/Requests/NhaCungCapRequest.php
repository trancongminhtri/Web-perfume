<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NhaCungCapRequest extends FormRequest
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
            'ten_ncc' => 'bail|required',
            'sdt_ncc' => ['bail','required','numeric','digits_between:10,10','regex:/^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/'],
            'email_ncc' => 'bail|required|email',
            'dia_chi_ncc' => 'bail|required',
        ];
    }

    public function messages()
    {
        return [
            'ten_ncc.required' => 'Vui lòng nhập tên nhà cung cấp!',
            'email_ncc.required' => 'Vui lòng nhập email!',
            'email_ncc.email' => 'Email không đúng định dạng!',
            'sdt_ncc.required' => 'Vui lòng nhập số điện thoại!',
            'sdt_ncc.numeric' => 'Số điện thoại là số nguyên dương!',
            'sdt_ncc.digits_between' => 'Số điện thoại phải đủ 10 ký tự số!',
            'sdt_ncc.regex' => 'Số điện thoại không đúng đầu số nhà mạng!',
            'dia_chi_ncc.required' => 'Vui lòng nhập địa chỉ!',
        ];
    }
}
