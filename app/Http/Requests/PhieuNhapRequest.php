<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhieuNhapRequest extends FormRequest
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
        return
        [
            'ngay_nhap' => 'bail|required',
            'nha_cung_cap_id' => 'bail|required',
        ];
        
    }

    public function messages()
    {
        return [
            'ngay_nhap.required' => 'Vui lòng chọn ngày nhập!',
            'nha_cung_cap_id.required' => 'Vui lòng nhập số lượng!',
        ];
    }
}
