<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
                'name' => 'required|min:5|max:30|unique:roles,name,'.$this->request->get('id'),
                'display_name' => 'required',
            ];
        }else{
            return [
                'name' => 'required|min:5|max:30|unique:roles,name',
                'display_name' => 'required',
            ];
        }
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng điền tên vai trò',
            'display_name.required' => 'Vui lòng mô tả vai trò',
            'name.max' => 'Tên vai trò không được quá 30 ký tự',
            'name.min' => 'Tên vai trò phải có ít nhất 5 ký tự',
            'name.unique' => 'Vai trò này đã tồn tại',
        ];
    }
}
