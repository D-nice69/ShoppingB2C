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
        if($this->request->get('id')){
            return [
                'name' => 'required|unique:coupons,name,'.$this->request->get('id'),
                'qty' => 'required|min:1',
                'feature' => 'required',
                'discount_number' => 'required',
            ];
        }else{
            return [
                'name' => 'required|unique:coupons,name',
                'qty' => 'required',
                'feature' => 'required',
                'discount_number' => 'required',
            ];
        }
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng điền tên mã giảm giá',
            'name.unique' => 'Tên mã giảm giá đã tồn tại',
            'qty.required' => 'Vui lòng điền số lượng mã giảm giá',
            'qty.min' => 'Số lượng mã giảm giá ít nhất là 1',
            'feature.required' => 'Vui lòng chọn tính năng',
            'discount_number.required' => 'Vui lòng điền số lượng giảm giá',
            
        ];
    }
}
