@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.article.management'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.article.management') }}
        <small>{{ trans('labels.backend.article.view') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.article.view') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.article.includes.partials.article-header-buttons')
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
                                <th width="20%">{{ trans('labels.backend.article.tabs.content.overview.name') }}</th>
                                <td>{{ $articleInfo->name }}</td>
                            </tr>

                            <tr>
                                <th>{{ trans('labels.backend.article.tabs.content.overview.slug') }}</th>
                                <td>{{ $articleInfo->clean_url }}</td>
                            </tr>

                            <tr>
                                <th>{{ trans('labels.backend.article.tabs.content.overview.description') }}</th>
                                <td>{!! $articleInfo->content !!}</td>
                            </tr>

                            <tr>
                                <th>{{ trans('labels.backend.article.tabs.content.overview.status') }}</th>
                                <td>
                                    @if ($articleInfo->status == 1)
                                        Publish
                                    @else
                                        Unpublish
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th>{{ trans('labels.backend.article.tabs.content.overview.image') }}</th>
                                <td><img src="{{ $articleInfo->image }}" class="user-profile-image" /></td>
                            </tr>

                            <tr>
                                <th>{{ trans('labels.backend.article.tabs.content.overview.created_at') }}</th>
                                <td>{{ $articleInfo->created_at }} ({{ $articleInfo->created_at->diffForHumans() }})</td>
                            </tr>

                            <tr>
                                <th>{{ trans('labels.backend.article.tabs.content.overview.last_updated') }}</th>
                                <td>{{ $articleInfo->updated_at }} ({{ $articleInfo->updated_at->diffForHumans() }})</td>
                            </tr>

                          <tr>
                              <td colspan="2">
                                  <a href="{{ route('admin.article.article.edit',$articleInfo->id) }}" class="btn btn-xs btn-primary">Edit This Article</a>
                              </td>
                          </tr>
                        </table>
                    </div><!--tab overview profile-->

                </div><!--tab content-->

            </div><!--tab panel-->

        </div><!-- /.box-body -->
    </div><!--box-->
@endsection