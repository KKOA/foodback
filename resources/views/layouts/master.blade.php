<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <!-- favicon -->
        <meta name="theme-color" content="#00aba9"/>
        <meta name="msapplication-TileColor" content="#00aba9">
         <link rel="shortcut icon" href="{{ asset('imgs/favicon/favicon.ico') }}" > 
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('imgs/favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('imgs/favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('imgs/favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('imgs/favicon/site.webmanifest') }}">
        <link rel="mask-icon" href="{{ asset('imgs/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
        
        <!-- Custom Meta -->
        @section('meta')
        <meta name="description" content="Restaurant review written by chef, food taster and you">
        @endsection
        @yield('meta')

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{asset('css/master.css')}}">

        <!-- Script -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        {{--<script src="{{asset('js/master.js')}}"></script>--}}

        <title>Foodreview @yield('title')</title>
    </head>
    <body>
        {{--@include('inc.header')--}}
        <div class='container-fluid'>
        @include('inc.messages')
            
            @yield('content')
        </div>
        {{--@include('inc.footer')--}}
        @yield('script')
        {{--<script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>--}}
        <script>
            // $(document).ready(function(){
            //     if($('#article-ckeditor').length)
            //     {
            //         CKEDITOR.replace( 'article-ckeditor' );
            //     }
            // });
        </script>


    </body>
</html>