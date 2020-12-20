<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Customer;
use App\Order;
use App\Order_detail;
use App\Payment;
use App\Product;
use App\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Cart;
use Illuminate\Support\Facades\Auth;
use PDF;
class OrderController extends Controller
{
    // public function orderPlace(Request $request)
    // {
    //     $content = Cart::content();

    //     //insert payment 
    //     $dataPayment = Payment::create([
    //         'method' =>$request->payment_method,
    //         'status' =>'Đang chờ xử lý',
    //     ]);        
    //     $payment_id = $dataPayment->id;
        
    //     //insert order
    //     $dataOrder = Order::create([
    //         'customer_id' => Session::get('customerId') ,
    //         'payment_id' => $payment_id,
    //         'shipping_id' => Session::get('shippingId'),
    //         'total' => Cart::total(),
    //         'status' => 'Đang chờ xử lý',
    //     ]);
    //     $order_id = $dataOrder->id;

    //     //insert order details
    //     foreach($content as $value){
    //         $dataOrderDetails = [
    //             'order_id' => $order_id,
    //             'product_id' => $value->id,
    //             'product_name' => $value->name,
    //             'product_price' =>$value->price,
    //             'product_sales_quantity' => $value->qty,      
    //         ];
    //         Order_detail::create($dataOrderDetails);
    //     };

    //     if($dataPayment['method']=='ATM'){
    //         return 'atm';
    //     }elseif($dataPayment['method']=='Cash'){
    //         Cart::destroy();
    //         $meta_desc = "";
    //         $meta_keywords = "";
    //         $meta_title = "";
    //         $url_canonical = $request->url();
    //         return view('home.checkout.handCash',compact('content','meta_desc','meta_keywords','meta_title','url_canonical'));
    //     }else{
    //         return redirect()->back();
    //     };
    // }
    public function index(Request $request)
    {
        $orderDetails = Order_detail::where('seller_id',Auth::user()->id)->get();
        // dd($orderDetails);
        // dd(count($orderDetails));
        // $orders = Order::where('seller_id',Auth::user()->id)->get();
        // $product = Session::get('cart');

        // foreach($product as $pro){
        //     $unique[] = $pro['seller_id'];
        // }
        // $unique_id = array_unique($unique);
        // dd($unique_id);
        
        return view('admin.order.index',compact('orderDetails'));
    }
    public function view($id, Request $request)
    {
        $order = Order::find($id);
        $all_product = 0;
        $fee_ship = 0;
        foreach($order->orderDetails as $orderItem){
            if($orderItem->seller_id == Auth::user()->id){
                $coupon = Coupon::where('code',$orderItem->coupon)->first();
                $one_product = $orderItem->product_sales_quantity * $orderItem->product_price;
                $all_product += $one_product;
                $fee_ship = $orderItem->fee_ship;
            }
        }
        return view('admin.order.view',compact('order','coupon','all_product','fee_ship'));
    }
    public function confirm(Request $request)
    {
        $data = $request->all();
        $product = Session::get('cart');
        if($data['payment_select']==1){

            $shipping = Shipping::create([
                'name' => $data['shipping_name'],
                'email' => $data['shipping_email'],
                'address' => $data['shipping_address'],
                'phone' => $data['shipping_phone'],
                'note' => $data['shipping_note'],
                'method' => $data['payment_select'],
            ]);
            $shipping_id = $shipping->id;
            
            foreach($product as $pro){
                $unique[] = $pro['seller_id'];
            }
            $unique_id = array_unique($unique);
            if($product){
                foreach($unique_id as $ui){
                    $order = Order::create([
                        'customer_id' => Session::get('CustomerId'),
                        'shipping_id' => $shipping_id,
                        // 'seller_id' => $ui,
                        'status' => 1,
                        'code' => substr(md5(microtime()),rand(0,26),5),
                    ]);
                foreach($product as $val){
                    if($val['seller_id']==$ui){
                        Order_detail::create([
                            'order_id' => $order->id,
                            'product_id' => $val['product_id'],
                            'seller_id' => $val['seller_id'],
                            'product_name' => $val['product_name'],
                            'product_sales_quantity' => $val['product_qty'],
                            'product_price' => $val['product_price'],
                            'coupon' => $data['order_coupon'],
                            'fee_ship' => $data['order_fee'],
                            ]);
                        }
                    }
                }

            }
            Session::forget('fee');
            Session::forget('coupon');
            Session::forget('cart');
            echo 'cash';
        }else if($data['payment_select']==0){

            $vnp_TmnCode = "Y4U88XFK"; //Mã website tại VNPAY 
            $vnp_HashSecret = "DTHXNFNBUMNKFKQOZVHTXUXNUQUUXMTV"; //Chuỗi bí mật
            $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://localhost:8000/vnpay_php/vnpay_return.php";

            $vnp_TxnRef = date("YmdHis");
            $vnp_OrderInfo = $data['shipping_note'];
            $vnp_OrderType = 'other';
            $vnp_Amount = str_replace(',', '', $data['total']) * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = $data['bank_code'];
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            $inputData = array(
                "vnp_Version" => "2.0.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
            );


            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . $key . "=" . $value;
                } else {
                    $hashdata .= $key . "=" . $value;
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
            // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
                $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
                $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array('code' => '00'
                , 'message' => 'success'
                , 'data' => $vnp_Url);
            echo $vnp_Url;
        }

    }
    public function print($checkout_code)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }
    public function print_order_convert($checkout_code)
    {
        $order = Order::where('code',$checkout_code)->first();
        $customer = Customer::where('id',$order->customer_id)->first();
        $shipping = Shipping::where('id',$order->shipping_id)->first();
        $all_product = 0;
        $fee_ship = 0;
        foreach($order->orderDetails as $orderItem){
            $coupon = Coupon::where('code',$orderItem->coupon)->first();
            $one_product = $orderItem->product_sales_quantity * $orderItem->product_price;
            $all_product += $one_product;
            $fee_ship = $orderItem->fee_ship;
        }
        return view('home.checkout.pdf',compact('customer','shipping','order','coupon','all_product','fee_ship'));
    }
    public function delete($id)
    {
        Order::find($id)->delete();
        return response()->json([
            'code' => 200,
            'message' => 'success'
        ],200);
        return response()->json([
            'code' => 500,
            'message' => 'fail'
        ],500);
    }
    public function update($id,Request $request)
    {
        $order = Order::find($id);
        foreach($order->orderDetails as $orderItem){
            $product = Product::where('id',$orderItem->product_id)->where('user_id',Auth::user()->id)->first();
            $product_sale_qty = $orderItem->product_sales_quantity;
            $product_qty = $product->product_qty;
            if($product_qty <= $product_sale_qty){
                $html = "Không thể cập nhật đơn hàng do số lượng sản phẩm trong kho không đủ.";
                toastr()->error('Không cập nhật được đơn hàng');
                return response()->json([
                    'code' => 200,
                    'message' => $html,
                    'url' => 0
                ],200);
                return response()->json([
                    'code' => 500,
                    'message' => 'fail'
                ],500);
            }else{
                $product_after_sale_qty = $product_qty - $product_sale_qty;
                $product->update([
                    'product_qty' => $product_after_sale_qty,
                ]);
                $order->update([
                    'status' => '0',
                ]);
            }
        }
        toastr()->success('Cập nhật đơn hàng thành công');
        return response()->json([
            'code' => 200,
            'message' => 'ok',
            'url' => 1
        ],200);
        return response()->json([
            'code' => 500,
            'message' => 'fail'
        ],500);
    }
}
