@extends('adminPartials.layout')
@section('title')
Edit post
@endsection
@section('content')
<div class="form-w3layouts">
    <section class="panel">
        <header class="panel-heading">
            Sửa bài viết
        </header>
        <div class="panel-body">
            <div class="col-12">
                <form role="form" action="{{ route('post.update',['id'=>$post->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf                    
                    <div class="form-group">
                        <label for="">Tiêu đề</label>
                        <input class="form-control @error('title') is-invalid @enderror" name="title"
                            value="{{ $post->title }}">
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Hình ảnh</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                            name="image" value="{{ $post->image }}">
                        <img src="/uploads/posts/{{ $post->image }}" alt="">
                        @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>                    
                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <textarea rows="5" class="form-control @error('description') is-invalid @enderror"
                            name="description">{{ $post->description }}</textarea>
                        @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>                    
                    <div class="form-group">
                        <label for="">Nội dung</label>
                        <textarea id="editor1" rows="10"
                            class="form-control @error('content') is-invalid @enderror"
                            name="content">{{ $post->content }}</textarea>
                        @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="">Chọn danh mục</label>
                        <select class="form-control m-bot15" name="parent_id">
                            <option value="0" hidden>---Chọn danh mục---</option>
                            {!! $htmlOption !!}
                        </select>
                    </div>   
                    <div class="form-group">
                        <label for="">Ẩn/Hiện</label>
                        <select class="form-control m-bot15" name="status">
                            <option value="0">Hiện</option>
                            <option value="1">Ẩn</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info">Sửa</button>
                </form>
            </div>

        </div>
    </section>
</div>
@endsection