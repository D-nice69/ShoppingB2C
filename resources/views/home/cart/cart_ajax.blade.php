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
                    @foreach( $cart as $key=> $value)
                    <tr>
                        <td class="cart_product">
                            <a href="">
                                <img src="/uploads/products/{{ $value['product_image'] }}" height="100px" width="100px"
                                    alt="">
                            </a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{ $value['product_name'] }}</a></h4>
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
                </tbody>
            </table>
        </div>
    </div>
</section>
<!--/#cart_items-->
@if($cart)
<section id="do_action">
    <div class="container" id="coupon_check">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your
                delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Tổng tiền<span> {{ number_format($total) }} VNĐ</span></li>
                            @if(Session::get('coupon'))
                            @foreach(Session::get('coupon') as $key => $cou)
                            @if($cou['feature']==0)
                            <li> Mã giảm: <span>{{ $cou['discount_number'] }} %</span> </li>
                            @php
                            $total_coupon = ($total*$cou['discount_number'])/100;
                            echo '
                        <li>Tổng giảm: '.'<span>'.number_format($total_coupon).' VNĐ</span>'.'</li>';
                        @endphp
                        <li>Tổng tiền sau khi giảm
                            <span>
                                {{ number_format($total - $total_coupon) }} VNĐ
                            </span>
                        </li>
                        @else
                        <li> Mã giảm: <span>{{ number_format($cou['discount_number']) }} VNĐ</span> </li>
                        <li>Tổng tiền sau khi giảm
                            <span>
                                {{ number_format($total - $cou['discount_number']) }} VNĐ
                            </span>
                        </li>
                        @endif
                        @endforeach
                        @endif
                        {{-- <li>Thuế <span> VNĐ</span></li>
                        <li>Phí vận chuyển <span>Free</span></li>
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
                    <a class="btn btn-default check_out" href="">Thanh toán</a>
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