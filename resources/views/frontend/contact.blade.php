@extends('frontend.layouts.app')

@section('title', app_name() . ' | Contact Us')

@section('meta_description', ' Ritual Thanka, Contact us')
@section('meta_author', 'Ritual Thanka, Contact us')

@section('content')
    <section class="breadcrumb-block padding-top">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
                    <li class="breadcrumb-item current-menu-item"><a href="{{ route('frontend.contact') }}">Contact</a></li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="contactblock padding">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="cnt_address">
                        <h1 class="fa-4">Get in Touch</h1>
                        <p>We strive to provide our customers with authentic and high quality thangka paintings so that we can preserve and share this ancient form of art with all the spiritual followers and art lovers all over the world.</p>
                        <ul>
                            <li><i class="fa fa-map-marker"></i> P.O Box No. 21,  Soltimod , Kalimati, Kahtmandu , Nepal</li>
                            <li><i class="fa fa-phone"></i> <a href="callto:+977 5533441">+977 5533441</a>, <a href="callto:5566778">5566778</a></li>
                            <li><i class="fa fa-envelope"></i> <a href="mailto:info@thangkarithual,com">info@thangkarithual,com</a>, <a href="mailto:info@ritualthangka.com">info@ritualthangka.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="cnt_form">
                        <h2 class="fa-4">Send A Message</h2>
                        <form action="">
                            <div class="form-group">
                                <input type="text" name="Name" class="form-control" placeholder="" required="">
                                <label class="floating-label">Name</label>
                            </div>
                            <div class="form-group">
                                <input type="text" email="Email" class="form-control" placeholder="" required="">
                                <label class="floating-label">Email Address</label>
                            </div>
                            <div class="form-group date">
                                <textarea class="form-control" rows="3" placeholder="" required=""></textarea>
                                <label class="floating-label">Message</label>
                            </div>
                            <button class="btn btn-primary" method="post">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="g_map padding-top">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.0990375376045!2d85.3100792147005!3d27.714228282789033!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19027fd4c4d1%3A0xc21b87bf94b3e89f!2sRitual+Thanka!5e0!3m2!1sen!2snp!4v1527051433531" width="600" height="478" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </section>

   {{-- <div class="row">

        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('labels.frontend.contact.box_title') }}</div>

                <div class="panel-body">

                    {{ Form::open(['route' => 'frontend.contact.send', 'class' => 'form-horizontal']) }}

                    <div class="form-group">
                        {{ Form::label('name', trans('validation.attributes.frontend.name'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('validation.attributes.frontend.name')]) }}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        {{ Form::label('email', trans('validation.attributes.frontend.email'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::email('email', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => trans('validation.attributes.frontend.email')]) }}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        {{ Form::label('phone', trans('validation.attributes.frontend.phone'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::text('phone', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.phone')]) }}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        {{ Form::label('message', trans('validation.attributes.frontend.message'), ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::textarea('message', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => trans('validation.attributes.frontend.message')]) }}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            {{ Form::submit(trans('labels.frontend.contact.button'), ['class' => 'btn btn-primary pull-right']) }}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    {{ Form::close() }}
                </div><!-- panel body -->

            </div><!-- panel -->

        </div><!-- col-md-8 -->

    </div><!-- row -->--}}
@endsection