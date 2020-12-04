<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Picture;
use Illuminate\Support\Facades\Auth;

class CropImageController extends Controller
{
    public function index()
    {
        return view('admin.shop.crop-image-upload');
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

        $saveFile = new Picture;
        $saveFile->name = $imageName;
        $saveFile->save();
    
        return response()->json(['success'=>'Crop Image Uploaded Successfully']);
    }
}
