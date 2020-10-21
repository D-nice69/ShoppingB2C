@extends('adminPartials.layout')
@section('title')
Add product
@endsection
@section('content')
<div class="form-w3layouts">
    <section class="panel">
        <header class="panel-heading">
            Thêm sản phẩm
        </header>
        <div class="panel-body">
            <div class="col-12">
                <form role="form" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Tên</label>
                        <input class="form-control @error('product_name') is-invalid @enderror" name="product_name"
                            placeholder="Enter name">
                        @error('product_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Giá</label>
                        <input class="form-control @error('product_price') is-invalid @enderror" name="product_price"
                            placeholder="Enter price">
                        @error('product_price')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Hình ảnh</label>
                        <input type="file" class="form-control @error('product_image') is-invalid @enderror"
                            name="product_image">
                        @error('product_image')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <textarea rows="5" class="form-control @error('product_desc') is-invalid @enderror"
                            name="product_desc"></textarea>
                        @error('product_desc')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Từ khóa</label>
                        <textarea class="form-control @error('keyword') is-invalid @enderror" name="keyword"></textarea>
                        @error('keyword')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Nội dung</label>
                        <textarea id="editor1" rows="10"
                            class="form-control @error('product_content') is-invalid @enderror"
                            name="product_content"></textarea>
                        @error('product_content')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Danh mục</label>
                        <select class="form-control m-bot15" name="category_id">
                            @foreach($categories as $key=>$category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Thương hiệu</label>
                        <select class="form-control m-bot15" name="brand_id">
                            @foreach($brands as $key=>$brand)
                            <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Hiện/Ẩn</label>
                        <select class="form-control m-bot15" name="product_status">
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