<nav class="navbar navbar-expand navbar-light navbar-laravel-light top-row-navbar">
        <div class="container">
            <h1>
                <a class="navbar-brand" href="{{route('root')}}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </h1>
            <div class="attr-nav">
            @guest
                <ul class="navbar-nav x">
                    <li class="nav-item">
                        <a class="nav-link" id='nav-login' href="{{ route('login') }}">{{ __('Login') }}</a>
                        {{-- <a href="{{ route('login') . '?previous=' . Request::fullUrl() }}">Login</a> --}}
                    </li>
    
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" id='nav-register' href="{{ route('register') }}">
                            {{-- {{ __('Register') }} --}}Sign Up
                        </a>
                    </li>
                @endif
                </ul>
            @else
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <span id="accountName">{{ Auth::user()->name }}</span>
                            <span class="caret"></span>
                        </a>
    
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('account')}}">
                                Account
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();"
                                            >
                            {{ __('Logout') }}
                            </a>
    
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class=".d-none">
                                @csrf
                                {{--  --}}
                                {{-- Pass current url  --}}
                                    <input type="hidden" name="previous" value="{{ URL::full() }}">
                                {{--  --}}
                            </form>
                        </div>
                    </li>
                </ul>
                @endguest
            </div>
        </div>
    </nav>
        
        