{{-- @extends('layouts.app') --}}
@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="loginCard" class="card">
                {{--  --}}
                <div class="card-content">
                        <div class="card-header text-center"><h2>{{ __('Login') }}</h2></div>
                        <div class="card-body">

                            <p class="text-center">New to FoodBack ?
                            <a href="{{route('register')}}" class="register-link"> Register here</a>
                            </p>
                            <p class="text-center">
                                By logging in, you agree to Foodback’s
                                <a href="{{route('legal.terms')}}" target="_blank">Terms of Service</a>
                                ,
                                <a href="{{route('legal.privacy')}}" target="_blank">Privacy Policy</a> and
                                <a href="{{route('legal.cookie')}}" target="_blank">Cookie policy</a>.
                            </p>
                            <h3 class="text-center">Login with</h3>
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
                                    <a class="btn btn-twitter btn-block" href="#">
                                        <i class="fab fa-twitter"></i> Twitter
                                    </a>
                                </div>
                            </div>

                            <h4 class="text-center hr-line">OR</h4>


                            <form method="POST" action="{{ route('login') }}" id="loginForm">
                                @csrf

                                <div class="form-group row">
                                    <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

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

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                {{-- <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <label class="cuisine" for="remember">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <span class="label-text">{{ __('Remember Me') }}</span>
                                        </label>
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <label class="cuisine" for="remember">
                                            <input {{ old('remember') ? 'checked' : '' }} name="remember" type="checkbox"  id="remember" >
                                            <span class="label-text">{{ __('Remember Me') }}</span> 
                                        </label>
                                    </div>
                                </div>

                                {{-- <label class="cuisine" id="Mexican"> 
                                    <input checked="checked" name="cuisines[]" type="checkbox" value="11"> 
                                    <span class="label-text">Mexican</span> 
                                </label> --}}

                                <div class="form-group row mb-0 justify-content-center">
                                    {{-- <div class="col-md-8 offset-md-4"> --}}
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            {{ __('Login') }}
                                        </button>
                                        {{-- <hr>

                                        <a class="btn btn-link font-weight-bold" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a> --}}
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <p class="text-center mb-0">
                                <a class="text-center font-weight-bold" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </p>
                        </div>
                    </div>
                {{--  --}}
            </div>
        </div>
    </div>
</div>
@endsection
