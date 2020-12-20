@extends('adminPartials.layout')
@section('title')
Shipping fee management
@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function(){

        $(document).on('blur','.feeship_edit',function(){
            var feeship_id = $(this).data('feeship_id');
            var feeship_value = $(this).text();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{ route('delivery.update') }}',
                method: 'POST',
                data:{feeship_id:feeship_id, feeship_value:feeship_value, _token:_token},
                success:function(data){
                    location.reload();
                }
            });
        });
        $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            if (action == 'city'){
                result = 'district';
            }else{
                result = 'town';
            }
            $.ajax({
                url: '{{ route('delivery.select') }}',
                method: 'POST',
                data:{action:action, ma_id:ma_id, _token:_token},
                success:function(data){
                    $('#'+result).html(data);
                }
            });
        });
    })
</script>
<script src="js/dataTables/shipping.js"></script>
@endsection
@section('content')
@include('admin.toast')
<div class="form-w3layouts">
    <section class="panel">
        <header class="panel-heading">
            Quản lý phí vận chuyển
        </header>
        <div class="panel-body">
            <div class="col-12">
                <form action="{{ route('delivery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Chọn tỉnh, thành phố</label>
                        <select class="form-control m-bot15 choose city select2_multiple" id="city" name="matp">
                            <option value="" hidden>---Chọn tỉnh, thành phố---</option>
                            @foreach($cities as $city)
                            <option value="{{ $city->matp }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Chọn quận huyện </label>
                        <select class="form-control m-bot15 choose district select2_multiple" id="district" name="maqh">
                            <option value="" hidden>---Chọn quận huyện---</option>
                            @foreach($districts as $district)
                            <option value="{{ $district->maqh }}">{{ $district->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Chọn xã phường</label>
                        <select class="form-control m-bot15 town select2_multiple" id="town" name="xaid">
                            <option value="" hidden>---Chọn xã phường---</option>
                            @foreach($towns as $town)
                            <option value="{{ $town->xaid }}">{{ $town->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Phí vận chuyển</label>
                        <input class="form-control fee_ship @error('fee_feeship') is-invalid @enderror"
                            name="fee_feeship" placeholder="Enter name">
                        @error('fee_feeship')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @can('add_shipping')
                    <button type="submit" class="btn btn-info add_delivery">Thêm phí vận chuyển</button>
                    @endcan
                </form>
            </div>   
            <br/>         
            <div class="table-responsive">
                <table id="myTable" class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>Tên thành phố</th>
                            <th>Tên quận huyện</th>
                            <th>Tên xã phường</th>
                            <th>Phí vận chuyển</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fee_ships as $fee_ship)
                        <tr>
                            <td>
                                {{ $fee_ship->city->name }}
                            </td>
                            <td>
                                {{ $fee_ship->district->name }}
                            </td>
                            <td>
                                {{ $fee_ship->town->name }}
                            </td>
                            <td data-feeship_id="{{ $fee_ship->id }}" class="feeship_edit" @can('edit_shipping')
                                contenteditable @endcan>
                                {{ number_format($fee_ship->fee_feeship) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div id="load_delivery">
            </div>
            {{-- <footer class="panel-footer">
                <div class="row">
                    <div class="col-sm-5 text-center">
                            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                        </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        {{$fee_ships->links()}}
                    </div>
                </div>
            </footer> --}}
        </div>
    </section>
</div>
@endsection