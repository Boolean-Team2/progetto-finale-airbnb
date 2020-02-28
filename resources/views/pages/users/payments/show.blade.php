@extends('templates.template')

@section('body')

    {{-- INCLUDE ERRORS/MESSAGES SECTION --}}
    <div class="container-fluid">
        @include('partials.showErrors')
    </div>
    <div class="container-fluid mb-5">
        @include('partials.topSectionUser')
        <div class="row">
            <div class="d-none d-md-block col-md-3 offset-md-1">
                @include('partials.leftSidebarUser')
            </div>
            <div class="col-sm-12 col-md-7">
                <h3 class="mb-4">Your payments</h3>
                <div class="row">
                    <div class="d-none d-sm-block col-md-3">
                        <h6 class="text-uppercase font-weight-bold">Apartment Name</h6>
                    </div>
                    <div class="d-none d-sm-block col-md-1">
                        <h6 class="text-uppercase font-weight-bold">Ad Type</h6>
                    </div>
                    <div class="d-none d-sm-block col-md-2">
                        <h6 class="text-uppercase font-weight-bold">Ad Price</h6>
                    </div>
                    <div class="d-none d-sm-block col-md-5">
                        <h6 class="text-uppercase font-weight-bold">Ad Period</h6>
                    </div>
                    <div class="d-none d-sm-block col-md-1">
                        <h6 class="text-uppercase font-weight-bold">Status</h6>
                    </div>
                    @foreach ($user->apartments as $apartment)
                        @foreach ($apartment->ads as $ad)
                            @if (($apartment->ads->count()) > 0)
                                <div class="col-sm-12 col-md-3 font-weight-bold">
                                    {{ $apartment->name }}
                                </div>
                                <div class="col-sm-12 col-md-1">
                                    {{ $ad->name }}
                                </div>
                                <div class="col-sm-12 col-md-2">
                                    {{ $ad->price }}€
                                </div>
                                <div class="col-sm-12 col-md-5">
                                    from {{ $ad->pivot->start_time }} to {{ $ad->pivot->end_time }}
                                </div>
                                <div class="col-sm-12 col-md-1">
                                    @if($ad->pivot->active == 1)
                                        <span class="text-success" >
                                            <i class="fas fa-toggle-on fa-lg"></i>
                                        </span>
                                        @else
                                        <span class="text-danger" >
                                            <i class="fas fa-toggle-on fa-flip-horizontal fa-lg"></i>
                                        </span>
                                    @endif
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