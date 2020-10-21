<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
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
            'product_name'=>'required|max:30|unique:products,product_name',
            'product_price'=>'required',
            'product_desc'=>'required',
            'product_content'=>'required',
            'keyword' => 'required',
            'product_image'=>'required|image',

        ];
    }
    public function messages()
    {
        return [
            'product_name.required' => 'Vui lòng điền tên sản phẩm',
            'keyword.required' => 'Vui lòng điền từ khóa cho sản phẩm',
            'product_name.max' => 'Tên sản phẩm không được quá 30 ký tự',
            'product_name.unique' => 'Sản phẩm này đã tồn tại',
            'product_price.required' => 'Vui lòng điền giá sản phẩm',
            'product_desc.required' => 'Vui lòng mô tả sản phẩm',
            'product_content.required' => 'Vui lòng mô tả nội dung sản phẩm',
            'product_image.required' => 'Sản phẩm cần có ảnh',
            'product_image.image' => 'Ảnh phải có dạng là jpeg, png, bmp, gif, svg, hoặc webp',
        ];
    }
}
