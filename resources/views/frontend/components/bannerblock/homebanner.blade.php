@if(!empty($homebanner))

    <section class="homebanner_block">
        <div class="contianer-fluid">
            <div class="banner slider">
                @foreach ($homebanner as $banner)
                    <div class="slick-item">
                        <figure>
                            <div class="banner-overlay">
                                <img class="img-responsive" src="{{ URL::to($banner->image) }}" alt="{!! $banner->title !!}">
                            </div>
                        </figure>
                        <figcaption>
                            <div class="caption">
                                <h1 class="fig-containt fa-6 wow slideDown">Ritual Thanka</h1>
                                <P>{!! $banner->title !!}</P>
                            </div>
                        </figcaption>
                    </div>
                @endforeach

            </div>
        </div>
    </section>


@endif
