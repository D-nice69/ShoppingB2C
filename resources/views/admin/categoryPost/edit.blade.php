@extends('adminPartials.layout')
@section('title')
Edit post categories
@endsection
@section('content')
<div class="form-w3layouts">
    <section class="panel">
        <header class="panel-heading">
            Sửa danh mục bài viết
        </header>
        <div class="panel-body">
            <div class="col-12">
                <form role="form" action="{{ route('categoryPost.update',['id'=>$cPost->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Tên</label>
                        <input class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ $cPost->name }}">
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
                            name="description">{{ $cPost->description }}</textarea>
                        @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>        
                    </div>
                    <div class="form-group">
                        <label for="">Ẩn/Hiện</label>
                        <select class="form-control m-bot15" name="status">
                            @if($cPost->status==0)
                            <option selected value="0">Hiện</option>
                            <option value="1">Ẩn</option>
                            @else
                            <option value="0">Hiện</option>
                            <option selected value="1">Ẩn</option>
                            @endif
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info">Sửa</button>
                </form>
            </div>

        </div>
    </section>
</div>
@endsection