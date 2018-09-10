@if(!$onsales->isEmpty())
    <section class="featureproduct padding-bottom">
        <div class="container">
            <div class="section-title text-center">
                <h2 class="fa-4 title">On Sale</h2>
            </div>
            <div class="grid">
                <div class="grid-sizer col-lg-3 col-md-3 col-sm-6 col-xs-6"></div>

                @foreach($onsales as $onsale )
                    <div class="grid-item col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <article>
                            <figure>
                                @if(!empty($onsale->image))
                                <img class="img-responsive" src="{{ URL::to($onsale->image) }}" alt="{{ $onsale->title }}" onclick="gotopage('{{ route('frontend.product',$onsale->clean_url) }}')">
                                @endif
                            </figure>
                            <figcaption>
                                <a href="{{ route('frontend.product',$onsale->clean_url) }}">{{ $onsale->title }}</a>
                                <h5>Price :
                                    {{ App\Http\Controllers\Frontend\ProductController::getthankaprice($onsale->id,'list') }}
                                </h5>
                            </figcaption>
                        </article>
                    </div>

                 @endforeach

            </div>
            <div class="more text-center">
                <a href="{{ route('frontend.saleProduct') }}" class="btn btn-secondary">View More</a>
            </div>
        </div>
    </section>
@endif
