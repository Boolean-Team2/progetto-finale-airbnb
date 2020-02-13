@extends('templates.template')

{{-- NAVBAR --}}
<div class="bg-primary">
    @include('partials.navbar')
</div>

{{-- CONTENT --}}
@section('body')
<div class="container my-5 py-5">
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
</div>
<div class="container">
  <div class="row">
    <div class="col-sm-12 col-lg-6">
      <h3> Views number</h3>
      <p id="views">{{$apartment->views}}</p>
      <div class="container">
        <div class="wrap">
          <canvas id="myViews"></canvas> 
        </div>
      </div>
    </div>
    
    <div class="col-sm-12 col-lg-6">
      <h3> Messages number</h3>
      <p id="messages">{{ $apartment->messages->count()}}</p>
      <div class="container">
        <div class="wrap">
          <canvas id="myMessages"></canvas> 
        </div>
      </div>
    </div>
  </div>
</div>


{{-- FOOTER --}}
@include('partials.footer')



<script>
  
  $(document).ready(function() {  

    var views = $("#views").text();
    var ctx = document.getElementById('myViews').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: moment.months(),
            datasets: [{
                label: 'Views',
                data: views,
                backgroundColor: "#fff",
                borderColor: "#fff",
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

    var views = $("#messages").text();
    var ctx = document.getElementById('myMessages').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: moment.months(),
            datasets: [{
                label: 'Messages',
                data: views,
                backgroundColor: "#fff",
                borderColor: "#fff",
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
   });



   
</script>

@endsection

