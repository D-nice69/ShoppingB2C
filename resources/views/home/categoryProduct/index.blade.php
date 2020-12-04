@extends('layouts.home')
@section('title')
Eshop | {{ $getCategory->category_name }}
@endsection
@section('slider')
@include('homePartials.slider')
@endsection
@section('left_side_bar')
@include('homePartials.left_sidebar')
@include('homePartials.left_sidebar_price')
@include('homePartials.left_sidebar_ads')
@endsection
@section('css')
<style>
    option:first-child {
        display: none;
    }

    .ui-slider-range.ui-corner-all.ui-widget-header {
        background: rgb(131, 58, 180);
        background: linear-gradient(90deg, rgba(131, 58, 180, 1) 0%, rgba(253, 29, 29, 1) 50%, rgba(252, 176, 69, 1) 100%);
    }
</style>
@endsection
@section('js')
@include('home.sort')
@endsection
@section('content')

<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">{{ $getCategory->category_name }}</h2>
    <div class="row" style="border: 1px solid orange; padding:5px;margin:0px">
        <div class="col-md-8">
            <form action="">
                <p style="font-size: 15px">
                    <label for="amount">Giá giao động:</label>
                    <input type="text" id="amount" readonly
                        style="border:0; color:#f6931f;width:60%; font-weight:bold;">
                    <input type="hidden" name="start_price" id="start_price">
                    <input type="hidden" name="end_price" id="end_price">
                </p>
                <div id="slider-range" style="margin-left:7px; border-color:orange"></div>
                <br />
                <input type="submit" name="filter_price" class="btn btn-default" value="Lọc theo giá">
                <a href="{{ Request::url() }}" class="btn btn-default">Bỏ lọc</a>
            </form>
        </div>
        <div class="col-md-4" style="float:right">
            <div class="sel sel--black-panther">
                <form action="">
                    @csrf
                    <select id="sort" class="form-control">
                        <option value="">Sắp xếp</option>
                        <option value="{{ Request::url() }}?sort_by=price_up">Giá tăng dần</option>
                        <option value="{{ Request::url() }}?sort_by=price_down">Giá giảm dần</option>
                        <option value="{{ Request::url() }}?sort_by=name_az">Theo tên từ A-Z</option>
                        <option value="{{ Request::url() }}?sort_by=name_za">Theo tên từ Z-A</option>
                    </select>
                </form>
            </div>
        </div>
    </div>
    @foreach($productC as $productItem)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <form>
                        @csrf
                        <input type="hidden" value="{{$productItem->user_id}}"
                            class="cart_product_seller_id_{{$productItem->id}}">
                        <input type="hidden" value="{{$productItem->id}}" class="cart_product_id_{{$productItem->id}}">
                        <input type="hidden" value="{{$productItem->product_name}}"
                            class="cart_product_name_{{$productItem->id}}">
                        <input type="hidden" value="{{$productItem->product_image}}"
                            class="cart_product_image_{{$productItem->id}}">
                        <input type="hidden" value="{{$productItem->product_price}}"
                            class="cart_product_price_{{$productItem->id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$productItem->id}}">
                        <a
                            href="{{ route('home.productDetails',['slug'=>$productItem->slug,'id'=>$productItem->id]) }}">
                            <img src="/uploads/products/{{ $productItem->user_id }}/{{ $productItem->product_image }}"
                                style=" height: 300px; object-fit: cover;" alt="" />
                        </a>
                        <h2>{{ number_format($productItem->product_price) }} VNĐ</h2>
                        <p>{{ $productItem->product_name }}</p>
                        <button type="button" class="btn btn-default add-to-cart" name="add-to-cart"
                            data-id_product="{{ $productItem->id }}">Thêm giỏ hàng</button>
                        <button type="button" class="btn btn-default add-to-cart" data-toggle="modal"
                            data-target="#myModal_{{ $productItem->id }}">Xem nhanh</button>

                    </form>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal_{{ $productItem->id }}" role="dialog">
                        <form>
                            @csrf
                            <input type="hidden" value="{{$productItem->user_id}}"
                                class="cart_product_seller_id_{{$productItem->id}}">
                            <input type="hidden" value="{{$productItem->id}}"
                                class="cart_product_id_{{$productItem->id}}">
                            <input type="hidden" value="{{$productItem->product_name}}"
                                class="cart_product_name_{{$productItem->id}}">
                            <input type="hidden" value="{{$productItem->product_image}}"
                                class="cart_product_image_{{$productItem->id}}">
                            <input type="hidden" value="{{$productItem->product_price}}"
                                class="cart_product_price_{{$productItem->id}}">
                            <div class="modal-dialog modal-lg modal-sm">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h3 style="color: brown;font-size:26px" class="modal-title">
                                            {{ $productItem->product_name }}</h3>
                                        <p>Mã sản phẩm: {{ $productItem->id }} </p>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <img style="width: 100%; height:100%; float:left"
                                                    src="/uploads/products/{{ $productItem->user_id }}/{{ $productItem->product_image }}"
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
                                                        Giá sản phẩm: {{ number_format($productItem->product_price) }}
                                                        VNĐ
                                                    </h2>
                                                </p>
                                                <br />
                                                <p><label>Số lượng sản phẩm: </label> {{ $productItem->product_qty }}
                                                </p>
                                                <h4 style="text-align: left">Mô tả sản phẩm:</h4>
                                                <p><span>{!! $productItem->product_desc !!}</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy
                                            bỏ</button>
                                        <button type="button" class="btn btn-default add-to-cart" name="add-to-cart"
                                            data-id_product="{{ $productItem->id }}">Thêm giỏ hàng</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            {{-- <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                </ul>
            </div> --}}
        </div>
    </div>
    @endforeach
    <div class="col-md-12">
        {{ $productC->links() }}
    </div>

</div>

<!--category-tab-->
@include('homePartials.category_tab')
<!--/category-tab-->

<!--recommended_items-->
@include('homePartials.recommended_items')
<!--/recommended_items-->



@endsection