@extends('templates.template')

{{-- NAVBAR --}}
<div class="bg-primary">
    @include('partials.header')
</div>

{{-- CONTENT --}}
@section('body')
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
                            <div class="card mb-3" style="width: 20rem;">
                                <img class="img-fluid" src="https://source.unsplash.com/random/?apartment" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize">{{ $apartment->name }}</h5>
                                    <p class="card-text text-capitalize">{{ $apartment->description }}</p>
                                    <a href="#" class="btn btn-primary">Show details</a>
                                </div>
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
                <div class="col-sm-12 col-md-10 offset-md-1 p-3">
                    <h3>Alloggi Free</h3>
                    <p>Una selezione di alloggi verificati per qualità e design.</p>
                    <div class="d-flex flex-wrap justify-content-between">
                        @foreach ($apartments as $apartment)
                            <div class="card mb-3" style="width: 20rem;">
                                <img class="img-fluid" src="https://source.unsplash.com/random/?apartment" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize">{{ $apartment->name }}</h5>
                                    <p class="card-text text-capitalize">{{ $apartment->description }}</p>
                                    <a href="#" class="btn btn-primary">Show details</a>
                                </div>
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