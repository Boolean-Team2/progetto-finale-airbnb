@extends('templates.template')

{{-- NAVBAR --}}
<div class="bg-primary">
    @include('partials.navbar')
</div>

{{-- CONTENT --}}
@section('body')

    <div class="container my-5 py-5">
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

    {{-- FOOTER --}}
    @include('partials.footer')

@endsection