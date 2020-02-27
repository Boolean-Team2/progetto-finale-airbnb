@extends('templates.template')

{{-- CONTENT --}}
@section('body')

    {{-- INCLUDE ERRORS/MESSAGES SECTION --}}
    <div class="container-fluid">
        @include('partials.showErrors')
    </div>
    
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
            <div class="col-sm-12 col-md-7 mt-2 m-md-0">
                <div class="d-flex flex-wrap justify-content-between align-items-start mb-3">
                    <div>
                        <h3>Your apartments</h3>
                    </div>
                    <a href="{{ route('account.apartments.create') }}" class="btn btn-primary">Add new apartment</a>
                </div>
                {{-- Sponsorizzati --}}
                <div class="d-flex flex-wrap justify-content-between">
                    @foreach ($apartmentsAdActive as $apartment)
                        <div class="card mb-3" style="width: 20rem;">
                            @if ($apartment->img)
                                <img class="img-fluid" src="{{ asset('assets/images/users/' . $apartment->user_id . "/apartments/" . $apartment->id . "/" . $apartment->img) }}" alt="Card image cap">
                                @else
                                <img class="img-fluid" src="{{ asset('assets/images/placeholder.jpg') }}" alt="Card image cap">
                            @endif
                            <div class="card-body">
                                <div class="d-flex aling-items-center justify-content-between h-100">
                                    @if ($apartment->visibility === 1)
                                        <h5 class="card-title text-capitalize text-success">{{ $apartment->name }}</h5>
                                        @else
                                        <h5 class="card-title text-capitalize text-danger">{{ $apartment->name }}</h5>
                                    @endif
                                    <div>
                                        <a style="font-size: 1.4rem" class="ml-1" href="{{ route('account.apartment.edit', $apartment->id) }}"><i class="far fa-edit"></i></a>
                                        <a style="font-size: 1.4rem" class="ml-1" href="{{ route('apartmet.statistics.show', [Auth::user()->id, $apartment->id]) }}"><i class="fas fa-chart-pie"></i></a>
                                        <span style="font-size: 1.4rem; cursor: pointer;" id="js_showEndTimeAd" class="ml-1 text-success"><i class="fas fa-ad"></i></span>
                                    </div>
                                </div>
                                <p class="js_adEndTime card-text text-center mt-1">
                                    Ad active until: {{ $apartment->end_time }}
                                </p>
                            </div>
                        </div>        
                    @endforeach
                    {{-- non Sponsorizzati --}}
                    @foreach ($apartmentsAdNotActive as $apartment)
                        <div class="card mb-3" style="width: 20rem;">
                            @if ($apartment->img)
                                <img class="img-fluid" src="{{ asset('assets/images/users/' . $apartment->user_id . "/apartments/" . $apartment->id . "/" . $apartment->img) }}" alt="Card image cap">
                                @else
                                <img class="img-fluid" src="{{ asset('assets/images/placeholder.jpg') }}" alt="Card image cap">
                            @endif
                            <div class="card-body">
                                <div class="d-flex aling-items-center justify-content-between h-100">
                                    @if ($apartment->visibility === 1)
                                        <h5 class="card-title text-capitalize text-success">{{ $apartment->name }}</h5>
                                        @else
                                        <h5 class="card-title text-capitalize text-danger">{{ $apartment->name }}</h5>
                                    @endif
                                    <div>
                                        <a style="font-size: 1.4rem" class="ml-1" href="{{ route('account.apartment.edit', $apartment->id) }}"><i class="far fa-edit"></i></a>
                                        <a style="font-size: 1.4rem" class="ml-1" href="{{ route('apartmet.statistics.show', [Auth::user()->id, $apartment->id]) }}"><i class="fas fa-chart-pie"></i></a>
                                        <a href="{{ route('apartment.sponsor', [Auth::user()->id, $apartment->id]) }}"><span style="font-size: 1.4rem; cursor: pointer;" class="ml-1 text-danger"><i class="fas fa-ad"></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>        
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
@endsection