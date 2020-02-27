@extends('templates.template')

{{-- CONTENT --}}
@section('body')

    <div class="container my-5">
        <div class="row mb-3">
            <div class="col-sm-12">
                @if (Auth::user()->firstname)
                    <h3>Welcome back {{ Auth::user()->firstname }}</h3>
                    @else
                        <h3>Welcome back {{ Auth::user()->email }}</h3>
                @endif
                <p>Here you can edit your informations</p>
            </div>
        </div>
        <div class="row">
            <div class="d-none d-md-block col-md-3">
                @include('partials.leftSidebarUser')
            </div>
            <div class="col-sm-12 col-md-9">
                <h3 class="mb-3">Your messages</h3>
                <div class="row">
                    <div class="d-none d-sm-block col-md-4">
                        <h6 class="text-uppercase font-weight-bold">Email</h6>
                    </div>
                    <div class="d-none d-sm-block col-md-4">
                        <h6 class="text-uppercase font-weight-bold">Content</h6>
                    </div>
                    <div class="d-none d-sm-block col-md-4">
                        <h6 class="text-uppercase font-weight-bold">Apartment</h6>
                    </div>
                    @foreach ($userMsgs as $userMsg)
                        @foreach ($userMsg as $msg)
                            <div class="col-sm-12 col-md-4 font-weight-bold">
                                {{ $msg->apartment->name }}
                            </div>
                            <div class="col-sm-12 col-md-4">
                                {{ $msg->email_sender }}
                            </div>
                            <div class="col-sm-12 col-md-4">
                                {{ $msg->body }}
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection