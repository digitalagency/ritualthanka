<?php
   $options="";$related_article=""; $code="";$weight="";$size="";$material="";$price="";$keywords="";$metadesc="";$images="";
    $on_sale = "";$antique_thanka="";$popular_thanka="";$feature_thanka="";
   if(!empty($postmeta)){
       foreach($postmeta as $pm){
           if($pm->meta_key=='options')
               $options = unserialize($pm->meta_value);
           if($pm->meta_key=='code')
               $code = $pm->meta_value;
           if($pm->meta_key=='weight')
               $weight = $pm->meta_value;
           if($pm->meta_key=='size')
               $size = $pm->meta_value;
           if($pm->meta_key=='material')
               $material = $pm->meta_value;
           if($pm->meta_key=='price')
               $price = $pm->meta_value;
           if($pm->meta_key=='keywords')
               $keywords = $pm->meta_value;
           if($pm->meta_key=='metadesc')
               $metadesc = $pm->meta_value;
           if($pm->meta_key=='images')
               $images = $pm->meta_value;
           if($pm->meta_key=='related_article')
               $related_article = unserialize($pm->meta_value);
            //display options
           if($pm->meta_key=='antique_thanka')
             $antique_thanka = $pm->meta_value;
           if($pm->meta_key=='popular_thanka')
               $popular_thanka = $pm->meta_value;
           if($pm->meta_key=='feature_thanka')
               $feature_thanka = $pm->meta_value;
           if($pm->meta_key=='on_sale')
               $on_sale = $pm->meta_value;
       }
   }
