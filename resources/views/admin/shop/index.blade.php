@extends('adminPartials.layout')
@section('title')
Shop's setting
@endsection
@section('css')
<style>
    .img-circle {
        border-radius: 0;
    }

    .image_area {
        position: relative;
    }

    img {
        display: block;
        max-width: 100%;
    }

    .preview {
        overflow: hidden;
        width: 160px;
        height: 160px;
        margin: 10px;
        border: 1px solid red;
    }

    .modal-lg {
        max-width: 1000px !important;
    }

    .overlay {
        position: absolute;
        bottom: 6px;
        left: 0;
        right: 0;
        background-color: rgba(255, 255, 255, 0.5);
        overflow: hidden;
        height: 0;
        transition: .5s ease;
        width: 100%;
    }

    .image_area:hover .overlay {
        height: 50%;
        cursor: pointer;
    }

    .text {
        color: #333;
        font-size: 20px;
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        text-align: center;
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
			aspectRatio: 5/2,
			viewMode: 3,
			preview:'.preview'
		});
	}).on('hidden.bs.modal', function(){
		cropper.destroy();
   		cropper = null;
	});

	$("#crop").click(function(){
        canvas = cropper.getCroppedCanvas({
            maxWidth: 4096,
            maxHeight: 4096,
          });
    
        canvas.toBlob(function(blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
             reader.readAsDataURL(blob); 
             reader.onloadend = function() {
                var base64data = reader.result; 
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "crop-image-upload",
                    data: {'_token': $('meta[name="_token"]').attr('content'), 'image': base64data},
                    success: function(data){
                        $modal.modal('hide');
                        $("#uploaded_image").attr('src',data.image_src);
                    }
                });
            }
        });
    });
});
</script>
@endsection
@section('head')
<meta name="_token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
@endsection
@section('content')
@include('admin.toast')
<div class="form-w3layouts">
    <section class="panel">
        <header class="panel-heading">
            Cài đặt cửa hàng
        </header>
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
                        <label for="">Ảnh bìa</label>
                        <div class="row">
                            <div class="col-md-4">&nbsp;</div>
                            <div class="col-md-4">
                                <div class="image_area">
                                    {{-- <form method="post"> --}}
                                        <label for="upload_image">
                                            <img @if($pic)
                                            src="/uploads/shop/{{ Auth::user()->id }}/{{ $pic->name }}"
                                            @else
                                            src="/uploads/shop/blog-one.jpg"
                                            @endif 
                                                id="uploaded_image" class="img-responsive img-circle" />
                                            <div class="overlay">
                                                <div class="text">Nhấn để đổi ảnh</div>
                                            </div>
                                            <input type="file" name="image" class="image" id="upload_image"
                                                style="display:none" />
                                        </label>
                                    {{-- </form> --}}
                                </div>
                            </div>
                            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            {{-- <h5 class="modal-title">Crop Image Before Upload</h5> --}}
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="img-container">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <img src="" id="sample_image" />
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="preview"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="crop" class="btn btn-primary">Lưu</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Hủy</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <textarea rows="5" rows="5" class="form-control @error('shop_info') is-invalid @enderror"
                            name="shop_info">{{ $shop->shop_info }}{{ old('shop_info') }}</textarea>
                        @error('shop_info')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-info">Lưu</button>
                </form>
            </div>

        </div>
    </section>
</div>

@endsection