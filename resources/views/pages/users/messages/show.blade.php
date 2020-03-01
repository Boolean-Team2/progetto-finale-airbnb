@extends('templates.template')

{{-- 
    TO DO:
    CONTEGGIO MESSAGGI LETTI E NON    
--}}

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
            <div class="col-sm-12 col-md-7">
                <h3 class="mb-3">Your messages, <span class="badge badge-primary">{{ $unread_msgs }}</span> unread.</h3>
                <div class="row">
                    <div class="d-none d-sm-block col-md-3">
                        <h6 class="text-uppercase font-weight-bold">From</h6>
                    </div>
                    <div class="d-none d-sm-block col-md-3">
                        <h6 class="text-uppercase font-weight-bold">Preview message</h6>
                    </div>
                    <div class="d-none d-sm-block col-md-3">
                        <h6 class="text-uppercase font-weight-bold">Date</h6>
                    </div>
                    <div class="d-none d-sm-block col-md-3">
                        <h6 class="text-uppercase font-weight-bold">Apartment</h6>
                    </div>
                    <hr>
                    @foreach ($userMsgs as $msg)

                        <div class="col-sm-12 col-md-3 @if($msg->is_read == 0) font-weight-bold @endif">
                            <span>{{ $msg->email_sender }}</span>
                        </div>
                        <div class="col-sm-12 col-md-3 @if($msg->is_read == 0) font-weight-bold @endif">
                            <a href="{{ route('account.message.show', [Auth::user()->id, $msg->id]) }}">
                                <p style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">{{ $msg->body }}</p>
                            </a>
                        </div>
                        <div class="col-sm-12 col-md-3 @if($msg->is_read == 0) font-weight-bold @endif">
                            <span>{{ date('d M yy, h:i a', strtotime($msg->created_at)) }}</span>
                        </div>
                        <div class="col-sm-12 col-md-3 @if($msg->is_read == 0) font-weight-bold @endif">
                            <span>{{ $msg->apartment->name }}</span>
                        </div>
                            
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection