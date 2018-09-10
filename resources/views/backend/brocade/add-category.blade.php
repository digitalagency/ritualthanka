@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.brocade.management'))

@section('after-styles')
    {{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
@endsection

@section('page-header')
    <h1>
        {{ trans('labels.backend.brocade.management') }}
        <small>{{ trans('labels.backend.brocade.all_brocade') }}</small>
    </h1>
@endsection

@section('content')
    <div class="content-wrap">
        <div class="row">
            <div class="col-md-8 col-xs-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('labels.backend.brocade.category') }}</h3>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="article-table" class="table table-condensed table-hover">
                                <thead>
                                <tr>
                                    <th>{{ trans('labels.backend.brocade.cattable.name') }}</th>
                                    <th>{{ trans('labels.backend.brocade.cattable.slug') }}</th>
                                    <th>{{ trans('labels.general.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($postcat))
                                    @forelse ($postcat as $cat)
                                        <tr>
                                            <td> {!! $cat->name !!} </td>
                                            <td>{!!$cat->slug!!}</td>

                                            <td>
                                                {{--<a href="{{ route('admin.article.article.show',$article->id) }}" class="btn btn-xs btn-info"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"></i></a>--}}
                                                <a href="/admin/brocade/category/{{$cat->id}}" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                                                <a data-method="delete" data-trans-button-cancel="Cancel" data-trans-button-confirm="Delete" data-trans-title="Are you sure you want to do this?" class="btn btn-xs btn-danger" style="cursor:pointer;" onclick="$(this).find(&quot;form&quot;).submit();"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></i>
                                                    <form action="{{ route('admin.brocade.brocadecatdestroy',$cat->id) }}" method="POST" name="delete_item" style="display:none">
                                                        <input type="hidden" name="_method" value="delete">
                                                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                                                    </form>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">No Categories added</td>
                                        </tr>
                                    @endforelse
                                @endif
                                </tbody>

                            </table>
                        </div>
                        <!--table-responsive-->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!--box-->
            </div>
            <div class="col-md-4 col-xs-12">
                {{ Form::open(['route' => 'admin.brocade.brocadecatstore', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}

                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('labels.backend.brocade.add_category') }}</h3>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">

                        @if(!empty($editcat))
                            <input type="hidden" name="catid" value="{{ $editcat->id }}">
                        @endif

                        <input type="hidden" name="categoryType" value="{{$categoryType}}">
                        <div class="form-group">
                            {{ Form::label('title', trans('validation.attributes.backend.access.category.title'), ['class' => 'col-lg-12 lft-align control-label']) }}

                            <div class="col-lg-12">
                                {{ Form::text('title', !empty($editcat) ? $editcat->name : '' , ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('validation.attributes.backend.access.category.title')]) }}
                            </div>
                            <!--col-lg-12-->
                        </div>
                        <!--form control-->

                        <div class="form-group">
                            {{ Form::label('slug', trans('validation.attributes.backend.access.category.slug'),
                             ['class' => 'col-lg-12 lft-align control-label']) }}

                            <div class="col-lg-12">
                                {{ Form::text('slug', !empty($editcat) ? $editcat->slug : '', ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => trans('validation.attributes.backend.access.category.slug')]) }}
                            </div>
                            <!--col-lg-12-->
                        </div>
                        <!--form control-->


                        <div class="form-group">
                            {{ Form::label('image', trans('validation.attributes.backend.access.category.photo'),
                             ['class' => 'col-lg-12 lft-align control-label']) }}

                            <div class="col-lg-12">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                     <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                         <i class="fa fa-picture-o"></i> Choose
                                     </a>
                                   </span>

                                    {{ Form::text('image', !empty($editcat->image) ? $editcat->image : '', ['class' => 'form-control', 'id'=>'thumbnail', 'placeholder' => trans('validation.attributes.backend.access.category.photo')]) }}
                                </div>
                                @if(!empty($editcat->image))
                                    <img id="holder" style="margin-top:15px;max-height:100px;" src="{{ URL::to($editcat->image) }}">
                                @else
                                    <img id="holder" style="margin-top:15px;max-height:100px;">
                                @endif
                            </div>
                            <!--col-lg-12-->

                        </div>
                        <!--form control-->

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <div class="pull-right">
                            @if(!empty($editcat->id))
                                {{ Form::submit(trans('buttons.general.crud.edit'), ['class' => 'btn btn-success']) }}
                            @else
                                {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success']) }}
                            @endif

                        </div>
                    </div>
                </div>
                <!--box-->



                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection


@section('after-scripts')
    {{ Html::script("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.js") }}
    {{ Html::script("js/backend/plugin/datatables/dataTables-extend.js") }}

    <script>
        $(function () {
            $('#article-table').DataTable({
                "lengthMenu": [[ 25, 50, -1], [ 25, 50, "All"]],
                dom: 'lfrtip',
                processing: false,
                autoWidth: false,
                ordering: false,
            });
        });
    </script>
@endsection