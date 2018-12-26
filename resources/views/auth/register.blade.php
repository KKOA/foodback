{{-- @extends('layouts.app') --}}
@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-xl-8">
            <div id="registerCard" class="card">
                <div class="card-content">
                    <div class="card-header text-center">
                        <h2>{{ __('Register') }}</h2>
                    </div>

                    <div class="card-body">
                        <p class="text-center offset-1-center">
                            By registring you agree to Foodback’s
                            <a href="{{route('legal.terms')}}" target="_blank">Terms of Service</a>,
                            <a href="{{route('legal.privacy')}}" target="_blank">Privacy Policy</a>
                            and <a href="{{route('legal.cookie')}}" target="_blank">Cookie policy</a>.
                        </p>
                        <h3 class="text-center">Register with</h3>
                        <div class="row social-auth-links justify-content-center">
                            <div class="col-12 col-sm-6 col-lg-4 my-2">
                                <a class="btn btn-facebook btn-block" href="#">
                                    <i class="fab fa-facebook-f"></i> Facebok
                                </a>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4 my-2">
                                <a class="btn btn-google btn-block" href="#">
                                    <i class="fab fa-google"></i> Google
                                </a>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4 my-2">
                                <a class="btn btn-twitter  btn-block" href="#">
                                        <i class="fab fa-twitter"></i> Twitter
                                </a>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4 my-2">
                                    <a class="btn btn-twitter btn-block" >
                                        <i class="fab fa-twitter"></i> Twitter
                                    </a>
                            </div>
                        </div>

                        <h4 class="text-center hr-line">OR</h4>

                        <p class="text-center font-weight-bold" >All fields are required unless indicated as optional.</p>

                        <form method="POST" action="{{ route('register') }}" id="registerForm">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <div class="invalid-feedback-content">
                                                <i class="fas fa-exclamation-circle fa-lg"></i>
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </div>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <div class="invalid-feedback-content">
                                                <i class="fas fa-exclamation-circle fa-lg"></i>
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </div>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                    <small> <span style="color:#25406F;"><i class='fas fa-info-circle fa-lg'></i></span> Min 6 characters, case sensitive </small>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <div class="invalid-feedback-content">
                                                <i class="fas fa-exclamation-circle fa-lg"></i>
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </div>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            {{--  --}}
                            {{-- Url Previous : {{URL::previous()}}<br>
                            Url Currentd : {{URL::full()}}<br>
                            {{URL::previous() ===  URL::full() }}<br>
                            Root Url {{URL::route('root')}}<br>
                            Root Url {{URL::to('/')}}<br> --}}
                            <div class="form-group">
                                @if (Request::has('previous'))
                                    <input type="hidden" name="previous" value="{{ Request::get('previous') }}">
                                    wtf
                                @elseif(URL::previous() === URL::full())
                                    <input type="hidden" name="previous" value="{{ URL::route('root') }}">
                                @else
                                    <input type="hidden" name="previous" value="{{ URL::previous() }}">
                                @endif

                                {{-- <input type="hidden" name="previous" value="{{ URL::full() }}"> --}}
                                {{-- url()->full(); --}}
                            </div>
                            {{--  --}}
                            
                            <div class="form-group row mb-0 ">
                                <div class="offset-md-4 col-md-6">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{-- {{ __('Register') }} --}}
                                        Join now
                                    </button>
                                </div>
                            </div>
                        </form>


                    </div>
                    <div class="card-footer">
                        <p class="text-center">Already have an account already?
                            <a href="{{route('login')}}" class="login-link">Log in here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>

    main a, .btn
    {
        letter-spacing:1px;
    }


    /* Card Header */
    .card-header
    {
        padding: 0.5rem;

    }

    .card-header h2
    {
        font-family: Arvo;
        font-weight: bold;
        letter-spacing: 0.1em;
    }

    #registerCard .card-content .card-header
    {
        background: #25406F;
    }

    #registerCard .card-content .card-header h2
    {
        color: white;
        text-shadow: 
        -2px -2px 0 #2E6B8F,
         2px -2px 0 #2E6B8F,
        -2px 2px 0 #2E6B8F,
        2px 2px 0 #2E6B8F,
        2px 3px 0 #ddd,
        3px 4px 0 #ddd;
    }

    /* card-body */

    /* Social links */

    /*.btn-facebook,
    .btn-google,
    .btn-twitter
    {
        border-width: 2px;
        border-style: solid;
        /* box-shadow: 0 2px 4px grey; *//*
    }

    .btn-facebook
    {
        background:#38538F;
        color:white;
        border-color:#26375F;
    }

    .btn-facebook:hover{
        background:#26375F;
        color:white;
        border-color:#26375F;
    }

    .btn-google
    {
        background:#FF826B;
        color:black;
        border-color:#FF6447;
    }

    .btn-google:hover
    {
        background:#FF6447;
        color:black;
        border-color:#FF6447;
    }

    .btn-twitter
    {
        /* background: #52ABFF; *//*
        background:#2998FF;
        color: black;
        border-color: #5cB0FF;
    }

    .btn-twitter:hover
    {
        /* background: #3399FF; *//*
        background: #5cB0FF;
        color: black;
        border-color: #5cB0FF;
    }*/


    /* hr-line -generic style */

    .hr-line::before {
        margin: 0 0.5em 0 -55%;
    }

    .hr-line:after {
        margin: 0 -55% 0 0.5em;
    }

    .hr-line {
        width:95%;
        margin:.7em auto;
        overflow:hidden;
        font-weight:300px;
    }

    .hr-line:before,
    .hr-line:after {
        content: "";
        display: inline-block;
        width: 50%;
        vertical-align: middle;
        border-bottom: 1px solid
    }



    /* form */

    /* #registerCard .card-content .card-body form
    {
        margin-left:-1.25rem;
        margin-right:-1.25rem;
    } */

    /* .invalid-feedback-content 
    { 
        border:1px solid red;
        padding:5px;
        background: #FFEFE5;
	    background: #FFF3B8;
    } */

    /* #registerCard .card-content .card-body form button
    {
        box-shadow: 0 2px 4px grey;
    } */

    /* card footer */

    #registerCard .card-content .card-footer
    {
        background:#25406F;
        color:white;
    }

    #registerCard .card-content .card-footer a
    {
        color:#8ee3fB;
    }

    #registerCard .card-content .card-footer a:hover
    {
        color:#c5effb;
    }

    
</style>
{{-- <script>
    $(document).ready(function(){
        /*
        Loop through form inputs with
        */

        $('input').each(function(){
            if($(this).hasClass('is-invalid'))
            {
                $(this).closest('.form-group').find('.invalid-feedback').addClass('d-block');
            }
        });
    });
</script> --}}

@endsection