?>
@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.product.management'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.product.management') }}
        <small>{{ trans('labels.backend.product.add_product') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.product.storeProduct', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}
    <div class="row">
        <div class="col-md-8">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('labels.backend.product.add_product') }}</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <input type="hidden" name="post_type" value="product">
                    <input type="hidden" name="postid" value="<?php  echo (!empty($post->id ))? $post->id : '' ?>">
                    <div class="form-group">
                        {{ Form::label('title', trans('validation.attributes.backend.access.product.title'), ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::text('title', !empty($post->title) ? $post->title : '', ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('validation.attributes.backend.access.product.title')]) }}
                        </div>
                        <!--col-lg-10-->
                    </div>
                    <!--form control-->

                    <div class="form-group">
                        {{ Form::label('slug', trans('validation.attributes.backend.access.product.slug'),
                         ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::text('slug', !empty($post->clean_url) ? $post->clean_url : '', ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => trans('validation.attributes.backend.access.product.slug')]) }}
                        </div>
                        <!--col-lg-10-->
                    </div>
                    <!--form control-->

                    <div class="form-group">
                        {{ Form::label('description', trans('validation.attributes.backend.access.product.description'),
                         ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::textarea('description', !empty($post->content) ? $post->content : '', ['class' => 'form-control tinymce']) }}

                        </div>
                        <!--col-lg-10-->
                    </div>
                    <!--form control-->


                    <div class="form-group">
                        {{ Form::label('excerpt', trans('validation.attributes.backend.access.product.excerpt'),
                         ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::textarea('excerpt', !empty($post->excerpt) ? $post->excerpt : '', ['class' => 'form-control','rows' => 3, 'cols' => 10]) }}
                        </div>
                        <!--col-lg-10-->
                    </div>
                    <!--form control-->
                </div>

            </div>

            {{--Other Images--}}
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('validation.attributes.backend.access.product.add_other_photos') }}</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div id="imageList">
                        <?php
                        if($images!=""){
                            $imgArr = unserialize($images);
                            $imgCount = 1;
                            echo '<input type="hidden" name="imgCount" id="imgCount" value="'.count($imgArr).'">';
                            foreach($imgArr as $img)
                            {?>
                                <div class="form-group img<?php echo $imgCount;?>">
                                    <div class="col-xs-8">
                                        <div class="input-group">
                                            <?php if($imgCount>1){?>
                                            <span>
                                                  <div class="delImage" data-action="<?php echo $imgCount;?>">
                                                      <i class="fa fa-fw fa-minus-circle"></i>
                                                  </div>
                                                </span>
                                            <?php } ?>
                                            <span class="input-group-btn">
                                               <a data-input="thumbinput<?php echo $imgCount;?>" data-preview="thumholder<?php echo $imgCount;?>" class="btn btn-primary uploadImage">
                                                   <i class="fa fa-picture-o"></i> Choose
                                               </a>
                                             </span>
                                            <input id="thumbinput<?php echo $imgCount;?>" class="form-control" type="text" name="imagespath[]" value="<?php  echo $img; ?>">
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <img src="<?php  echo $img; ?>" id="thumholder<?php echo $imgCount;?>" style="max-height:40px;">
                                    </div>
                                </div>
                                <!-- END of form-group-->
                                <?php
                                $imgCount++;
                            }
                        }
                        else{
                        ?>
                        <input type="hidden" name="imgCount" id="imgCount" value="1">
                        <div class="form-group img1">
                            <div class="col-xs-8">
                                <div class="input-group">
                                 <span class="input-group-btn">
                                   <a data-input="thumbinput1" data-preview="thumholder1" class="btn btn-primary uploadImage">
                                       <i class="fa fa-picture-o"></i> Choose
                                   </a>
                                 </span>
                                    <input id="thumbinput1" class="form-control" type="text" name="imagespath[]" value="">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <img id="thumholder1" style="max-height:40px;">
                            </div>
                        </div>
                        <!--form control-->
                        <?php } ?>

                    </div>



                </div>
                <div class="box-footer">
                    <button class="btn btn-success btnAddImage">Add Image</button>
                </div>

            </div>

            {{--article --}}
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('validation.attributes.backend.access.product.article') }}</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">


                        <div class="col-lg-12">
                            <div class="article-list">

                                @if(!empty($articles))
                                    <ul clas="row">
                                        @foreach ($articles as $article)
                                            @if($related_article !="")
                                                @if(in_array($article->id,$related_article))
                                                    <li class="col-md-4 col-sm-6"><label><input type="checkbox" checked name="related_article[]" value="{!! $article->id !!}"></label> {!! $article->title !!}</li>
                                                @else
                                                    <li class="col-md-4 col-sm-6"><label><input type="checkbox" name="related_article[]" value="{!! $article->id !!}"></label> {!! $article->title !!}</li>
                                                @endif
                                            @else
                                                <li class="col-md-4 col-sm-6"><label><input type="checkbox" name="related_article[]" value="{!! $article->id !!}"></label> {!! $article->title !!}</li>
                                            @endif
                                        @endforeach
                                    </ul>

                                @endif
                            </div>
                        </div><!--col-lg-1-->
                    </div><!--form control-->

                </div>
                <!-- /.box-body -->
            </div><!--box-->



        </div>

        <div class="col-md-4">
            {{--Publish Unpublish--}}
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('validation.attributes.backend.access.product.publish') }}</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">


                        <div class="col-lg-12">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="status" id="status" value="1" <?php echo(isset($post->status)&&(($post->status)=="1"))?"checked":"checked"; ?>>
                                    Publish
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="status" id="status" value="0" <?php echo(isset($post->status)&&(($post->status)=="0"))?"checked":""; ?>>
                                    Unpublish
                                </label>
                            </div>
                        </div><!--col-lg-1-->
                    </div><!--form control-->

                    <div class="box-body">
                        <div class="pull-left">
                            {{ link_to_route('admin.product.prodIndex', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger']) }}
                        </div>
                        <!--pull-left-->

                        <div class="pull-right">
                            @if(!empty($post->id))
                                {{ Form::submit(trans('buttons.general.crud.edit'), ['class' => 'btn btn-success']) }}
                            @else
                                {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success']) }}
                            @endif
                        </div>
                        <!--pull-right-->

                        <div class="clearfix"></div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div><!--box-->


            {{--Featured Image--}}
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('validation.attributes.backend.access.product.photo') }}</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <div class="col-lg-12">
                            <div class="input-group">
                                    <span class="input-group-btn">
                                     <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                         <i class="fa fa-picture-o"></i> Choose
                                     </a>
                                   </span>

                                {{ Form::text('image', !empty($post->image) ? $post->image : '', ['class' => 'form-control', 'id'=>'thumbnail', 'placeholder' => trans('validation.attributes.backend.access.product.photo')]) }}
                            </div>
                            @if(!empty($post->image))
                                <img id="holder" style="margin-top:15px;max-height:100px;" src="{{ URL::to($post->image) }}">
                            @else
                                <img id="holder" style="margin-top:15px;max-height:100px;">
                            @endif

                        </div>
                        <!--col-lg-10-->

                    </div>

                </div>
                <!-- /.box-body -->
            </div><!--box-->


            {{--Category --}}
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('validation.attributes.backend.access.product.category') }}</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">


                        <div class="col-lg-12">
                            <div class="category-list">
                                {!! $ddlCat !!}
                            </div>
                        </div><!--col-lg-1-->
                    </div><!--form control-->

                </div>
                <!-- /.box-body -->
            </div><!--box-->

            {{--Display options--}}
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Display Options</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <div class="form-group">
                        {{ Form::label('title', 'Antique Thanka', ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            <?php
                            if( ($antique_thanka=="1"))
                            {
                                $atyeschecked = "checked";
                                $atnochecked = "";
                            }
                            elseif( ($antique_thanka=="0")){
                                $atyeschecked = "";
                                $atnochecked = "checked";
                            }
                            else{
                                $atyeschecked = "";
                                $atnochecked = "checked";
                            }
                            ?>
                            <div class="radio">

                                <label>
                                    <input type="radio" name="antique_thanka" id="status" value="1" <?php echo $atyeschecked; ?> >
                                    Yes
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="antique_thanka" id="status" value="0" <?php echo $atnochecked; ?> >
                                    No
                                </label>
                            </div>
                        </div>
                        <!--col-lg-10-->
                    </div>
                    <div class="form-group">
                        {{ Form::label('title', 'Popular Thanka', ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            <?php
                            if( ($popular_thanka=="1"))
                            {
                                $ptyeschecked = "checked";
                                $ptnochecked = "";
                            }
                            elseif( ($popular_thanka=="0")){
                                $ptyeschecked = "";
                                $ptnochecked = "checked";
                            }
                            else{
                                $ptyeschecked = "";
                                $ptnochecked = "checked";
                            }
                            ?>
                            <div class="radio">

                                <label>
                                    <input type="radio" name="popular_thanka"  value="1" <?php echo $ptyeschecked;?>>
                                    Yes
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="popular_thanka" value="0" <?php echo $ptnochecked?>>
                                    No
                                </label>
                            </div>
                        </div>
                        <!--col-lg-10-->
                    </div>

                    <div class="form-group">
                        {{ Form::label('title', 'Featured Thanka', ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            <?php
                            if( ($feature_thanka=="1"))
                            {
                                $ftyeschecked = "checked";
                                $ftnochecked = "";
                            }
                            elseif( ($feature_thanka=="0")){
                                $ftyeschecked = "";
                                $ftnochecked = "checked";
                            }
                            else{
                                $ftyeschecked = "";
                                $ftnochecked = "checked";
                            }
                            ?>
                            <div class="radio">

                                <label>
                                    <input type="radio" name="feature_thanka"  value="1" <?php echo $ftyeschecked;?> >
                                    Yes
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="feature_thanka" value="0" <?php echo $ftnochecked?>>
                                    No
                                </label>
                            </div>
                        </div>
                        <!--col-lg-10-->
                    </div>

                    <div class="form-group">
                        {{ Form::label('title', 'On Sale', ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            <?php
                            if( ($on_sale=="1"))
                            {
                                $osyeschecked = "checked";
                                $osnochecked = "";
                            }
                            elseif( ($on_sale=="0")){
                                $osyeschecked = "";
                                $osnochecked = "checked";
                            }
                            else{
                                $osyeschecked = "";
                                $osnochecked = "checked";
                            }
                            ?>
                            <div class="radio">

                                <label>
                                    <input type="radio" name="on_sale"  value="1"  <?php echo $osyeschecked;?>>
                                    Yes
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="on_sale"  value="0" <?php echo $osnochecked;?>>
                                    No
                                </label>
                            </div>
                        </div>
                        <!--col-lg-10-->
                    </div>

                </div>
                <!-- /.box-body -->
            </div><!--box-->

            {{--Attributes --}}
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('validation.attributes.backend.access.product.attributes') }}</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        {{ Form::label('code', trans('validation.attributes.backend.access.product.code'),
                         ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::text('code', $code, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.product.code')]) }}
                        </div>
                        <!--col-lg-10-->
                    </div>
                    <!--form control-->

                    <div class="form-group">
                        {{ Form::label('weight', trans('validation.attributes.backend.access.product.weight'),
                         ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::text('weight', $weight, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.product.weight')]) }}
                        </div>
                        <!--col-lg-10-->
                    </div>
                    <!--form control-->

                    <div class="form-group">
                        {{ Form::label('size', trans('validation.attributes.backend.access.product.size'),
                         ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::text('size', $size, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.product.size')]) }}
                        </div>
                        <!--col-lg-10-->
                    </div>
                    <!--form control-->

                    <div class="form-group">
                        {{ Form::label('material', trans('validation.attributes.backend.access.product.material'),
                         ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::text('material', $material, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.product.material')]) }}
                        </div>
                        <!--col-lg-10-->
                    </div>
                    <!--form control-->

                    {{--<div class="form-group">
                        {{ Form::label('price', trans('validation.attributes.backend.access.product.price'),
                         ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::text('price', $price, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.product.price')]) }}
                        </div>

                    </div>--}}
                    <!--form control-->
                </div>
                <!-- /.box-body -->
            </div><!--box-->

            {{--Stock--}}
            @if($pc == 'new')
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Stocks for </h3>
                </div>

                <div class="box-body">


                    <input type="hidden" name="pc" value="{{ $pc }}">
                    <div class="form-group">
                        {{ Form::label('org_stock', 'Stock', ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::number('org_stock', '' , ['class' => 'form-control', 'min' => '0', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => 'Stock']) }}
                        </div>
                        <!--col-lg-12-->
                    </div>

                    <div class="form-group">
                        {{ Form::label('cost_price', 'Cost Price', ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::number('cost_price', '' , ['class' => 'form-control', 'min' => '0', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => 'Cost Price']) }}
                        </div>
                        <!--col-lg-12-->
                    </div>

                    <div class="form-group">
                        {{ Form::label('selling_price', 'Selling Price', ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::number('selling_price', '' , ['class' => 'form-control', 'min' => '0', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => 'Selling Price']) }}
                        </div>
                        <!--col-lg-12-->
                    </div>

                    <div class="form-group">
                        {{ Form::label('bought_date', 'Bought Date', ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::text('bought_date', '' , ['class' => 'form-control', 'id'=>'bought_date', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => 'Bought Date']) }}
                        </div>
                        <!--col-lg-12-->
                    </div>


                </div>
            </div>
            @endif
            {{--Seo --}}
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('validation.attributes.backend.access.product.seo') }}</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        {{ Form::label('keywords', trans('validation.attributes.backend.access.product.keywords'),
                         ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::text('keywords', $keywords, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.product.keywords')]) }}
                        </div>
                        <!--col-lg-10-->
                    </div>
                    <!--form control-->

                    <div class="form-group">
                        {{ Form::label('metadesc', trans('validation.attributes.backend.access.product.metadesc'),
                         ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::text('metadesc', $metadesc, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.product.metadesc')]) }}
                        </div>
                        <!--col-lg-10-->
                    </div>
                    <!--form control-->

                </div>
                <!-- /.box-body -->
            </div><!--box-->


        </div>
    </div>



    {{ Form::close() }}
@endsection
