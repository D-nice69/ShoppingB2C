<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSellerRequest extends FormRequest
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
            'shop_info' => 'min:50',
            'shop_name' =>'required|min:10|max:50|unique:sellers,shop_name,'.$this->user()->seller->id,
        ];
    }
    public function messages()
    {
        return [
            'shop_name.required' => 'Vui lòng điền tên cho shop',
            'shop_info.min' => 'Phần mô tả shop phải có ít nhất 50 ký tự',
            'shop_name.unique' => 'Tên shop này đã tồn tại',
            'shop_name.min' => 'Tên shop phải có ít nhất 10 ký tự',
            'shop_name.max' => 'Tên shop không được quá 50 ký tự',
        ];
    }
}
