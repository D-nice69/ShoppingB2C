@extends('layouts.home')
@section('title')
Eshop | Tìm kiếm
@endsection
@section('slider')
@include('homePartials.slider')
@endsection
@section('left_side_bar')
@include('homePartials.left_sidebar')
@endsection
@section('content')

<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">Kết quả tìm kiếm</h2>
    @foreach($searchProducts as $Sproduct)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <a href="{{ route('home.productDetails',['slug'=>$Sproduct->slug]) }}">
                        <img src="/uploads/products/{{ $Sproduct->product_image }}"
                            style=" height: 300px; object-fit: cover;" alt="" />
                    </a>
                    <h2>{{ number_format($Sproduct->product_price) }} VNĐ</h2>
                    <p>{{ $Sproduct->product_name }}</p>
                    <a href="" type="submit" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                </div>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Đánh dấu</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div>
<!--category-tab-->
@include('homePartials.category_tab')
<!--/category-tab-->
<!--recommended_items-->
@include('homePartials.recommended_items')
<!--/recommended_items-->

@endsection