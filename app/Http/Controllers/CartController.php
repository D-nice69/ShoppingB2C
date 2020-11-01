<?php

namespace App\Http\Controllers;

use App\City;
use App\District;
use App\Product;
use App\Town;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function show(Request $request)
    { 
        //SEO
        $meta_desc = "Giỏ hàng của bạn";
        $meta_keywords = "Giỏ hàng của bạn";
        $meta_title = "Giỏ hàng của bạn";
        $url_canonical = $request->url();
        //SEO
        $cities = City::all();
        $districts = District::all();
        $towns = Town::all();
        $cart = Session::get('cart');
        $total = 0;
        if($cart){
            foreach($cart as $key=>$value){
                $subtotal = $value['product_price'] * $value['product_qty'];
                $total += $subtotal;
            }
            return view('home.cart.cart_ajax',compact('meta_desc','meta_keywords','meta_title','url_canonical','total','cart','cities','districts','towns'));
        }else{
            return view('home.cart.cart_ajax',compact('meta_desc','meta_keywords','meta_title','url_canonical','total','cart','cities','districts','towns'));
        }
    }
    public function index(Request $request)
    {
        $meta_desc = "Giỏ hàng của bạn";
        $meta_keywords = "Giỏ hàng của bạn";
        $meta_title = "Giỏ hàng của bạn";
        $url_canonical = $request->url();
        $content = Cart::content();
        return view('home.cart',compact('content','meta_desc','meta_keywords','meta_title','url_canonical'));
    }
    public function store(Request $request)
    {
        // $productId = $request->productid_hidden;
        // $productInfo = Product::where('id',$productId)->first();
        // $data =[
        //     'id' => $productInfo->id,
        //     'qty' => $request->qty,
        //     'name' => $productInfo->product_name,
        //     'price' => $productInfo->product_price,
        //     'weight' => '0',
        //     'options' => ['image'=>$productInfo->product_image],
        // ];
        // Cart::add($data);
        // return redirect()->route('cart.index');
        Cart::destroy();
    }
    public function delete($id)
    {
        Cart::update($id,0);
        return redirect()->back();
    }
    public function update(Request $request)
    {
        $id = $request->rowId_cart;
        $quanty = $request->quantity;
        Cart::update($id,$quanty);
        return redirect()->route('cart.index');
    }
    public function addCartAjax(Request $request)
    {
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart == true){
            $is_available = 0;
            foreach($cart as $key => $val){
                if ($val['product_id'] == $data['cart_product_id']){
                    $is_available++;
                }
            }
            if($is_available == 0){
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_slug' => Str::slug($data['cart_product_name']),
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_slug' => Str::slug($data['cart_product_name']),
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],

            );
            Session::put('cart',$cart);
        }
        Session::save();
    }
    public function updateAjax($id, Request $request)
    {
        $data = $request -> all();
        $cart = Session::get('cart');
        if($cart == true){
            foreach($data['cart_qty'] as $key=>$qty){
                foreach($cart as $sess => $value){
                    if($value['session_id']==$id){
                       $cart[$sess]['product_qty'] = $qty;
                       if($cart[$sess]['product_qty'] == 0){
                           unset($cart[$sess]);
                           Session::forget('coupon');
                           Session::forget('fee');
                       }
                    }
                }
            }
        }
        Session::put('cart',$cart);
        return redirect()->back();
    }
    public function deleteAjax($id)
    {
        $cart = Session::get('cart');
        if($cart == true){
            foreach($cart as $key => $value){
                if($value['session_id']==$id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return redirect()->back();
        }
    }
    
}
