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


    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.brocade.all_brocade') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.brocade.includes.partials.page-header-buttons')
            </div><!--box-tools pull-right-->

        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table id="article-table" class="table table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>{{ trans('labels.backend.brocade.table.title') }}</th>
                        <th>{{ trans('labels.backend.brocade.table.slug') }}</th>
                        <th>{{ trans('labels.backend.brocade.table.status') }}</th>
                        <th>{{ trans('labels.backend.brocade.table.created') }}</th>
                        <th>{{ trans('labels.backend.brocade.table.last_updated') }}</th>
                        <th>{{ trans('labels.general.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($posts))
                        @forelse ($posts as $post)
                            <tr>
                                <td> {!! $post->title !!} </td>
                                <td>{!!$post->clean_url!!}</td>
                                <td>
                                    @if ($post->status == 1)
                                        Publish
                                    @else
                                        Unpublish
                                    @endif
                                </td>
                                <td>{!!$post->created_at!!}</td>
                                <td>{!!$post->updated_at!!}</td>
                                <td>
                                    {{--<a href="{{ route('admin.page.page.show',$post->id) }}" class="btn btn-xs btn-info"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"></i></a>--}}
                                    <a href="{{ route('admin.brocade.editBrocade',$post->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                                    <a data-method="delete" data-trans-button-cancel="Cancel" data-trans-button-confirm="Delete" data-trans-title="Are you sure you want to do this?" class="btn btn-xs btn-danger" style="cursor:pointer;" onclick="$(this).find(&quot;form&quot;).submit();"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></i>
                                        <form action="{{ route('admin.brocade.deleteBrocade',$post->id) }}" method="POST" name="delete_item" style="display:none">
                                            <input type="hidden" name="_method" value="delete">
                                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                                        </form>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No brocade added</td>
                            </tr>
                        @endforelse
                    @endif
                    </tbody>


                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->



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