@extends('templates.template')

{{-- CONTENT --}}
@section('body')

<header class="ms_100VhHeader">

    {{-- INCLUDE NAVBAR --}}
    @include('partials.navbar')

    {{-- SEARCH VUE COMPONENT --}}
    <div id="app" class="container-fluid h-100">
        <div class="row h-75 align-items-center">
            <div class="col-sm-12 col-md-10 col-lg-4 offset-md-1 bg-white p-3">
                <h1 class="mb-3">Apartment Search</h1>
                <form>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-9">
                            <input id="js_input" type="text" class="form-control" placeholder="Where do you want to go ?">
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <a id="js_search" type="submit" class="btn btn-primary w-100">Search</a>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-4">
                            <label>Min 1 - Max 100</label>
                            <input id="js_radius" type="range" class="form-control-range">
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label>Stanze</label>
                            <input id="js_rooms" type="number" class="form-control">
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label>Letti</label>
                            <input id="js_beds" type="number" class="form-control">
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="col-sm-12 d-flex">
                            @foreach($services as $service)
                                <span class="d-flex align-items-center mr-3 text-capitalize"><input class="mr-1" name="service" type="checkbox" value="{{ $service->id }}">{{ $service->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </form>
            </div>
            <div id="map" class="col-sm-12 col-lg-4 offset-md-1 h-100 p-0"></div>
        </div>
    </div>
</header>

<script>
    $(document).ready(function() {

        // Prendiamo i valori degli input
        $('#js_search').click(function() {
            var input = $('#js_input').val();
            var radius = $('#js_radius').val();
            var beds = $('#js_beds').val();
            var rooms = $('#js_rooms').val();
            var services = [];
            $.each($("input[name='service']:checked"), function(){
                services.push($(this).val());
            });

            // Cerco..
            search(input, radius, beds, rooms, services);
        });

        // Funzione di ricerca appartamenti
        function search(input, radius, beds, rooms, services){
            console.clear();
            console.log("Ricerca:", input, "Raggio", radius, "Letti", beds, "Stanze", rooms, "Services:", services);
            $.ajax({
                url: "https://api.tomtom.com/search/2/geocode/"+ input +".json",
                method: 'GET',
                data: {
                    limit : 1,
                    key: 'UnotVndyZgjPLoXejGGoIUZDc49X2IrU'
                },
                success: function (data) {
                        // console.log(data);
                        var results = data.results;
                        var lat = results[0].position.lat;                   
                        var lon = results[0].position.lon;
                        // Chiamata al nostro db che restituisce tutti gli appartamenti
                    $.ajax({
                        url: "http://localhost:3000/api/apartments/show",
                        method: 'GET',
                        data: {
                            lat : lat,
                            lon : lon,
                            radius : radius,
                            beds : beds,
                            rooms : rooms,
                            services : services
                        },
                        success: function (data) {
                            console.log("Dati del db:",data);
                        },
                        error: function (error) {
                            alert("Si è verificato un errore", error)
                        }
                    });
                },
                error: function () {
                alert("Si è verificato un errore")
                },
            }); 
        }
    });
</script>

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