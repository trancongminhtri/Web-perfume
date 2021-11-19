<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'ho_ten' => 'bail|required',
            'email' => 'bail|required|email',
            'sdt' => ['bail','required','numeric','digits_between:10,10','regex:/^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/'],
            'dia_chi' => 'bail|required',
            'mat_khau' => 'bail|required',
            'mat_khau_lai' => 'bail|required|same:mat_khau',
        ];
    }
    public function messages()
    {
        return [
            'ho_ten.required' => 'Vui lòng nhập họ tên!',
            'email.required' => 'Vui lòng nhập email!',
            'email.email' => 'Email không đúng định dạng!',
            'sdt.required' => 'Vui lòng nhập số điện thoại!',
            'sdt.numeric' => 'Số điện thoại là số nguyên dương!',
            'sdt.digits_between' => 'Số điện thoại phải đủ 10 ký tự số!',
            'sdt.regex' => 'Số điện thoại không đúng đầu số nhà mạng!',
            'dia_chi.required' => 'Vui lòng nhập địa chỉ!',
            'mat_khau.required' => 'Vui lòng nhập mật khẩu!',
            'mat_khau_lai.required' => 'Vui lòng nhập mật khẩu lại!',
            'mat_khau_lai.same' => 'Mật khẩu không trùng khớp!',
        ];
    }
}
