<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8" />
        <title>Ottozilla</title>
        <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link rel="icon" href="{{ frontend_asset('images/favicon.ico') }}" type="image/x-icon">

        <!------------------------ Fonts ------------------------------------>
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,800,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300i,400,600,700" rel="stylesheet">


        <!------------------------ Main CSS ------------------------------------>
        <link rel="stylesheet" type="text/css" media="all" href="{{ frontend_asset('css/style.css') }}" />

        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    </head>
    <body>
        <main>

            @include('frontend.includes.header')

            @yield('content')

            @include('frontend.includes.footer')
        </main>
        <!------------------------ CSS Library ------------------------------------>
        <link href="{{ frontend_asset('css/library.css')}}" rel="stylesheet">

        <!------------------------ Jquery CDN ------------------------------------> 
        <script type="text/javascript" src="{{ frontend_asset('js/jquery-1.11.3.min.js')}}"></script> 
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <!------------------------ Javascript ------------------------------------> 
        <script type="text/javascript" src="{{ frontend_asset('js/library.js')}}"></script> 
        <script type="text/javascript" src="{{ frontend_asset('js/main.js')}}"></script> 

        <!------------------------ WOW Animation CDN------------------------------------> 
        <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script> 
        <script>new WOW().init();</script> 
        <script type="text/javascript">
            $(function () {
                $("#datepicker").datepicker({
                    dateFormat: 'yy-mm-dd'
                });
                ;
            });
        </script>

    </body></html>
