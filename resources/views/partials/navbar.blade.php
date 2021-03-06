<nav style="z-index: 999999;" class="navbar navbar-expand-md navbar-light bg-white shadow">
    <div class="container-fluid">
        <a class="navbar-brand text-primary" href="{{ url('/') }}">
            <i class="fab fa-airbnb display-4"></i>
        </a>
        <button class="navbar-toggler bg-primary" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if (Auth::user()->firstname || Auth::user()->lastname)
                                {{ Auth::user()->firstname }} {{ Auth::user()->lastname }} 
                                @else
                                    {{ Auth::user()->email }}
                            @endif <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('account.show', Auth::user()->id) }}">
                                {{ __('Profile') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('account.apartments.show', Auth::user()->id) }}">
                                {{ __('Apartments') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('account.statistics.show', Auth::user()->id) }}">
                                {{ __('Statistics') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('user.sponsor.payments', Auth::user()->id) }}">
                                {{ __('Payments') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('account.messages.show', Auth::user()->id) }}">
                                {{ __('Emails') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('chats') }}">
                                {{ __('Chat messages') }}
                            </a>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>            
    </div>
</nav>