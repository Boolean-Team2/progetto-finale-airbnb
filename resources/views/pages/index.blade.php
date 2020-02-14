@extends('templates.template')

{{-- CONTENT --}}
@section('body')

<header class="ms_100VhHeader">
    {{-- INCLUDE SCRIPT VUE --}}
    @include('comps.search')

    {{-- INCLUDE NAVBAR --}}
    @include('partials.navbar')

    {{-- SEARCH VUE COMPONENT --}}
    <div id="app" class="container-fluid h-100">
        <div class="row h-75 align-items-center">
            <apartmentsearch></apartmentsearch>
        </div>
    </div>
</header>

<main>    
    <div class="container">
        {{-- PREMIUM APARTMENTS --}}
        <section class="my-5">
            <div class="row">
                <div class="col-sm-12 p-3">
                    <h3>Alloggi Sponsorizzati</h3>
                    <p>Una selezione di alloggi verificati per qualità e design.</p>
                    <div class="d-flex flex-wrap justify-content-between">
                        @foreach ($apartments as $apartment)
                            <div class="card mb-3" style="width: 20rem;">
                                @if ($apartment->img)
                                    <img class="img-fluid" src="{{ asset('assets/images/users/' . $apartment->user_id . "/apartments/" . $apartment->id . "/" . $apartment->img) }}" alt="Card image cap">
                                    @else
                                    <img class="img-fluid" src="{{ asset('assets/images/placeholder.jpg') }}" alt="Card image cap">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize">{{ $apartment->name }}</h5>
                                    <p class="card-text text-capitalize">{{ $apartment->description }}</p>
                                    <a href="{{ route('apartment.show', $apartment->id) }}" class="btn btn-primary">Show details</a>
                                </div>
                                <p>Visibility: {{ $apartment->visibility }}</p>
                            </div>        
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        {{-- /PREMIUM APARTMENTS --}}
        {{-- FREE APARTMENTS --}}
        <section class="my-5">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Alloggi non sponsorizzati</h3>
                    <p>Una selezione di alloggi verificati per qualità e design.</p>
                    <div class="d-flex flex-wrap justify-content-between">
                        @foreach ($apartments as $apartment)
                            <div class="card mb-3" style="width: 20rem;">
                                @if ($apartment->img)
                                    <img class="img-fluid" src="{{ asset('assets/images/users/' . $apartment->user_id . "/apartments/" . $apartment->id . "/" . $apartment->img) }}" alt="Card image cap">
                                    @else
                                    <img class="img-fluid" src="{{ asset('assets/images/placeholder.jpg') }}" alt="Card image cap">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize">{{ $apartment->name }}</h5>
                                    <p class="card-text text-capitalize">{{ $apartment->description }}</p>
                                    <a href="{{ route('apartment.show', $apartment->id) }}" class="btn btn-primary">Show details</a>
                                </div>
                                <p>Visibility: {{ $apartment->visibility }}</p>
                            </div>        
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        {{-- /FREE APARTMENTS --}}
    </div>
</main>

{{-- FOOTER --}}
@include('partials.footer')

@endsection