@extends('adminPartials.layout')
@section('title')
Edit brand
@endsection
@section('content')
<div class="form-w3layouts">
    <section class="panel">
        <header class="panel-heading">
            Cập nhật thương hiệu
        </header>
        <div class="panel-body">
            <div class="col-12">
                <form role="form" action="{{ route('brand.update',['id'=>$brand->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Tên</label>
                        <input class="form-control @error('brand_name') is-invalid @enderror" name="brand_name"
                            value="{{ $brand->brand_name }}">
                        @error('brand_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <textarea rows="3" class="form-control @error('brand_description') is-invalid @enderror"
                            name="brand_description">{{ $brand->brand_description }}</textarea>
                        @error('brand_description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Từ khóa thương hiệu</label>
                        <textarea class="form-control @error('keyword') is-invalid @enderror" name="keyword">{{ $brand->keyword }}</textarea>
                        @error('keyword')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Ẩn/Hiện</label>
                        <select class="form-control m-bot15" name="brand_status">
                            @if($brand->brand_status==0)
                            <option value="0" selected>Hiện</option>
                            <option value="1">Ẩn</option>
                            @else
                            <option value="0">Hiện</option>
                            <option value="1" selected>Ẩn</option>
                            @endif
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info">Cập nhật</button>
                </form>
            </div>

        </div>
    </section>
</div>
@endsection