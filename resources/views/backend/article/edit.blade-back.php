@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.article.management'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.article.management') }}
        <small>{{ trans('labels.backend.article.edit') }}</small>
    </h1>
@endsection

@section('content')

    {{ Form::model($articleInfo, ['route' => ['admin.article.article.update', $articleInfo], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) }}
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.article.edit') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.article.includes.partials.article-header-buttons')
            </div>
            <!--box-tools pull-right-->
        </div>
        <!-- /.box-header -->

        <div class="box-body">
            <div class="form-group">
                {{ Form::label('title', trans('validation.attributes.backend.access.article.title'), ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('title', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('validation.attributes.backend.access.article.title')]) }}
                </div>
                <!--col-lg-10-->
            </div>
            <!--form control-->

            <div class="form-group">
                {{ Form::label('slug', trans('validation.attributes.backend.access.article.slug'),
                 ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('slug', $articleInfo->clean_url, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => trans('validation.attributes.backend.access.article.slug')]) }}
                </div>
                <!--col-lg-10-->
            </div>
            <!--form control-->

            <div class="form-group">
                {{ Form::label('description', trans('validation.attributes.backend.access.article.description'),
                 ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::textarea('description', $articleInfo->content, ['class' => 'form-control tinymce']) }}

                </div>
                <!--col-lg-10-->
            </div>
            <!--form control-->

            <div class="form-group">
                {{ Form::label('image', trans('validation.attributes.backend.access.article.photo'),
                 ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    <div class="input-group">
                    <span class="input-group-btn">
                     <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                         <i class="fa fa-picture-o"></i> Choose
                     </a>
                   </span>

                        {{ Form::text('image', null, ['class' => 'form-control', 'id'=>'thumbnail', 'placeholder' => trans('validation.attributes.backend.access.article.description')]) }}
                    </div>
                    @if(!empty($articleInfo->image))
                        <img id="holder" style="margin-top:15px;max-height:100px;" src="{{ URL::to($articleInfo->image) }}">
                    @else
                        <img id="holder" style="margin-top:15px;max-height:100px;">
                    @endif
                </div>
                <!--col-lg-10-->

            </div>
            <!--form control-->

            <div class="form-group">
                {{ Form::label('publish', trans('validation.attributes.backend.access.article.publish'), ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" id="status" value="1" <?php echo ($articleInfo->status==1) ? 'checked="checked"' : ''; ?>>
                            Publish
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" id="status" value="0" <?php echo ($articleInfo->status==0) ? 'checked="checked"' : ''; ?>>
                            Unpublish
                        </label>
                    </div>
                </div><!--col-lg-1-->
            </div><!--form control-->

        </div>
        <!-- /.box-body -->
    </div><!--box-->

    <div class="box box-info">
        <div class="box-body">
            <div class="pull-left">
                {{ link_to_route('admin.article.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
            </div>
            <!--pull-left-->

            <div class="pull-right">
                {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success btn-xs']) }}
            </div>
            <!--pull-right-->

            <div class="clearfix"></div>
        </div>
        <!-- /.box-body -->
    </div><!--box-->

    {{ Form::close() }}
@endsection