@extends('layouts.home')
@section('title')
Eshop | Cart
@endsection
@section('css')
<style>
    .cart_quantity_input {
        float: none;
    }

    .cart_delete a {
        background: #b9b9a4;
    }
</style>
@endsection
@section('js')
<script>
</script>
@endsection
@section('content_2')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Trang chủ</a></li>
                <li class="active">Giỏ hàng</li>
            </ol>
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

                    @foreach( $cart as $key=> $value)
                    <tr>
                        <td class="cart_product">
                            <a href="{{ route('home.productDetails',['slug'=>$value['product_slug'],'id'=>$value['product_id']]) }}">
                                <img src="/uploads/products/{{ $value['seller_id'] }}/{{ $value['product_image'] }}" height="auto" width="100px"
                                    alt="">
                            </a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="{{ route('home.productDetails',['slug'=>$value['product_slug'],'id'=>$value['product_id']]) }}">{{ $value['product_name'] }}</a></h4>
                            <p>ID sản phẩm: {{ $value['product_id'] }} </p>
                        </td>
                        <td class="cart_price">
                            <p> {{ number_format($value['product_price']) }} VNĐ</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form action="{{ route('cart.updateAjax',['id'=>$value['session_id']]) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input class="cart_quantity" min="0" style="width: 45px" type="number"
                                        name="cart_qty[{{ $value['session_id'] }}]" value="{{ $value['product_qty'] }}"
                                        size="2">
                                    <button type="submit" name="update_qty" class="btn btn-default btn-sm"><i
                                            class="fa fa-refresh"></i></button>
                                </form>

                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                {{ number_format($value['product_price'] * $value['product_qty']) }} VNĐ</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete"
                                href="{{ route('cart.deleteAjax',['id'=>$value['session_id']]) }}"><i
                                    class="fa fa-times"></i></a>
                        </td>
                    </tr>

                    @endforeach
                    @endif

                </tbody>
            </table>
        </div>
    </div>
</section>
<!--/#cart_items-->
@if($cart)
<section id="do_action">
    <div class="container" id="coupon_check">
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area" style="padding-left: 30px">
                    <h4>Nơi vận chuyển </h4>
                    <form>
                        @csrf
                        <div class="form-group">
                            <label for="">Chọn tỉnh, thành phố</label>
                            <select class="form-control m-bot15 choose city" id="city" name="matp">
                                <option selected value="" hidden>---Chọn tỉnh, thành phố---</option>
                                @foreach($cities as $city)
                                <option value="{{ $city->matp }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Chọn quận huyện </label>
                            <select class="form-control m-bot15 choose district" id="district" name="maqh">
                                <option selected value="" hidden>---Chọn quận huyện---</option>
                                @foreach($districts as $district)
                                <option value="{{ $district->maqh }}">{{ $district->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Chọn xã phường</label>
                            <select class="form-control m-bot15 town" id="town" name="xaid">
                                <option selected value="" hidden>---Chọn xã phường---</option>
                                @foreach($towns as $town)
                                <option value="{{ $town->xaid }}">{{ $town->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <a type="button" class="btn btn-default check_out delivery_cal">Tính phí vận chuyển</a>
                        {{-- <input type="button" class="btn btn-primary check_out delivery_cal" value="Tính phí vận chuyển"> --}}
                    </form>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Tổng tiền:<span> {{ number_format($total) }} VNĐ</span></li>
                        @if(Session::get('fee'))
                        <li>
                            <a href="{{ route('customer.deliveryDel') }}">
                                <i class="fa fa-times">
                                </i>
                            </a>
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

                    <form style="margin-left: 38px" action="{{ route('coupon.checkCoupon') }}" method="POST">
                        @csrf
                        <input style="width: 50%; margin-bottom: 10px;" type="text" class="form-control"
                            placeholder="Nhập mã giảm giá" name="coupon">
                        <input type="submit" class="btn btn-default check_coupon" name="check_coupon"
                            value="Tính mã giảm giá">
                        @if(Session::get('coupon'))
                        <a href="{{ route('coupon.unset') }}" class="btn btn-default">Xóa mã giảm giá</a>
                        @endif
                    </form>
                    <?php
                    $message = Session::get('message');
                    if ($message) {
                        echo '<span style="color: green; padding: 10px">' . $message . '</span>';
                        Session::put('message', null);
                    }
                    $error = Session::get('error');
                    if ($error) {
                    echo '<span style="color: red; padding: 10px">' . $error . '</span>';
                    Session::put('message', null);
                    }
                    ?>
                    <?php
                    $customerId = Session::get('customerId');
                    if($customerId!=Null){                                
                    ?>
                    <a class="btn btn-default check_out" href="{{ route('customer.checkout') }}">Check Out</a>
                    <?php 
                    }else {                                    
                    ?>
                    <a class="btn btn-default check_out" href="{{ route('customer.login') }}">Check Out</a>
                    <?php 
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
@else
<section id="do_action">
    <div class="container">
        <div class="heading">
            <h4>Vui lòng thêm sản phẩm vào giỏ hàng</h4>
        </div>
    </div>
</section>
@endif
<!--/#do_action-->
@endsection