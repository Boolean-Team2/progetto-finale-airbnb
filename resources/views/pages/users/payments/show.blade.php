@extends('templates.template')

@section('body')

    {{-- INCLUDE NAVBAR --}}
    <div class="bg-primary">
        @include('partials.navbar')
    </div>

    {{-- 
        TO DO: 
        Ads attive in verde
        Ads scaute in rosso   
    --}}

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
        <div class="row">
            <div class="col-sm-12">
                <h3 class="mb-3">Your payments</h3>
                @foreach ($user->apartments as $apartment)
                    
                    @foreach ($apartment->ads as $ad)

                        @if (($apartment->ads->count()) > 0)

                            Nome appartamento: {{ $apartment->name }} <br>
                            Sponsorizzazione: {{ $ad->name }} <br>
                            Periodo: da {{ $ad->pivot->start_time }} a {{ $ad->pivot->end_time }} <br>
                            Prezzo: {{ $ad->price }} € <br><br>
                            
                        @endif
                    

                    @endforeach

                @endforeach
            </div>
        </div>
    </div>

    {{-- INCLUDE FOOTER --}}
    @include('partials.footer')
    
@endsection