@if(!$fthankas->isEmpty())

@endif
<section class="featureproduct padding-bottom">
    <div class="container">
        <div class="section-title text-center">
            <h2 class="fa-4 title">Featured Thangkas</h2>
        </div>
        <div class="grid">
            <div class="grid-sizer col-lg-3 col-md-3 col-sm-6 col-xs-6"></div>
            @foreach($fthankas as $fthanka)
                <div class="grid-item col-lg-3 col-md-3 col-sm-6 col-xs-6">
                    <article>
                        <figure>
                            @if(!empty($fthanka->image))
                            <img class="img-responsive" src="{{ URL::to($fthanka->image) }}" alt="{{$fthanka->title}}" onclick="gotopage('{{ route('frontend.product',$fthanka->clean_url) }}')">
                            @endif
                        </figure>
                        <figcaption>
                            <a href="{{ route('frontend.product',$fthanka->clean_url) }}">{{$fthanka->title}}</a>
                            <h5>Price :
                                {{ App\Http\Controllers\Frontend\ProductController::getthankaprice($fthanka->id,'list') }}

                            </h5>
                        </figcaption>
                    </article>
                </div>
            @endforeach
        </div>
        <div class="more text-center">
            <a href="{{ route('frontend.featuredProduct') }}" class="btn btn-secondary">View More</a>
        </div>
    </div>
</section>