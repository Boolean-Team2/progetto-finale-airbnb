@extends('templates.template')

{{-- CONTENT --}}
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
                                        <h5 class="card-title text-capitalize text-success m-0">{{ $apartment->name }}</h5>
                                        @else
                                        <h5 class="card-title text-capitalize text-danger m-0">{{ $apartment->name }}</h5>
                                    @endif
                                    <div class="d-flex">
                                        <a class="ml-2" href="{{ route('account.apartment.edit', $apartment->id) }}"><i class="far fa-edit fa-lg"></i></a>
                                        <a class="ml-2" href="{{ route('apartmet.statistics.show', [Auth::user()->id, $apartment->id]) }}"><i class="fas fa-chart-pie fa-lg"></i></a>
                                        <span style="cursor: pointer;" id="js_showEndTimeAd" class="ml-2 text-success"><i class="fas fa-ad fa-lg"></i></span>
                                        <a class="ml-2 text-muted" href="#" onclick="deleteData({{Auth::user()->id}})" data-toggle="modal" data-target="#DeleteModal"><i class="fas fa-trash-alt fa-lg"></i></a>
                                        <!-- Modal content-->
                                        <div style="z-index: 999999" id="DeleteModal" class="modal fade text-danger mt-5" role="dialog">
                                            <div class="modal-dialog ">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger justify-content-center align-items-center">
                                                        <h4 class="modal-title text-white">DELETE CONFIRMATION</h4>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <span>Are sure you want to delete your this apartment?</span><br>
                                                        <span>The action is <strong>irreversible</strong>!</span><br>
                                                        <span>All sponsorship payments will not be refunded.</span><br>
                                                        <span>All messages and email will no longer be available.</span><br>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-between">
                                                        <a href="#" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                                                        <a href="{{ route('account.apartment.delete', [Auth::user()->id, $apartment->id]) }}" class="btn btn-danger">Confirm</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="js_adEndTime card-text text-center mt-2">
                                    Expiry date: {{ date('d M yy, h:i a', strtotime($apartment->end_time)) }}
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
                                    <div class="d-flex">
                                        <a class="ml-2" href="{{ route('account.apartment.edit', $apartment->id) }}"><i class="far fa-edit fa-lg"></i></a>
                                        <a class="ml-2" href="{{ route('apartmet.statistics.show', [Auth::user()->id, $apartment->id]) }}"><i class="fas fa-chart-pie fa-lg"></i></a>
                                        <a href="{{ route('apartment.sponsor', [Auth::user()->id, $apartment->id]) }}"><span class="ml-1 text-danger"><i class="fas fa-ad fa-lg"></i></span></a>
                                        <a class="ml-2 text-muted" href="{{ route('account.apartment.delete', [Auth::user()->id, $apartment->id]) }}"><i class="fas fa-trash-alt fa-lg"></i></a>
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