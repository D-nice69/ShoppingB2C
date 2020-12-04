@extends('layouts.home')
@section('title')
Eshop | {{ $getProduct->product_name }}
@endsection
@section('slider')
@include('homePartials.slider')
@endsection
@section('left_side_bar')
@include('homePartials.left_sidebar')
@include('homePartials.left_sidebar_ads')

@endsection
@section('css')
<link href="css/productTags.css" rel="stylesheet">
<style>
  /* .add-to-cart {
    color: black;
    margin: 0px 5px 10px;
  } */

  .product-information {
    padding-top: 0px;
  }

  ul.lSGallery>li,
  li.lslide {
    border: 2px solid rgb(248, 167, 18);
  }

  li.breadcrumb-item>a {
    font-size: 16px;
    color: #e95713;
  }

  li.breadcrumb-item>a:hover {
    color: #e0a80c;
  }
</style>
@endsection
@section('js')
<script src="js/jquery.zoom.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#imageGallery').lightSlider({
        gallery:true,
        item:1,
        loop:true,
        thumbItem:3,
        slideMargin:0,
        adaptiveHeight:true,
        enableDrag: false,
        currentPagerPosition:'left',
        prevHtml: '<i class="fa fa-angle-left" style="font-size:50px"></i>',
        nextHtml: '<i class="fa fa-angle-right" style="font-size:50px"></i>',
        onSliderLoad: function(el) {
            el.lightGallery({
                selector: '#imageGallery .lslide'
            });
            el.find('li').zoom();
        }   
    });  
  });
</script>
@endsection
@section('content')
@php
use App\Category;
$categoriesLimit = Category::where('id',$getProduct->category_id)->first();
$parent_id = $categoriesLimit->parent_id;
@endphp

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    {!! $html !!}
    <li style="font-size: 16px" class="breadcrumb-item active" aria-current="page">{{ $getProduct->product_name }}</li>
  </ol>
</nav>
<div class="product-details">
  <!--product-details-->
  <div class="col-sm-5">
    <ul id="imageGallery">
      <li data-thumb="/uploads/products/{{ $getProduct->user_id }}/{{ $getProduct->product_image }}"
        data-src="/uploads/products/{{ $getProduct->user_id }}/{{ $getProduct->product_image }}">
        <img width="100%" src="/uploads/products/{{ $getProduct->user_id }}/{{ $getProduct->product_image }}" />
      </li>
      @foreach($getProduct->images as $image)
      <li data-thumb="/uploads/products/{{ $getProduct->user_id }}/{{ $image->image }}"
        data-src="/uploads/products/{{ $getProduct->user_id }}/{{ $image->image }}">
        <img width="100%" src="/uploads/products/{{ $getProduct->user_id }}/{{ $image->image }}" />
      </li>
      @endforeach

    </ul>
    {{-- <div class="view-product">
      <img src="/uploads/products/{{ $getProduct->product_image }}" alt="" />
    <h3>ZOOM</h3>
  </div>
  <div id="similar-product" class="carousel slide" data-ride="carousel">

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
        <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
        <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
      </div>
      <div class="item">
        <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
        <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
        <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
      </div>

    </div>

    <!-- Controls -->
    <a class="left item-control" href="#similar-product" data-slide="prev">
      <i class="fa fa-angle-left"></i>
    </a>
    <a class="right item-control" href="#similar-product" data-slide="next">
      <i class="fa fa-angle-right"></i>
    </a>
  </div> --}}

</div>

