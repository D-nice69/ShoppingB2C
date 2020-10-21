<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Http\Requests\StoreProduct;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.product.index',compact('products'));
    }
    public function create()
    {
        $categories = Category::get();
        $brands = Brand::get();
        return view('admin.product.create',compact('categories','brands'));
    }
    public function store(StoreProduct $request)
    {
        $storeProduct = [
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_status' => $request->product_status,
            'product_desc' => $request->product_desc,
            'product_content' => $request->product_content,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'user_id' => '1',
            'product_image' => '',
            'slug' => Str::slug($request->product_name,'-'),
            'keyword' => $request->keyword,
        ];
        $getImage = $request->file('product_image');
        if(!empty($getImage)){
            $getNameImage = $getImage->getClientOriginalName();
            $nameImage = current(explode('.',$getNameImage));
            $newImage =  $nameImage.rand(0,999) .'.'.$getImage->getClientOriginalExtension();
            $getImage->move('uploads/products',$newImage);
            $storeProduct['product_image'] = $newImage;
            Product::create($storeProduct);
            Session::put('message','Thêm sản phẩm thành công');
            return redirect()->route('product.index');
        }
        Product::create($storeProduct);
        Session::put('message','Thêm sản phẩm thành công');
        return redirect()->route('product.index');
    }
    public function edit($id)
    {
        $categories = Category::get();
        $brands = Brand::get();
        $product = Product::find($id);
        return view('admin.product.edit',compact('product','categories','brands'));
    }
    public function update($id,Request $request)
    {
        $updateProduct = [
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_status' => $request->product_status,
            'product_desc' => $request->product_desc,
            'product_content' => $request->product_content,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'user_id' => '1',
            'product_image' => '',
            'slug' => Str::slug($request->product_name,'-'),
            'keyword' => $request->keyword,
        ];
        $getImage = $request->file('product_image');
        if(!empty($getImage)){
            $getNameImage = $getImage->getClientOriginalName();
            $nameImage = current(explode('.',$getNameImage));
            $newImage =  $nameImage.rand(0,999) .'.'.$getImage->getClientOriginalExtension();
            $getImage->move('uploads/products',$newImage);
            $updateProduct['product_image'] = $newImage;
            Product::find($id)->update($updateProduct);
            Session::put('message','Product updated');
            return redirect()->route('product.index');
        }
        Product::find($id)->update($updateProduct);
        Session::put('message','Product updated');
        return redirect()->route('product.index');
    }
    public function delete($id)
    {
        Product::find($id)->delete();
        return response()->json([
            'code' => 200,
            'message' => 'success'
        ],200);
        return response()->json([
            'code' => 500,
            'message' => 'fail'
        ],500);
    }
    public function unactive($id)
    {
        Product::find($id)->update(['product_status'=>1]);
        Session::put('message','Product is hidden');
        return redirect()->route('product.index');
    }
    public function active($id)
    {
        Product::find($id)->update(['product_status'=>0]);
        Session::put('message','Product is shown');
        return redirect()->route('product.index');
    }
}
