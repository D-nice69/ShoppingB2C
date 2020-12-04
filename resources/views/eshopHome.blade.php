@extends('layouts.home')
@section('title')
Eshop | Trang chủ
@endsection
@section('slider')
@include('homePartials.slider')
@endsection
@section('left_side_bar')
@include('homePartials.left_sidebar')
@include('homePartials.left_sidebar_price')
@include('homePartials.left_sidebar_ads')
@endsection
@section('content')
@include('homePartials.features_items')
<!--features_items-->
<!--category-tab-->
@include('homePartials.category_tab')
<!--/category-tab-->
<!--recommended_items-->
@include('homePartials.recommended_items')
<!--/recommended_items-->

@endsection