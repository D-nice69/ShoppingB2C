@extends('layouts.home')
@section('title')
Eshop | {{ $getProduct->product_name }}
@endsection
@section('slider')
@include('homePartials.slider')
@endsection
@section('left_side_bar')
@include('homePartials.left_sidebar')
@endsection
@section('css')
<style>
  .cart {
    margin-left: 0px;
  }

  .product-information {
    padding-top: 0px;
  }
</style>
@endsection
@section('content')

</div>
<div class="product-details">
  <!--product-details-->
  <div class="col-sm-5">
    <div class="view-product">
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
    </div>

  </div>
  <div class="col-sm-7">
    <div class="product-information">
      <!--/product-information-->
      <h2>{{ $getProduct->product_name }}</h2>
      <p> Mã sản phẩm: {{ $getProduct->id }}</p>
      <span>
        <span>{{ number_format($getProduct->product_price) }} VNĐ</span>
        <label>Số lượng:</label>
        <form action="{{ route('cart.add') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="number" name="qty" value="1" min="1" />
          <input type="hidden" name="productid_hidden" value="{{ $getProduct->id }}">
          <button type="submit" class="btn btn-fefault cart">
            <i class="fa fa-shopping-cart"></i>
            Thêm giỏ hàng
          </button>
      </span>
      </form>
      <p><b>Còn hàng:</b> Còn</p>
      <p><b>Điều kiện:</b> Mới</p>
      <p><b>Danh mục:</b> {{ $getProduct->category->category_name }}</p>
      <p><b>Thương hiệu:</b> {{ $getProduct->brand->brand_name }}</p>
      <div class="fb-like" data-href="{{ $url_canonical }}" data-width="" data-layout="button_count"
        data-action="like"  data-size="small" data-share="true"></div>
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
                <img src="/uploads/products/{{ $pro->product_image }}" alt="" />
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