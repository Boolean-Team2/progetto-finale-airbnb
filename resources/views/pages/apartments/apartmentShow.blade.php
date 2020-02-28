@extends('templates.template')

{{-- CONTENT --}}
@section('body')

    {{-- INCLUDE ERRORS/MESSAGES SECTION --}}
    <div class="container-fluid">
        @include('partials.showErrors')
    </div>

    <div class="container-fluid">
        <section class="my-5">
            <div class="row">
                <div class="col-sm-12 col-md-4 offset-md-1">
                    <h3>{{ $apartment->name }}</h3>
                    <p class="font-italic">{{ $apartment->description }}</p>
                    <p><i class="mr-2 fas fa-map-marker"></i> {{ $apartment->address }}</p>
                    <div>
                        <p class="d-flex align-items-center justify-content-between"> 
                            <span><i class="mr-2 fas fa-ruler-combined"></i>{{ $apartment->mq }}</span>
                            <span><i class="mr-2 fas fa-bed"></i>{{ $apartment->beds }}</span>
                            <span><i class="mr-2 fas fa-toilet-paper"></i>{{ $apartment->baths }}</span>
                            <span><i class="mr-2 fas fa-person-booth"></i>{{ $apartment->rooms }}</span>
                            <span><i class="mr-2 fas fa-eye"></i>{{ $apartment->views->count() }}</span>
                        </p>
                    </div>
                    <hr class="my-4">
                    <h3>Services</h3>
                    @foreach ($apartment->services as $service)
                        <span>{{ $service->name }}</span>
                    @endforeach 
                    <hr class="my-4">
                    <h4>Owner's contacts</h4>
                    <p class="mr-0"><i class="mr-2 fas fa-user"></i>{{ $apartment->user->firstname }} {{ $apartment->user->lastname }}</p>
                    <p class="m-0"><i class="mr-2 fas fa-envelope"></i><a href="mailto:{{ $apartment->user->email }}">{{ $apartment->user->email }}</a></p>
                </div>
                <div class="col-sm-12 col-md-6 text-right">
                    @if ($apartment->img)
                        <img class="img-fluid" src="{{ asset('assets/images/users/' . $apartment->user_id . "/apartments/" . $apartment->id . "/" . $apartment->img) }}" alt="Card image cap">
                        @else
                        <img class="img-fluid" src="{{ asset('assets/images/placeholder.jpg') }}" alt="Card image cap">
                    @endif
                </div>
            </div>
            <div class="row my-5">
                <div class="col-sm-12 col-md-10 offset-md-1">
                    @auth
                        {{-- OWNER SHOW HIS APARTMENT --}}
                        @if (Auth::user()->id === $apartment->user_id)
                            <p class="d-flex align-items-center justify-content-between">
                                <span class="text-success">You're the apartment owner.</span>
                                <a href="{{ route('apartmet.statistics.show', [Auth::user()->id, $apartment->id]) }}" class="btn btn-primary">View all statistics</a>
                            </p>
                            @else
                            {{-- CONTACT FORM FOR GUESTS AND OTHER USERS--}}
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <h4>Use our chats!</h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestias, nisi dolorem? Labore, earum. Quam officia deserunt nobis sapiente perferendis. Adipisci qui veritatis vero doloremque est veniam corrupti ut iste aperiam.</p>
                                    <a class="" href="{{ route('chats') }}">
                                        {{ __('Chat messages') }}
                                    </a>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <h4>Contact me</h4>
                                    <p>Use the form below to send an email to apartment's owner.</p>
                                    <form action="{{ route('sendmail', $apartment -> id) }}" method="post">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group">
                                            @if (Auth::user())
                                                <input type="email" name="email_sender" class="form-control" value="{{ Auth::user()->email }}">
                                                @else
                                                <input type="email" name="email_sender" class="form-control" placeholder="Inserisci e-mail">
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" name="body" placeholder="Dear owner.."></textarea>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-sm-12 col-md-8">
                                                <input class="mr-2" type="checkbox" required><span>Accept terms and conditions</span>
                                            </div>
                                            <div class="col-sm-12 col-md-4 text-right">
                                                <button class="btn btn-primary">Send message</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @else
                    {{-- CONTACT FORM FOR GUESTS AND OTHER USERS--}}
                    <h4>Contact me</h4>
                    <form action="{{ route('sendmail', $apartment -> id) }}" method="post">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <input type="email" name="email_sender" class="form-control" placeholder="Inserisci e-mail">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="body" placeholder="Dear owner.."></textarea>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-12 col-md-8">
                                <input class="mr-2" type="checkbox" required><span>Accept terms and conditions</span>
                            </div>
                            <div class="col-sm-12 col-md-4 text-right">
                                <button class="btn btn-primary">Send message</button>
                            </div>
                        </div>
                    </form>
                    @endauth
                </div>
            </div>
            <div class="row my-5">
                <div class="col-sm-12 col-md-10 offset-md-1">
                    <hr>
                </div>
            </div>
            <div class="row my-5">
                <div class="col-sm-12 col-md-10 offset-md-1">
                    <input hidden id="lon" type="text" value="{{ $apartment -> longitude }}">
                    <input hidden id="lat" type="text" value="{{ $apartment -> latitude }}">
                    <div id="map" class="mapboxgl-map" style="height: 400px; width: 100%;"></div>
                </div>
            </div>
            <div class="row my-5">
                <div class="col-sm-12 col-md-10 offset-md-1">
                    <hr>
                </div>
            </div>
            <div class="row my-5">
                <div class="col-sm-12 col-md-10 offset-md-1">
                    <h4>Near apartments</h4>
                    {{-- HANDLEBARS OUTPUT --}}
                    <div id="js_hbOutput" class="d-flex flex-wrap">
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- CDN HANDLEBARS --}}
    <script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>
    {{-- TEMPLATE HANDLEBARS --}}
    <script id="hbApTemplate" type="text/x-handlebars-template">
        <div class="card mb-3 p-1 mr-3" style="width: 19rem;">
            {{-- debug --}} <img class="img-fluid rounded-top" src="http://localhost:3000/assets/images/placeholder.jpg"  alt="Card image cap"> {{-- debug --}}
            {{-- <img class="img-fluid rounded-top" src="http://localhost:3000/assets/images/users/@{{user_id}}/apartments/@{{id}}/@{{img}}"  alt="Card image cap"> --}}
            <div class="card-body">
                <h5 class="card-title text-center m-0">
                    <a class="text-primary text-capitalize" href="@{{showUrl}}">@{{name}}</a>
                </h5>
            </div>
        </div>
    </script>

    {{-- APPARTAMENTI IN ZONA --}}
    <script>
        $(document).ready(function() {

            // Chiamata al nostro db che restituisce gli appartamenti
            var lat = $('#lat').val();
            var lon = $('#lon').val();            

            $.ajax({
                url: "http://localhost:3000/api/apartments-in-radius",
                method: 'GET',
                data: {
                    lat : lat,
                    lon : lon,
                    radius : 10
                },
                success: function (data) {
                    console.log("Dati del db:",data);
                    printData(data);
                },
                error: function (error) {
                    console.log("Si è verificato un errore", error);
                }
            });

            // PrintData function
            function printData(res) {
                // console.log("Devo stampare in pagina:", res);

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

        }); 
    </script>

    {{-- TOMTOM MAP --}}
    <script>
        $(document).ready(function() {
            var lon = $('#lon').val();
            var lat = $('#lat').val();
            var location = [lon,lat];
            var map = tt.map({
                    key: 'UnotVndyZgjPLoXejGGoIUZDc49X2IrU',
                    container: 'map',
                    style: 'tomtom://vector/1/basic-main',
                    center: location,
                    zoom: 12,
                    radius: 20000
                });
            var marker = new tt.Marker().setLngLat(location).addTo(map);
            map.addControl(new tt.FullscreenControl());
            map.addControl(new tt.NavigationControl());
            });
    </script>

@endsection
