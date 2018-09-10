<section class="new_product featureproduct padding">
    <div class="container">
        <div class="row">
            @if(!$pthankas->isEmpty())
                <div class="col-md-6">
                    <div class="popular_product">
                        <div class="section-title text-center">
                            <h2 class="fa-4 title">Popular Thangkas</h2>
                        </div>
                        <div class="grid">
                            <div class="grid-sizer col-lg-1 col-md-2 col-sm-2 col-xs-6"></div>
                            @foreach($pthankas as $pthanka)
                                <div class="grid-item col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <article>
                                        <figure>
                                            @if(!empty($pthanka->image))
                                            <img class="img-responsive" src="{{ URL::to($pthanka->image) }}" alt="{{$pthanka->title}}" onclick="gotopage('{{ route('frontend.product',$pthanka->clean_url) }}')">
                                            @endif
                                        </figure>
                                        <figcaption>
                                            <a href="{{ route('frontend.product',$pthanka->clean_url) }}">{{$pthanka->title}}</a>
                                            <h5>Price :
                                                {{ App\Http\Controllers\Frontend\ProductController::getthankaprice($pthanka->id,'list') }}
                                            </h5>
                                        </figcaption>
                                    </article>
                                </div>
                            @endforeach

                        </div>
                        <div class="more text-center">
                            <a href="{{ route('frontend.popularProduct') }}" class="btn btn-secondary">View More</a>
                        </div>
                    </div>
                </div>
            @endif

            @if(!$athankas->isEmpty())
                    <div class="col-md-6">
                        <div class="popular_product">
                            <div class="section-title text-center">
                                <h2 class="fa-4 title">Old Thangkas</h2>
                            </div>
                            <div class="grid">
                                <div class="grid-sizer col-lg-1 col-md-2 col-sm-2 col-xs-6"></div>
                                @foreach($athankas as $athanka)
                                    <div class="grid-item col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <article>
                                            <figure>
                                                @if(!empty($athanka->image))
                                                <img class="img-responsive" src="{{ URL::to($athanka->image) }}" alt="{{$athanka->title}}" onclick="gotopage('{{ route('frontend.product',$athanka->clean_url) }}')">
                                                @endif
                                            </figure>
                                            <figcaption>
                                                <a href="{{ route('frontend.product',$athanka->clean_url) }}">{{$athanka->title}}</a>
                                                <h5>Price :
                                                    {{ App\Http\Controllers\Frontend\ProductController::getthankaprice($athanka->id,'list') }}
                                                </h5>
                                            </figcaption>
                                        </article>
                                    </div>
                                @endforeach
                            </div>
                            <div class="more text-center">
                                <a href="{{ route('frontend.oldProduct') }}" class="btn btn-secondary">View More</a>
                            </div>
                        </div>
                    </div>
            @endif

        </div>
    </div>
</section>