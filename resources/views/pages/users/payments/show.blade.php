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
                <div class="row">
                    <div class="d-none d-sm-block col-md-3">
                        <h6 class="text-uppercase font-weight-bold">Apartment Name</h6>
                    </div>
                    <div class="d-none d-sm-block col-md-2">
                        <h6 class="text-uppercase font-weight-bold">Ad Type</h6>
                    </div>
                    <div class="d-none d-sm-block col-md-2">
                        <h6 class="text-uppercase font-weight-bold">Ad Price</h6>
                    </div>
                    <div class="d-none d-sm-block col-md-5">
                        <h6 class="text-uppercase font-weight-bold">Ad Period</h6>
                    </div>
                    @foreach ($user->apartments as $apartment)
                        @foreach ($apartment->ads as $ad)
                            @if (($apartment->ads->count()) > 0)
                            <div class="col-sm-12 col-md-3 font-weight-bold">
                                {{ $apartment->name }}
                            </div>
                            <div class="col-sm-12 col-md-2">
                                {{ $ad->name }}
                            </div>
                            <div class="col-sm-12 col-md-2">
                                {{ $ad->price }}€
                            </div>
                            <div class="col-sm-12 col-md-5">
                                from {{ $ad->pivot->start_time }} to {{ $ad->pivot->end_time }}
                            </div>
                            @endif
                            @endforeach
                    @endforeach

                </div>
            </div>
        </div>
        <hr>
            <div class="text-right"> Total payments: {{ $result }}€ </div>
        <hr>
    </div>

    {{-- INCLUDE FOOTER --}}
    @include('partials.footer')
    
@endsection