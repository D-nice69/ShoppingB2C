<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderRequest;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SliderController extends Controller
{
    public function create()
    {
        return view('admin.slider.create');
    }
    public function index()
    {
        $sliders = Slider::latest()->paginate(5);
        return view('admin.slider.index',compact('sliders'));
    }
    public function store(SliderRequest $request)
    {
        $data = [
            'name' => $request->name,
            'desc' => $request->desc,
            'status' => $request->status,
            'image' => $request->image,
        ];
        $getImage = $request->file('image');
        if(!empty($getImage)){
            $getNameImage = $getImage->getClientOriginalName();
            $nameImage = current(explode('.',$getNameImage));
            $newImage =  $nameImage.rand(0,999) .'.'.$getImage->getClientOriginalExtension();
            $getImage->move('uploads/sliders',$newImage);
            $data['image'] = $newImage;
        }
        Slider::create($data);
        toastr()->success('Thêm slider thành công');
        return redirect()->route('slider.index');
    }
    public function unactive($id)
    {
        Slider::find($id)->update(['status'=>1]);
        toastr()->info('Ẩn thương hiệu');
        return redirect()->route('slider.index');
    }
    public function active($id)
    {
        Slider::find($id)->update(['status'=>0]);
        toastr()->info('Hiện thương hiệu');
        return redirect()->route('slider.index');
    }
    public function edit($id, Request $request)
    {
        $slider = Slider::find($id);
        return view('admin.slider.edit',compact('slider'));
    }
    public function update($id, SliderRequest $request)
    {
        $slider = Slider::find($id);
        $data = [
            'name' => $request->name,
            'desc' => $request->desc,
            'status' => $request->status,
            'image' => $slider->image,
        ];
        $getImage = $request->file('image');
        if(!empty($getImage)){
            $getNameImage = $getImage->getClientOriginalName();
            $nameImage = current(explode('.',$getNameImage));
            $newImage =  $nameImage.rand(0,999) .'.'.$getImage->getClientOriginalExtension();
            $getImage->move('uploads/sliders',$newImage);
            $data['image'] = $newImage;            
        }
        Slider::find($id)->update($data);
        toastr()->success('Cập nhật slider thành công');
        return redirect()->route('slider.index');
    }
    public function delete($id)
    {
        Slider::find($id)->delete();
        return response()->json([
            'code' => 200,
            'message' => 'success'
        ],200);
        return response()->json([
            'code' => 500,
            'message' => 'fail'
        ],500);
    }
}
