@extends('frontend.layouts.app')

@section('title', app_name() . ' | Register')

@section('content')
    <section class="contactblock padding">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="cnt_form">
                        <h2 class="panel panel-default">
                            <h2 class="fa-4">{{ trans('labels.frontend.auth.register_box_title') }}</h2>

                            <div class="panel-body">

                                {{ Form::open(['route' => 'frontend.auth.register.post', 'class' => 'form-horizontal']) }}

                                <div class="form-group">
                                    {{ Form::label('first_name', trans('validation.attributes.frontend.first_name'),
                                    ['class' => 'col-md-4 control-label']) }}
                                    <div class="col-md-8">
                                        {{ Form::text('first_name', null,
                                        ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('validation.attributes.frontend.first_name')]) }}
                                    </div>
                                    <!--col-md-6-->
                                </div>
                                <!--form-group-->

                                <div class="form-group">
                                    {{ Form::label('last_name', trans('validation.attributes.frontend.last_name'),
                                    ['class' => 'col-md-4 control-label']) }}
                                    <div class="col-md-8">
                                        {{ Form::text('last_name', null,
                                        ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => trans('validation.attributes.frontend.last_name')]) }}
                                    </div>
                                    <!--col-md-6-->
                                </div>
                                <!--form-group-->

                                <div class="form-group">
                                    {{ Form::label('email', trans('validation.attributes.frontend.email'), ['class' => 'col-md-4 control-label']) }}
                                    <div class="col-md-8">
                                        {{ Form::email('email', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => trans('validation.attributes.frontend.email')]) }}
                                    </div>
                                    <!--col-md-6-->
                                </div>
                                <!--form-group-->

                                <div class="form-group">
                                    {{ Form::label('password', trans('validation.attributes.frontend.password'), ['class' => 'col-md-4 control-label']) }}
                                    <div class="col-md-8">
                                        {{ Form::password('password', ['class' => 'form-control', 'required' => 'required', 'placeholder' => trans('validation.attributes.frontend.password')]) }}
                                    </div>
                                    <!--col-md-6-->
                                </div>
                                <!--form-group-->

                                <div class="form-group">
                                    {{ Form::label('password_confirmation', trans('validation.attributes.frontend.password_confirmation'), ['class' => 'col-md-4 control-label']) }}
                                    <div class="col-md-8">
                                        {{ Form::password('password_confirmation', ['class' => 'form-control', 'required' => 'required', 'placeholder' => trans('validation.attributes.frontend.password_confirmation')]) }}
                                    </div>
                                    <!--col-md-6-->
                                </div>
                                <!--form-group-->

                                @if (config('access.captcha.registration'))
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            {!! Form::captcha() !!}
                                            {{ Form::hidden('captcha_status', 'true') }}
                                        </div>
                                        <!--col-md-6-->
                                    </div><!--form-group-->
                                @endif

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        {{ Form::submit(trans('labels.frontend.auth.register_button'), ['class' => 'btn btn-primary']) }}
                                    </div>
                                    <!--col-md-6-->
                                </div>
                                <!--form-group-->

                                {{ Form::close() }}

                            </div>
                            <!-- panel body -->

                        </div>
                        <!-- panel -->
                    </div>
                </div>
                <!-- col-md-8 -->

            </div>
            <!-- row -->
        </div>
    </section>


@endsection

@section('after-scripts')
    @if (config('access.captcha.registration'))
        {!! Captcha::script() !!}
    @endif
@endsection