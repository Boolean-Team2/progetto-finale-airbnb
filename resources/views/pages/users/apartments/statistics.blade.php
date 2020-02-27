@extends('templates.template')

{{-- CONTENT --}}
@section('body')
    <div id="idApp" class="container my-5" data-param={{$apartment -> id}}>
        <div class="row mb-3">
            <div class="col-sm-12">
                @if (Auth::user()->firstname)
                    <h3>Welcome back {{ Auth::user()->firstname }}</h3>
                    @else
                        <h3>Welcome back {{ Auth::user()->email }}</h3>
                @endif
                <p>Here you can edit your informations</p>
            </div>
        </div>
        <div class="row">
            <div class="d-none d-md-block col-md-3">
                @include('partials.leftSidebarUser')
            </div>
            <div class="col-sm-12 col-md-9">
                <div class="row">
                    <div class="col col-lg-6">
                        <h3> Views number</h3>
                        <div class="container">
                            <div class="wrap">
                                <canvas id="myViews"></canvas> 
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-6">
                        <h3> Messages number</h3>
                        <div class="container">
                            <div class="wrap">
                                <canvas id="myMessages"></canvas> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    $(document).ready(function() {  

        var idApp = $('#idApp').attr("data-param");

        // Vies Chart
        $.ajax({
            url: 'http://localhost:3000/api/apartment/viewsStatistic',
            method: 'GET',
            data : {
                'id' : idApp
            },
            success : function(data) {
                printViews(data.viewsForMonth);
            },
            error : function(err) {
                console.log(err);
            },
        });
        // Messages Chart
        $.ajax({
            url: 'http://localhost:3000/api/apartment/msgsStatistic',
            method: 'GET',
            data : {
                'id' : idApp
            },
            success : function(data) {
                printMsgs(data.messagesForMonth);
            },
            error : function(err) {
                console.log(err);
                
            },
        });
        // All functions
        function printViews(data){
            var ctx = document.getElementById('myViews').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: moment.months(),
                    datasets: [{
                        label: 'Views',
                        data: data,
                        backgroundColor: "red",
                        borderColor: "red",
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }
        function printMsgs(data){
            var ctx = document.getElementById('myMessages').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: moment.months(),
                    datasets: [{
                        label: 'Messages',
                        data: data,
                        backgroundColor: "red",
                        borderColor: "red",
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }
    });
</script>

@endsection

