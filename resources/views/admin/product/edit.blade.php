@extends('adminPartials.layout')
@section('title')
Edit product
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
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<style>
    button.fileinput-upload.fileinput-upload-button {
        display: none;
    }

    /* @media (min-width: 1300px) {
        .form-group.product_image>div.file-input.file-input-ajax-new {
            width: 50%;
        }

        .form-group.product_image>div.file-input {
            width: 32%;
        }
    } */
</style>
@endsection
@section('content')
<div class="form-w3layouts">
    <section class="panel">
        <header class="panel-heading">
            Chỉnh sửa sản phẩm
        </header>
        <div class="panel-body">
            <div class="col-12">
                <form role="form" action="{{ route('product.update',['id'=>$product->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Tên</label>
                        <input class="form-control @error('product_name') is-invalid @enderror" name="product_name"
                            value="{{ $product->product_name }}">
                    </div>
                    @error('product_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="">Giá</label>
                        <input class="form-control @error('product_price') is-invalid @enderror" name="product_price"
                            value="{{ $product->product_price }}">
                        @error('product_price')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Hình ảnh</label>
                            <br />
                            {{-- <input type="file" class="form-control @error('product_image') is-invalid @enderror"
                                name="product_image" value="{{ $product->product_image }}"> --}}
                            <div class="col-sm-4 center">
                                <img src="/uploads/products/{{ Auth::user()->id }}/{{ $product->product_image }}"
                                    alt="{{ $product->product_image }}"
                                    style="padding-top: 10px;height: auto; width: 300px;padding-bottom: 10px;">
                            </div>
                            <div class="col-sm-6">
                                <input id="product_image" type="file" name="product_image"
                                    class="file form-control @error('product_image') is-invalid @enderror"
                                    data-preview-file-type="any" value="{{ $product->product_image }}">
                            </div>
                            @error('product_image')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Hình ảnh chi tiết</label>
                            <div class="col-sm-12" style="padding-bottom: 10px">
                                @foreach($product->images as $image)
                                <img src="/uploads/products/{{ Auth::user()->id }}/{{ $image->image }}"
                                    alt="{{ $image->image }}" width="auto" height="200" style="padding-top: 10px">
                                @endforeach
                                @error('images')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <br />
                            <div class="col-sm-12">
                                <input id="images" type="file" name="images[]" multiple
                                    class="file form-control @error('images') is-invalid @enderror"
                                    data-preview-file-type="any" @foreach($product->images as $image)
                                value="{{ $image->image }}
                                @endforeach">
                            </div>
                            {{-- <input type="file" multiple class="form-control @error('images') is-invalid @enderror"
                                name="images[]" @foreach($product->images as $image) value="{{ $image->image }}
                            @endforeach"> --}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Số lượng</label>
                        <input class="form-control @error('product_qty') is-invalid @enderror" name="product_qty"
                            value="{{ $product->product_qty }}">
                        @error('product_qty')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Chọn tag sản phẩm</label>
                        <br />
                        <select class="form-control tags-select-choose" multiple="multiple" name="tags[]" @error('tags')
                            is-invalid @enderror>
                            @foreach($product->tags as $tag)
                            <option selected value="{{ $tag->name }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                        @error('tags')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <textarea id="editor" rows="10" class="form-control @error('product_desc') is-invalid @enderror"
                            name="product_desc">{{ $product->product_desc }}</textarea>
                        @error('product_desc')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Nội dung</label>
                        <textarea id="editor1" rows="10"
                            class="form-control @error('product_content') is-invalid @enderror"
                            name="product_content">{{ $product->product_content }}</textarea>
                        @error('product_content')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Danh mục</label>
                        <select class="form-control m-bot15" name="category_id">
                            @foreach($categories as $key=>$category)
                            <option value="{{ $category->id }}"
                                {{ ($category->id==$product->category->id) ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Thương hiệu</label>
                        <select class="form-control m-bot15" name="brand_id">
                            @foreach($brands as $key=>$brand)
                            <option value="{{ $brand->id }}" {{ ($brand->id==$product->brand->id) ? 'selected' : '' }}>
                                {{ $brand->brand_name }}
                            </option>
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
                    <button type="submit" class="btn btn-info">Cập nhật</button>
                </form>
            </div>

        </div>
    </section>
</div>
@endsection