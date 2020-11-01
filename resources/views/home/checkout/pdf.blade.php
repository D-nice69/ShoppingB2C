<style>
    body {
        margin-top: 20px;
        background: #eee;
        font-family: DejaVu Sans;
    }

    table {
        width: 100%;
    }

    .invoice {
        padding: 30px;
    }

    .invoice h2 {
        margin-top: 0px;
        line-height: 0.8em;
    }

    .invoice .small {
        font-weight: 300;
    }

    .invoice hr {
        margin-top: 10px;
        border-color: #ddd;
    }

    .invoice .table tr.line {
        border-bottom: 1px solid #ccc;
    }

    .invoice .table td {
        border: none;
    }

    .invoice .identity {
        margin-top: 10px;
        font-size: 1.1em;
        font-weight: 300;
    }

    .invoice .identity strong {
        font-weight: 600;
    }


    .grid {
        position: relative;
        width: 100%;
        background: #fff;
        color: #666666;
        border-radius: 2px;
        margin-bottom: 25px;
        box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="container">
    <div class="row">
        <!-- BEGIN INVOICE -->
        <div class="col-xs-12">
            <div class="grid invoice">
                <div class="grid-body">
                    <div class="invoice-title">
                        <div class="row">
                            <div class="col-xs-12">
                                <img src="Eshopper/images/home/logo.png" alt="" height="35">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12">
                                <h2>Hóa đơn<br>
                                    <span class="small">#{{ $order->id }}</span></h2>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-6">
                            <address>
                                <strong>Người gửi:</strong><br>
                                {{ $customer->name }}<br>
                                {{ $customer->email }}<br>
                                <abbr title="Phone">SĐT:</abbr> {{ $customer->phone }}
                            </address>
                        </div>
                        <div class="col-xs-6 text-right">
                            <address>
                                <strong>Người nhận:</strong><br>
                                {{ $shipping->name }}<br>
                                {{ $shipping->email }}<br>
                                {{ $shipping->address }}<br>
                                <abbr title="Phone">SĐT:</abbr> {{ $shipping->phone }}
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <address>
                                <strong>Hình thức thanh toán:</strong><br>
                                @if($shipping->method == 0)
                                Chuyển khoản
                                @else
                                Tiền mặt
                                @endif
                            </address>
                        </div>
                        <div class="col-xs-6 text-right">
                            <address>
                                <strong>Ngày đặt hóa đơn:</strong><br>
                                {{ $order->created_at->format('d/m/Y') }}
                            </address>
                        </div>
                        <div class="col-xs-6 text-right">
                            <address>
                                <strong>Ghi chú:</strong><br>
                                {{ $shipping->note }}<br>
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Đơn hàng</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr class="line">
                                        <td><strong>#</strong></td>
                                        <td class="text-center"><strong>Tên sản phẩm </strong></td>
                                        <td class="text-right"><strong>Số lượng </strong></td>
                                        <td class="text-right"><strong>Giá sản phẩm </strong></td>
                                        <td class="text-right"><strong>Tổng tiền </strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->orderDetails as $key => $orderItem)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><strong>{{ $orderItem->product_name }}</strong></td>
                                        <td class="text-center">
                                            {{ $orderItem->product_sales_quantity }}</td>
                                        <td class="text-center">
                                            {{ number_format($orderItem->product_price) }} VNĐ</td>
                                        <td class="text-right">
                                            {{ number_format($orderItem->product_sales_quantity * $orderItem->product_price) }}
                                            VNĐ</td>
                                    </tr>
                                    @endforeach


                                    <tr>
                                        <td colspan="3"></td>
                                        <td style="padding-top: 30px" class="text-right"><strong>Mã giảm giá</strong>
                                        </td>
                                        <td style="padding-top: 30px" class="text-right">
                                            <strong>
                                                @if($coupon)
                                                {{ $coupon->code }}
                                                @else
                                                Không có
                                                @endif
                                            </strong>
                                        </td>
                                    </tr>
                                    @if($coupon)
                                    <tr>
                                        <td colspan="3">
                                        </td>
                                        <td class="text-right">
                                            <strong>Tổng giảm</strong>
                                        </td>
                                        <td class="text-right">
                                            <strong>
                                                @if($coupon->feature == 0)
                                                @php
                                                $phan_tram = 0;
                                                $phan_tram = $all_product * $coupon->discount_number/100;
                                                $tien_mat = $coupon->discount_number;
                                                @endphp
                                                {{ number_format($phan_tram) }} VNĐ
                                                @else
                                                {{ number_format($tien_mat) }} VNĐ
                                                @endif
                                            </strong>
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td colspan="3">
                                        </td>
                                        <td class="text-right"><strong>Phí vận chuyển</strong></td>
                                        <td class="text-right"><strong>{{ number_format($fee_ship) }} VNĐ</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                        </td>
                                        <td class="text-right"><strong>Thuế</strong></td>
                                        <td class="text-right"><strong>N/A</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                        </td>
                                        <td class="text-right"><strong>Thành tiền</strong></td>
                                        <td class="text-right">
                                            <strong>
                                                @if($coupon)
                                                @if($coupon->feature == 0)
                                                {{ number_format($all_product - $phan_tram + $fee_ship) }} VNĐ
                                                @else
                                                {{ number_format($all_product - $tien_mat + $fee_ship) }} VNĐ
                                                @endif
                                                @else
                                                {{ number_format($all_product + $fee_ship) }} VNĐ
                                                @endif
                                            </strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div style="padding-top: 30px">
                                <span style="float: right"> ….Ngày ……tháng……năm 20….</span>
                                <table style="padding-top: 30px" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <td style="text-align: center">Người mua hàng <br>
                                                (Ký, ghi rõ họ, tên)</td>
                                            <td style="text-align: center">Người bán hàng <br>
                                                (Ký, đóng dấu, ghi rõ họ, tên)</td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END INVOICE -->
    </div>
</div>