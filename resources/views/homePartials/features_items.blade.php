<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">Sản phẩm mới nhất</h2>

    @foreach($products as $product)

    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <form>
                        @csrf
                        <input type="hidden" value="{{$product->user_id}}"
                            class="cart_product_seller_id_{{$product->id}}">
                        <input type="hidden" value="{{$product->id}}" class="cart_product_id_{{$product->id}}">
                        <input type="hidden" value="{{$product->product_name}}"
                            class="cart_product_name_{{$product->id}}">
                        <input type="hidden" value="{{$product->product_image}}"
                            class="cart_product_image_{{$product->id}}">
                        <input type="hidden" value="{{$product->product_price}}"
                            class="cart_product_price_{{$product->id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$product->id}}">
                        <a href="{{ route('home.productDetails',['slug'=>$product->slug,'id'=>$product->id]) }}">
                            <img src="/uploads/products/{{ $product->user_id }}/{{ $product->product_image }}"
                                style=" height: 300px; object-fit: cover;" alt="" />
                        </a>
                        <h2>{{ number_format($product->product_price) }} VNĐ</h2>
                        <p>{{ $product->product_name }}</p>
                        <button type="button" class="btn btn-default add-to-cart" name="add-to-cart"
                            data-id_product="{{ $product->id }}">Thêm giỏ hàng</button>
                        <button type="button" class="btn btn-default add-to-cart" data-toggle="modal"
                            data-target="#myModal_{{ $product->id }}">Xem nhanh</button>

                    </form>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal_{{ $product->id }}" role="dialog">
                        <form>
                            @csrf
                            <input type="hidden" value="{{$product->user_id}}"
                                class="cart_product_seller_id_{{$product->id}}">
                            <input type="hidden" value="{{$product->id}}" class="cart_product_id_{{$product->id}}">
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
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h3 style="color: brown;font-size:26px" class="modal-title">
                                            {{ $product->product_name }}</h3>
                                        <p>Mã sản phẩm: {{ $product->id }} </p>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <img style="width: 300px; height:100%; float:left"
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
                                                        Giá sản phẩm: {{ number_format($product->product_price) }} VNĐ
                                                    </h2>
                                                </p>
                                                <br />
                                                <p><label>Số lượng sản phẩm: </label> {{ $product->product_qty }}
                                                </p>
                                                <h4 style="text-align: left">Mô tả sản phẩm:</h4>
                                                <p><span>{!! $product->product_desc !!}</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy
                                            bỏ</button>
                                        <button type="button" class="btn btn-default add-to-cart" name="add-to-cart"
                                            data-id_product="{{ $product->id }}">Thêm giỏ hàng</button>
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
    <div class="col-md-12">
        {{ $products->links() }}
    </div>
</div>