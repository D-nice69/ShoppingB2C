@extends('adminPartials.layout')
@section('title')
Add slider
@endsection
@section('content')
<div class="form-w3layouts">
    <section class="panel">
        <header class="panel-heading">
            Thêm slider
        </header>
        <div class="panel-body">
            <div class="col-12">
                <form role="form" action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Tên</label>
                        <input class="form-control @error('name') is-invalid @enderror" name="name"
                            placeholder="Enter name" value="{{ old('name') }}">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Hình ảnh</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                        @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <textarea rows="5" class="form-control @error('desc') is-invalid @enderror"
                            name="desc">{{ old('desc') }}</textarea>
                        @error('desc')
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