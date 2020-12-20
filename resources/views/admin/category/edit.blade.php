@extends('adminPartials.layout')
@section('title')
Update category
@endsection
@section('content')
<div class="form-w3layouts">
    <section class="panel">
        <header class="panel-heading">
            Cập nhật danh mục
        </header>
        <div class="panel-body">
            <div class="col-12">
                <form role="form" action="{{ route('category.update',['id'=>$category->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Tên</label>
                        <input class="form-control @error('category_name') is-invalid @enderror" name="category_name"
                            value="{{ $category->category_name }}">
                        @error('category_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="hidden" name="id" value="{{ $category->id }}">
                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <textarea rows="3" class="form-control @error('category_description') is-invalid @enderror"
                            name="category_description">{{ $category->category_description }}</textarea>
                        @error('category_description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Từ khóa danh mục</label>
                        <textarea class="form-control @error('keyword') is-invalid @enderror"
                            name="keyword">{{ $category->keyword }}</textarea>
                        @error('keyword')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Chọn danh mục cha</label>
                        <select class="form-control m-bot15 select2_multiple" name="parent_id">
                            <option value="0" hidden>---Chọn danh mục cha---</option>
                            {!! $htmlOption !!}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Ẩn/Hiện</label>
                        <select class="form-control m-bot15" name="category_status">
                            @if($category->category_status == 0)
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