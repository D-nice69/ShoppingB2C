@extends('layouts.home')
@section('title')
Eshop | Cart
@endsection
@section('css')
<style>
    .cart_quantity_input {
        float: none;
    }
</style>
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
                        <td class="description"></td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Số tiền</td>
                        <td></td>
                    </tr>

                </thead>
                <tbody>
                    @foreach($content as $conValue)
                    <tr>
                        <td class="cart_product">
                            <a href="">
                                <img src="/uploads/products/{{ $conValue->options->image }}" height="100px"
                                    width="100px" alt="">
                            </a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{ $conValue->name }}</a></h4>
                            <p>ID sản phẩm: {{ $conValue->id }}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{ number_format($conValue->price) }} VNĐ</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form action="{{ route('cart.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input class="cart_quantity_input" type="text" name="quantity"
                                        value="{{ $conValue->qty }}" size="2">
                                    <input type="hidden" name="rowId_cart" value="{{ $conValue->rowId }}">
                                    <button type="submit" name="update_qty" class="btn btn-default btn-sm"><i
                                            class="fa fa-refresh"></i></button>
                                </form>

                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{ number_format($conValue->price * $conValue->qty) }} VNĐ</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete"
                                href="{{ route('cart.delete',['id'=>$conValue->rowId]) }}"><i
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

<section id="do_action">
    <div class="container">
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
                        <li>Số tiền <span>{{ Cart::subtotal() }} VNĐ</span></li>
                        <li>Thuế <span>{{ Cart::tax() }} VNĐ</span></li>
                        <li>Phí vận chuyển <span>Free</span></li>
                        <li>Tổng số tiền <span>{{ Cart::total() }} VNĐ</span></li>
                    </ul>
                    {{-- <a class="btn btn-default update" href="">Update</a> --}}
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
<!--/#do_action-->
@endsection