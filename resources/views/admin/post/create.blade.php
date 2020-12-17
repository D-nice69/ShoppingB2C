@extends('adminPartials.layout')
@section('title')
Add post
@endsection
@section('content')
<div class="form-w3layouts">
    <section class="panel">
        <header class="panel-heading">
            Thêm bài viết
        </header>
        <div class="panel-body">
            <div class="col-12">
                <form role="form" action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf                    
                    <div class="form-group">
                        <label for="">Tiêu đề</label>
                        <input class="form-control @error('title') is-invalid @enderror" name="title"
                            placeholder="Enter price" value="{{ old('title') }}">
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Hình ảnh</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                            name="image">
                        @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>                    
                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <textarea rows="5" class="form-control @error('description') is-invalid @enderror"
                            name="description">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>                    
                    <div class="form-group">
                        <label for="">Nội dung</label>
                        <textarea id="editor1" rows="10"
                            class="form-control @error('content') is-invalid @enderror"
                            name="content">{{ old('content') }}</textarea>
                        @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="">Chọn danh mục</label>
                        <select class="form-control m-bot15" name="parent_id">
                            <option value="" hidden>---Chọn danh mục---</option>
                            {!! $htmlOption !!}
                        </select>
                        @error('parent_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>   
                    <div class="form-group">
                        <label for="">Ẩn/Hiện</label>
                        <select class="form-control m-bot15" name="status">
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