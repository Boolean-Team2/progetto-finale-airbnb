@extends('templates.template')

{{-- CONTENT --}}
@section('body')

    {{-- INCLUDE ERRORS/MESSAGES SECTION --}}
    <div class="container-fluid">
        @include('partials.showErrors')
    </div>
    
    <div id="idApp" class="container-fluid mb-5" data-param={{$apartment -> id}}>
        @include('partials.topSectionUser')
        <div class="row">
            <div class="d-none d-md-block col-md-3 offset-md-1">
                @include('partials.leftSidebarUser')
            </div>
            <div class="col-sm-12 col-md-7">
                <div class="row">
                    <div class="col col-lg-6">
                        <h3>Views <span class="badge badge-primary">{{ $apartment->views->count() }}</span></h3>
                        <div class="container">
                            <div class="wrap">
                                <canvas id="myViews"></canvas> 
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-6">
                        <h3>Messages <span class="badge badge-primary">{{ $apartment->messages->count() }}</span></h3>
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
                    labels: moment.monthsShort(),
                    datasets: [{
                        label: 'Views',
                        data: data,
                        backgroundColor: "#3490dc",
                        borderColor: "#3490dc",
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
                    labels: moment.monthsShort(),
                    datasets: [{
                        label: 'Messages',
                        data: data,
                        backgroundColor: "#3490dc",
                        borderColor: "#3490dc",
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

