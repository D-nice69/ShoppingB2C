<div class="left-sidebar">
    <h2>Danh mục</h2>
    <div class="panel-group category-products" id="accordian">
        <!--category-productsr-->
        {{-- <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                        Sportswear
                    </a>
                </h4>
            </div>
            <div id="sportswear" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul>
                        <li><a href="#">Nike </a></li>
                        <li><a href="#">Under Armour </a></li>
                        <li><a href="#">Adidas </a></li>
                        <li><a href="#">Puma</a></li>
                        <li><a href="#">ASICS </a></li>
                    </ul>
                </div>
            </div>
        </div> --}}
        @foreach($categories as $category)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a href="{{ route('home.categoryProduct',['slug'=>$category->slug]) }}">{{ $category->category_name }}
                    </a>
                </h4>
            </div>
        </div>
        @endforeach
    </div>
    <!--/category-products-->

    <div class="brands_products">
        <!--brands_products-->
        <h2>Thương hiệu</h2>
        <div class="brands-name">
            <ul class="nav nav-pills nav-stacked">
                @foreach($brands as $brand)
                <li>
                    <a href="{{ route('home.brandProduct',['slug'=>$brand->slug]) }}"> <span
                        class="pull-right">({{ count($brand->products) }})</span>{{ $brand->brand_name }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <!--/brands_products-->

    <div class="price-range">
        <!--price-range-->
        <h2>Giá giao động</h2>
        <div class="well text-center">
            <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5"
                data-slider-value="[250,450]" id="sl2"><br />
            <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
        </div>
    </div>
    <!--/price-range-->

    <div class="shipping text-center">
        <!--shipping-->
        <img src="images/home/shipping.jpg" alt="" />
    </div>
    <!--/shipping-->

</div>