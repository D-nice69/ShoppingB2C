@extends('adminPartials.layout')
@section('title')
Coupons List
@endsection
@section('js')
<script src="{{ asset('admins/delete/delete.js') }}"></script>
@endsection
@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Danh sách mã giảm giá
        </div>
        <?php
            $message = Session::get('message');
            if ($message) {
            echo '<span style="color: red; padding: 10px">' . $message . '</span>';
            Session::put('message', null);
            }
            ?>
        <div class="row w3-res-tb">
            <div class="col-sm-5 m-b-xs">
                <select class="inpu\t-sm form-control w-sm inline v-middle">
                    <option value="0">Bulk action</option>
                    <option value="1">Delete selected</option>
                    <option value="2">Bulk edit</option>
                    <option value="3">Export</option>
                </select>
                <button class="btn btn-sm btn-default">Apply</button>
            </div>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Tên</th>
                        <th>Mã giảm giá</th>
                        <th>Số lượng mã</th>
                        <th>Điều kiện</th>
                        <th>Số giảm</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coupons as $coupon)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label>
                        </td>
                        <td>{{ $coupon->name }}</td>
                        <td>{{ $coupon->code }}</td>
                        <td>{{ $coupon->qty }}</td>
                        <td>
                            @if($coupon->feature == 0)
                            Giảm theo phần trăm
                            @else
                            Giảm theo tiền
                            @endif
                        </td>
                        <td>
                            @if($coupon->feature == 0)
                            {{ $coupon->discount_number }}%
                            @else
                            {{ number_format($coupon->discount_number) }} VNĐ
                            @endif

                        </td>
                        <td>
                            {{-- <a href="{{ route('coupon.edit',['id'=>$coupon->id]) }}">
                            <i class="fa fa-pencil-square-o text-success text-active"></i>
                            </a> --}}
                            @can('delete_coupon')
                            <a href="" class="action_delete"
                                data-url="{{ route('coupon.delete',['id'=>$coupon->id]) }}">
                                <i class="fa fa-times text-danger text"></i>
                            </a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <footer class="panel-footer">
            <div class="row">
                {{-- <div class="col-sm-5 text-center">
                        <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div> --}}
                <div class="col-sm-7 text-right text-center-xs">
                    {{$coupons->links()}}
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection