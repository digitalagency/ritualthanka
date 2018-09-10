<!doctype html>
<html lang="{{ app()->getLocale() }}" prefix="og: http://ogp.me/ns#">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" type="image/png" href="{{url('/img/backend/rituallogo.png')}}"/>
        <title>@yield('title', app_name())</title>

        <!-- Meta -->
        <meta name="description" content="@yield('meta_description', 'Laravel 5 Boilerplate')">
        <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
        @yield('meta')

        <!-- Styles -->
        @yield('before-styles')

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        {{--@langRTL
            {{ Html::style(getRtlCss(mix('css/frontend.css'))) }}
        @else
            {{ Html::style(mix('css/frontend.css')) }}
        @endif--}}

        <link rel="stylesheet" href="{{url('frontend/assets/dist/style.min.css')}}">
        <link rel="stylesheet" href="{{url('frontend/assets/dist/custom.css')}}">
        @yield('after-styles')

        <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </head>
    <body id="app-layout">
         <div class="page-wrapper">
            @include('frontend.components.header.header')

            @yield('content')

             @include('frontend.components.footerblock.footer')
         </div>

        <script src="http://w.sharethis.com/button/buttons.js"></script>
         <script src="{{ URL::to('frontend/assets/dist/jquery.min.js?ver=2.2.4') }}"></script>
        <!-- Scripts -->
        @yield('before-scripts')
        {{--{!! Html::script(mix('js/frontend.js')) !!}--}}
        @yield('after-scripts')
         
         <script src="{{ URL::to('frontend/assets/dist/app.min.js?ver=1.0') }}"></script>
         <script>
             function gotopage(link){
                 window.location.href = link;
                 //window.location.replace(link);
             }
         </script>
        @include('includes.partials.ga')
    </body>
</html>