<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
                'title' => 'required|min:10|max:50|unique:posts,title,'.$this->request->get('id'),
                'description' => 'required|min:20|max:300',
                'content' => 'required|min:100',
                'image' => 'mimes:png,jpg,jpe',
                'parent_id' => 'required'
            ];
        }else{
            return [
                'title' => 'required|min:10|max:100|unique:posts,title',
                'description' => 'required|min:20|max:300',
                'content' => 'required|min:100',
                'image' => 'required|mimes:png,jpg,jpe',
                'parent_id' => 'required'
            ];
        }
    }
    public function messages()
    {
        return [
            'title.required' => 'Vui lòng điền tiêu đề',
            'title.max' => 'Tiêu đề không được quá 100 ký tự',
            'title.min' => 'Tiêu đề phải có ít nhất 10 ký tự',
            'title.unique' => 'Tiêu đề này đã tồn tại',
            'description.required' => 'Vui lòng mô tả bài viết',
            'description.min' => 'Mô tả bài viết phải có ít nhất 20 ký tự',
            'description.max' => 'Mô tả bài viết không được quá 300 ký tự',
            'content.required' => 'Vui lòng mô tả nội dung bài viết',
            'content.min' => 'Nội dung bài viết phải có ít nhất 100 ký tự',
            'image.mimes' => 'Ảnh phải có dạng là jpeg, png, jpg',
            'image.required' => 'Vui lòng thêm ảnh bài viết',
            'parent_id.required' => 'Vui lòng chọn danh mục bài viết',
        ];
    }
}
