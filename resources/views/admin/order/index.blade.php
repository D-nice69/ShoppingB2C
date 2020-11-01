@extends('adminPartials.layout')
@section('title')
    Orders List
@endsection
@section('js')
    <script src="{{ asset('admins/delete/delete.js') }}"></script>
@endsection
@section('content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê đơn hàng
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
                            <th>Mã đơn hàng</th>
                            <th>Tình trạng</th>
                            <th></th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
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
                                    <a href="" class="action_delete" data-url="{{ route('order.delete',['id'=>$order->id]) }}">
                                        <i  class="fa fa-times text-danger text"></i>
                                    </a>                                                                     
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
                       {{$orders->links()}}
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
