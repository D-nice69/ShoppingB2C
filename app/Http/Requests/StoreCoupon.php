<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCoupon extends FormRequest
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
            'name' => 'required',
            'code' => 'required',
            'qty' => 'required',
            'feature' => 'required',
            'discount_number' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng điền tên mã giảm giá',
            'code.required' => 'Vui lòng điền mã giảm giá',
            'qty.required' => 'Vui lòng điền số lượng mã giảm giá',
            'feature.required' => 'Vui lòng chọn tính năng',
            'discount_number.required' => 'Vui lòng điền số lượng giảm giá',
            
        ];
    }
}
