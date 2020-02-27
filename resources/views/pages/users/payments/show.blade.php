@extends('templates.template')

@section('body')

    {{-- 
        TO DO: 
        Ads attive in verde
        Ads scaute in rosso   
    --}}

    <div class="container-fluid mb-5">
        <div class="row mb-3">
            <div class="col-sm-12 col-md-10 offset-md-1">
                @if (Auth::user()->firstname)
                    <h3>Welcome back {{ Auth::user()->firstname }}</h3>
                    @else
                        <h3>Welcome back {{ Auth::user()->email }}</h3>
                @endif
                <p>Here you can edit your informations</p>
            </div>
        </div>
        <div class="row">
            <div class="d-none d-md-block col-md-3 offset-md-1">
                @include('partials.leftSidebarUser')
            </div>
            <div class="col-sm-12 col-md-7">
                <h3 class="mb-4">Your payments</h3>
                <div class="row">
                    <div class="d-none d-sm-block col-md-4">
                        <h6 class="text-uppercase font-weight-bold">Apartment Name</h6>
                    </div>
                    <div class="d-none d-sm-block col-md-1">
                        <h6 class="text-uppercase font-weight-bold">Ad Type</h6>
                    </div>
                    <div class="d-none d-sm-block col-md-2">
                        <h6 class="text-uppercase font-weight-bold">Ad Price</h6>
                    </div>
                    <div class="d-none d-sm-block col-md-4">
                        <h6 class="text-uppercase font-weight-bold">Ad Period</h6>
                    </div>
                    @foreach ($user->apartments as $apartment)
                        @foreach ($apartment->ads as $ad)
                            @if (($apartment->ads->count()) > 0)
                            <div class="col-sm-12 col-md-4 font-weight-bold">
                                {{ $apartment->name }}
                            </div>
                            <div class="col-sm-12 col-md-1">
                                {{ $ad->name }}
                            </div>
                            <div class="col-sm-12 col-md-2">
                                {{ $ad->price }}€
                            </div>
                            <div class="col-sm-12 col-md-4">
                                from {{ $ad->pivot->start_time }} to {{ $ad->pivot->end_time }}
                            </div>
                            @endif
                        @endforeach
                    @endforeach
                </div>
                <hr>
                    <div class="text-right text-uppercase font-weight-bold"> Total: {{ $result }}€ </div>
                <hr>
            </div>
        </div>
    </div>
    
@endsection