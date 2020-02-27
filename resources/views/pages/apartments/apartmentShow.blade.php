@extends('templates.template')

{{-- CONTENT --}}
@section('body')   
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
                            <h4>Contact me</h4>
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
                    <div id="map" class="mapboxgl-map" style="height: 400px; width: 100%;">
                </div>
            </div>
        </section>
    </div>

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
