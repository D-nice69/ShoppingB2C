<?php

namespace App\Http\Controllers;

use App\Order;
use App\Order_detail;
use App\Payment;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Cart;
class OrderController extends Controller
{
    public function orderPlace(Request $request)
    {
        $content = Cart::content();

        //insert payment 
        $dataPayment = Payment::create([
            'method' =>$request->payment_method,
            'status' =>'Đang chờ xử lý',
        ]);        
        $payment_id = $dataPayment->id;
        
        //insert order
        $dataOrder = Order::create([
            'customer_id' => Session::get('customerId') ,
            'payment_id' => $payment_id,
            'shipping_id' => Session::get('shippingId'),
            'total' => Cart::total(),
            'status' => 'Đang chờ xử lý',
        ]);
        $order_id = $dataOrder->id;

        //insert order details
        foreach($content as $value){
            $dataOrderDetails = [
                'order_id' => $order_id,
                'product_id' => $value->id,
                'product_name' => $value->name,
                'product_price' =>$value->price,
                'product_sales_quantity' => $value->qty,      
            ];
            Order_detail::create($dataOrderDetails);
        };

        if($dataPayment['method']=='ATM'){
            return 'atm';
        }elseif($dataPayment['method']=='Cash'){
            Cart::destroy();
            $meta_desc = "";
            $meta_keywords = "";
            $meta_title = "";
            $url_canonical = $request->url();
            return view('home.checkout.handCash',compact('content','meta_desc','meta_keywords','meta_title','url_canonical'));
        }else{
            return redirect()->back();
        };
    }
    public function index(Request $request)
    {
        $meta_desc = "";
        $meta_keywords = "";
        $meta_title = "";
        $url_canonical = $request->url();
        $orders = Order::latest()->paginate(10);
        return view('admin.order.index',compact('orders','meta_desc','meta_keywords','meta_title','url_canonical'));
    }
    public function view($id, Request $request)
    {
        $meta_desc = "";
        $meta_keywords = "";
        $meta_title = "";
        $url_canonical = $request->url();
        $order = Order::find($id);
        return view('admin.order.view',compact('order','meta_desc','meta_keywords','meta_title','url_canonical'));
    }
}
