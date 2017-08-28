<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8" />
        <title>Smart Mart :: @yield('title')</title>
        <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link href="{{ frontend_asset('images/favicon.ico') }}"  rel="icon" type="image/x-icon">

        <!------------------------ Fonts ------------------------------------>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet">
        <!-- style-->
        <link href="{{ frontend_asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ frontend_asset('css/responsive_style.css') }}" rel="stylesheet">
        <link href="{{ frontend_asset('css/library.css') }}" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css" rel="stylesheet" />
        {{--<script src="{{ frontend_asset('js/library.js')}}" type="text/javascript" ></script>--}}
    {{--<script src="{{ frontend_asset('js/main.js')}}" type="text/javascript"></script>--}}
    {{--<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>--}}
    @yield('CSSLibraries')

</head>
    <?php
    $path = Route::getCurrentRoute()->getPath();
    ?>
    @if ($path === "index")
<body  class="home">
    <header class="wow fadeInDown">
        @else
        <body >
            <header >
                @endif

                @include('frontend.includes.header')
            </header>

            @yield('content')

            @include('frontend.includes.footer')
            <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
            @yield('JSLibraries')
            <script type="text/javascript">

$(document).ready(function () {
    if ($(".js-example-basic-single").select2) {
        $(".js-example-basic-single").select2({
            placeholder: "Search...",
//                    allowClear: true
        });
    }
});
            </script>
            @yield('inlineJS')

        </body>

</html>