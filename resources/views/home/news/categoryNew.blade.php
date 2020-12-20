@extends('layouts.home')
@section('css')
<style>
    p.pNew {
        color: black;
    }
</style>
@endsection
@section('title')
Eshop | News
@endsection
@section('slider')
@include('homePartials.slider')
@endsection
@section('left_side_bar')
@include('homePartials.left_sidebar')
@endsection
@section('content')
<div class="features_items">
    <h2 class="title text-center">{{ $category->name }}</h2>
    @foreach($categoryPosts as $new)
    <div class="col-sm-12" style="padding: 15px 0px;">
        <a href="{{ route('home.newDetails',['slug'=>$new->slug]) }}">
    <div class="col-sm-4" style="height: 200px">
        <img src="/uploads/posts/{{ $new->image }}" alt="" style='height: 100%; width: 100%; object-fit: contain'>
    </div>
    <div class="col-sm-7">
        <div class="col-sm-12">
            <p class="pNew">
                <h4 class="text-center">
                    {{ $new->title }}
                </h4>
            </p>
        </div>
        <div class="col-sm-12">
            <p class="pNew">
                {{ $new->description }}
            </p>
        </div>
    </div>
    </a>
</div>
@endforeach

<div class="col-sm-12 text-center text-center-xs">
    {{$categoryPosts->links()}}
</div>
</div>
@endsection