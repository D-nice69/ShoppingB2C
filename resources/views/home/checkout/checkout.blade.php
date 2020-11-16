@extends('layouts.home')
@section('title')
Eshop | Thanh toán
@endsection
@section('js')
<script>
    $("input:checkbox").on('click', function() {
  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
  if ($box.is(":checked")) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[name='" + $box.attr("name") + "']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});
</script>
@endsection
@section('content_2')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Trang chủ</a></li>
                <li class="active">Thanh toán</li>
            </ol>
        </div>
        <!--/breadcrums-->
        <div class="register-req">
            <p>Làm ơn đăng ký hoặc đăng nhập để thanh toán giỏ hàng và xem lịch sử mua hàng</p>
        </div>
        <!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                {{-- <div class="col-sm-3 clearfix">
                    <div class="shopper-info">
                        <p>Shopper Information</p>
                        <form>
                            <input type="text" name="name" placeholder="Name">
                            <input type="text" name="email" placeholder="Email">
                            <input type="text" name="address" placeholder="Address">
                            <input type="text" name="phone" placeholder="Phone">
                        </form>
                        <a class="btn btn-primary" href="">Get Quotes</a>
                        <a class="btn btn-primary" href="">Continue</a>
                    </div>
                </div> --}}
                <div class="col-sm-6">
                    <div class="bill-to">
                        <p>Điền thông tin gửi hàng</p>
                        <div class="form-one" style="width: 90%">
                            <form method="POST">
                                @csrf
                                <input type="text" class="shipping_name" name="name" placeholder="Họ tên người gửi">
                                <input type="text" class="shipping_email" name="email" placeholder="Email">
                                <input type="text" class="shipping_address" name="address"
                                    placeholder="Địa chỉ gửi hàng">
                                <input type="text" class="shipping_phone" name="phone" placeholder="Số điện thoại">
                                @if(Session::get('fee'))
                                <input type="hidden" class="order_fee" name="order_fee"
                                    value="{{ Session::get('fee') }}">
                                @else
                                <input type="hidden" class="order_fee" name="order_fee" value="25000">
                                @endif

                                @if(Session::get('coupon'))
                                @foreach(Session::get('coupon') as $key => $cou)
                                <input type="hidden" class="order_coupon" name="order_coupon"
                                    value="{{ $cou['code'] }}">
                                @endforeach
                                @else
                                <input type="hidden" class="order_coupon" name="order_coupon" value="">
                                @endif
                                
                            </form>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="order-message">
                        <p>Ghi chú</p>
                        <textarea style="height: 200px; font-size:15px" class="shipping_note" name="note"
                            placeholder="Ghi chú đơn hàng của bạn"></textarea>
                    </div>
                </div>
                {{-- <div class="col-sm-10 clearfix">
                    <div class="order-message">
                        <p>Nơi vận chuyển </p>
                        @csrf
                        <div class="form-group">
                            <label for="">Chọn tỉnh, thành phố</label>
                            <select class="form-control m-bot15 choose city" id="city" name="matp">
                                <option value="" hidden>---Chọn tỉnh, thành phố---</option>
                                @foreach($cities as $city)
                                <option value="{{ $city->matp }}">{{ $city->name }}</option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Chọn quận huyện </label>
                <select class="form-control m-bot15 choose district" id="district" name="maqh">
                    <option value="" hidden>---Chọn quận huyện---</option>
                    @foreach($districts as $district)
                    <option value="{{ $district->maqh }}">{{ $district->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Chọn xã phường</label>
                <select class="form-control m-bot15 town" id="town" name="xaid">
                    <option value="" hidden>---Chọn xã phường---</option>
                    @foreach($towns as $town)
                    <option value="{{ $town->xaid }}">{{ $town->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-info add_delivery">Tính phí vận chuyển</button>
        </div>
    </div> --}}
    {{-- <div class="col-sm-12">
        <input type="submit" name="send_order" value="Xác nhận đơn hàng" class="btn btn-default check_out">
    </div> --}}
    <div class="review-payment">
        <h2>Xem lại giỏ hàng & phương thức thanh toán</h2>
    </div>

    <div class="table-responsive cart_info">
        <table class="table table-condensed">
            <thead>
                <tr class="cart_menu">
                    <td class="image">Sản phẩm</td>
                    <td class="description">Tên sản phẩm</td>
                    <td class="price">Giá</td>
                    <td class="quantity">Số lượng</td>
                    <td class="total">Thành tiền</td>
                    <td></td>
                </tr>

            </thead>

            <tbody>
                @if($cart)
                @foreach($cart as $val)
                <input type="hidden" value="{{ $val['seller_id'] }}" class="seller_id" name="seller_id">
                <tr>
                    <td class="cart_product">
                        <a href="{{ route('home.productDetails',['slug'=>$val['product_slug']]) }}">
                            <img src="/uploads/products/{{ $val['product_image']}}" height="100px" width="100px" alt="">
                        </a>
                    </td>
                    <td class="cart_description">
                        <h4><a href="">{{ $val['product_name'] }}</a></h4>
                        <p>ID sản phẩm: {{ $val['product_id'] }}</p>
                    </td>
                    <td class="cart_price">
                        <p>{{ number_format($val['product_price']) }} VNĐ</p>
                    </td>
                    <td class="cart_quantity">
                        <div class="cart_quantity_button">
                            <input class="cart_quantity_input" disabled type="text" name="quantity"
                                value="{{ $val['product_qty'] }}" size="2">
                        </div>
                    </td>
                    <td class="cart_total">
                        <p class="cart_total_price">{{ number_format($val['product_price'] * $val['product_qty']) }}
                            VNĐ</p>
                    </td>
                </tr>

                @endforeach
                @endif

            </tbody>
        </table>
        <div class="col-sm-6" style="float: right">
            <div class="total_area">
                <ul>
                    <li>Tổng tiền:<span> {{ number_format($total) }} VNĐ</span></li>
                    @if(Session::get('fee'))
                    <li>
                        Phí vận chuyển: <span>{{ number_format(Session::get('fee')) }} VNĐ</span></li>
                    @endif
                    @if(Session::get('coupon'))
                    @foreach(Session::get('coupon') as $key => $cou)
                    @if($cou['feature']==0)
                    <li> Mã giảm: <span>{{ $cou['discount_number'] }} %</span> </li>
                    @php
                    $total_coupon = ($total*$cou['discount_number'])/100;
                    @endphp
                    <li>Thành tiền:
                        <span>
                            @if(Session::get('fee'))
                            {{ number_format($total - $total_coupon + Session::get('fee')) }} VNĐ
                            @else
                            {{ number_format($total - $total_coupon) }} VNĐ
                            @endif
                        </span>
                    </li>
                    @else
                    <li> Mã giảm giá sản phẩm: <span>{{ number_format($cou['discount_number']) }} VNĐ</span> </li>
                    <li>Thành tiền:
                        <span>
                            @if(Session::get('fee'))
                            {{ number_format($total - $cou['discount_number'] + Session::get('fee')) }} VNĐ
                            @else
                            {{ number_format($total - $cou['discount_number']) }} VNĐ
                            @endif
                        </span>
                    </li>
                    @endif
                    @endforeach
                    @endif

                    {{-- <li>Thuế <span> VNĐ</span></li>
                    <li>Tổng số tiền (bao gồm coupon) <span> VNĐ</span></li> --}}
                </ul>
                {{-- <a class="btn btn-default update" href="">Update</a> --}}
            </div>
        </div>
    </div>

    <h4>Chọn hình thức thanh toán:</h4>
    <br />
    <form method="POST">
        @csrf
        <div class="payment-options">
            {{-- <select class="payment_select" id="city" name="matp">
                <option selected value="3" >---Chọn tỉnh, thành phố---</option>               
            </select> --}}
            <span >
                <label><input name="payment_method" class="radio payment_select" value="0" type="checkbox"> Trả bằng thẻ
                    ATM</label>
            </span>
            <span >
                <label ><input name="payment_method" class="radio payment_select" value="1" type="checkbox"> Nhận tiền
                    mặt</label>
            </span>
            {{-- <span>
                <label><input type="checkbox"> Paypal</label>
            </span> --}}
            <br />
            <a type="button" class="btn btn-default check_out send_order" name="send_order_place">Đặt hàng</a>
        </div>
    </form>
</section>
<!--/#cart_items-->

@endsection