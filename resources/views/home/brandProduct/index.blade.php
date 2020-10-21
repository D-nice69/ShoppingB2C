@extends('layouts.home')
@section('title')
Eshop | {{ $getBrand->brand_name }}
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
    <h2 class="title text-center">{{ $getBrand->brand_name }}</h2>
    @foreach($brandProducts as $productItem)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <a href="{{ route('home.productDetails',['slug'=>$productItem->slug]) }}">
                        <img src="/uploads/products/{{ $productItem->product_image }}"
                            style=" height: 300px; object-fit: cover;" alt="" />
                    </a>
                    <h2>{{ number_format($productItem->product_price) }} VNĐ</h2>
                    <p>{{ $productItem->product_name }}</p>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                </div>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
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