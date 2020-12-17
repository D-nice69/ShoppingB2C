@extends('adminPartials.layout')
@section('title')
Edit coupon
@endsection
@section('content')
<div class="form-w3layouts">
    <section class="panel">
        <header class="panel-heading">
            Cập nhật mã giảm giá
        </header>
        <div class="panel-body">
            <div class="col-12">
                <form role="form" action="{{ route('coupon.update',['id'=>$coupon->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $coupon->id }}">
                    <div class="form-group">
                        <label for="">Tên</label>
                        <input class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ $coupon->name }}">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="form-group">
                        <label for="">Mã giảm giá</label>
                        <input class="form-control @error('code') is-invalid @enderror" name="code" value="{{ $coupon->code }}">
                    @error('code')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
            </div> --}}
            <div class="form-group">
                <label for="">Số lượng</label>
                <input class="form-control @error('qty') is-invalid @enderror" name="qty" value="{{ $coupon->qty }}">
                @error('qty')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Tính năng</label>
                <select class="form-control  @error('feature') is-invalid @enderror" name="feature">
                    <option hidden value="">----Chọn----</option>
                    @if($coupon->feature == 0)
                    <option selected value="0">Giảm theo phần trăm</option>
                    <option value="1">Giảm theo tiền</option>
                    @else
                    <option value="0">Giảm theo phần trăm</option>
                    <option selected value="1">Giảm theo tiền</option>
                    @endif
                </select>
                @error('feature')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Nhập số phần trăm hoặc số tiền giảm</label>
                <textarea style="width: 300px" name="discount_number"
                    class="form-control @error('discount_number') is-invalid @enderror" cols="30"
                    rows="1">{{ $coupon->discount_number }}</textarea>
                @error('discount_number')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-info">Cập nhật</button>
            </form>
        </div>

</div>
</section>
</div>
@endsection