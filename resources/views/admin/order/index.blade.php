@extends('adminPartials.layout')
@section('title')
Orders List
@endsection
@section('js')
<script src="{{ asset('admins/delete/delete.js') }}"></script>
<script src="js/dataTables/order.js"></script>
@endsection
@section('content')
@include('admin.toast')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê đơn hàng
        </div>
       
        {{-- <div class="row w3-res-tb">
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
        </div> --}}
        <br />
        <div class="table-responsive">
            <table id="myTable" class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Mã đơn hàng</th>
                        <th>Tình trạng</th>
                        <th style="width:50px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderDetails as $order)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label>
                        <td>{{ $order->order->code }}</td>
                        <td>
                            @if( $order->order->status == 1)
                            Đơn hàng mới
                            @else
                            Đơn hàng đã được thanh toán
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('order.view',['id'=>$order->order->id]) }}">
                                <i class="fa fa-eye"></i>
                            </a>
                            @can('delete_order')
                            <a href="" class="action_delete" data-url="{{ route('order.delete',['id'=>$order->order->id]) }}">
                                <i class="fa fa-times text-danger text"></i>
                            </a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach

                    {{-- @if(count($orderDetails)>0)
                    @foreach($orderDetails as $od)
                    @php
                    $od_id[] = $od->order_id;
                    @endphp
                    @endforeach
                    @php
                    $unique_data = array_unique($od_id);
                    @endphp
                    @foreach($unique_data as $unique)

                    @foreach ($orders as $order)
                    @if($order->id == $unique)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label>
                        </td>
                        <td>{{ $order->code }}</td>
                    <td>
                        @if( $order->status == 1)
                        Đơn hàng mới
                        @else
                        Đơn hàng đã được thanh toán
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('order.view',['id'=>$order->id]) }}">
                            <i class="fa fa-eye"></i>
                        </a>
                        @can('delete_order')
                        <a href="" class="action_delete" data-url="{{ route('order.delete',['id'=>$order->id]) }}">
                            <i class="fa fa-times text-danger text"></i>
                        </a>
                        @endcan
                    </td>
                    </tr>
                    @endif
                    @endforeach
                    @endforeach
                    @endif --}}

                </tbody>
            </table>
        </div>
        <footer class="panel-footer">
            <div class="row">
                {{-- <div class="col-sm-5 text-center">
                        <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div> --}}
                {{-- <div class="col-sm-7 text-right text-center-xs">
                    {{$orders->links()}}
            </div> --}}
    </div>
    </footer>
</div>
</div>
@endsection