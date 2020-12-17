<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
                'name' => 'required|min:10|max:50|unique:sliders,name,'.$this->request->get('id'),
                'desc' => 'required|min:10',
                'image' => 'mimes:png,jpg,jpe',
            ];
        }else{
            return [
                'name' => 'required|min:10|max:50|unique:sliders,name',
                'desc' => 'required|min:10',
                'image' => 'required|mimes:png,jpg,jpe',
            ];
        }
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng điền tên slider',
            'name.max' => 'Tên slider không được quá 50 ký tự',
            'name.min' => 'Tên slider phải có ít nhất 10 ký tự',
            'name.unique' => 'Tên Slider này đã tồn tại',
            'desc.required' => 'Vui lòng mô tả slider',
            'desc.min' => 'Mô tả slider phải có ít nhất 10 ký tự',
            'image.mimes' => 'Ảnh phải có dạng là jpeg, png, jpg',
            'image.required' => 'Vui lòng thêm ảnh slider',
        ];
    }
}
