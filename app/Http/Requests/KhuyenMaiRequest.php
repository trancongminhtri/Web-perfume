<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KhuyenMaiRequest extends FormRequest
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
            'ten_khuyen_mai' => 'bail|required',
            'ngay_bat_dau' => ['bail','required','after_or_equal:today'],
            'gia_khuyen_mai' => 'bail|required',
            'ngay_ket_thuc'=> 'date|after:ngay_bat_dau',
        ];
    }

    public function messages(){
        return [
            'ten_khuyen_mai.required' => 'Vui lòng nhập tên khuyến mãi!',
            'ngay_bat_dau.required' => 'Vui lòng chọn ngày bắt đầu!',
            'ngay_bat_dau.after_or_equal' => 'Ngày bắt đầu lớn hơn hoặc bằng ngày hiện tại!',
            'gia_khuyen_mai.required' => 'Vui lòng nhập giá khuyến mãi!',
            'ngay_ket_thuc.after' => 'Ngày bắt đầu nhỏ hơn ngày kết thúc!',
        ];
    }
}
