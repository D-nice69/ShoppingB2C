<div class="category-tab shop-details-tab">
    <!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#Description" data-toggle="tab">Mô tả</a></li>
            <li><a href="#Detail" data-toggle="tab">Chi tiết sản phẩm</a></li>
            <li><a href="#reviews" data-toggle="tab">Bình luận (5)</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="Description">
            <div class="col-sm-12">
                {!! $getProduct->product_desc !!}
            </div>
        </div>

        <div class="tab-pane fade" id="Detail">
            <div class="col-sm-12">
                {!! $getProduct->product_content !!}
            </div>
        </div>

        <div class="tab-pane fade" id="reviews">            
            <div class="col-sm-12">
                <div class="fb-comments" data-width="100%" data-href="{{ $url_canonical }}" data-numposts="20" data-width=""></div>
            </div>            
        </div>

    </div>
</div>
<!--/category-tab-->