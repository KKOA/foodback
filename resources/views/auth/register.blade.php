{{-- @extends('layouts.app') --}}
@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-xl-8">
            <div id="registerCard" class="card">
                <div class="card-content">
                    <div class="card-header text-center bg-blue-header">
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
                                <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                    @if ($errors->has('first_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <div class="invalid-feedback-content">
                                                <i class="fas fa-exclamation-circle fa-lg"></i>
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </div>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required>

                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <div class="invalid-feedback-content">
                                                <i class="fas fa-exclamation-circle fa-lg"></i>
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </div>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}">

                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback" role="alert">
                                            <div class="invalid-feedback-content">
                                                <i class="fas fa-exclamation-circle fa-lg"></i>
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </div>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <div class="invalid-feedback-content font-weight-bold">
                                                <i class="fas fa-exclamation-circle fa-lg"></i>{{ $errors->first('email') }}
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
                                            <div class="invalid-feedback-content font">
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

                            <?php 
                                $loginUrl = route('login');
                                $previousUrl="";
                                if (Request::has('previous'))
                                    $previousUrl = old('previous') ?? Request::get('previous');
                                else 
                                    $previousUrl = old('previous') ?? URL::previous();

                                if((stripos($previousUrl,'/login'))||(stripos($previousUrl,'/register')))
                                    $previousUrl ="";
                            ?>

                            <div class="form-group">
                                <input type="hidden" name="previous" value="{{ $previousUrl }}" class="form-control">
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
                    <div class="card-footer bg-blue-footer">
                        <p class="text-center">Already have an account already?
                            <a href="{{$loginUrl . ($previousUrl ? '?previous='.$previousUrl : '')}} " class="login-link">
                                Log in here
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

