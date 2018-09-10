@extends('frontend.layouts.app')

@section('title', app_name() . ' | About Us')

@section('meta_description', ' Ritual Thanka, About us')
@section('meta_author', 'Ritual Thanka, About us')

@section('content')
    <section class="breadcrumb-block padding-top">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
                    <li class="breadcrumb-item current-menu-item"><a href="{{ route('frontend.about') }}">About Us</a></li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="aboutblock padding">
        <div class="container">
            <h1 class="inner_title text-center">Who We Are ?</h1>

            <div class="row">
                <div class="col-md-6">
                    <div class="left_aside">
                        <p>We strive to provide our customers with authentic and high quality thangka paintings so that we can preserve and share this ancient form of art with all the spiritual followers and art lovers all over the world. We strive to provide our customers with authentic and high quality thangka paintings.</p>
                        <p>So that we can preserve and share this ancient form of art with all the spiritual followers and art lovers all over the world.We strive to provide our customers with authentic and high quality thangka paintings so that we can preserve and share this ancient form of</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right_aside">
                        <p>So that we can preserve and share this ancient form of art with all the spiritual followers and art lovers all over the world.We strive to provide our customers with authentic and high quality thangka paintings so that we can preserve and share this ancient form of art with all the spiritual followers and art lovers all over the world.</p>
                        <p>We strive to provide our customers with authentic and high quality thangka paintings so that we can preserve and share this ancient form of art with all the spiritual followers and art lovers all over the world. We strive to provide our customers with authentic and high quality thangka paintings.</p>
                    </div>
                </div>
            </div>
            <div class="more text-center">
                <a href="#" class="btn btn-secondary">Load more</a>
            </div>
        </div>
    </section>

@endsection