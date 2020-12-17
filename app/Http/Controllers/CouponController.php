<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Http\Requests\StoreCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->paginate(5);
        return view('admin.coupon.index',compact('coupons'));
    }
    public function create()
    {
        return view('admin.coupon.create');
    }
    public function delete($id)
    {
        Coupon::find($id)->delete();
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
        $coupon = Coupon::find($id);
        return view('admin.coupon.edit',compact('coupon'));
    }
    public function update($id, StoreCoupon $request)
    {
        $coupon = Coupon::find($id)->update([
            'name' => $request->name,
            'qty' => $request->qty,
            'feature' => $request->feature,
            'discount_number' => $request->discount_number
        ]);
        toastr()->success('Cập nhật mã giảm giá thành công');
        return redirect()->route('coupon.index');
    }
    public function store(StoreCoupon $request)
    {
        Coupon::create([
            'name' => $request->name,
            'code' => substr(md5(microtime()),rand(0,26),5),
            'qty' => $request->qty,
            'feature' => $request->feature,
            'discount_number' => $request->discount_number
        ]);
        toastr()->success('Thêm mã giảm giá thành công');
        return redirect()->route('coupon.index');
    }
    public function checkCoupon(Request $request)
    {
        $url = URL::route('cart.show') . '#coupon_check';
        $data = $request->all();
        $coupon = Coupon::where('code',$data['coupon'])->first();
        if($coupon){
            $count_coupon = $coupon->count();
            if($count_coupon>0){
                $coupon_session = Session::get('coupon');
                if($coupon_session == true){
                    $is_available = 0;
                    if($is_available == 0){
                        $cou[] = array(
                            'code' => $coupon->code,
                            'feature' => $coupon->feature,
                            'discount_number' => $coupon->discount_number,
                        );
                        Session::put('coupon',$cou);
                    }
                }else{
                    $cou[] = array(
                        'code' => $coupon->code,
                        'feature' => $coupon->feature,
                        'discount_number' => $coupon->discount_number,
                    );
                    Session::put('coupon',$cou);
                }
                Session::save();
                return redirect()->to($url)->with('message','Thêm mã giảm giá thành công');
            }

        }else{
            return redirect()->to($url)->with('error','Mã giảm giá không đúng');
        }
    }
    public function unset()
    {
        $url = URL::route('cart.show') . '#coupon_check';
        $coupon = Session::get('coupon');
        if($coupon == true){
            Session::forget('coupon');
            return redirect()->to($url)->with('message','Xóa mã giảm giá thành công');
        }
    }
}
