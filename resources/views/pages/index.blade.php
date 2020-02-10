@extends('templates.template')

@section('body')
<header class="ms_100VhHeader">
    <nav class="navbar navbar-expand-md navbar-light text-white">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="{{ url('/') }}">
                <i class="fab fa-airbnb display-4"></i>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                            <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @if (Auth::user()->firstname || Auth::user()->lastname)
                                    {{ Auth::user()->firstname }} {{ Auth::user()->lastname }} 
                                    @else
                                        {{ Auth::user()->email }}
                                @endif <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('account.show', Auth::user()->id) }}">
                                    {{ __('My Profile') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
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
    <div class="container-fluid h-100">
        <div class="row h-100 align-items-center">
            <div class="col-sm-12 col-md-3 offset-md-1 bg-white p-3">
                <h1>Prenota alloggi e attività unici.</h2>
                <form>
                    <div class="form-group">
                        <label>Dove</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-6">
                                <label>Check-in</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-6">
                                <label>Check-out</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Ospiti</label>
                        <select class="form-control">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>                    
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Cerca</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</header>
<main>    
    <div class="container-fluid">
        {{-- PREMIUM APARTMENTS --}}
        <section class="my-5">
            <div class="row">
                <div class="col-sm-12 col-md-10 offset-md-1 p-3">
                    <h3>Alloggi Sponsorizzati</h3>
                    <p>Una selezione di alloggi verificati per qualità e design.</p>
                    <div class="d-flex flex-wrap justify-content-between">
                        @foreach ($apartments as $apartment)
                            <div class="card" style="width: 20rem;">
                                <img class="img-fluid" src="https://source.unsplash.com/random/?apartment" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>        
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        {{-- /PREMIUM APARTMENTS --}}
        <section class="my-5">
            {{-- FREE APARTMENTS --}}
            <div class="row">
                <div class="col-sm-12 col-md-10 offset-md-1 p-3">
                    <h3>Alloggi Free</h3>
                    <p>Una selezione di alloggi verificati per qualità e design.</p>
                    <div class="d-flex flex-wrap justify-content-between">
                        @foreach ($apartments as $apartment)
                            <div class="card" style="width: 20rem;">
                                <img class="img-fluid" src="https://source.unsplash.com/random/?apartment" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>        
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- /FREE APARTMENTS --}}
        </section>
    </div>
</main>
@endsection

