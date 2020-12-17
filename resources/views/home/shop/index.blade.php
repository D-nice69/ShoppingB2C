@extends('layouts.home')
@section('title')
Eshop | pro
@endsection
@section('css')
<style>
    .section-seller-overview-horizontal__leading {
        height: 160px;
        position: relative;
        width: 550px;
        overflow: hidden;
        border-radius: .25rem;
    }

    .section-seller-overview-horizontal__leading-background {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        background-position: 50%;
        background-size: cover;
        background-repeat: no-repeat;
        filter: url(data:image/svg+xml;charset=utf-8,<svg xmlns="http://www.w3.org/2000/svg"><filter id="filter"><feGaussianBlur stdDeviation="2" /></filter></svg>#filter);
        -webkit-filter: blur(2px);
        filter: blur(2px);
        margin: -4px;
    }

    .section-seller-overview-horizontal__leading-background-mask {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        background-color: rgba(0, 0, 0, .6);
    }

    .section-seller-overview-horizontal {
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        overflow: hidden;
        height: 140px;
    }

    .section-seller-overview-horizontal__leading-content {
        position: absolute;
        top: .625rem;
        left: 3.25rem;
        right: .875rem;
        bottom: .625rem;
    }

    .section-seller-overview-horizontal__seller-portrait {
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
    }

    .section-seller-overview-horizontal__buttons {
        position: relative;
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        margin-top: .625rem;
    }

    .button {
        background-color: white;
        /* Green */
        border: none;
        color: white;
        padding: 7px 30px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }

    .button1 {
        margin-left: 20px;
        background-color: transparent;
        color: white;
        border: 2px solid white;
    }
</style>
@endsection
@section('content_2')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="section-seller-overview-horizontal container">
                    <div class="section-seller-overview-horizontal__leading">
                        <div class="section-seller-overview-horizontal__leading-background" style="background-image: 
                            @if($pic)
                            url(&quot;http://127.0.0.1:8000/uploads/shop/{{ $i }}/{{ $pic->name }}&quot;)
                            @else
                            url(&quot;http://127.0.0.1:8000/uploads/shop/blog-one.jpg&quot;)
                            @endif
                            ;">
                        </div>
                        <div class="section-seller-overview-horizontal__leading-background-mask"></div>
                    </div>
                    <div class="section-seller-overview-horizontal__leading-content">
                        <div class="section-seller-overview-horizontal__seller-portrait">
                            <div class="col-sm-12">
                                <h3 style="text-align: center;color:white">{{ $seller->shop_name }}</h3>
                            </div>
                        </div>
                        <div class="section-seller-overview-horizontal__buttons">
                            <div class="col-sm-12">
                                <button class="button button1">LIÊN HỆ</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-12">
                <div class="category-tab">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#shop_info" data-toggle="tab">Thông tin Shop</a></li>
                            <li><a href="#shop_product" data-toggle="tab">Tất cả sản phẩm</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="shop_info">
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            @if($seller->shop_info)
                                            {!! $seller->shop_info !!}
                                            @else
                                            Hiện tại chưa có thông tin về shop
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="shop_product">
                            @if($products->count()>0)
                            @foreach($products as $product)
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <form>
                                                @csrf
                                                <input type="hidden" value="{{$product->user_id}}"
                                                    class="cart_product_seller_id_{{$product->id}}">
                                                <input type="hidden" value="{{$product->id}}"
                                                    class="cart_product_id_{{$product->id}}">
                                                <input type="hidden" value="{{$product->product_name}}"
                                                    class="cart_product_name_{{$product->id}}">
                                                <input type="hidden" value="{{$product->product_image}}"
                                                    class="cart_product_image_{{$product->id}}">
                                                <input type="hidden" value="{{$product->product_price}}"
                                                    class="cart_product_price_{{$product->id}}">
                                                <input type="hidden" value="1"
                                                    class="cart_product_qty_{{$product->id}}">
                                                <a
                                                    href="{{ route('home.productDetails',['slug'=>$product->slug,'id'=>$product->id]) }}">
                                                    <img src="/uploads/products/{{ $product->user_id }}/{{ $product->product_image }}"
                                                        style=" height: 300px; object-fit: cover;" alt="" />
                                                </a>
                                                <h2>{{ number_format($product->product_price) }} VNĐ</h2>
                                                <p>{{ $product->product_name }}</p>
                                                <button type="button" class="btn btn-default add-to-cart"
                                                    name="add-to-cart" data-id_product="{{ $product->id }}">Thêm giỏ
                                                    hàng</button>
                                                <button type="button" class="btn btn-default add-to-cart"
                                                    data-toggle="modal" data-target="#myModal_{{ $product->id }}">Xem
                                                    nhanh</button>

                                            </form>
                                            <!-- Modal -->
                                            <div class="modal fade" id="myModal_{{ $product->id }}" role="dialog">
                                                <form>
                                                    @csrf
                                                    <input type="hidden" value="{{$product->user_id}}"
                                                        class="cart_product_seller_id_{{$product->id}}">
                                                    <input type="hidden" value="{{$product->id}}"
                                                        class="cart_product_id_{{$product->id}}">
                                                    <input type="hidden" value="{{$product->product_name}}"
                                                        class="cart_product_name_{{$product->id}}">
                                                    <input type="hidden" value="{{$product->product_image}}"
                                                        class="cart_product_image_{{$product->id}}">
                                                    <input type="hidden" value="{{$product->product_price}}"
                                                        class="cart_product_price_{{$product->id}}">
                                                    <div class="modal-dialog modal-lg modal-sm">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                                <h3 style="color: brown;font-size:26px"
                                                                    class="modal-title">
                                                                    {{ $product->product_name }}</h3>
                                                                <p>Mã sản phẩm: {{ $product->id }} </p>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-5">
                                                                        <img style="width: 100%; height:100%; float:left"
                                                                            src="/uploads/products/{{ $product->user_id }}/{{ $product->product_image }}"
                                                                            alt="">
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <style>
                                                                            div.col-md-7>p {
                                                                                text-align: left;
                                                                            }

                                                                            /* @media screen and (min-width:768px){
                                                                                .modal-dialog{
                                                                                    width: 700px;
                                                                                }
                                                                                .modal-sm{
                                                                                    width: 350px;
                                                                                }
                                                                            } */
                                                                            @media screen and (min-width:992px) {
                                                                                .modal-lg {
                                                                                    width: 1000px;
                                                                                }
                                                                            }
                                                                        </style>
                                                                        <p>
                                                                            <h2
                                                                                style="color: rgb(238, 101, 10);text-align: left; font-size:30px">
                                                                                Giá sản phẩm:
                                                                                {{ number_format($product->product_price) }}
                                                                                VNĐ
                                                                            </h2>
                                                                        </p>
                                                                        <br />
                                                                        <p><label>Số lượng sản phẩm: </label>
                                                                            {{ $product->product_qty }}
                                                                        </p>
                                                                        <h4 style="text-align: left">Mô tả sản phẩm:
                                                                        </h4>
                                                                        <p><span>{!! $product->product_desc !!}</span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Hủy
                                                                    bỏ</button>
                                                                <button type="button"
                                                                    class="btn btn-default add-to-cart"
                                                                    name="add-to-cart"
                                                                    data-id_product="{{ $product->id }}">Thêm giỏ
                                                                    hàng</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                    {{-- <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Đánh dấu</a></li>
                                            <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                                        </ul>
                                    </div> --}}
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            Hiện tại shop chưa có sản phẩm
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</section>
@endsection