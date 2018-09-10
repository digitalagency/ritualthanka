@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.option.exchange.management'))

@section('after-styles')
    {{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
@endsection

@section('page-header')
    <h1>
        {{ trans('labels.backend.option.exchange.management') }}
    </h1>
@endsection

@section('content')
    <div class="content-wrap">
        <div class="row">
            <div class="col-md-8 col-xs-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('labels.backend.option.exchange.management') }}</h3>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="article-table" class="table table-condensed table-hover">
                                <thead>
                                <tr>
                                    <th>{{ trans('labels.backend.product.exchange.name') }}</th>
                                    <th>{{ trans('labels.backend.product.exchange.code') }}</th>
                                    <th>{{ trans('labels.backend.product.exchange.rate') }}</th>
                                    <th>{{ trans('labels.general.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($postcat))
                                    @forelse ($postcat as $cat)
                                        <tr>
                                            <td> {!! $cat->country_name !!} </td>
                                            <td>{!!$cat->country_code!!}</td>
                                            <td>
                                                @if ($cat->rate == '')
                                                    N/A
                                                @else
                                                    {!!$cat->rate!!}
                                                @endif

                                            </td>

                                            <td>
                                                {{--<a href="{{ route('admin.article.article.show',$article->id) }}" class="btn btn-xs btn-info"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"></i></a>--}}
                                                <a href="/admin/exchange/{{$cat->id}}" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
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
            @if(!empty($editcat))
            <div class="col-md-4 col-xs-12">
                {{ Form::open(['route' => 'admin.exchange.ratestore', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}

                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('labels.backend.product.exchange.exchange_rate') }} @if(!empty($editcat)){{ $editcat->country_name }}@endif</h3>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">

                        @if(!empty($editcat))
                            <input type="hidden" name="countryid" value="{{ $editcat->id }}">
                        @endif

                        <div class="form-group">
                            {{ Form::label('rate', trans('validation.attributes.backend.access.product.exchange_rate'), ['class' => 'col-lg-12 lft-align control-label']) }}

                            <div class="col-lg-12">
                                {{ Form::number('rate', !empty($editcat) ? $editcat->rate : '' , ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('validation.attributes.backend.access.product.exchange_rate')]) }}
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