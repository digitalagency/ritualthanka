@extends('frontend.layouts.app')

@section('meta_description', ' Ritual Thanka')
@section('meta_author', 'Ritual Thanka')

@section('content')
    @include('frontend.components.bannerblock.homebanner')

    @include('frontend.components.productcategory.productcategory')

    @include('frontend.components.featureproduct.featureproduct')

    @include('frontend.components.latestproduct.latestproduct')

    @include('frontend.components.newproductblock.newproductblock')

    @include('frontend.components.videoblock.videoblock')

    @include('frontend.components.sellingproduct.sellingproduct')

    @include('frontend.components.blogblock.blogblock')

    {{--@include('frontend.components.orderblock.orderblock')--}}

    @include('frontend.components.newsblock.newsblock')

@endsection

@section('after-scripts')

@endsection