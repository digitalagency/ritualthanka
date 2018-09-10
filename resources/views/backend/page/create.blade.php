@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.page.management'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.page.management') }}
        <small>{{ trans('labels.backend.page.add') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.page.page.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}

    <div class="row">
        <div class="col-md-8">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('labels.backend.page.add') }}</h3>

                    <!--box-tools pull-right-->
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <div class="form-group">
                        {{ Form::label('title', trans('validation.attributes.backend.access.page.title'), ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::text('title', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('validation.attributes.backend.access.page.title')]) }}
                        </div>
                        <!--col-lg-10-->
                    </div>
                    <!--form control-->

                    <div class="form-group">
                        {{ Form::label('slug', trans('validation.attributes.backend.access.page.slug'),
                         ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::text('slug', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => trans('validation.attributes.backend.access.page.slug')]) }}
                        </div>
                        <!--col-lg-10-->
                    </div>
                    <!--form control-->

                    <div class="form-group">
                        {{ Form::label('description', trans('validation.attributes.backend.access.page.description'),
                         ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::textarea('description', null, ['class' => 'form-control tinymce']) }}

                        </div>
                        <!--col-lg-10-->
                    </div>
                    <!--form control-->

                    <div class="form-group">
                        {{ Form::label('excerpt', trans('validation.attributes.backend.access.product.excerpt'),
                         ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::textarea('excerpt', null, ['class' => 'form-control','rows' => 3, 'cols' => 10]) }}
                        </div>
                        <!--col-lg-10-->
                    </div>
                    <!--form control-->

                </div>



            </div>

        </div>
        <div class="col-md-4">
            {{--Publish unpublish--}}
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('validation.attributes.backend.access.page.publish') }}</h3>

                </div>
                <div class="box-body">
                    <div class="form-group">


                        <div class="col-lg-10">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="status" id="status" value="1" checked>
                                    Publish
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="status" id="status" value="0">
                                    Unpublish
                                </label>
                            </div>
                        </div><!--col-lg-1-->
                    </div><!--form control-->
                </div>
                <div class="box-body">
                    <div class="pull-left">
                        {{ link_to_route('admin.page.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger']) }}
                    </div>
                    <!--pull-left-->

                    <div class="pull-right">
                        {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success']) }}
                    </div>
                    <!--pull-right-->

                    <div class="clearfix"></div>
                </div>
            </div>

            {{--Featured Image--}}
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('validation.attributes.backend.access.page.photo') }}</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                    <div class="col-lg-12">
                        <div class="input-group">
                    <span class="input-group-btn">
                     <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                         <i class="fa fa-picture-o"></i> Choose
                     </a>
                   </span>

                            {{ Form::text('image', null, ['class' => 'form-control', 'id'=>'thumbnail', 'placeholder' => trans('validation.attributes.backend.access.page.photo')]) }}
                        </div>
                        <img id="holder" style="margin-top:15px;max-height:100px;">
                    </div>
                    <!--col-lg-10-->
                    </div>
                </div>

            </div>

            {{--Seo --}}
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('validation.attributes.backend.access.page.seo') }}</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        {{ Form::label('keywords', trans('validation.attributes.backend.access.page.keywords'),
                         ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::text('keywords', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.page.keywords')]) }}
                        </div>
                        <!--col-lg-10-->
                    </div>
                    <!--form control-->

                    <div class="form-group">
                        {{ Form::label('metadesc', trans('validation.attributes.backend.access.page.metadesc'),
                         ['class' => 'col-lg-12 lft-align control-label']) }}

                        <div class="col-lg-12">
                            {{ Form::text('metadesc', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.page.metadesc')]) }}
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
