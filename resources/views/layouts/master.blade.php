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
        <link rel="stylesheet" href="{{mix('css/master.css')}}">
        @yield('style')

        <!-- Script -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.6.3/js/all.js" integrity="sha384-EIHISlAOj4zgYieurP0SdoiBYfGJKkgWedPHH4jCzpCXLmzVsw1ouK59MuUtP4a1" crossorigin="anonymous"></script>
    </head>
    <body>
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
            // $(document).ready(function(){
            //     if($('#article-ckeditor').length)
            //     {
            //         CKEDITOR.replace( 'article-ckeditor' );
            //     }
            // });
        </script>
    </body>
</html>