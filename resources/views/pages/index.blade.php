@extends('templates.template')

{{-- CONTENT --}}
@section('body')

<header class="ms_100VhHeader">

    {{-- INCLUDE NAVBAR --}}
    @include('partials.navbar')

    {{-- SEARCH --}}
    <div id="app" class="container-fluid h-100">
        <div class="row h-75 align-items-center">
            <div class="col-sm-12 col-md-10 col-lg-4 offset-md-1 bg-white p-3">
                <h1 class="mb-3">Apartment Search</h1>
                <small id="js_alertInput" class="text-danger">* Il campo non può essere vuoto.</small>
                <form>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-9">
                            <input required id="js_input" type="text" class="form-control" placeholder="Where do you want to go ?">
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <a id="js_search" type="submit" class="btn btn-primary w-100">Search</a>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-4">
                            <label class="d-flex justify-content-between">
                                <span>0 km</span>
                                <span id="js_rangeKm">50 km</span>
                                <span>100 km</span>
                            </label>
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
                        <div class="col-sm-12 d-flex justify-content-center flex-wrap">
                            @foreach($services as $service)
                                <span class="d-flex align-items-center mr-3 text-capitalize"><input class="mr-1" name="service" type="checkbox" value="{{ $service->id }}">{{ $service->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</header>

{{-- CDN HANDLEBARS --}}
<script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>
{{-- TEMPLATE HANDLEBARS --}}
<script id="hbApTemplate" type="text/x-handlebars-template">
    <div class="card mb-3" style="width: 20rem;">
        <img class="img-fluid p-1" src="http://localhost:3000/assets/images/users/@{{user_id}}/apartments/@{{id}}/@{{img}}"  alt="Card image cap">
        <div class="card-body">
            <p class="d-flex justify-content-between">
                <a class="text-primary" href="@{{showUrl}}">@{{name}}</a>
            </p>
            <p class="d-flex justify-content-between">
                <span><i class="mr-1 fas fa-bed"></i>@{{beds}}</span>
                <span><i class="mr-1 fas fa-users"></i>@{{rooms}}</span>
                <span><i class="mr-1 fas fa-toilet-paper"></i>@{{baths}}</span>
                <span><i class="mr-1 fas fa-ruler-combined"></i>@{{mq}}</span>
            </p>
            <p>Distanza dalla ricerca: @{{km}} km</p>
        </div>
    </div>
</script>

{{-- AJAX CALL SCRIPT --}}
<script>
    $(document).ready(function() {

        // Nascondo il div dei risultati della ricerca
        $('#js_infoSearch').hide();
        $('#js_alertInput').hide();

        // Stampo il valore del range in pagina
        $('#js_radius').click(function() {
            $('#js_rangeKm').html($('#js_radius').val() + " km");
        });

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
            if(!input == "") {
                search(input, radius, beds, rooms, services);
            } else { // se l'input è vuoto avverto l'utente
                $('#js_alertInput').fadeIn(350);
                setTimeout(() => {
                    $('#js_alertInput').fadeOut(350);
                }, 1500);
            }
        });

        // Funzione di ricerca appartamenti
        function search(input, radius, beds, rooms, services){
            console.clear();
            // console.log("Ricerca:", input, "Raggio", radius, "Letti", beds, "Stanze", rooms, "Services:", services);
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
                            // console.log("Dati del db:",data);
                            printData(data);

                            // Scroll to results
                            scrollToResults();
                        },
                        error: function (error) {
                            console.log("Si è verificato un errore", error);
                        }
                    });
                    // PrintData function
                    function printData(res) {
                        console.log("Devo stampare in pagina:", res);

                        var output = $("#js_hbOutput").html("");
                        var sorgente = $("#hbApTemplate").html();
                        var template = Handlebars.compile(sorgente);
                        var temp;

                        res.apps.forEach(oggetto => {
                            temp = oggetto;

                            var dist = oggetto.km.toFixed(2);
                            temp['km'] = dist;

                            var id = oggetto.id;
                            var routeUrl = '{{ route("apartment.show", ":id") }}';
                            routeUrl = routeUrl.replace(':id', id);
                            temp['showUrl'] = routeUrl;

                            html = template(temp);
                            output.append(html);
                        });
                    }
                    // Scroll to results function
                    function scrollToResults() {
                        $('html,body').animate({
                            scrollTop: $('#js_hbOutput').offset().top
                        },'slow');

                        $('#js_infoSearch').show();
                    }
                    // Fine Chiamata al nostro db che restituisce tutti gli appartamenti
                },
                error: function () {
                    console.log("Si è verificato un errore");
                },
            }); 
        }
    });
</script>

<main>    
    <div class="container-fluid bg-info">
        <section class="my-5 py-3">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="text-center">Alloggi Sponsorizzati</h3>
                    <p class="text-center">Una selezione di alloggi verificati per qualità e design.</p>
                    <div class="d-flex flex-wrap">
                        @foreach ($sponsoredApartments as $apartment)
                            <div class="card mr-2 mb-2" style="width: 20rem;">
                                @if ($apartment->img)
                                    <img class="img-fluid" src="{{ asset('assets/images/users/' . $apartment->user_id . "/apartments/" . $apartment->id . "/" . $apartment->img) }}" alt="Card image cap">
                                    @else
                                    <img class="img-fluid" src="{{ asset('assets/images/placeholder.jpg') }}" alt="Card image cap">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize">{{ $apartment->name }}</h5>
                                    <p class="card-text text-capitalize">{{ $apartment->description }}</p>
                                    <a href="{{ route('apartment.show', $apartment->apartment_id) }}" class="btn btn-primary">Show details</a>
                                </div>
                                <p>Visibility: {{ $apartment->visibility }}</p>
                                <p>Sponsored: {{ $apartment->sponsored }}</p>
                            </div>        
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="container-fluid">
        <div class="row my-5 py-3">
            <div class="col-sm-12">
                <div id="js_infoSearch">
                    <h3 class="text-center">Risultati ricerca</h3>
                    <p class="text-center">Una selezione di alloggi verificati per qualità e design.</p>
                </div>
                {{-- HANDLEBARS OUTPUT --}}
                <div id="js_hbOutput" class="col-sm-12 d-flex flex-wrap justify-content-between">
                </div>
            </div>
        </div>
    </div>
</main>

{{-- FOOTER --}}
@include('partials.footer')

@endsection