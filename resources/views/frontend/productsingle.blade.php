<?php
$keywords="";$metadesc="";$images="";$price;$code="";$related_article="";

if(!empty($prodmeta)){
    foreach($prodmeta as $pm){

        if($pm->meta_key=='keywords')
            $keywords = $pm->meta_value;
        if($pm->meta_key=='metadesc')
            $metadesc = $pm->meta_value;
        if($pm->meta_key=='images')
            $images = $pm->meta_value;
        if($pm->meta_key=='price')
            $price = $pm->meta_value;
        if($pm->meta_key=='code')
            $code = $pm->meta_value;
        if($pm->meta_key=='related_article')
            $related_article = unserialize($pm->meta_value);
    }
}


?>

@extends('frontend.layouts.app')

@section('title', app_name() . ' | Thanka -' .$product->title)
@if(!empty($metadesc))
@section('meta_description', $metadesc)
@else
    @section('meta_description', ' Ritual Thanka')
@endif
@section('meta_author', 'Ritual Thanka, Contact us')

@section('content')
    <section class="breadcrumb-block padding-top">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="JavaScript:Void(0)">Thanka</a></li>
                    <li class="breadcrumb-item current-menu-item"><a href="{{ url("/product/".$product->clean_url) }}">{{$product->title}}</a></li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="single_product padding">
        <div class="container">
            <div class="detail_product">
                <div class="row">
                    <div class="col-md-7">
                        <div class="left-slide">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="slicknav slider">
                                        <div class="slick-item">
                                            <figure>
                                                <img class="img-responsive" src="{{ URL::to($product->image) }}" alt="">
                                            </figure>
                                        </div>
                                        <?php
                                        if($images!=""){
                                            $imgArr = unserialize($images);
                                            foreach($imgArr as $img)

                                                {
                                        if(!empty($img)){
                                        ?>
                                                    <div class="slick-item">
                                                        <figure>
                                                            <img class="img-responsive" src="{{ URL::to($img) }}" alt="1">
                                                        </figure>
                                                    </div>
                                                <?php
                                        }
                                        }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="singleslide slider">
                                        <div id="demo" class="zoom" data-image="{{ URL::to($product->image) }}">
                                            <figure>
                                                <img class="img-responsive" src="{{ URL::to($product->image) }}" alt="1">
                                            </figure>
                                            <div id="preview-zoom"></div>
                                        </div>
                                        <?php
                                            if($images!=""){
                                            $imgArr = unserialize($images);

                                            foreach($imgArr as $img)
                                            {
                                            if(!empty($img)){
                                            ?>

                                                <div id="demo" class="zoom" data-image="{{ URL::to($img) }}">
                                                    <figure>
                                                        <img class="img-responsive" src="{{ URL::to($img) }}" alt="1">
                                                    </figure>
                                                    <div id="preview-zoom"></div>
                                                </div>
                                            <?php }
                                            }
                                            }
                                        ?>

                                    </div>
                                    <div id="container-zoom">
                                        <div id="window-zoom" style="display:none;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="sp_right">
                            <form action="{{url('add-to-cart')}}" name="addtocart" id="addtocart" method="post">
                                {!! csrf_field() !!}
                                <h1>{{$product->title}}</h1>
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <h5>Price :
                                    {{ App\Http\Controllers\Frontend\ProductController::getthankaprice($product->id,'single') }}

                                </h5>
                                <p>{{$product->excerpt}}</p>

                                @if($totalstock>0)
                                    <div class="cart_form">
                                        <p>Qty:</p>
                                        <div class="form-group d-flex justify-content-center">
                                            <div class="quantity">
                                                <input type="number" name="qty" min="1" max="{!! $totalstock !!}" step="1" value="1"><div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>
                                            </div>
                                            <button class="btn btn-primary"><i class="fa fa-cart-arrow-down"></i> Add to Cart</button>
                                        </div>
                                    </div>
                                 @endif

                                <div class="pro_details">

                                    <div class="product-code d-flex justify-content-between">
                                        @if(!empty($code))
                                        <p>Product Code : <span>{{$code}}</span></p>
                                        @endif
                                        <div class="social social-roll">
                                            <span class='st_sharethis_hcount' displayText='ShareThis'><i class="fa fa-share-alt"></i> Share</span>
                                        </div>
                                    </div>
                                    <div class="product-form-group d-flex justify-content-between">
                                        <div class="form-group d-flex">
                                            <label>Brocade</label>
                                            <select class="form-control" id="brocade" name="brocade" placeholder="" required="" onchange="getbrocadeHandle();">
                                                <option value="">None</option>
                                                @if(!empty($brodaces))
                                                        @foreach($brodaces as $brocade)
                                                            <option value="{!! $brocade->id !!}">{!! $brocade->title !!}</option>
                                                        @endforeach
                                                @endif

                                            </select>
                                        </div>
                                        <div class="form-group d-flex">
                                            <label>Handle</label>
                                            <select class="form-control" id="handle" name="handle" placeholder="" required="" onchange="getbrocadeHandle();">
                                                <option value="">None</option>
                                                @if(!empty($handles))
                                                    @foreach($handles as $handle)
                                                        <option value="{!! $handle->id !!}">{!! $handle->title !!}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="p_discription">
                    <div class="col-md-10 m-auto">
                        <h4 class="fa-4">Description</h4>
                        <div class="dis_item">
                            {!! $product->content !!}
                        </div>
                        <?php
                            if($related_article!=""){
                                foreach($related_article as $article){
                                   ?>
                                {{ App\Http\Controllers\Frontend\ProductController::get_all_article($article) }}
                               <?php  }
                            }
                        ?>

                    </div>
                </div>
            </div>
            <?php //include('components/relatedproduct/relatedproduct.php') ?>
        </div>
    </section>

@endsection
@section('after-scripts')
    <script>
        function getbrocadeHandle(){
            
            var brocade = $('#brocade').val();
            var handle = $('#handle').val();
            var price = $('#price').data('orgprice');
            //alert(brocade+' '+handle);

            //alert(price);

            $.ajax({
                url:'{{route('frontend.brocadehandle')}}',
                method: 'POST',
                data :{price:price,brocade:brocade, handle:handle, _token:"{{csrf_token()}}"},
                dataType : 'text',
                success:function(data){
                 console.log(data);
                }
            });



        }
    </script>
@endsection