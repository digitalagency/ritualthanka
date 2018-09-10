@if(!empty($postcats))
    <section class="productcategory padding">
        <div class="container">
            <div class="grid">
                <div class="grid-sizer col-lg-3 col-md-3 col-sm-4 col-xs-6"></div>
                @foreach($postcats as $cat)
                    <div class="grid-item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                        <figure>
                            <img class="img-responsive" src="{{ URL::to($cat->image) }}" alt="{{$cat->name}}" onclick="gotopage('{{ route('frontend.category',$cat->slug) }}')">
                            {{--<figcaption>
                                <img class="img-responsive" style="width:70%" src="{{ URL::to($cat->image) }}" alt="{{$cat->name}}">
                            </figcaption>--}}
                            <a href="{{ route('frontend.category',$cat->slug) }}"><span>{{$cat->name}}</span></a>
                        </figure>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
