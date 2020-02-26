@extends('templates.template')

{{-- NAVBAR --}}
<div class="bg-primary">
    @include('partials.navbar')
</div>

{{-- CONTENT --}}
@section('body')
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
            <div class="col-sm-12 col-md-9 mt-2 m-md-0">
                <h3>Your informations</h3>
                <form action="{{ route('account.edit', Auth::user()->id) }}" method="post">
                    <input id="mjs_user" type="hidden" value="{{ Auth::user()->id }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-row mb-2">
                        <div class="col-4">
                            <label for="firstname">Firstname</label>
                            <input type="text" class="form-control" name="firstname" value="{{ Auth::user()->firstname}}">
                        </div>
                        <div class="col-4">
                            <label for="lastname">Lastname</label>
                            <input type="text" class="form-control" name="lastname" value="{{ Auth::user()->lastname}}">
                        </div>
                        <div class="col-4">
                            <label for="date_of_birth">Date of birth</label>
                            <input type="date" class="form-control" name="date_of_birth" value="{{ Auth::user()->date_of_birth}}">
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="col-12">
                            <label for="email">Email address</label>
                            <input type="text" class="form-control" name="email" value="{{ Auth::user()->email}}">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end my-3">
                        <button type="submit" class="my-2 my-md-0 btn btn-success">Edit informations <i class="fas fa-edit"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{{-- FOOTER --}}
@include('partials.footer')
@endsection