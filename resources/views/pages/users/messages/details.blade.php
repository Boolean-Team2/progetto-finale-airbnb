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
                <h3>Message details</h3>
                <h5>
                    <span class="font-weight-bold">From:</span>
                    <a href="mailto:{{ $msg->email_sender }}"><small>{{ $msg->email_sender }}</small></a>
                </h5>
                <h5>
                    <span class="font-weight-bold">On:</span>
                    <small>{{ date('d M y, h:i a', strtotime($msg->created_at)) }}</small>
                </h5>
                <p>
                    <p>Dear {{ Auth::user()->firstname }},</p>
                    <p class="px-5 font-italic">
                        {{ $msg->body }}
                    </p>
                    <p>Greetings, see you soon!</p>
                </p>
                <div class="text-right">
                    <a class="btn btn-primary" href="{{ route('account.message.changeState', [Auth::user()->id, $msg->id]) }}">Mark as unread</a>
                    <a class="btn btn-primary" href="mailto:{{ $msg->email_sender }}">Reply</a>
                </div>
            </div>
        </div>
    </div>

@endsection