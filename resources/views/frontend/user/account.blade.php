@extends('frontend.layouts.app')

@section('title', app_name() . ' | Account -'.$logged_in_user->name )

@section('content')

    <section class="contactblock padding">
        <div class="container">
            <div class="row">

                <div class="col-xs-12">

                    <h2 class="panel panel-default">
                        <h2 class="fa-4">{{ trans('navs.frontend.user.account') }}</h2>

                        <div class="panel-body">

                            <div role="tabpanel">

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#profile" aria-controls="profile" role="tab"
                                           data-toggle="tab">{{ trans('navs.frontend.user.profile') }}</a>
                                    </li>

                                    <li role="presentation">
                                        <a href="#edit" aria-controls="edit" role="tab"
                                           data-toggle="tab">{{ trans('labels.frontend.user.profile.update_information') }}</a>
                                    </li>

                                    @if ($logged_in_user->canChangePassword())
                                        <li role="presentation">
                                            <a href="#password" aria-controls="password" role="tab"
                                               data-toggle="tab">{{ trans('navs.frontend.user.change_password') }}</a>
                                        </li>
                                    @endif
                                </ul>

                                <div class="tab-content">

                                    <div role="tabpanel" class="tab-pane mt-30 active" id="profile">
                                        @include('frontend.user.account.tabs.profile')
                                    </div>
                                    <!--tab panel profile-->

                                    <div role="tabpanel" class="tab-pane mt-30" id="edit">
                                        @include('frontend.user.account.tabs.edit')
                                    </div>
                                    <!--tab panel profile-->

                                    @if ($logged_in_user->canChangePassword())
                                        <div role="tabpanel" class="tab-pane mt-30" id="password">
                                            @include('frontend.user.account.tabs.change-password')
                                        </div><!--tab panel change password-->
                                    @endif

                                </div>
                                <!--tab content-->

                            </div>
                            <!--tab panel-->

                        </div>
                        <!--panel body-->

                    </div>
                    <!-- panel -->

                </div>
                <!-- col-xs-12 -->

            </div>
            <!-- row -->
        </div>
    </section>
@endsection