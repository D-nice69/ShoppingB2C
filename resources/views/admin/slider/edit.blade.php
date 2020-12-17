@extends('adminPartials.layout')
@section('title')
Edit slider
@endsection
@section('content')
<div class="form-w3layouts">
    <section class="panel">
        <header class="panel-heading">
            Sửa slider
        </header>
        <div class="panel-body">
            <div class="col-12">
                <form role="form" action="{{ route('slider.update',['id'=>$slider->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $slider->id }}">
                    <div class="form-group">
                        <label for="">Tên</label>
                        <input class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $slider->name }}{{ old('name') }}">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>                    
                    <div class="form-group">
                        <label for="">Hình ảnh</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                            name="image" value="{{ $slider->image }}">
                        <img src="/uploads/sliders/{{ $slider->image }}" alt="{{ $slider->image }}"
                        width="200" height="200" style="padding-top: 10px">
                        @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <textarea rows="5" class="form-control @error('desc') is-invalid @enderror"
                            name="desc">{{ $slider->desc }}{{ old('desc') }}</textarea>
                        @error('desc')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>                   
                    <div class="form-group">
                        <label for="">Ẩn/Hiện</label>
                        <select class="form-control m-bot15" name="status">
                            @if($slider->status == 0)
                            <option selected value="0">Hiện</option>
                            <option value="1">Ẩn</option>
                            @else
                            <option value="0">Hiện</option>
                            <option selected value="1">Ẩn</option>
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