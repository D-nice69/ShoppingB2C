<?php

namespace App\Http\Controllers;

use App\City;
use App\Customer;
use App\District;
use App\feeShip;
use App\Http\Requests\CaptchaRequest;
use App\Http\Requests\CustomerResigterRequest;
use App\Seller;
use App\Shipping;
use App\Town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Cart;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function login()
    {
        return view('home.checkout.login');
    }
    public function loginCustomer(Request $request)
    {
        $email = $request->email;
    	$password = md5($request->password);
        $result = Customer::where('email',$email)->where('password',$password)->first();
    	if($result){
            Session::put('customerName',$result->name);
            Session::put('customerId',$result->id); 
        }
        if(Auth::attempt([
            'email' => $email,
            'password' => $request->password
        ])){
            return redirect()->intended();
        }else{
    		return redirect('/login');
        };
    }
    public function register()
    {
        return view('home.CustomerRegistration.register');
    }
    public function add(CustomerResigterRequest $request)
    {
        $data = Customer::create([
            'name' =>$request->name,
            'email' =>$request->email,
            'phone' =>$request->phone,
            'password' =>md5($request->password),
            'role_id' => 2,
        ]);
        Seller::create([
            'customer_id' => $data->id,
            'shop_info' => '',
            'shop_name' => $request->name,
        ]);
        $customerId = $data->id;
        Session::put('customerId',$customerId);
        Session::put('customerName',$request->name);
        Auth::login($data);
        return redirect('/checkout');
    }
    public function Checkout(Request $request)
    {
        //SEO
        $meta_desc = "";
        $meta_keywords = "";
        $meta_title = "";
        $url_canonical = $request->url();
        //SEO

        $cart = Session::get('cart');
        $total = 0;
        
        // $cities = City::all();
        // $districts = District::all();
        // $towns = Town::all();
        if($cart){
            foreach($cart as $key=>$value){
                $subtotal = $value['product_price'] * $value['product_qty'];
                $total += $subtotal;
            }
        }
        return view('home.checkout.checkout',compact('meta_desc','meta_keywords','meta_title','url_canonical','total','cart'));
    }
    public function saveCheckout(Request $request)
    {
        dd($request->payment_method);
    }
    public function payment(Request $request)
    {
        $meta_desc = "";
        $meta_keywords = "";
        $meta_title = "";
        $url_canonical = $request->url();
        $cart = Session::get('cart');
        $total = 0;
        foreach($cart as $value){
            $subtotal = $value['product_price'] * $value['product_qty'];
            $total += $subtotal;
        }
        return view('home.checkout.payment',compact('cart','meta_desc','meta_keywords','meta_title','url_canonical'));
    }
    public function logout(){
        Auth::logout();
        Session::flush();
    	return redirect()->route('home.index');
    }
    public function deliveryCal(Request $request)
    {
        $data = $request->all();
        if($data['matp']){
            $feeship = feeShip::where('matp',$data['matp'])->where('maqh',$data['maqh'])->where('xaid',$data['xaid'])->get();
            if($feeship){
                $count_feeship = $feeship->count();
                if($count_feeship>0){
                    foreach($feeship as $fee){
                        Session::put('fee',$fee->fee_feeship);
                        Session::save();
                    }
                }else{
                    Session::put('fee',25000);
                    Session::save();
                }
            }
        }
    }
    public function deliveryDel()
    {
        Session::forget('fee');
        return redirect()->back();
    }
    public function thanks(Request $request)
    {
        $meta_desc = "";
        $meta_keywords = "";
        $meta_title = "";
        $url_canonical = $request->url();
        return view('home.checkout.tks',compact('meta_desc','meta_keywords','meta_title','url_canonical'));
    }
}
