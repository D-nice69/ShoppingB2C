<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Http\Requests\StoreProduct;
use App\Product;
use App\ProductImage;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('user_id',Auth::user()->id)->latest()->get();
        return view('admin.product.index',compact('products'));
    }
    public function create()
    {
        $categories = Category::get();
        $brands = Brand::get();
        return view('admin.product.create',compact('categories','brands'));
    }
    public function store(Request $request)
    {
        // $getImage = $request->file('pro');
        // $getImage2 = $request->file('images');

        // dd($getImage);

        $storeProduct = [
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_qty' => $request->product_qty,
            'product_status' => $request->product_status,
            'product_desc' => $request->product_desc,
            'product_content' => $request->product_content,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'user_id' => Auth::user()->id,
            'product_image' => '',
            'slug' => Str::slug($request->product_name,'-'),
            // 'keyword' => $request->keyword,
        ];
        $getImage = $request->file('product_image');
        if(!empty($getImage)){
            $getNameImage = $getImage->getClientOriginalName();
            $nameImage = current(explode('.',$getNameImage));
            $newImage =  $nameImage.rand(0,999) .'.'.$getImage->getClientOriginalExtension();
            $getImage->move('uploads/products/'.Auth::user()->id,$newImage);
            $storeProduct['product_image'] = $newImage;            
        }
        $sP = Product::create($storeProduct);
        //add tags
        foreach ($request->tags as $tagItem) {
            $tagInstance = Tag::firstOrCreate([
                'name' => $tagItem,
                'slug' => Str::slug($tagItem,'-'),
            ]);
            $tagIds[] = $tagInstance->id;
        }
        $sP->tags()->attach($tagIds);

        if($request->hasFile('images')){
            foreach($request->images as $fileItem){
                $getNameImage = $fileItem->getClientOriginalName();
                $nameImage = current(explode('.',$getNameImage));
                $newImage =  $nameImage.rand(0,999) .'.'.$fileItem->getClientOriginalExtension();
                $fileItem->move('uploads/products/'.Auth::user()->id,$newImage);
                ProductImage::create([
                    'image' => $newImage,
                    'product_id' => $sP->id,
                ]);
            }
        }
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
        $product = Product::find($id);
        $updateProduct = [
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_qty' => $request->product_qty,
            'product_status' => $request->product_status,
            'product_desc' => $request->product_desc,
            'product_content' => $request->product_content,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'user_id' => Auth::user()->id,
            'product_image' => $product->product_image,
            'slug' => Str::slug($request->product_name,'-'),
        ];
        $getImage = $request->file('product_image');
        if(!empty($getImage)){
            $getNameImage = $getImage->getClientOriginalName();
            $nameImage = current(explode('.',$getNameImage));
            $newImage =  $nameImage.rand(0,999) .'.'.$getImage->getClientOriginalExtension();
            $getImage->move('uploads/products/'.Auth::user()->id,$newImage);
            $updateProduct['product_image'] = $newImage;
        }
        Product::find($id)->update($updateProduct);
        $sP =  Product::find($id);
        $tagIds = [];
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    $tagInstance = Tag::firstOrCreate([
                        'name' => $tagItem,
                        'slug' => Str::slug($tagItem,'-'),
                    ]);
                    $tagIds[] = $tagInstance->id;
                }
            }
        $sP->tags()->sync($tagIds);
        if($request->hasFile('images')){
            ProductImage::where('product_id',$id)->delete();
            foreach($request->images as $fileItem){
                $getNameImage = $fileItem->getClientOriginalName();
                $nameImage = current(explode('.',$getNameImage));
                $newImage =  $nameImage.rand(0,999) .'.'.$fileItem->getClientOriginalExtension();
                $fileItem->move('uploads/products/'.Auth::user()->id,$newImage);
                ProductImage::create([
                    'image' => $newImage,
                    'product_id' => $sP->id,
                ]);
            }
        }

        Session::put('message','Product updated');
        return redirect()->route('product.index');
    }
    public function delete($id)
    {
        Product::find($id)->delete();
        ProductImage::where('product_id',$id)->delete();
        return response()->json([
            'code' => 200,
            'message' => 'success',
        ],200);
        return response()->json([
            'code' => 500,
            'message' => 'fail'
        ],500);
    }
    public function unactive($id)
    {
        Product::find($id)->update(['product_status'=>1]);
        Session::put('message','Đã ẩn');
        return redirect()->route('product.index');
    }
    public function active($id)
    {
        Product::find($id)->update(['product_status'=>0]);
        Session::put('message','đã hiện');
        return redirect()->route('product.index');
    }
}
