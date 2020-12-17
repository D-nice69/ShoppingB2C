<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryPostRequest extends FormRequest
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
                'name' => 'required|max:30|unique:category_posts,name,'.$this->request->get('id'),
                'description' => 'required',
            ];
        }else{
            return [
                'name' => 'required|max:30|unique:category_posts,name',
                'description' => 'required',
            ];
        }
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng điền tên danh mục',
            'description.required' => 'Vui lòng mô tả danh mục',
            'name.max' => 'Tên danh mục không được quá 30 ký tự',
            'name.unique' => 'Danh mục này đã tồn tại',
        ];
    }
}
