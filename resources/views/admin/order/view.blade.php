@extends('adminPartials.layout')
@section('title')
Order details
@endsection
@section('css')
<style>
    .check_out p {
        padding: 5px;
        padding-left: 15px;
    }
</style>
@endsection
@section('js')
<script src="{{ asset('admins/delete/delete.js') }}"></script>
<script src="{{ asset('admins/update/update_order.js') }}"></script>
<script src="js/dataTables/orderDetails.js"></script>
{{-- <script type="text/javascript">
    $(document).ready(function(){
    $('#update_order').click(function(){
        alert('ok');
        // Swal.fire('Any fool can use a computer')
        // Swal.fire({
        //     title: 'Are you sure?',
        //     text: "You won't be able to revert this!",
        //     icon: 'warning',
        //     showCancelButton: true,
        //     confirmButtonColor: '#3085d6',
        //     cancelButtonColor: '#d33',
        //     confirmButtonText: 'Yes, delete it!'
        // }).then((result) => {
        //     if (result.isConfirmed) {
        //         Swal.fire(
        //             'Deleted!',
        //             'Your file has been deleted.',
        //             'success'
        //         )
        //     }
        // });
        // $.ajax({
        //     url: '{{route('cart.addCartAjax')}}',
        //     method: 'POST',
        //     data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token},
        //     success:function(data){
                // swal({
                //         title: "Đã thêm sản phẩm vào giỏ hàng",
                //         text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                //         showCancelButton: true,
                //         cancelButtonText: "Xem tiếp",
                //         confirmButtonClass: "btn-success",
                //         confirmButtonText: "Đi đến giỏ hàng",
                //         closeOnConfirm: false
                //     },
                    // function() {
                    //     window.location.href = "{{route('cart.show')}}";
                    // });
        //     }
        // });
    });
});
</script> --}}
@endsection
@section('content')
@include('admin.toast')
<div class="form-w3layouts">
    <section class="panel">
        <header class="panel-heading">
            Thông tin khách hàng
        </header>
        <div class="panel-body">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $order->customer->name }}</td>
                        <td>{{ $order->customer->phone }}</td>
                        <td>{{ $order->customer->email }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    <section class="panel">
        <header class="panel-heading">
            Thông tin vận chuyển
        </header>
        <div class="panel-body">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên người vận chuyển</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Hình thức thanh toán</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $order->shipping->name }}</td>
                        <td>{{ $order->shipping->phone }}</td>
                        <td>{{ $order->shipping->email }}</td>
                        <td>
                            @if($order->shipping->method == 1)
                            Tiền mặt
                            @else
                            Chuyển khoản
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Địa chỉ</th>
                        <th>Ghi chú</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $order->shipping->address }}</td>
                        <td>{{ $order->shipping->note }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    <form>
        @csrf
        <section class="panel">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liệt kê chi tiết đơn hàng
                </div>
                <br/>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Mã giảm giá</th>
                                <th>Số lượng</th>
                                <th>Giá sản phẩm</th>
                                <th>Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderDetails as $orderItem)
                            @if($orderItem->seller_id == Auth::user()->id)
                            <tr>
                                <td>{{ $orderItem->product_name }}</td>
                                <td>
                                    @if($coupon)
                                    {{ $orderItem->coupon }}
                                    @else
                                    Không dùng mã giảm giá
                                    @endif
                                </td>
                                <input type="hidden" name="product_sale_qty"
                                    value="{{ $orderItem->product_sales_quantity }}">
                                <td>{{ $orderItem->product_sales_quantity }}</td>
                                <td>{{ number_format($orderItem->product_price) }} VNĐ</td>
                                <td>{{ number_format($orderItem->product_sales_quantity * $orderItem->product_price) }}
                                    VNĐ
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="check_out" style="font-size: 0.9em;
            color: #999;">
                    @if($coupon)
                    @if($coupon->feature == 0)
                    <p>Số tiền giảm: {{ number_format($all_product*$coupon->discount_number/100) }} VNĐ</p>
                    <p>Phí vận chuyển: {{ number_format($fee_ship) }} VNĐ</p>
                    <p>Thành tiền:
                        {{ number_format(($all_product - $all_product*$coupon->discount_number/100)+$fee_ship)}}
                        VNĐ</p>
                    @else
                    <p>Số tiền giảm: {{ number_format($coupon->discount_number) }} VNĐ</p>
                    <p>Phí vận chuyển: {{ number_format($fee_ship) }} VNĐ</p>
                    <p>Thành tiền: {{ number_format($all_product +$fee_ship)}} VNĐ</p>
                    @endif
                    @else
                    <p>Phí vận chuyển: {{ number_format($fee_ship) }} VNĐ</p>
                    <p>Thành tiền: {{ number_format($all_product + $fee_ship)}} VNĐ</p>
                    @endif
                </div>
                @if($order->status == 1)
                @can('update_order')
                <a style="margin: 5px" class="btn btn-default" id="update_order" data-url="{{ route('order.update',['id'=>$order->id]) }}"
                    href="">Thanh toán hóa đơn và cập
                    nhật số lượng sản phẩm
                </a>                
                @endcan
                @endif
                @can('print_order')
                <a style="margin: 5px" class="btn btn-default"
                    href="{{ route('order.print',['checkout_code'=>$order->code]) }}">In đơn hàng
                </a>    
                @endcan                
            </div>
        </section>
    </form>
</div>
@endsection