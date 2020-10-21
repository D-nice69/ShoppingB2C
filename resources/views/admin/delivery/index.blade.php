@extends('adminPartials.layout')
@section('title')
Shipping management
@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        // $('.add_delivery').click(function(){
        //     var city = $('.city').val();
        //     var distric = $('.distric').val();
        //     var town = $('.town').val();
        //     var fee_ship = $('.fee_ship').val();
        //     var _token = $('input[name="_token"]').val();
        //     $.ajax({
        //         url: '{{ route('delivery.store') }}',
        //         method: 'POST',
        //         data:{city:city, distric:distric, town:town, fee_ship:fee_ship, _token:_token},
        //         success:function(data){
        //             alert('pro');
        //         }
        //     });
        // });
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
@endsection

@section('content')
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
                        <select class="form-control m-bot15 choose city" id="city" name="matp">
                            <option value="" hidden>---Chọn tỉnh, thành phố---</option>
                            @foreach($cities as $city)
                            <option value="{{ $city->matp }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Chọn quận huyện </label>
                        <select class="form-control m-bot15 choose district" id="district" name="maqh">
                            <option value="" hidden>---Chọn quận huyện---</option>
                            @foreach($districts as $district)
                            <option value="{{ $district->maqh }}">{{ $district->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Chọn xã phường</label>
                        <select class="form-control m-bot15 town" id="town" name="xaid">
                            <option value="" hidden>---Chọn xã phường---</option>
                            @foreach($towns as $town)
                            <option value="{{ $town->xaid }}">{{ $town->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Phí vận chuyển</label>
                        <input class="form-control fee_ship @error('fee_feeship') is-invalid @enderror" name="fee_feeship"
                            placeholder="Enter name">
                        @error('fee_feeship')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-info add_delivery">Tính phí vận chuyển</button>
                </form>
            </div>

        </div>
    </section>
</div>
@endsection