@extends('frontend.layouts.loginapp')

@section('title', app_name() . ' | Login')

@section('content')


    <section class="contactblock padding">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="cnt_form">
                    <div class="panel panel-default">
                        <h2 class="fa-4">{{ trans('labels.frontend.auth.login_box_title') }}</h2>

                        <div class="panel-body">

                            {{ Form::open(['route' => 'frontend.auth.login.post', 'class' => 'form-horizontal']) }}

                            <div class="form-group">
                                {{ Form::label('email', trans('validation.attributes.frontend.email'), ['class' => 'col-md-4 control-label']) }}
                                <div class="col-md-8">
                                    {{ Form::email('email', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('validation.attributes.frontend.email')]) }}
                                </div><!--col-md-6-->
                            </div><!--form-group-->

                            <div class="form-group">
                                {{ Form::label('password', trans('validation.attributes.frontend.password'), ['class' => 'col-md-4 control-label']) }}
                                <div class="col-md-8">
                                    {{ Form::password('password', ['class' => 'form-control', 'required' => 'required', 'placeholder' => trans('validation.attributes.frontend.password')]) }}
                                </div><!--col-md-6-->
                            </div><!--form-group-->

                            <div class="form-group">
                                <div class="col-md-4">
                                    <div class="checkbox">
                                        <label>
                                            {{ Form::checkbox('remember') }} {{ trans('labels.frontend.auth.remember_me') }}
                                        </label>
                                    </div>
                                </div><!--col-md-6-->
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-3">
                                            {{ Form::submit(trans('labels.frontend.auth.login_button'), ['class' => 'btn btn-primary', 'style' => 'margin-right:15px']) }}
                                        </div>
                                        <div class="col-md-5">
                                            <a class="btn btn-primary" style="margin-right:15px" href="{{route('frontend.auth.password.reset')}}">Forgot Password</a>
                                        </div>
                                        <div class="col-md-4">
                                            <a  class="btn btn-primary" style="margin-right:15px" href="{{route('frontend.auth.register')}}">{{trans('labels.frontend.auth.register_box_title')}}</a>
                                        </div>
                                    </div>


                                </div>
                            </div><!--form-group-->

                            {{--<div class="form-group">
                                <div class="col-md-4 offset-md-3">
                                    {{ Form::submit(trans('labels.frontend.auth.login_button'), ['class' => 'btn btn-primary', 'style' => 'margin-right:15px']) }}

                                    {{ link_to_route('frontend.auth.password.reset', trans('labels.frontend.passwords.forgot_password')) }}
                                </div><!--col-md-6-->
                            </div><!--form-group-->--}}

                            {{ Form::close() }}

                            <div class="row text-center">
                                {!! $socialite_links !!}
                            </div>
                        </div><!-- panel body -->

                    </div><!-- panel -->

                </div><!-- col-md-8 -->
                </div>
            </div><!-- row -->
        </div>
    </section>
@endsection