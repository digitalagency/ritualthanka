@if(!$articles->isEmpty())
    <section class="blog_section padding-bottom">
        <div class="container">
            <div class="section-title text-center">
                <h2 class="fa-4 title">Article</h2>
            </div>
            <div class="row">
                @foreach($articles as $key => $article)
                    @if($key == 0)
                        <div class="col-md-7">
                            <div class="blog_leftaside light-bg">
                                <figure>
                                    @if(!empty($article->image))
                                    <img src="{{ URL::to($article->image) }}" alt="{{$article->title}}" onclick="gotopage('{{ route('frontend.product',$article->clean_url) }}')">
                                    @endif
                                </figure>
                                <figcaption>
                                    <a href="{{ route('frontend.product',$article->clean_url) }}"><h3>{{$article->title}}</h3></a>
                                    {!! $article->content!!}
                                </figcaption>
                            </div>
                        </div>
                    @endif

                    @if($key == 1)
                            <div class="col-md-5">
                                <div class="blog_rightaside">
                                    <span class="fa-2">You may also like...</span>
                    @endif
                                   @if($key!=0)
                                    <div class="blog_item d-md-flex">
                                        <figure>
                                            @if(!empty($article->image))
                                                <img src="{{ URL::to($article->image) }}" alt="{{$article->title}}" onclick="gotopage('{{ route('frontend.product',$article->clean_url) }}')">
                                            @endif
                                        </figure>
                                        <figcaption>
                                            <a href="{{ route('frontend.product',$article->clean_url) }}">{{$article->title}}</a>
                                        </figcaption>
                                    </div>
                                    @endif
                     @if($key == 3)
                                </div>
                            </div>
                    @endif
                @endforeach


            </div>
        </div>
    </section>


@endif
