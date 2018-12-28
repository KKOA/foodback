<nav class="navbar navbar-expand-md navbar-dark navbar-laravel-dark bottom-row-navbar">
    <div class="container">
        <button id="help" class="navbar-toggler hamburger hamburger--minus" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav nav-fill ml-auto mr-auto" style="width: 100%!important;">
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="{{route('about')}}" id="aboutDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-info-circle"></i> About
                    </a>
                    <div class="dropdown-menu" aria-labelledby="aboutDropdown">
                        <a class="dropdown-item" href="{{route('about')}}">
                            <i class="fas fa-info"></i> About topics
                        </a>
                        <a class="dropdown-item" href="{{route('about.history')}}">
                            <i class="fas fa-history"></i> History
                        </a>
                        <a class="dropdown-item" href="{{route('about.team')}}">
                            <i class="fas fa-users"></i> Team
                        </a>
                    </div>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{route('restaurants.index')}}" >
                            <i class="fas fa-utensils"></i> Restaurants
                    </a>
                </li>
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" href="{{route('support')}}" id="supportDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-life-ring"></i> Support
                    </a>
                    <div class="dropdown-menu" aria-labelledby="supportDropdown">
                        <a class="dropdown-item" href="{{route('support')}}">
                            <i class="fas fa-life-ring"></i> Support topics
                        </a>
                        <a class="dropdown-item" href="{{route('support.contact')}}">
                            <i class="fas fa-envelope"></i> Contact
                        </a>
                        <a class="dropdown-item" href="{{route('support.faqs')}}">
                            <i class="fas fa-question"></i> FAQs
                        </a>
                    </div>
                </li>
                @guest
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{route('login')}}" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-circle"></i> Account
                        </a>
                        <div class="dropdown-menu" aria-labelledby="aboutDropdown">
                            <a class="dropdown-item" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </a>
                            <a class="dropdown-item" href="{{ route('register') }}">
                                <i class="fas fa-user-plus"></i> Sign Up
                            </a>
                        </div>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <span id="accountName">{{ Auth::user()->name }}</span>
                            <span class="caret"></span>
                        </a>
    
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('account')}}">
                                    Your Account
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class=".d-none">
                                    @csrf
                                    {{--  --}}
                                    {{-- Pass current url  --}}
                                        <input type="hidden" name="previous" value="{{ URL::full() }}">
                                    {{--  --}}
                            </form>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();"
                                                >
                                {{ __('Logout') }}
                            </a>
    

                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>