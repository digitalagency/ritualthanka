<?php
   $price="";

   if(!empty($postmeta)){
       foreach($postmeta as $pm){

           if($pm->meta_key=='price')
               $price = $pm->meta_value;
       }
   }
?>
@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.handle.management'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.handle.management') }}
        <small>{{ trans('labels.backend.handle.add_handle') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.handle.storeHandle', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}
    <div class="row">
        <div class="col-md-8">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('labels.backend.handle.add_handle') }}</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <input type="hidden" name="post_type" value="handle">
                    <input type="hidden" name="postid" value="<?php  echo (!empty($post->id ))? $post->id : '' ?>">
                    <div class="form-group">
                        {{ Form::label('title', trans('validation.attributes.backend.access.handle.title'), ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::text('title', !empty($post->title) ? $post->title : '', ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('validation.attributes.backend.access.handle.title')]) }}
                        </div>
                        <!--col-lg-10-->
                    </div>
                    <!--form control-->

                    <div class="form-group">
                        {{ Form::label('slug', trans('validation.attributes.backend.access.handle.slug'),
                         ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::text('slug', !empty($post->clean_url) ? $post->clean_url : '', ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => trans('validation.attributes.backend.access.handle.slug')]) }}
                        </div>
                        <!--col-lg-10-->
                    </div>
                    <!--form control-->


                </div>

            </div>

        </div>

        <div class="col-md-4">
            {{--Publish Unpublish--}}
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('validation.attributes.backend.access.handle.publish') }}</h3>

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
                            {{ link_to_route('admin.handle.handleIndex', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger']) }}
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
                    <h3 class="box-title">{{ trans('validation.attributes.backend.access.handle.photo') }}</h3>

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

                                {{ Form::text('image', !empty($post->image) ? $post->image : '', ['class' => 'form-control', 'id'=>'thumbnail', 'placeholder' => trans('validation.attributes.backend.access.post.photo')]) }}
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


            {{--Attributes --}}
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('validation.attributes.backend.access.handle.attributes') }}</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">


                    <div class="form-group">
                        {{ Form::label('price', trans('validation.attributes.backend.access.handle.price'),
                         ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::text('price', $price, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.handle.price')]) }}
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
