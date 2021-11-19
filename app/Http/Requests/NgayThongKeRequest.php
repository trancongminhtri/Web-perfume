<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NgayThongKeRequest extends FormRequest
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
            'to_date'=> 'date|after_or_equal:from_date',
        ];
    }

    public function messages(){
        return [
            'to_date.after_or_equal' => 'Ngày bắt đầu nhỏ hơn hoặc bằng ngày kết thúc!',
        ];
    }
}
