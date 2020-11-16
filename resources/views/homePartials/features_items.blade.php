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
                        <input type="hidden" value="{{$product->user_id}}" class="cart_product_seller_id_{{$product->id}}">
                        <input type="hidden" value="{{$product->id}}" class="cart_product_id_{{$product->id}}">
                        <input type="hidden" value="{{$product->product_name}}"
                            class="cart_product_name_{{$product->id}}">
                        <input type="hidden" value="{{$product->product_image}}"
                            class="cart_product_image_{{$product->id}}">
                        <input type="hidden" value="{{$product->product_price}}"
                            class="cart_product_price_{{$product->id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$product->id}}">
                        <a href="{{ route('home.productDetails',['slug'=>$product->slug]) }}">
                            <img src="/uploads/products/{{ $product->product_image }}"
                                style=" height: 300px; object-fit: cover;" alt="" />
                        </a>
                        <h2>{{ number_format($product->product_price) }} VNĐ</h2>
                        <p>{{ $product->product_name }}</p>
                        <button type="button" class="btn btn-default add-to-cart" name="add-to-cart"
                            data-id_product="{{ $product->id }}">Thêm giỏ hàng</button>
                    </form>
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