<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\CaptchaRequest;
use App\Http\Requests\CustomerResigterRequest;
use App\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Cart;

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
    		return redirect('/checkout');
    	}else{
    		return redirect('/login');
    	}
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
        ]);
        $customerId = $data->id;
        Session::put('customerId',$customerId);
        Session::put('customerName',$request->name);
        return redirect('/checkout');
    }
    public function Checkout(Request $request)
    {
        $meta_desc = "";
        $meta_keywords = "";
        $meta_title = "";
        $url_canonical = $request->url();
        return view('home.checkout.checkout',compact('meta_desc','meta_keywords','meta_title','url_canonical'));
    }
    public function saveCheckout(Request $request)
    {
        $data = Shipping::create([
            'name' =>$request->name,
            'email' =>$request->email,
            'phone' =>$request->phone,
            'address' =>$request->address,
            'note' =>$request->note,
        ]);
        $shippingId = $data->id;
        Session::put('shippingId',$shippingId);
        return redirect('/payment');
    }
    public function payment(Request $request)
    {
        $meta_desc = "";
        $meta_keywords = "";
        $meta_title = "";
        $url_canonical = $request->url();
        $content = Cart::content();
        return view('home.checkout.payment',compact('content','meta_desc','meta_keywords','meta_title','url_canonical'));
    }
    public function logout(){
    	Session::flush();
    	return redirect()->back();
    }
}
