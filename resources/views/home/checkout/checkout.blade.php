@extends('layouts.home')
@section('title')
Eshop | Thanh toán
@endsection
@section('css')
  
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
                <div class="col-sm-5 clearfix">
                    <div class="bill-to">
                        <p>Thông tin người mua hàng</p>
                        <div class="form-one">
                            <form method="POST" action="{{ route('customer.saveCheckout') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="text" name="name" placeholder="Tên">
                                <input type="text" name="email" placeholder="Email">
                                <input type="text" name="address" placeholder="Địa chỉ">
                                <input type="text" name="phone" placeholder="Số điện thoại">
                                <input type="submit" name="send_order" value="Gửi"
                                    class="btn btn-primary btn-small">

                        </div>
                        {{-- <div class="form-two">
                            <form>
                                <input type="text" placeholder="Zip / Postal Code *">
                                <select>
                                    <option>-- Country --</option>
                                    <option>United States</option>
                                    <option>Bangladesh</option>
                                    <option>UK</option>
                                    <option>India</option>
                                    <option>Pakistan</option>
                                    <option>Ucrane</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>
                                <select>
                                    <option>-- State / Province / Region --</option>
                                    <option>United States</option>
                                    <option>Bangladesh</option>
                                    <option>UK</option>
                                    <option>India</option>
                                    <option>Pakistan</option>
                                    <option>Ucrane</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>
                                <input type="password" placeholder="Confirm password">
                                <input type="text" placeholder="Phone *">
                                <input type="text" placeholder="Mobile Phone">
                                <input type="text" placeholder="Fax">
                            </form>
                        </div> --}}
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="order-message">
                        <p>Ghi chú</p>
                        <textarea name="note" placeholder="Ghi chú đơn hàng của bạn"
                            rows="16"></textarea>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="review-payment">
            <h2>Review & Payment</h2>
        </div>

        {{-- <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="images/cart/one.png" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">Colorblock Scuba</a></h4>
                            <p>Web ID: 1089772</p>
                        </td>
                        <td class="cart_price">
                            <p>$59</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href=""> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
                                <a class="cart_quantity_down" href=""> - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">$59</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <tr>
                                    <td>Cart Sub Total</td>
                                    <td>$59</td>
                                </tr>
                                <tr>
                                    <td>Exo Tax</td>
                                    <td>$2</td>
                                </tr>
                                <tr class="shipping-cost">
                                    <td>Shipping Cost</td>
                                    <td>Free</td>										
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td><span>$61</span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div> --}}
        <div class="payment-options">
            <span>
                <label><input type="checkbox"> Direct Bank Transfer</label>
            </span>
            <span>
                <label><input type="checkbox"> Check Payment</label>
            </span>
            <span>
                <label><input type="checkbox"> Paypal</label>
            </span>
        </div>
    </div>
</section>
<!--/#cart_items-->

@endsection