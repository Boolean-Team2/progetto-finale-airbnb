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

    <div class="container">
        <div class="row my-5">
            <div class="col-sm-12">
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