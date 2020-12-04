@extends('adminPartials.layout')
@section('title')
Shop's setting
@endsection
@section('head')
<meta name="_token" content="{{ csrf_token() }}">
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script> --}}
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script> --}}
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
@endsection
@section('css')
<style type="text/css">
    img {
        display: block;
        max-width: 100%;
    }

    .preview {
        overflow: hidden;
        width: 100%;
        height: 160px;
        margin: 10px;
        border: 1px solid red;
    }

    .modal-lg {
        max-width: 1000px !important;
    }
</style>
@endsection
@section('js')
<script>
    $(document).ready(function(){
    
        var $modal = $('#modal');
    
        var image = document.getElementById('sample_image');
    
        var cropper;
    
        $('#upload_image').change(function(event){
            var files = event.target.files;
    
            var done = function(url){
                image.src = url;
                $modal.modal('show');
            };
    
            if(files && files.length > 0)
            {
                reader = new FileReader();
                reader.onload = function(event)
                {
                    done(reader.result);
                };
                reader.readAsDataURL(files[0]);
            }
        });
    
        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                preview:'.preview'
            });
        }).on('hidden.bs.modal', function(){
            cropper.destroy();
               cropper = null;
        });
    
        $('#crop').click(function(){
            canvas = cropper.getCroppedCanvas({
                width:400,
                height:400
            });
    
            canvas.toBlob(function(blob){
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function(){
                    var base64data = reader.result;
                    $.ajax({
                        url:'upload.php',
                        method:'POST',
                        data:{image:base64data},
                        success:function(data)
                        {
                            $modal.modal('hide');
                            $('#uploaded_image').attr('src', data);
                        }
                    });
                };
            });
        });
        
    });
</script>
@endsection
@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Cài đặt Shop
        </div>
        <br />
        <?php
            $message = Session::get('message');
            if ($message) {
            echo '<span style="color: red; padding: 10px">' . $message . '</span>';
            Session::put('message', null);
            }
            ?>
        <div class="panel-body">
            <div class="col-12">
                <form role="form" action="{{ route('shop.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Tên Shop</label>
                        <input class="form-control @error('shop_name') is-invalid @enderror" name="shop_name"
                            placeholder="Enter name" value="{{ $shop->shop_name }}">
                        @error('shop_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>                    
                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <textarea rows="5" rows="5" class="form-control @error('shop_info') is-invalid @enderror"
                            name="shop_info">{{ $shop->shop_info }}</textarea>
                        @error('shop_info')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-info">Lưu</button>
                </form>
            </div>
        </div>
        @endsection