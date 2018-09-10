@if(!$latests->isEmpty())
    <section class="latest_product light-bg padding">
        <div class="container">
            <div class="section-title text-center">
                <h2 class="fa-5 title">Latest Thangkas</h2>
            </div>
            <div class="row">
                <div class="col-md-10 m-auto">
                    <div class="productslide slider">
                        @foreach($latests as $latest)
                            <div class="slick-item">
                                <div class="row">
                                    <div class="col-md-9 align-self-center">
                                        <figure>
                                            @if(!empty($latest->image))
                                                <img class="img-responsive" src="{{ URL::to($latest->image) }}" alt="{{$latest->title}}" onclick="gotopage('{{ route('frontend.product',$latest->clean_url) }}')">
                                            @endif
                                        </figure>
                                    </div>
                                    <div class="col-md-3 slide_article align-self-center">
                                        <figcaption>
                                            <a href="{{ route('frontend.product',$latest->clean_url) }}">
                                                <h5 class="fa-2">{{$latest->title}}</h5>
                                            </a>

                                            <h6>Price :
                                                {{ App\Http\Controllers\Frontend\ProductController::getthankaprice($latest->id,'list') }}
                                            </h6>
                                            {{$latest->excerpt}}
                                        </figcaption>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
