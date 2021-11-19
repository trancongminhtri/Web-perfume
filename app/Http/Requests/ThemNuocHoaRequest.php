<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThemNuocHoaRequest extends FormRequest
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
            'ten_nuoc_hoa' => 'bail|required',
            'gia_tien' => 'bail|required',
            'so_luong_ton' => 'bail|required|numeric',
            'gioi_tinh' => 'bail|required',
            'thuong_hieu' => 'bail|required',
            'nong_do' => 'bail|required',
            'dung_tich' => 'bail|required',
            'duong_dan_banner' => 'bail|required',
        ];
    }

    public function messages(){
        return [
            'ten_nuoc_hoa.required' => 'Vui lòng nhập tên nước hoa!',
            'gia_tien.required' => 'Vui lòng nhập giá tiền!',
            'so_luong_ton.required' => 'Vui lòng nhập số lượng tồn!',
            'so_luong_ton.numeric' => 'Số lượng tồn là số nguyên dương!',
            'gioi_tinh.required' => 'Vui lòng chọn giới tính!',
            'thuong_hieu.required' => 'Vui lòng chọn thương hiệu!',
            'nong_do.required' => 'Vui lòng chọn nồng độ!',
            'dung_tich.required' => 'Vui lòng chọn dung tích!',
            'duong_dan_banner.required' => 'Vui lòng chọn đường dẫn!',
        ];
    }
}
