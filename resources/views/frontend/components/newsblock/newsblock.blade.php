@if(!$news->isEmpty())
<section class="news_section padding-bottom">
    <div class="container">
        <div class="section-title text-center">
            <h2 class="fa-4 title">News & Events</h2>
        </div>
        <div class="row">
            <div class="col-md-10 m-auto">
                <div class="row">
                    @foreach($news as $n)
                        <div class="col-md-4">
                            <div class="news_item">
                                <figure>
                                    @if(!empty($n->image))
                                        <img src="{{ URL::to($n->image) }}" alt="{{$n->title}}" onclick="gotopage('{{ route('frontend.newsevents',$n->clean_url) }}')">
                                    @endif
                                </figure>
                                <figcaption>
                                    <a href="{{ route('frontend.newsevents',$n->clean_url) }}"><h3 class="fa-2">{{$n->title}}</h3></a>
                                        <?php $date = $n->created_at;
                                             $ndate =   date_format($date,'d M Y')
                                        ?>
                                    <em>By
                                        {{ App\Http\Controllers\Frontend\FrontendController::getAuthorName($n->userid) }}
                                        /
                                        {{$ndate}}
                                    </em>
                                    {!! $n->excerpt !!}
                                    <a class="more" href="{{ route('frontend.product',$n->clean_url) }}">Read More...</a>
                                </figcaption>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <div class="more text-center">
            <a href="#" class="btn btn-secondary">View All</a>
        </div>
    </div>
</section>

@endif