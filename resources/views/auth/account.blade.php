@extends('layouts.master')

@section('meta')
    <meta name="description" content="account">
    @overwrite
@section('title', 'Account')

@section('content')
{{-- {{$myTitle}} --}}

<style>



.accountNav,
.accountMain{
        border:solid 1px #000
    }

    .avatar-box{
        border:solid 1px #000;
        width:80%;
        height:auto;
        margin-left:auto;
        margin-right:auto;
        /* height:100px; */
        max-width:150px;
    }


    .avatar{
        border-radius:50%;
        width:100%;
        padding-bottom:100%;
        background:red;
    }


    .avatar-name-box 
    {
        display:flex;
        align-items: center;
        justify-content: center;
    }


    header{
        margin-left:-15px;
        margin-right:-15px;
        border-bottom:solid 1px #000;
    }

    .accountMain form
    {
        margin-left:-15px;
        margin-right:-15px;
    }

</style>
{{-- <div class="container"> --}}
    <div class="row justify-content-center">
        <div class="col-sm-10 col-md-8" style="background:white;">
            <div class="row">
                <div class="col-md-4 accountNav">
                    <div class='row'>
                        <div class='col-5 col-md-12'>
                            <div class='avatar-box my-2 py-2 px-2'>
                                <div class='avatar'>

                                </div>
                            </div>
                        </div>
                        <div class='col-7 col-md-12 avatar-name-box'>
                            <h2 class="text-center">{{auth::user()->name}}</h2>
                        </div>
                    </div>
                    {{-- buttton open and close menu --}}
                    {{-- Google Nexus Website Menu --}}
                    <ul>
                        <li>Profile <i class="far fa-id-card"></i></li>
                        <li>Photo <i class="fas fa-file-image"></i></li>
                        <li>Password <i class="fas fa-key"></i></li>
                        <li>Restaurants <i class="far fa-building"></i></li>
                        <li>Reviews <i class="far fa-comment"></i></li>
                        <li>Privacy <i class="fas fa-lock"></i></li>
                        <li>Close Account <i class="fas fa-trash-alt"></i></li>

                    </ul>


                </div>
                
                <div class="col-md-8 accountMain">
                    <header >
                        <h2 class='text-center'> Public Profile </h2>
                        <p class='text-center'>Add information about yourself</p>
                    </header>
                    <form method="POST" action="{{ route('login') }}" id="loginForm">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">
                                {{-- {{ __('Name') }} --}}
                                First Name
                            </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name')?? auth::user()->name }}">

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

                        {{--  --}}
                        <div class="form-group row">
                                <label for="lastname" class="col-md-4 col-form-label text-md-right">
                                    {{-- {{ __('Name') }} --}}
                                    Last Name
                                </label>
    
                                <div class="col-md-6">
                                    <input id="lastname" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="lastname" value="">
    
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
                        {{--  --}}

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">
                                {{-- {{ __('E-Mail Address') }} --}}
                                Email
                            </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email')?? auth::user()->email}}">

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
                                <label for="email" class="col-sm-4 col-form-label text-md-right">
                                    {{-- {{ __('E-Mail Address') }} --}}
                                    Profession
                                </label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email')?? auth::user()->email}}">
    
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
                                    <label for="email" class="col-sm-4 col-form-label text-md-right">
                                        {{-- {{ __('E-Mail Address') }} --}}
                                        Biography
                                    </label>
        
                                    <div class="col-md-6">
                                        {{-- <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email')?? auth::user()->email}}" required autofocus> --}}
                                        <textarea class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="" value="{{ old('email')?? auth::user()->email}}">
                                        </textarea>
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
                    </form>

                </div>
            </div>
        </div>
    </div>
{{-- </div> --}}

@endsection