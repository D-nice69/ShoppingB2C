@extends('adminPartials.layout')
@section('title')
Add coupon
@endsection
@section('content')
<div class="form-w3layouts">
    <section class="panel">
        <header class="panel-heading">
            Thêm mã giảm giá
        </header>
        <div class="panel-body">
            <div class="col-12">
                <form role="form" action="{{ route('coupon.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Tên</label>
                        <input class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="form-group">
                        <label for="">Mã giảm giá</label>
                        <input class="form-control @error('code') is-invalid @enderror" name="code">
                        @error('code')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <div class="form-group">
                        <label for="">Số lượng</label>
                        <input class="form-control @error('qty') is-invalid @enderror" name="qty">
                        @error('qty')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Tính năng</label>
                        <select class="form-control  @error('feature') is-invalid @enderror" name="feature">
                            <option hidden value="">----Chọn----</option>
                            <option {{ old('feature') == 0 ? 'selected' : '' }} value="0">Giảm theo phần trăm</option>
                            <option {{ old('feature') == 1 ? 'selected' : '' }} value="1">Giảm theo tiền</option>
                        </select>
                        @error('feature')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Nhập số phần trăm hoặc số tiền giảm</label>
                        <textarea style="width: 300px" name="discount_number"  class="form-control @error('discount_number') is-invalid @enderror" cols="30" rows="1"></textarea>
                        @error('discount_number')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>  
                    <button type="submit" class="btn btn-info">Tạo mã</button>
                </form>
            </div>

        </div>
    </section>
</div>
@endsection