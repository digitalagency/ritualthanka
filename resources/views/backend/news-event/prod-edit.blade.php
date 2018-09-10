<?php
   $options="";$code="";$weight="";$size="";$material="";$price="";$keywords="";$metadesc="";$images="";

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
                        {{ Form::label('excerpt', trans('validation.attributes.backend.access.product.slug'),
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


            {{--Options--}}
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('validation.attributes.backend.access.product.prod_options') }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body" id="option-list">
                    <?php $optionCount=2; ?>
                    <div class="option-box optList1">
                        <input type="hidden" name="optionNumber" id="optionNumber" value="1">
                        <input type="hidden" name="valueCount1" id="valueCount1" value="1">
                        <div class="form-group">
                            <label for="option1name" class="col-sm-12 control-label lft-align">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="optName[]" placeholder="Option Name">
                            </div>
                        </div>
                        <div class="form-group option1value1">
                            <label class="col-sm-12 control-label lft-align">Value</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control opt-val mar-rht-10" name="optValue1[]" placeholder="value">
                                <input type="text" class="form-control opt-val mar-rht-10" name="optPrice1[]" placeholder="price">
                                <div class="wid20">
                                    <div class="fa-add-but">
                                        <a data-optioncount="1" data-valuecount="1" class="btn btn-primary addOptValue">
                                            <i class="fa fa-fw fa-plus-circle"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- END of form-group-->
                    </div>

                </div>

                <div class="box-footer">
                    <button class="btn btn-success btnAddOption" id="optCount" data-optioncount=<?php echo $optionCount;?>>Add Option</button>
                </div>

            </div>

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
                                <?php
                                    if(!empty($post->status)){
                                        if($post->status==1){
                                            $published = "checked";
                                            $unpublished = "";
                                        }else{
                                            $published = "";
                                            $unpublished = "checked";
                                        }
                                    }
                                    else{
                                        $published = "checked";
                                        $unpublished = "";
                                    }
                                ?>
                                <label>
                                    <input type="radio" name="status" id="status" value="1" <?php echo(!empty($post->status)&&($post->status=="1"))?"checked":"checked"; ?>>
                                    Publish
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="status" id="status" value="0" <?php echo(!empty($post->status)&&($post->status=="0"))?"checked":""; ?>>
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
                            {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success']) }}
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

                    <div class="form-group">
                        {{ Form::label('price', trans('validation.attributes.backend.access.product.price'),
                         ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::text('price', $price, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.product.price')]) }}
                        </div>
                        <!--col-lg-10-->
                    </div>
                    <!--form control-->
                </div>
                <!-- /.box-body -->
            </div><!--box-->


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
