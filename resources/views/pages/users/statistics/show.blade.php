@extends('templates.template')

@section('body')
    {{-- INCLUDE ERRORS/MESSAGES SECTION --}}
    <div class="container-fluid">
        @include('partials.showErrors')
    </div>
    
    {{-- CONTENT --}}
    <div class="container-fluid mb-5">
        @include('partials.topSectionUser')
        <div class="row">
            <div class="d-none d-md-block col-md-3 offset-md-1">
                @include('partials.leftSidebarUser')
            </div>
            <div class="col-sm-12 col-md-7">
                {{-- APARTMENT'S DETAILS LIST --}}
                <div class="col-sm-12">
                    <h3 class="mb-3">Apartments list and charts</h3>
                    @foreach ($userApartments as $userApartment)
                        <div class="row">
                            <div class="col-sm-3">
                                <span><i class="fas fa-building"></i></span>
                                <span class="js_nameList">{{ $userApartment->name }}</span>
                            </div>
                            <div class="col-sm-3">
                                <span><i class="mr-2 fas fa-eye"></i></span>
                                <span class="js_viewsCount">{{ $userApartment->views->count() }}</span>
                            </div>
                            <div class="col-sm-3">
                                <span><i class="fas fa-envelope"></i></span>
                                <span class="js_msgsCount">{{ $userApartment->messages->count() }}</span>
                            </div>
                            <div class="col-sm-3">
                                <a href="{{ route('apartmet.statistics.show', [Auth::user()->id, $userApartment->id]) }}">Details</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
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
                names.push($(this).text());
            });
            $('.js_viewsCount').each( function() {
                views.push($(this).text());
            });
            $('.js_msgsCount').each( function() {
                msgs.push($(this).text());
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

@endsection