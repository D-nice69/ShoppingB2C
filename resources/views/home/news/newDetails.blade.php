@extends('layouts.news')
@section('css')
<style>
    div.nContent>p>img {
        max-width: 100%;
        max-height: 100%;
    }
</style>
@endsection
@section('title')
Eshop | News
@endsection
@section('content')
<div class="features_items">

    <div class="col-sm-2">
        ADS
    </div>
    <div class="col-sm-8 nContent">
        {!! $new->content !!}
        <br>


    </div>
    <div class="col-sm-2">
        ADS
    </div>
    <div class="col-sm-12" style="width: 66%;    margin-left: 16%;">
        <div class="recommended_items">
            <!--recommended_items-->
            <h2 class="title text-center">Tin liên quan</h2>

            <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($news as $key => $new)
                    @if ($key % 3 == 0)
                    <div class="item {{ $key == 0 ? 'active' : '0' }}">
                        @endif
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <a href="">
                                        <div class="productinfo text-center">
                                            <img src="/uploads/posts/{{ $new->image }}" alt="" height="100px" style="width: 60%" />
                                            <h5>{{ $new->title }}</h5>
                                        </div>
                                    </a>
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
    </div>
    <div class="col-sm-8" style=" margin-left: 16%;">
        <div class="fb-comments" data-href="{{ $url_canonical }}" data-numposts="10" data-width="100%"></div>
    </div>
</div>
<br>
@endsection