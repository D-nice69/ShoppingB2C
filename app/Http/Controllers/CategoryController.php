<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\StoreCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Components\Recusive;
use App\Http\Requests\UpdateCategoryRequest;

session_start();
class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.category.index',compact('categories'));
    }
    public function create()
    {
        $htmlOption = $this->getCategory($parentId = '');
        return view('admin.category.create',compact('htmlOption'));
    }
    public function store(StoreCategory $request)
    {
        Category::create([
            'category_name' => $request->category_name,
            'category_description' => $request->category_description,
            'category_status' => $request->category_status,
            'parent_id' => $request->parent_id,
            'keyword' => $request->keyword,
            'slug' => Str::slug( $request->category_name,'-'),
        ]);
        toastr()->success('Thêm danh mục thành công');
        return redirect()->route('category.index');
    }   
    public function edit($id)
    {
        $category = Category::where('id',$id)->first();
        $htmlOption = $this->getCategory($category->parent_id);
        return view('admin.category.edit',compact('category','htmlOption'));
    }
    public function update($id, StoreCategory $request)
    {
        $category = Category::where('id',$id)->update([
            'category_name' => $request->category_name,
            'category_description' => $request->category_description,
            'category_status' => $request->category_status,
            'parent_id' => $request->parent_id,
            'keyword' => $request->keyword,
            'slug' => Str::slug( $request->category_name,'-'),
        ]);
        toastr()->success('Cập nhật danh mục thành công');
        return redirect()->route('category.index');
    }
    public function unactive($id)
    {
        Category::where('id',$id)->update(['category_status'=>1]);
        toastr()->info('Ẩn danh mục');
        return redirect()->route('category.index');
    }
    public function active($id)
    {
        Category::where('id',$id)->update(['category_status'=>0]);
        toastr()->info('Hiện danh mục');
        return redirect()->route('category.index');
    }
    public function delete($id)
    {
        try {
            Category::where('id',$id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);
        } catch (\Exception $exception) {
            Log::error('Message: ' . $exception->getMessage() . 'Line: ' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }
    public function getCategory($parentId)
    {
        $data = Category::all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parentId);
        return $htmlOption;
    }

}