<div class="col-sm-7">
  <div class="product-information">
    <!--/product-information-->
    <h2>{{ $getProduct->product_name }}</h2>
    <p> Mã sản phẩm: {{ $getProduct->id }}</p>
    <span>
      <span>{{ number_format($getProduct->product_price) }} VNĐ</span>
      <label>Số lượng:</label>
      <form>
        @csrf
        <input type="number" name="qty" min="1" value="1" class="cart_product_qty_{{$getProduct->id}}" />
        <input type="hidden" value="{{$getProduct->id}}" class="cart_product_id_{{$getProduct->id}}">
        <input type="hidden" value="{{$getProduct->user_id}}" class="cart_product_seller_id_{{$getProduct->id}}">
        <input type="hidden" value="{{$getProduct->product_name}}" class="cart_product_name_{{$getProduct->id}}">
        <input type="hidden" value="{{$getProduct->product_image}}" class="cart_product_image_{{$getProduct->id}}">
        <input type="hidden" value="{{$getProduct->product_price}}" class="cart_product_price_{{$getProduct->id}}">
        <input type="hidden" value="{{ $getProduct->product_qty  }}" class="cart_product_quantity_{{$getProduct->id}}">
        <button style="background-color: #f9b02c" type="button" class="btn btn-default add-to-cart-detail"
          name="add-to-cart" data-id_product="{{ $getProduct->id }}">
          <i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
      </form>
    </span>
    <p><b>Số lượng hàng trong kho:</b> {{ $getProduct->product_qty }}</p>
    {{-- <p><b>Điều kiện:</b> Mới</p> --}}
    <p><b>Danh mục:</b> {{ $getProduct->category->category_name }}</p>
    <p><b>Thương hiệu:</b> {{ $getProduct->brand->brand_name }}</p>
    <p>
      <b>Shop bán:</b>
      <a href="{{ route('home.shop',['id'=>$getProduct->customer->id]) }}">
        {{ $getProduct->customer->name }}
      </a> 
    </p>
    <ul class="list-inline" title="Average Rating">
    @for($count = 1; $count <= 5; $count++)
    @php
      if($count<=$rating){
        $color = 'color:#ffcc00';
      }else {
        $color = 'color:#ccc';
      }
    @endphp
      <li title="start_rating" 
      id="{{ $getProduct->id }}-{{ $count }}" data-index="{{ $count }}" 
      data-product-id="{{ $getProduct->id }}" 
      data-rating="{{ $rating }}"
      @if(Auth::user()) 
      data-user_id="{{ Auth::user()->id }}" 
      @endif
      class="rating" 
      style="cursor: pointer;font-size:30px;{{ $color }}">
      &#9733;
      </li>
    @endfor
  </ul>
  <p>Lượt đánh giá: {{ count($ratings) }}</p>
    <div class="fb-like col-sm-12" data-href="{{ $url_canonical }}" data-width="" data-layout="button_count"
      data-action="like" data-size="small" data-share="true"></div>
    <p><b>Tags:</b>
      <ul class="tags">
        @foreach($getProduct->tags as $tag)
        <li>
          <a href="{{ route('home.tagProduct',['slug'=>$tag->slug]) }}">
            {{ $tag->name }}
          </a>
        </li>
        @endforeach
      </ul>
    </p>
  </div>
  <!--/product-information-->
</div>
</div>
<!--/product-details-->

@include('homePartials.product_details_tab')

<!--recommended_items-->
<div class="recommended_items">
  <!--recommended_items-->
  <h2 class="title text-center">Sản phẩm gợi ý</h2>

  <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      @foreach ($productCategories as $key => $pro)
      @if ($key % 3 == 0)
      <div class="item {{ $key == 0 ? 'active' : '0' }}">
        @endif
        <div class="col-sm-4">
          <div class="product-image-wrapper">
            <div class="single-products">

              <div class="productinfo text-center">
                <img src="/uploads/products/{{ $pro->user_id }}/{{ $pro->product_image }}" alt="" />
                <h2>${{ number_format($pro->product_price) }}</h2>
                <p>{{ $pro->product_name }}</p>
                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
              </div>

            </div>
          </div>
        </div>
        @if ($key % 3 == 2)
      </div>
      @endif
      @endforeach

    </div>
    <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
      <i class="fa fa-angle-left"></i>
    </a>
    <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
      <i class="fa fa-angle-right"></i>
    </a>
  </div>
</div>
<!--/recommended_items-->

@endsection