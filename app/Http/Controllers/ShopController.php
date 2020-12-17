<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSellerRequest;
use App\Picture;
use App\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        $shop = Seller::where('customer_id',Auth::user()->id)->first();
        $pic = Picture::where('customer_id',Auth::user()->id)->first();
        return view('admin.shop.index',compact('shop','pic'));
    }
    public function store(UpdateSellerRequest $request)
    {
        Seller::where('customer_id',Auth::user()->id)->update([
            'customer_id' => Auth::user()->id,
            'shop_name' => $request->shop_name,
            'shop_info' => $request->shop_info,
        ]);
        toastr()->success('Lưu thành công');
        return redirect()->back();
    }
    public function uploadCropImage(Request $request)
    {
        $folderPath = public_path('uploads/shop/'.Auth::user()->id.'/');
        if(!is_dir($folderPath)){
            mkdir($folderPath);
        }
        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $imageName = uniqid() . '.png';
 
        $imageFullPath = $folderPath.$imageName;
 
        file_put_contents($imageFullPath, $image_base64);

        Picture::where('id',26)->update([
            'customer_id' => Auth::user()->id,
            'name' => $imageName,
        ]);        
    
        return response()->json([
            'success'=>'Crop Image Uploaded Successfully',
            'image_src' => '/uploads/shop/'.Auth::user()->id.'/'.$imageName,
        ]);
    }
    // public function index()
    // {
    //     $shop = Seller::where('customer_id',Auth::user()->id)->first();
    //     $pic = Picture::first();
    //     return view('admin.shop.index',compact('shop','pic'));
    // }
    // public function cropImage(Request $request)
    // {
    //     dd(print_r('123'));
    //     $folderPath = public_path('uploads/shop/'.Auth::user()->id.'/');
    //     if(!is_dir($folderPath)){
    //         mkdir($folderPath);
    //     }
    //     $image_parts = explode(";base64,", $request->image);
    //     $image_type_aux = explode("image/", $image_parts[0]);
    //     $image_type = $image_type_aux[1];
    //     $image_base64 = base64_decode($image_parts[1]);

    //     $imageName = uniqid() . '.png';
 
    //     $imageFullPath = $folderPath.$imageName;
 
    //     file_put_contents($imageFullPath, $image_base64);

    //     $saveFile = new Picture;
    //     $saveFile->name = $imageName;
    //     $saveFile->save();
    
    //     return response()->json(['success'=>'Crop Image Uploaded Successfully']);
    // }
    // public function index2()
    // {
    //     return view('crop-image-upload');
    // }
}
