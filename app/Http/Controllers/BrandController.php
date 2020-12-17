<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Http\Requests\StoreBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->paginate(10);
        return view('admin.brand.index',compact('brands'));
    }
    public function create()
    {
        return view('admin.brand.create');
    }
    public function store(StoreBrand $request)
    {
        Brand::create([
            'brand_name' => $request->brand_name,
            'brand_description' => $request->brand_description,
            'brand_status' => $request->brand_status,
            'keyword' => $request->keyword,
            'slug' => Str::slug( $request->brand_name,'-')
        ]);
        toastr()->success('Thêm thương hiệu thành công');
        return redirect()->route('brand.index');
    }
    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand.edit',compact('brand'));
    }
    public function update($id, StoreBrand $request)
    {
        Brand::find($id)->update([
            'brand_name' => $request->brand_name,
            'brand_description' => $request->brand_description,
            'brand_status' => $request->brand_status,
            'keyword' => $request->keyword,
            'slug' => Str::slug( $request->brand_name,'-')
        ]);
        toastr()->success('Cập nhật thương hiệu thành công');
        return redirect()->route('brand.index');
    }
    public function delete($id)
    {        
        Brand::find($id)->delete();
        return response()->json([
            'code' => 200,
            'message' => 'success',
        ],200);        
        return response()->json([
            'code' => 500,
            'message' => 'fail',
        ],500);   
    }
    public function unactive($id)
    {
        Brand::find($id)->update(['Brand_status'=>1]);
        toastr()->info('Ẩn thương hiệu');
        return redirect()->route('brand.index');
    }
    public function active($id)
    {
        Brand::find($id)->update(['Brand_status'=>0]);
        toastr()->info('Hiện thương hiệu');
        return redirect()->route('brand.index');
    }
}
