@extends('adminPartials.layout')
@section('title')
Add category
@endsection
@section('css')

@endsection
@section('content')
<div class="form-w3layouts">
    <section class="panel">
        <header class="panel-heading">
            Thêm danh mục
        </header>
        <div class="panel-body">
            <div class="col-12">
                <form role="form" action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Tên</label>
                        <input class="form-control @error('category_name') is-invalid @enderror" name="category_name"
                            placeholder="Enter name">
                        @error('category_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <textarea rows="3" class="form-control @error('category_description') is-invalid @enderror" name="category_description"></textarea>
                        @error('category_description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Từ khóa danh mục</label>
                        <textarea class="form-control @error('keyword') is-invalid @enderror" name="keyword"></textarea>
                        @error('keyword')
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
                        <label for="">Ẩn/Hiện</label>
                        <select class="form-control m-bot15" name="category_status">
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