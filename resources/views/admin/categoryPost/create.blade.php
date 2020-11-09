@extends('adminPartials.layout')
@section('title')
Add post categories
@endsection
@section('content')
<div class="form-w3layouts">
    <section class="panel">
        <header class="panel-heading">
            Thêm danh mục bài viết
        </header>
        <div class="panel-body">
            <div class="col-12">
                <form role="form" action="{{ route('categoryPost.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Tên</label>
                        <input class="form-control @error('name') is-invalid @enderror" name="name"
                            placeholder="Enter name">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Chọn danh mục cha</label>
                        <select class="form-control m-bot15" name="parent_id">
                            <option value="0">---Chọn danh mục cha---</option>
                            {!! $htmlOption !!}
                        </select>
                    </div>                    
                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <textarea rows="5" class="form-control @error('description') is-invalid @enderror"
                            name="description"></textarea>
                        @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>        
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