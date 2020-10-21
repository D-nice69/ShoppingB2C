<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrand extends FormRequest
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
            'brand_name' => 'required|max:30|unique:brands,brand_name',
            'brand_description' => 'required',
            'keyword' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'brand_name.required' => 'Vui lòng điền tên thương hiệu',
            'keyword.required' => 'Vui lòng điền từ khóa cho thương hiệu',
            'brand_description.required' => 'Vui lòng mô tả thương hiệu',
            'brand_name.max' => 'Tên thương hiệu không được quá 30 ký tự',
            'brand_name.unique' => 'Thương hiệu này đã tồn tại',
        ];
    }
}
