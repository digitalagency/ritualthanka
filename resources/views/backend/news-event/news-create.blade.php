<?php
   $keywords="";$metadesc="";$images="";$to="";$from="";$time="";

   if(!empty($postmeta)){
       foreach($postmeta as $pm){

           if($pm->meta_key=='keywords')
               $keywords = $pm->meta_value;
           if($pm->meta_key=='metadesc')
               $metadesc = $pm->meta_value;
           if($pm->meta_key=='dateto')
               $to = $pm->meta_value;
           if($pm->meta_key=='datefrom')
               $from = $pm->meta_value;
           if($pm->meta_key=='time')
               $time = $pm->meta_value;
           if($pm->meta_key=='images')
               $images = $pm->meta_value;

       }
   }
?>
@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.news.management'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.news.management') }}
        <small>{{ trans('labels.backend.news.add_post') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.news-events.storeNews', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}
    <div class="row">
        <div class="col-md-8">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('labels.backend.news.add_post') }}</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <input type="hidden" name="post_type" value="news">
                    <input type="hidden" name="postid" value="<?php  echo (!empty($post->id ))? $post->id : '' ?>">
                    <div class="form-group">
                        {{ Form::label('title', trans('validation.attributes.backend.access.news.title'), ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::text('title', !empty($post->title) ? $post->title : '', ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('validation.attributes.backend.access.news.title')]) }}
                        </div>
                        <!--col-lg-10-->
                    </div>
                    <!--form control-->

                    <div class="form-group">
                        {{ Form::label('slug', trans('validation.attributes.backend.access.news.slug'),
                         ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::text('slug', !empty($post->clean_url) ? $post->clean_url : '', ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => trans('validation.attributes.backend.access.news.slug')]) }}
                        </div>
                        <!--col-lg-10-->
                    </div>
                    <!--form control-->

                    <div class="form-group">
                        {{ Form::label('description', trans('validation.attributes.backend.access.news.description'),
                         ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::textarea('description', !empty($post->content) ? $post->content : '', ['class' => 'form-control tinymce']) }}

                        </div>
                        <!--col-lg-10-->
                    </div>
                    <!--form control-->


                    <div class="form-group">
                        {{ Form::label('excerpt', trans('validation.attributes.backend.access.news.excerpt'),
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
                    <h3 class="box-title">{{ trans('validation.attributes.backend.access.news.add_other_photos') }}</h3>

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
                    <button class="btn btn-success btnAddImage">Add Images</button>
                </div>

            </div>


        </div>

        <div class="col-md-4">
            {{--Publish Unpublish--}}
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('validation.attributes.backend.access.news.publish') }}</h3>

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
                            {{ link_to_route('admin.news-events.newsIndex', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger']) }}
                        </div>
                        <!--pull-left-->

                        <div class="pull-right">
                            @if(!empty($post->id))
                                {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-success']) }}
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
                    <h3 class="box-title">{{ trans('validation.attributes.backend.access.news.photo') }}</h3>

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

                                {{ Form::text('image', !empty($post->image) ? $post->image : '', ['class' => 'form-control', 'id'=>'thumbnail', 'placeholder' => trans('validation.attributes.backend.access.news.photo')]) }}
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


            {{--Event detail--}}
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('validation.attributes.backend.access.news.detail') }}</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        {{ Form::label('time', trans('validation.attributes.backend.access.news.time'),
                         ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::text('time', $time, ['class' => 'form-control',  'placeholder' => trans('validation.attributes.backend.access.news.time')]) }}

                        </div>
                        <!--col-lg-10-->
                    </div>
                    <!--form control-->

                    <div class="form-group">
                        {{ Form::label('datefrom', trans('validation.attributes.backend.access.news.datefrom'),
                         ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            <div class="input-group date">
                                {{ Form::text('datefrom', $from, ['class' => 'form-control',  'placeholder' => trans('validation.attributes.backend.access.news.datefrom')]) }}
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                        </div>
                        <!--col-lg-10-->
                    </div>
                    <!--form control-->

                    <div class="form-group">
                        {{ Form::label('dateto', trans('validation.attributes.backend.access.news.dateto'),
                         ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            <div class="input-group date">
                                {{ Form::text('dateto', $to, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.news.dateto')]) }}
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
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
                    <h3 class="box-title">{{ trans('validation.attributes.backend.access.news.seo') }}</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        {{ Form::label('keywords', trans('validation.attributes.backend.access.news.keywords'),
                         ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::text('keywords', $keywords, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.news.keywords')]) }}
                        </div>
                        <!--col-lg-10-->
                    </div>
                    <!--form control-->

                    <div class="form-group">
                        {{ Form::label('metadesc', trans('validation.attributes.backend.access.news.metadesc'),
                         ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::text('metadesc', $metadesc, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.news.metadesc')]) }}
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
