<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategory extends FormRequest
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
            'category_name' => 'required|max:30|unique:categories,category_name',
            'category_description' => 'required',
            'keyword' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'category_name.required' => 'Vui lòng điền tên danh mục',
            'keyword.required' => 'Vui lòng điền từ khóa cho danh mục',
            'category_description.required' => 'Vui lòng mô tả danh mục',
            'category_name.max' => 'Tên danh mục không được quá 30 ký tự',
            'category_name.unique' => 'Danh mục này đã tồn tại',
        ];
    }
}
