<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
           'tieu_de_blog' => 'bail|required',
           'mo_ta_blog' => 'bail|required',
           'noi_dung_blog' => 'bail|required',
           'duong_dan_banner' => 'bail|required',
        ];
    }

    public function messages()
    {
           return [
            'tieu_de_blog.required' => 'Vui lòng nhập tiêu đề',
            'mo_ta_blog.required' => 'Vui lòng nhập mô tả',
            'noi_dung_blog.required' => 'Vui lòng nhập nội dung',
            'duong_dan_banner.required' => 'Vui lòng chọn ảnh',
           ];
    }
}
