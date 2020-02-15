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
            {{-- <apartmentsearch></apartmentsearch> --}}
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
                </form>
            </div>
            <div id="map" class="col-sm-12 col-lg-4 offset-md-1 h-100 p-0"></div>
        </div>
    </div>
</header>


<script src='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.45.0/services/services-web.min.js'></script>
<script src="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/1.0.8/SearchBox-web.js"></script>
<script>
    $(document).ready(function() {

        $('#js_search').click(function() {
            var input = $('#js_input').val();
            console.log(input);
            
            search(input);
        });
        function distance(lat1, lon1, lat2, lon2, unit) {
                        if ((lat1 == lat2) && (lon1 == lon2)) {
                            return 0;
                        }
                        else {
                            var radlat1 = Math.PI * lat1/180;
                            var radlat2 = Math.PI * lat2/180;
                            var theta = lon1-lon2;
                            var radtheta = Math.PI * theta/180;
                            var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
                            if (dist > 1) {
                                dist = 1;
                            }
                            dist = Math.acos(dist);
                            dist = dist * 180/Math.PI;
                            dist = dist * 60 * 1.1515;
                            if (unit=="K") { dist = dist * 1.609344 }
                            if (unit=="N") { dist = dist * 0.8684 }
                            return dist;
                        }
        };
        
        // // Mappa
        var location = [11.747475, 48.213205];
        var map = tt.map({
                key: 'UnotVndyZgjPLoXejGGoIUZDc49X2IrU',
                container: 'map',
                style: 'tomtom://vector/1/basic-main',
                center: location,
                zoom: 9,
            });
        map.addControl(new tt.FullscreenControl());
        map.addControl(new tt.NavigationControl());
        function search(input){

            // Chiamata al nostro db che restituisce tutti gli appartamenti
            $.ajax({
                url: "http://localhost:3000/api/apartments/show",
                method: 'GET',
                data: {
                    lat : '11.747475',
                    lng : '48.213205',
                    radius : 20000
                },
                success: function (data) {
                    //console.log(data);
                    var apartments = data.apartments;

                    var popupOffsets = {
                        top: [0, 0],
                        bottom: [0, -70],
                        'bottom-right': [0, -70],
                        'bottom-left': [0, -70],
                        left: [25, -35],
                        right: [-25, -35]
                    };
                    

                    
                    apartments.forEach(apartment => {
                        // getDistanceFromLatLonInKm(48.213205, 11.747475, apartment.latitude, apartment.longitude);
                        
                        console.log(apartment.latitude, apartment.longitude);
                        var distanza = distance(48.213205, 11.747475, apartment.latitude, apartment.longitude, "K");
                        console.log(Math.ceil(distanza));
                        if (distanza <= 20) {
                            var marker = new tt.Marker().setLngLat([apartment.longitude, apartment.latitude]).addTo(map);
                            console.log(apartment.name);
                            
                            
                        }
                        
                        // // var popup = new tt.Popup({offset: popupOffsets}).setHTML(apartment.address);
                        // marker.setPopup(popup).togglePopup();
                    });
                    
                    // tt.services.nearbySearch({
                    // key: 'UnotVndyZgjPLoXejGGoIUZDc49X2IrU',
                    // center: location,
                    // radius: 5000
                    // })
                    // .go()
                    // .then(function(data) {
                    //     console.log(data);
                        
                    //     for (var i = 0; i < data.results.length; i++) {
                    //         console.log(data.results[i].position);
                            
                    //         new tt.Marker().setLngLat(data.results[i].position).addTo(map);
                    //     }
                    // });
                    

                    // const geometryList = [
                    // {
                    //     type: 'CIRCLE',
                    //     position: location,
                    //     radius: 20000
                    // },
                    // ];
                    
                    // tt.services.geometrySearch({
                    //     key: 'UnotVndyZgjPLoXejGGoIUZDc49X2IrU',
                    //     query: '11.747475, 48.213205',
                    //     geometryList: geometryList
                    //     })
                    //     .go()
                    //     .then(function(data) {
                    //     console.log(data);
                        
                        
                    //     console.log(apartments);
                    //     for (var i = 0; i < apartments.length; i++) {
                    //         console.log(apartments[i]);
                            
                    //         //console.log(data.results[i].position);
                    //         var position = {lng: apartments[i].longitude, lat: apartments[i].latitude};
                    //         console.log(position);
                            
                            
                    //         new tt.Marker().setLngLat(position).addTo(map);
                    //     }
                    // });

                    
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