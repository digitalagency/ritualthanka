@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.option.buyers.management'))

@section('after-styles')
    {{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
@endsection

@section('page-header')
    <h1>
        {{ trans('labels.backend.option.buyers.management') }}
    </h1>
@endsection

@section('content')
    <div class="content-wrap">
        <div class="row">
            <div class="col-md-8 col-xs-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('labels.backend.option.buyers.management') }}</h3>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="article-table" class="table table-condensed table-hover">
                                <thead>
                                <tr>
                                    <th>{{ trans('labels.backend.option.buyers.name') }}</th>
                                    <th>{{ trans('labels.backend.option.buyers.email') }}</th>
                                    <th>{{ trans('labels.backend.option.buyers.allocation') }}</th>
                                    <th>{{ trans('labels.general.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($buyers))
                                    @forelse ($buyers as $buy)
                                        <tr>
                                            <td> {!! $buy->first_name !!} {!!$buy->last_name!!} </td>
                                            <td>{!!$buy->email!!}</td>
                                            <td>

                                                {{ App\Http\Controllers\Backend\Post\PostController::disc_allo($buy->id) }}
                                            </td>

                                            <td>
                                                <a href="/admin/orders/byuser/{{$buy->id}}" class="btn btn-xs btn-info"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"></i></a>
                                                <a href="/admin/buyers/{{$buy->id}}" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                                                {{--<a data-method="delete" data-trans-button-cancel="Cancel" data-trans-button-confirm="Delete" data-trans-title="Are you sure you want to do this?" class="btn btn-xs btn-danger" style="cursor:pointer;" onclick="$(this).find(&quot;form&quot;).submit();"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></i>
                                                    <form action="{{ route('admin.product.catdestroy',$cat->id) }}" method="POST" name="delete_item" style="display:none">
                                                        <input type="hidden" name="_method" value="delete">
                                                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                                                    </form>
                                                </a>--}}
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
            @if(!empty($userid))
            <div class="col-md-4 col-xs-12">
                {{ Form::open(['route' => 'admin.buyers.disstore', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}

                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('labels.backend.option.buyers.allocated_disc') }} @if(!empty($userid)){{ $editbuyer->first_name }} {{ $editbuyer->last_name }}@endif</h3>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">

                        @if(!empty($userid))
                            <input type="hidden" name="userid" value="{{ $userid }}">
                        @endif

                        <div class="form-group">
                            {{ Form::label('allocation', trans('validation.attributes.backend.access.product.allocation'), ['class' => 'col-lg-12 lft-align control-label']) }}

                            <div class="col-lg-12">
                                {{ Form::number('allocation', !empty($editbuy) ? $editbuy->allocation : '' , ['class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('validation.attributes.backend.access.product.allocation')]) }}
                            </div>
                            <!--col-lg-12-->
                        </div>
                        <!--form control-->


                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <div class="pull-right">
                            {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-success']) }}
                        </div>
                    </div>
                </div>
                <!--box-->



                {{ Form::close() }}
            </div>
            @endif
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