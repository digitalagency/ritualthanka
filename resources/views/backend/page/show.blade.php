@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.page.management'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.page.management') }}
        <small>{{ trans('labels.backend.page.view') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.page.view') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.page.includes.partials.page-header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">

            <div role="tabpanel">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#overview" aria-controls="overview" role="tab" data-toggle="tab">{{ trans('labels.backend.article.tabs.titles.overview') }}</a>
                    </li>

                </ul>

                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane mt-30 active" id="overview">
                        <table class="table table-striped table-hover">

                            <tr>
                                <th width="20%">{{ trans('labels.backend.page.tabs.content.overview.name') }}</th>
                                <td>{{ $pageInfo->name }}</td>
                            </tr>

                            <tr>
                                <th>{{ trans('labels.backend.page.tabs.content.overview.slug') }}</th>
                                <td>{{ $pageInfo->clean_url }}</td>
                            </tr>

                            <tr>
                                <th>{{ trans('labels.backend.page.tabs.content.overview.description') }}</th>
                                <td>{!! $pageInfo->content !!}</td>
                            </tr>

                            <tr>
                                <th>{{ trans('labels.backend.page.tabs.content.overview.status') }}</th>
                                <td>
                                    @if ($pageInfo->status == 1)
                                        Publish
                                    @else
                                        Unpublish
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th>{{ trans('labels.backend.page.tabs.content.overview.image') }}</th>
                                <td><img src="{{ $pageInfo->image }}" class="user-profile-image" /></td>
                            </tr>

                            <tr>
                                <th>{{ trans('labels.backend.page.tabs.content.overview.created_at') }}</th>
                                <td>{{ $pageInfo->created_at }} ({{ $pageInfo->created_at->diffForHumans() }})</td>
                            </tr>

                            <tr>
                                <th>{{ trans('labels.backend.page.tabs.content.overview.last_updated') }}</th>
                                <td>{{ $pageInfo->updated_at }} ({{ $pageInfo->updated_at->diffForHumans() }})</td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <a href="{{ route('admin.page.page.edit',$pageInfo->id) }}" class="btn btn-xs btn-primary">Edit This Page</a>
                                </td>
                            </tr>
                        </table>
                    </div><!--tab overview profile-->

                </div><!--tab content-->

            </div><!--tab panel-->

        </div><!-- /.box-body -->
    </div><!--box-->
@endsection