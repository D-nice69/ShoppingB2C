<?php

namespace App\Http\Controllers;

use App\CategoryPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Components\Recusive;

class CategoryPostController extends Controller
{
    public function index()
    {
        $cPosts = CategoryPost::latest()->paginate(5);
        return view('admin.categoryPost.index',compact('cPosts'));
    }
    public function create()
    {
        $htmlOption = $this->getCategory($parentId = '');
        return view('admin.categoryPost.create',compact('htmlOption'));
    }
    public function store(Request $request)
    {
        CategoryPost::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug( $request->name,'-'),
        ]);
        return redirect()->route('categoryPost.index');
    }
    public function unactive($id)
    {
        CategoryPost::find($id)->update(['status'=>1]);
        return redirect()->route('categoryPost.index')->with('message','Đã ẩn');
    }
    public function active($id)
    {
        CategoryPost::find($id)->update(['status'=>0]);
        return redirect()->route('categoryPost.index')->with('message','Đã hiện');
    }
    public function delete($id)
    {
        CategoryPost::find($id)->delete();
        return response()->json([
            'code' => 200,
            'message' => 'success'
        ],200);
        return response()->json([
            'code' => 500,
            'message' => 'fail'
        ],500);
    }
    public function edit($id)
    {
        $cPost = CategoryPost::find($id);
        $htmlOption = $this->getCategory($cPost->parent_id);
        return view('admin.categoryPost.edit',compact('cPost','htmlOption'));
    }
    public function update($id,Request $request)
    {
        CategoryPost::find($id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug( $request->name,'_'),
        ]);
        return redirect()->route('categoryPost.index')->with('message','Sửa danh mục thành công');
    }
    public function getCategory($parentId)
    {
        $data = CategoryPost::all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryPostRecusive($parentId);
        return $htmlOption;
    }
}
