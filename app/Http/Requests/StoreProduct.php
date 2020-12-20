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
        if($this->request->get('id')){
            return [
                'product_name'=>'required|max:100|unique:products,product_name,'.$this->request->get('id'),
                'product_price'=>'required',
                'product_desc'=>'required|max:3000',
                'product_content'=>'required|min:100',
                'product_qty'=>'required',
                'product_image'=>'mimes:jpeg,jpg,png',
            ];
        }else{
            return [
                'product_name'=>'required|max:100|unique:products,product_name',
                'product_price'=>'required',
                'product_desc'=>'required|max:3000',
                'product_content'=>'required|min:100',
                'product_qty'=>'required',
                'product_image'=>'required|mimes:jpeg,jpg,png',
            ];
        }
    }
    public function messages()
    {
        return [
            'product_name.required' => 'Vui lòng điền tên sản phẩm',
            'keyword.required' => 'Vui lòng điền từ khóa cho sản phẩm',
            'product_name.max' => 'Tên sản phẩm không được quá 100 ký tự',
            'product_name.unique' => 'Sản phẩm này đã tồn tại',
            'product_price.required' => 'Vui lòng điền giá sản phẩm',
            'product_desc.required' => 'Vui lòng mô tả sản phẩm',
            'product_desc.max' => 'Mô tả sản phẩm không được quá 3000 ký tự',
            'product_content.required' => 'Vui lòng mô tả nội dung sản phẩm',
            'product_content.min' => 'Nội dung sản phẩm phải có hơn 100 ký tự',
            'product_qty.required' => 'Vui lòng thêm số lượng sản phẩm',
            'product_image.required' => 'Sản phẩm cần có ảnh',
            'product_image.mimes' => 'Ảnh phải có dạng là jpeg, png, jpg',
        ];
    }
}
