<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('inc.head')
        
        <!-- Custom Meta -->
        @section('meta')
        <meta name="description" content="Restaurant review written by chef, food taster and you">
        @endsection
        @yield('meta')

        <title>
            {{config('app.name','Laravel')}}
            @if(View::hasSection('title'))
                | @yield('title')
            @endif
        </title>

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Arvo:700|Raleway:100,300,600" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link rel="stylesheet" href="{{mix('css/master.css')}}">
        @yield('style')

        <!-- Script -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body class="full-height">
        <div id="app">
            {{--phpinfo()--}}
            @include('inc.mainNav')
            <main class="py-4">
                <div class='container-fluid'>
                    @include('inc.messages')
                    @yield('content')
                    <a href="javascript:" id="return-to-top" title="Scroll to top">
                        <img src="{{ asset('imgs/up-chevron-min.png')}}" alt='Up arrow'>
                    </a>
                </div>
            </main>
        </div>

        {{--@include('inc.footer')--}}
        <script src="{{mix('js/master.js')}}"></script>
        @yield('script')
        {{--<script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>--}}
        <script>
            $(document).ready(function(){
            //     if($('#article-ckeditor').length)
            //     {
            //         CKEDITOR.replace( 'article-ckeditor' );
            //     }
                $(document).on('click','.hamburger',function(e){
                    $(this).toggleClass("is-active");
                });
            });
        </script>
    </body>
</html>