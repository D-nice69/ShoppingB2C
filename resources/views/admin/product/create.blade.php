@extends('adminPartials.layout')
@section('title')
Add product
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<style>
    button.fileinput-upload.fileinput-upload-button {
        display: none;
    }

    @media (min-width: 1300px) {
        .form-group.product_image>div.file-input.file-input-ajax-new {
            width: 50%;
        }

        .form-group.product_image>div.file-input {
            width: 32%;
        }
    }
</style>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="js/textarea.js"></script>

<script>
    $("#product_image").fileinput({
        language:'vi',
        browseOnZoneClick:true,
        showCaption:false,
        preferIconicZoomPreview:false,

    });
    $("#images").fileinput({
        language:'vi',
        browseOnZoneClick:true,
        showCaption:false,
    });
</script>
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
                    <div class="form-group product_image">
                        <label for="file">Hình ảnh</label>
                        <input id="product_image" type="file" name="product_image" class="file"
                            data-preview-file-type="any">
                    </div>
                    <div class="form-group">
                        <label for="">Hình ảnh chi tiết</label>
                        <input id="images" type="file" name="images[]" class="file" multiple=true
                            data-preview-file-type="any">

                    </div>

                    <div class="form-group">
                        <label for="">Số lượng</label>
                        <input class="form-control @error('product_qty') is-invalid @enderror" name="product_qty"
                            placeholder="Enter price">
                        @error('product_qty')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Chọn tag sản phẩm</label>
                        <br />
                        <select class="form-control tags-select-choose" multiple="multiple" name="tags[]" @error('tags')
                            is-invalid @enderror>
                            <option class="" value=""></option>
                        </select>
                        @error('tags')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <textarea id="editor" rows="10" rows="5"
                            class="form-control @error('product_desc') is-invalid @enderror"
                            name="product_desc"></textarea>
                        @error('product_desc')
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
                        <label for="">Ẩn/Hiện</label>
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