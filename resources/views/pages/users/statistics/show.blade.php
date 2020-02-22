@extends('templates.template')

@section('body')

    {{-- NAVBAR --}}
    <div class="bg-primary">
        @include('partials.navbar')
    </div>
    {{-- CONTENT --}}
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="m-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        <div class="row my-4">
            {{-- APARTMENT'S DETAILS LIST --}}
            <div class="col-sm-12">
                <h4>Apartments list</h4>
                @foreach ($userApartments as $userApartment)
                    <input hidden type="text" class="js_nameList" value="{{ $userApartment->name }}">
                    <input hidden type="text" class="js_viewsCount" value="{{ $userApartment->views }}">
                    <input hidden type="text" class="js_msgsCount" value="{{ $userApartment->messages->count() }}">
                    <div class="row">
                        <div class="col-sm-3">
                            <span><i class="fas fa-building"></i></span>
                            <span>{{ $userApartment->name }}</span>
                        </div>
                        <div class="col-sm-3">
                            <span><i class="mr-2 fas fa-eye"></i></span>
                            <span>{{ $userApartment->views }}</span>
                        </div>
                        <div class="col-sm-3">
                            <span><i class="fas fa-envelope"></i></span>
                            <span>{{ $userApartment->messages->count() }}</span>
                        </div>
                        <div class="col-sm-3">
                            <a href="{{ route('apartmet.statistics.show', [Auth::user()->id, $userApartment->id]) }}">Details</a>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- APARTMENT'S VIEWS CHART --}}
            <div class="col-sm-12 col-lg-6 my-5">
                <h4 class="text-center">Views</h4>
                <canvas id="myViews"></canvas>
            </div>
            {{-- APARTMENT'S MESSAGES CHART --}}
            <div class="col-sm-12 col-lg-6 my-5">
                <h4 class="text-center">Messages</h4>
                <canvas id="myMessages"></canvas>
            </div>
        </div>
    </div>
    {{-- CHARTS.JS SCRIPT --}}
    <script>
        $(document).ready(function() {  
            // console.clear();
            var names = [];
            var views = [];
            var msgs = [];
            $('.js_nameList').each( function() {
                names.push($(this).val());
            });
            $('.js_viewsCount').each( function() {
                views.push($(this).val());
            });
            $('.js_msgsCount').each( function() {
                msgs.push($(this).val());
            });
            // console.log("Nomi:", names, "Views:", views, "Msgs:", msgs);
            var ctx = document.getElementById('myViews').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: names,
                    datasets: [{
                        label: "Views per apartment",
                        data: views,
                        backgroundColor: arrayColorList(),
                        borderWidth: 1
                    }]
                }
            });
            var ctx = document.getElementById('myMessages').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: names,
                    datasets: [{
                        label: "Messages per apartment",
                        data: msgs,
                        backgroundColor: arrayColorList(),
                        borderWidth: 1
                    }]
                }
            });
            // Colore random
            function getRandomColor() {
                var letters = '0123456789ABCDEF'.split('');
                var color = '#';
                for (var i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }
            function arrayColorList() {
                var arrayLength = names.length;
                // console.log("Lunghezza", arrayLength);
                var arrayColor = [];

                for (var i=0; i<arrayLength; i++) {
                    arrayColor.push(getRandomColor()); 
                    // console.log(arrayColor);   
                }
                return arrayColor;
            }
        });
    </script>

    {{-- FOOTER --}}
    @include('partials.footer')

@endsection