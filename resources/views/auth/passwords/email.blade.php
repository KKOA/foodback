{{-- @extends('layouts.app') --}}
@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="resetPasswordCard" class="card">
                <div class="card-content">
                    <div class="card-header text-center bg-blue-header"><h2>{{ __('Reset Password') }}</h2></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer bg-blue-footer">
                            <?php 
                            $loginUrl = route('login');
                            $registerUrl = route('register');
                            $previousUrl="";
                            if (Request::has('previous'))
                                $previousUrl = old('previous') ?? Request::get('previous');
                            else 
                                $previousUrl = old('previous') ?? URL::previous();

                            if((stripos($previousUrl,'/login'))||(stripos($previousUrl,'/register')))
                                $previousUrl ="";
                        ?>
                        
                        
                        <p class="text-center">
                            {{-- <a class="text-center font-weight-bold" href="{{ route('login') }}"> --}}
                            <a href="{{$loginUrl . ($previousUrl ? '?previous='.$previousUrl : '')}} " class="login-link text-center font-weight-bold">
                            Just remembered? Log in here    
                            {{-- {{ __('Forgot Your Password?') }} --}}
                            </a>
                        </p>
                        <p class="text-center mb-0">
                            <a class="text-center font-weight-bold" href="{{$registerUrl . ($previousUrl ? '?previous='.$previousUrl : '')}}">
                                Do not have an account? Register here 
                                {{-- {{ __('Forgot Your Password?') }} --}}
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
