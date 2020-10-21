@extends('layouts.home')
@section('title')
Eshop | Thanh toán
@endsection
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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
                <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div>
        <!--/breadcrums-->

        <div class="review-payment">
            <h2>Cảm ơn bạn đã đặt hàng tại E-shop!</h2>
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
                                <input class="cart_quantity_input" type="text" name="quantity"
                                    value="{{ $conValue->qty }}" size="2">
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

    </div>
</section>
<!--/#cart_items-->

@endsection