@extends('frontend.layouts.app')

@section('title', app_name() . ' | '.$title)

@section('meta_description', ' Ritual Thanka, Product, Category')
@section('meta_author', 'Ritual Thanka, Product, Category')

@section('content')
    <section class="breadcrumb-block padding-top">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>

                    <li class="breadcrumb-item current-menu-item"><a href="">{{$title}}</a></li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="featureproduct padding">
        <div class="container">
            <div class="grid">
                <div class="grid-sizer col-lg-3 col-md-3 col-sm-6"></div>
                @forelse ($catproducts as $product)
                    <div class="grid-item col-lg-3 col-md-3 col-sm-6">
                        <article>
                            <figure>
                                <img class="img-responsive" src="{{ URL::to($product->image) }}" alt="{{$product->title}}" onclick="gotopage('{{ route('frontend.product',$product->clean_url) }}')">
                            </figure>
                            <figcaption>
                                <a href="{{ route('frontend.product',$product->clean_url) }}">{{$product->title}}</a>
                                <h5>Price :
                                    {{ App\Http\Controllers\Frontend\ProductController::getthankaprice($product->id,'list') }}
                                    {{--<span>
                                        $200

                                    </span>--}}
                                </h5>
                            </figcaption>
                        </article>
                    </div>
                @empty
                    no products
                @endforelse
            </div>
        </div>
    </section>

    <section class="pagination-block text-center">
        <div class="container">
            <nav>
                {{$catproducts->links('frontend.partials.paginators')}}

            </nav>
        </div>
    </section>

@endsection