@extends('adminPartials.layout')
@section('title')
Add brand
@endsection
@section('content')
<div class="form-w3layouts">
    <section class="panel">
        <header class="panel-heading">
            Thêm thương hiệu
        </header>
        <div class="panel-body">
            <div class="col-12">
                <form role="form" action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                   
                    <div class="form-group">
                        <label for="">Tên</label>
                        <input class="form-control @error('brand_name') is-invalid @enderror" name="brand_name"
                            placeholder="Enter name">
                        @error('brand_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <textarea rows="3" class="form-control @error('brand_description') is-invalid @enderror"
                            name="brand_description"></textarea>
                        @error('brand_description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Từ khóa thương hiệu</label>
                        <textarea class="form-control @error('keyword') is-invalid @enderror" name="keyword"></textarea>
                        @error('keyword')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Ẩn/Hiện</label>
                        <select class="form-control m-bot15" name="brand_status">
                            <option value="0">Hiện</option>
                            <option value="1">Ẩn</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info">Thêm</button>
                </form>
            </div>

        </div>
    </section>
</div>
@endsection