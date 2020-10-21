@extends('adminPartials.layout')
@section('title')
Order details
@endsection
@section('content')
<div class="form-w3layouts">
    <section class="panel">
        <header class="panel-heading">
            Thông tin khách hàng
        </header>
        <div class="panel-body">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên người mua</th>
                        <th>Số điện thoại</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $order->customer->name }}</td>
                        <td>{{ $order->customer->phone }}</td>
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
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Ghi chú</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $order->shipping->name }}</td>
                        <td>{{ $order->shipping->address }}</td>
                        <td>{{ $order->shipping->phone }}</td>
                        <td>{{ $order->shipping->note }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="panel">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê chi tiết đơn hàng
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderDetails as $orderItem)
                        <tr>
                            <td>{{ $orderItem->product_name }}</td>
                            <td>{{ $orderItem->product_sales_quantity }}</td>
                            <td>{{ number_format($orderItem->product_price) }} VNĐ</td>
                            <td>{{ number_format($orderItem->product_sales_quantity * $orderItem->product_price) }} VNĐ</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <div style="float: right">
        Tổng tiền: {{ $order->total }} VNĐ
    </div>



</div>
@endsection